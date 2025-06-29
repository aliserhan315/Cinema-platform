import { getSeatLayout, reserveSeats } from "./api.js";

(async () => {
  const id = localStorage.getItem("selectedFilmId");
  if (!id) return window.location.href = "home.html";

  const res = await getSeatLayout(id);
  const container = document.querySelector(".seat-container");
  let count = 0;

  res.seats.forEach(s => {
    const el = document.createElement("div");
    el.className = `seat ${s.booked ? 'booked' : ''}`;
    el.textContent = s.seat_row + s.seat_column;
    if (!s.booked) {
      el.onclick = () => {
        if (el.classList.toggle("selected")) count++;
        else count--;
        document.getElementById("count").textContent = count;
        document.getElementById("total").textContent = count * 200;
      };
    }
    container.appendChild(el);
  });

  document.querySelector(".btn-confirm").onclick = async () => {
    const selected = [...document.querySelectorAll(".seat.selected")].map(el => el.textContent);
    try {
      await reserveSeats({ showtimeId: id, seats: selected });
      alert("Success!");
      window.location.href = "home.html";
    } catch {
      alert("Failed.");
    }
  };
})();