function resolveApiBase() {
  const host = window.location.hostname;
  const origin = window.location.origin;
  const port = window.location.port;
  const backendProto = window.location.protocol === "https:" ? "https" : "http";

  // Local dev (XAMPP): serve frontend from /webProjectBackend/frontend-coders-journey
  // and call backend shims at /webProjectBackend/actions/* on the same origin.
  if (host === "localhost" || host === "127.0.0.1") {
    // If you're viewing the static HTML via a dev server like VS Code Live Server
    // (commonly port 5500), that server cannot execute PHP.
    // In that case, still send API calls to Apache/PHP on the default port.
    if (port && port !== "80" && port !== "443") {
      return `${backendProto}://${host}/webProjectBackend`;
    }

    return `${origin}/webProjectBackend`;
  }

  // Production (GitHub Pages/custom domain): always call the dedicated API host.
  if (
    host === "codersjourney.space" ||
    host === "www.codersjourney.space" ||
    host.endsWith(".github.io")
  ) {
    return "https://api.codersjourney.space";
  }

  // Safe default: prefer the API host rather than assuming /webProjectBackend exists.
  return "https://api.codersjourney.space";
}

export const API_BASE = resolveApiBase();

export function toUrlEncoded(formDataOrObject) {
  if (formDataOrObject instanceof FormData) {
    return new URLSearchParams(formDataOrObject);
  }
  return new URLSearchParams(formDataOrObject);
}

export async function apiFetch(path, options = {}) {
  const init = { ...options };

  // If caller passes a plain object as body, encode it like a classic PHP form POST.
  if (
    init.body &&
    typeof init.body === "object" &&
    !(init.body instanceof FormData) &&
    !(init.body instanceof URLSearchParams) &&
    !(init.body instanceof Blob)
  ) {
    init.body = new URLSearchParams(init.body);
    init.headers = {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      ...(init.headers || {}),
    };
  }

  const isAbsoluteUrl = /^https?:\/\//i.test(String(path));
  const url = isAbsoluteUrl
    ? String(path)
    : path && String(path).startsWith("/")
      ? API_BASE + String(path)
      : `${API_BASE}/${String(path ?? "")}`;

  const res = await fetch(url, {
    credentials: "include",
    ...init,
  });

  const text = await res.text();
  let data;
  try {
    data = text ? JSON.parse(text) : null;
  } catch {
    data = text;
  }

  if (!res.ok) {
    const isObj = data && typeof data === "object";
    const errFromJson = isObj && data.error ? String(data.error) : "";
    const detailFromJson = isObj && data.detail ? String(data.detail) : "";
    const snippet = typeof data === "string" ? data.slice(0, 180) : "";

    const detail = errFromJson || detailFromJson || snippet || res.statusText || "Request failed";
    throw new Error(`${res.status} ${detail} (${path})`);
  }

  return data;
}

export function escapeHtml(input) {
  return String(input ?? "").replace(/[&<>"']/g, (m) => ({
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#039;",
  })[m]);
}

export function getQueryParam(name) {
  return new URLSearchParams(window.location.search).get(name);
}
