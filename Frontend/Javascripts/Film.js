

function createFilmObject(data) {
  return {
    id: data.id || null,
    title: data.title || "",
    description: data.description || "",
    release_date: data.release_date || "",
    rating: data.rating || "",
    duration: data.duration || 0,
    trailer_url: data.trailer_url || "",
    poster_image: data.poster_image || "",
    background_image: data.background_image || "",
    age_restriction: data.age_restriction || null,
  };
}
let allFilms = [];

export async function loadAllFilms() {
  try {
    const response = await fetchFilms();
    allFilms = response.films.map(createFilmObject); 
    return allFilms;
  } catch (err) {
    console.error("Failed to load films", err);
  }
}