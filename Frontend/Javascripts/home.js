import { fetchFilms } from "./api.js";

const grid = document.querySelector(".movie-grid");
const search = document.getElementById("searchInput");
let films = [];

async function load() {
  grid.textContent = "Loading...";
  try {
    const res = await fetchFilms();
    films = res.films;
    render(films);
  } catch {
    grid.textContent = "Failed to load.";
  }
}

function render(arr) {
  grid.innerHTML = "";
  arr.forEach(f => {
    const card = document.createElement("div");
    card.className = "movie-card";
    card.innerHTML = `
      <img src="${f[4]}" class="movie-poster" alt="${f[1]}">
      <div class="movie-info">
        <h3 class="movie-title">${f[1]}</h3>
        <p class="movie-desc">${f[2] || ''}</p>
      </div>`;
    card.onclick = () => {
      localStorage.setItem("selectedFilmId", f[0]);
      window.location.href = "view.html";
    };
    grid.appendChild(card);
  });
  
}


search.addEventListener("input", e => {
  const q = e.target.value.toLowerCase();
  render(films.filter(f => f[1].toLowerCase().includes(q)));
});

document.getElementById("logoutBtn").onclick = () => {
  localStorage.clear();
  window.location.href = "login.html";
};




load();
