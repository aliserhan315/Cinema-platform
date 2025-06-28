<?php
require_once("Model.php");
class showTime extends Model {
    protected static string $tableName = "show_times";
    protected static string $primaryKey = "id";
    private int $id;
    private int $film_id;
    private string $start_time;
    private string $end_time;
    private ?string $updated_at;
    private int $auditorium_id;

     public function __construct(array $data) {
        $this->id = $data["id"];
        $this->film_id = $data["film_id"];
        $this->auditorium_id = $data["auditorium_id"];
        $this->start_time = $data["start_time"];
        $this->end_time = $data["end_time"] ;
    }
    public function getId(): int {
         return $this->id; 
        }
    public function getFilmId(): int { 
        return $this->film_id; 
    }
    public function getAuditoriumId(): int { 
        return $this->auditorium_id;
     }
    public function getStartTime(): string { 
        return $this->start_time; 
    }
    public function getEndTime(): ?string { 
        return $this->end_time;
     }

    public function setFilmId(int $film_id) {
         $this->film_id = $film_id; 
        }
    public function setAuditoriumId(int $auditorium_id) {
         $this->auditorium_id = $auditorium_id;
         }
    public function setStartTime(string $start_time) {
         $this->start_time = $start_time; 
        }
    public function setEndTime(?string $end_time) { 
        $this->end_time = $end_time;
     }

    public function toArray() {
        return [
            $this->id,
            $this->film_id,
            $this->auditorium_id,
            $this->start_time,
            $this->end_time
        ];
    }




}