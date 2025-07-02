import { createFilm } from "./api.js";

const form = document.getElementById("addMovieForm");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const formData = new FormData(form);
  const filmData = Object.fromEntries(formData.entries());

  
  filmData.duration = Number(filmData.duration) || 0;
  filmData.age_restriction = filmData.age_restriction ? Number(filmData.age_restriction) : null;

  try {
    const res = await createFilm(filmData);
    if (res.status === 201 || !res.error) {
      alert("Film added successfully!");
      form.reset();
    } else {
      alert("Failed to add film: " + (res.error || JSON.stringify(res)));
    }
  } catch (err) {
    alert("Error: " + err.message);
  }
});
