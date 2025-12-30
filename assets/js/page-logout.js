import { apiFetch } from "./api.js";

const statusEl = document.getElementById("logout-status");

(async () => {
  try {
    await apiFetch("/api/auth/logout", { method: "POST" });
    statusEl.textContent = "Logged out.";
  } catch {
    // Even if backend endpoint isn't ready yet, take user back home.
    statusEl.textContent = "Done.";
  }

  setTimeout(() => {
    window.location.href = "index.html";
  }, 400);
})();
