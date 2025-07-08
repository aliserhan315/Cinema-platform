import { userLogin } from "./api";

const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = e.target.email.value.trim();
  const password = e.target.password.value.trim();
  const errorElem = document.getElementById("LoginError");


  try {
    const res = await userLogin(email, password);
    if (res.status === 200) {
      const admin = res.data[0]; 
      localStorage.setItem("userLoggedIn", "true"); 
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
