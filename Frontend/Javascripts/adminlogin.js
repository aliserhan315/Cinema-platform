import { adminLogin } from "./api.js";

const adminLoginForm = document.getElementById("adminLoginForm");

adminLoginForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = e.target.adminEmail.value.trim();
  const password = e.target.adminPassword.value.trim();
  const errorElem = document.getElementById("adminLoginError");


  try {
    const res = await adminLogin(email, password);
    if (res.status === 200) {
      const admin = res.data[0]; 
      localStorage.setItem("adminLoggedIn", "true"); 
      localStorage.setItem("adminId", admin[0]);
      localStorage.setItem("adminName", admin[1]);

   
      window.location.href = "admin.html";
    } else {
       "Invalid credentials";
    }
  } catch (error) {
    console.error("Login error:", error);
    
  }
});
