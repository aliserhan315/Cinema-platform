import { fetchFilmsname } from "./api.js";

const grid = document.querySelector(".movie-grid"); 

const params = new URLSearchParams(window.location.search);
const filmname = params.get("title");


document.getElementById("bookBtn").onclick = () => {
  window.location.href = "../pages/seat.html";
};
         

(async () => {
  try {
    const res = await fetchFilmsname(filmname);
   
    console.log("Fetched Films:", res);

    const films = res.data;

  let selectedfilm = films.find(film => film.title === filmname);
    if (!films) {
      console.error("Film not found");
      return;
    }

  

    document.querySelector(".detail-container").style.backgroundImage = `url('${selectedfilm.background_image}')`;
    document.getElementById("poster").src = selectedfilm.poster_image;
    document.getElementById("title").textContent = selectedfilm.title;
    document.getElementById("description").textContent = selectedfilm.description || '';
    document.getElementById("releaseDate").textContent = `Release Date: ${selectedfilm.release_date}`;
    document.getElementById("rating").textContent = `Rating: ${selectedfilm.rating} stars`;
    document.getElementById("duration").textContent = `Duration: ${selectedfilm.duration} minutes`;


  } catch (err) {
    console.error("Failed to load film details", err);
  }
})();
// document.getElementById("logoutBtn").onclick = () => {
//   localStorage.clear();
//   window.location.href = "login.html";
// };