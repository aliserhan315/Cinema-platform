import { fetchFilms } from "./api.js";


async function loadMovies() {
  const response = await fetchFilms();
  if (response.status === 200) {
    const movies = response.films;
    console.log(movies); 
  } else {
    console.error("Failed to fetch movies");
  }
}

loadMovies();

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
    card.style.backgroundImage = `url('${f.poster_image}')`;
    card.innerHTML = `
      <div class="movie-info">
        <h3 class="movie-title">${f.title}</h3>
       
      </div>
    `;
    card.onclick = () => {
      localStorage.setItem("selectedFilmId", f.id);
      window.location.href = "../pages/adminFilmView.html";
    };
    grid.appendChild(card);
  });
}
  


search.addEventListener("input", e => {
  const q = e.target.value.toLowerCase();
  render(films.filter(f => f.title.toLowerCase().includes(q)|| f.description.toLowerCase().includes(q)));
});

document.getElementById("logoutBtn").onclick = () => {
  localStorage.clear();
  window.location.href = "login.html";
};
document.getElementById("addMovieBtn").onclick = () => {
  
  window.location.href = "../pages/addmovie.html";
};




load();
