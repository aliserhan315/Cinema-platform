<?php
require_once("Model.php");
class Booking extends Model {
    protected static string $table = "bookings";
    protected static string $primaryKey = "id";

    private int $id;
    private int $user_id;
    private int $showtime_id;
    private string $booking_time;
    private string $status;

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->user_id = $data["user_id"];
        $this->showtime_id = $data["showtime_id"];
        $this->booking_time = $data["booking_time"];
        $this->status = $data["status"];
    }

    public function getId(): int { 
        return $this->id; 
    }
    public function getUserId(): int {
         return $this->user_id; 
        }
    public function getShowtimeId(): int {
         return $this->showtime_id; 
        }
    public function getBookingTime(): string {
         return $this->booking_time;
         }
    public function getStatus(): string {
         return $this->status;
         }

    public function toArray() {
        return [
            $this->id,
            $this->user_id,
            $this->showtime_id,
            $this->booking_time,
            $this->status
        ];
    }
}