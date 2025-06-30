import { fetchFilms } from "./api.js";

(async () => {
  const id = localStorage.getItem("selectedFilmId");
  if (!id) return window.location.href = "home.html";

  const res = await fetchFilms();
  const f = res.films.find(f => f[0] == id);
  if (!f) return;

  document.querySelector(".detail-container").style.backgroundImage = `url('${f[4]}')`;
  document.getElementById("poster").src = f[4];
  document.getElementById("title").textContent = f[1];
  document.getElementById("description").textContent = f[2] || '';
  document.getElementById("bookBtn").onclick = () => {
  localStorage.setItem("selectedFilmId", id);
  window.location.href = "../pages/seat.html";
  };
  
});
