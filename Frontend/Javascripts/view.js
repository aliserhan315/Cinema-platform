import { loadAllFilms } from "./Film.js";


 const params = new URLSearchParams(window.location.search);
 const filmId=  params.get("id");
 console.log(filmId);
  document.getElementById("bookBtn").onclick = () => {
  localStorage.setItem("selectedFilmId", filmId);
  window.location.href = "../pages/seat.html";
  };


(async () => {



  const res = await fetchFilms();
  const f =allFilms.find(f => f.id == filmId);
  console.log(f);
  if (!f) return;

  document.querySelector(".detail-container").style.backgroundImage = `url('${f.background_image}')`;
  document.getElementById("poster").src = f.poster_image;
  document.getElementById("title").textContent = f.title;
  document.getElementById("description").textContent = f.description || '';
 
  
});
