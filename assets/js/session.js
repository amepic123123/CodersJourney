import { apiFetch } from "./api.js?v=202512291200";

// This endpoint does not exist in your current backend yet.
// You said you'll adjust your backend to match his endpoints, so implement:
// GET /actions/session.php  -> { logged_in: boolean, user_id?: number, username?: string }
export async function getSession() {
  try {
    return await apiFetch("/actions/session.php");
  } catch {
    return { logged_in: false };
  }
}

export async function renderNavAuth() {
  const el = document.getElementById("nav-auth");
  if (!el) return;

  const session = await getSession();
  if (session && session.logged_in) {
    el.innerHTML = `
      <a href="profile.html" class="btn btn-primary">Profile</a>
      <a href="logout.html" class="btn btn-primary">Logout</a>
    `;
  } else {
    el.innerHTML = `
      <a href="login.html" class="btn btn-primary">Log In</a>
      <a href="register.html" class="btn btn-primary">Sign Up</a>
    `;
  }
}
