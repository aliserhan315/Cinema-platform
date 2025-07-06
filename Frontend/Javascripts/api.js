const API_BASE = "http://localhost/Projects/cinema-platform/Backend";

async function apiFetch(path, method = "GET", body = null) {
  const headers = {
    "Content-Type": "application/json",
  };


  const response = await fetch(`${API_BASE}/${path}`, {
    method,
    headers,
    body: body ? JSON.stringify(body) : null,
  });

  try {
    return await response.json();
  } catch {
    return { status: response.status, error: "Invalid JSON response" };
  }
}

export async function userLogin(email, password) {
  return apiFetch("/login", "POST", { email, password });
}

export async function adminLogin(email, password) {
  return apiFetch("/admin", "POST", { email, password });
}

export async function createUser(userData) {
  return apiFetch("/register", "POST", userData);
}

export async function getUsers() {
  return apiFetch("/users", "GET");
}

export async function updateUser(userId, userData ) {
  return apiFetch(`/users?id=${userId}`, "PUT", userData );
}

export async function fetchFilms() {
  return apiFetch("/films", "GET");
}

export async function createFilm(filmData) {
  return apiFetch("/films", "POST", filmData );
}

export async function deleteFilm(filmId) {
  return apiFetch(`/films?id=${filmId}`, "DELETE", null );
}

export async function getSeatLayout(showtimeId) {
  return apiFetch(`seatController.php?showtime_id=${showtimeId}`, "GET");
}

export async function reserveSeats(bookingData) {
  return apiFetch("seatController.php", "POST", bookingData);
}
export async function getBookings(userId ) {
  return apiFetch(`bookingController.php?user_id=${userId}`, "GET", null );
}
export async function createBooking(bookingData ) {
  return apiFetch("bookingController.php", "POST", bookingData );
}
export async function deleteBooking(bookingId ) {
  return apiFetch(`bookingController.php?id=${bookingId}`, "DELETE", null );
}
export async function getShowtimes(filmId) {
  return apiFetch(`showtimeController.php?film_id=${filmId}`, "GET");
}
export async function createShowtime(showtimeData ) {
  return apiFetch("showtimeController.php", "POST", showtimeData );
}
export async function deleteShowtime(showtimeId ) {
  return apiFetch(`showtimeController.php?id=${showtimeId}`, "DELETE", null );
}

