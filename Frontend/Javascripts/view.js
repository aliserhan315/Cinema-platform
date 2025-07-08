import { fetchFilms } from "./api.js";

const grid = document.querySelector(".movie-grid"); 

const params = new URLSearchParams(window.location.search);
const filmId = params.get("title");


document.getElementById("bookBtn").onclick = () => {
  window.location.href = "../pages/seat.html";
};
         

(async () => {
  try {
    const res = await fetchFilms();
    console.log("Fetched Films:", res);

    const films = res.data;

    const selectedFilm = films.find(f => f.title == filmId);
    if (!selectedFilm) {
      console.error("Film not found");
      return;
    }

    console.log("Selected Film:", selectedFilm);

    document.querySelector(".detail-container").style.backgroundImage = `url('${selectedFilm.background_image}')`;
    document.getElementById("poster").src = selectedFilm.poster_image;
    document.getElementById("title").textContent = selectedFilm.title;
    document.getElementById("description").textContent = selectedFilm.description || '';
    document.getElementById("releaseDate").textContent = `Release Date: ${selectedFilm.release_date}`;
    document.getElementById("rating").textContent = `Rating: ${selectedFilm.rating} stars`;
    document.getElementById("duration").textContent = `Duration: ${selectedFilm.duration} minutes`;


  } catch (err) {
    console.error("Failed to load film details", err);
  }
})();
// document.getElementById("logoutBtn").onclick = () => {
//   localStorage.clear();
//   window.location.href = "login.html";
// };