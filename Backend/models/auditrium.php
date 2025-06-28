<?php
require_once("Model.php");
class Auditorium extends Model {
    protected static string $tableName = "auditoriums";
    protected static string $primaryKey = "id";

    private int $id;
    private string $name;
    private int $seat_rows;
    private int $seat_columns;

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->seat_rows = $data["seat_rows"];
        $this->seat_columns = $data["seat_columns"];
    }

    public function getId(): int {
         return $this->id;
         }
    public function getName(): string {
         return $this->name;
         }
    public function getSeatRows(): int { 
        return $this->seat_rows; 
    }
    public function getSeatColumns(): int { 
        return $this->seat_columns;
     }

    public function toArray() {
        return [
            $this->id,
            $this->name,
            $this->seat_rows,
            $this->seat_columns
        ];
    }
}