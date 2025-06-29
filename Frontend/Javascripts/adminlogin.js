import { adminLogin } from "./api.js";

const adminLoginForm = document.getElementById("adminLoginForm");

adminLoginForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = e.target.adminEmail.value.trim();
  const password = e.target.adminPassword.value.trim();
  const errorElem = document.getElementById("adminLoginError");
  errorElem.textContent = "";

  try {
    const res = await adminLogin(email, password);
    if (res.status === 200) {
      localStorage.setItem("adminLoggedIn", "true");
      localStorage.setItem("adminToken", res.token); 
      localStorage.setItem("adminId", res.admin.id);
      localStorage.setItem("adminName", res.admin.name);

   
      window.location.href = "admin.html";
    } else {
      errorElem.textContent = res.error || "Invalid credentials";
    }
  } catch (err) {
    errorElem.textContent = "Network error";
  }
});
