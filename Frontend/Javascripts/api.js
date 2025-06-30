const API_BASE = "http://localhost/Projects/cinema-platform/Backend/controller";

async function apiFetch(path, method = "GET", body = null, token = null) {
  const headers = {
    "Content-Type": "application/json",
  };
  if (token) headers["Authorization"] = `Bearer ${token}`;

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
  return apiFetch("logIncontroller.php", "POST", { email, password });
}

export async function adminLogin(email, password) {
  return apiFetch("adminController.php", "POST", { email, password });
}

export async function createUser(userData) {
  return apiFetch("createUser.php", userData);
}

export async function getUsers() {
  return apiFetch("getUser.php", "GET");
}

export async function updateUser(userId, userData, token) {
  return apiFetch(`userController.php?id=${userId}`, "PUT", userData, token);
}

export async function fetchFilms() {
  return apiFetch("filmController.php", "GET");
}

export async function createFilm(token, filmData) {
  return apiFetch("filmController.php", "POST", filmData, token);
}

export async function deleteFilm(token, filmId) {
  return apiFetch(`filmController.php?id=${filmId}`, "DELETE", null, token);
}

export async function getSeatLayout(showtimeId) {
  return apiFetch(`seatController.php?showtime_id=${showtimeId}`, "GET");
}

export async function reserveSeats(bookingData) {
  return apiFetch("seatController.php", "POST", bookingData);
}
export async function getBookings(userId, token) {
  return apiFetch(`bookingController.php?user_id=${userId}`, "GET", null, token);
}
export async function createBooking(bookingData, token) {
  return apiFetch("bookingController.php", "POST", bookingData, token);
}
export async function deleteBooking(bookingId, token) {
  return apiFetch(`bookingController.php?id=${bookingId}`, "DELETE", null, token);
}
export async function getShowtimes(filmId) {
  return apiFetch(`showtimeController.php?film_id=${filmId}`, "GET");
}
export async function createShowtime(showtimeData, token) {
  return apiFetch("showtimeController.php", "POST", showtimeData, token);
}
export async function deleteShowtime(showtimeId, token) {
  return apiFetch(`showtimeController.php?id=${showtimeId}`, "DELETE", null, token);
}

