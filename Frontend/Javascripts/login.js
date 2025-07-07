import { userLogin } from "./api.js";

const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = e.target.email.value.trim();
  const password = e.target.password.value.trim();
  const errorElem = document.getElementById("loginError");
  errorElem.textContent = "";

  try {
    const res = await userLogin(email, password);
        if (res.status === 200) {
          const User = res.data[0]; 
          localStorage.setItem("adminLoggedIn", "true"); 
          localStorage.setItem("UserId", User[0]);
          localStorage.setItem("UserName", User[1]);

      window.location.href = "home.html";
    } else {
      errorElem.textContent = res.error || "Invalid credentials";
    }
  } catch (err) {
    errorElem.textContent = "Network error";
  }
});
