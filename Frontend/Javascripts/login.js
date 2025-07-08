import { userLogin } from "./api.js";

const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = e.target.adminEmail.value.trim();
  const password = e.target.adminPassword.value.trim();
  const errorElem = document.getElementById("LoginError");


  try {
    const res = await userLogin(email, password);
    if (res.status === 200) {
      const admin = res.data[0]; 
      localStorage.setItem("LoggedIn", "true"); 
      localStorage.setItem("UserId", admin[0]);
      localStorage.setItem("UserName", admin[1]);

   
      window.location.href = "home.html";
    } else {
       "Invalid credentials";
    }
  } catch (error) {
    console.error("Login error:", error);
    
  }
});
