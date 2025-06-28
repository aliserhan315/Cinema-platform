<?php

require_once("Model.php");
class Seat extends Model {
    protected static string $tableName = "seats";
    protected static string $primaryKey = "id";

    private int $id;
    private int $auditorium_id;
    private int $seat_row;
    private int $seat_column;
    private ?string $seat_type;

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->auditorium_id = $data["auditorium_id"];
        $this->seat_row = $data["seat_row"];
        $this->seat_column = $data["seat_column"];
        $this->seat_type = $data["seat_type"] ?? null;
    }

    public function getId(): int {
         return $this->id;
         }
    public function getAuditoriumId(): int {
         return $this->auditorium_id; 
        }
    public function getSeatRow(): int {
         return $this->seat_row; 
        }
    public function getSeatColumn(): int { 
        return $this->seat_column;
     }
    public function getSeatType(): ?string { 
        return $this->seat_type; 
    }

    public function toArray() {
        return [
            $this->id,
            $this->auditorium_id,
            $this->seat_row,
            $this->seat_column,
            $this->seat_type
        ];
    }
}