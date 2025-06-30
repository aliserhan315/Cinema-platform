import { getSeatLayout, reserveSeats } from "./api.js";

async()=>{
  const showtimeId = localStorage.getItem("selectedShowtimeId");
  if (!showtimeId) {
    console.error("No showtime selected.");
    return;
  }
  try {
    const seatLayout = await getSeatLayout(showtimeId);
    if (seatLayout) {
      renderSeatLayout(seatLayout);
    } else {
      console.error("Failed to fetch seat layout.");
    }
  } catch (error) {
    console.error("Error fetching seat layout:", error);
  }
  const reserveButton = document.getElementById("reserve-button");
  reserveButton.addEventListener("click", async () => {
    const selectedSeats = getSelectedSeats();
    if (selectedSeats.length === 0) {
      alert("Please select at least one seat.");
      return;
    }})

}
