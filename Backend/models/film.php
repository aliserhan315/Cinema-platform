<?php
require_once("Model.php");
class Film extends Model {
    private int $id;
    private string $title;
    private ?string $description;
    private ?string $release_date;
    private ?string $created_at;
    private ?int $duration;
    private ?string $trailer_url;
    private ?string $poster_image;
    private ?int $age_restriction;
    private ?string $rating;
    protected static string $tableName = "films";
    protected static string $primaryKey = "id";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->description = $data["description"] ?? null;
        $this->release_date = $data["release_date"] ?? null;
        $this->rating = $data["rating"] ?? null;
        $this->duration = $data["duration"] ?? null;
        $this->trailer_url = $data["trailer_url"] ?? null;
        $this->poster_image = $data["poster_image"] ?? null;
        $this->created_at = $data["created_at"];
        $this->age_restriction = $data["age_restriction"] ?? null;
    }

    public function getId(): int {
        return $this->id;
    }
      public function getTitle(): string {
        return $this->title;
    }
    public function getRating(): ?string {
        return $this->rating;
    }
    public function getDuration(): ?int {
        return $this->duration;
    }
    public function getTrailerUrl(): ?string {
        return $this->trailer_url;
    }
    public function getPosterImage(): ?string {
        return $this->poster_image;
    }
    public function getAgeRestriction(): ?int {
        return $this->age_restriction;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getReleaseDate(): string {
        return $this->release_date;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }
    public function setTitle(string $title) {
        $this->title = $title;
    }
    public function setDescription(?string $description) {
        $this->description = $description;
    }
    public function setReleaseDate(?string $release_date) {
        $this->release_date = $release_date;
    }
    public function setRating(?string $rating) {
        $this->rating = $rating;
    }
    public function setDuration(?int $duration) {
        $this->duration = $duration;
    }
    public function setTrailerUrl(?string $trailer_url) {
        $this->trailer_url = $trailer_url;
    }
    public function setPosterImage(?string $poster_image) {
        $this->poster_image = $poster_image;
    }
    public function setAgeRestriction(?int $age_restriction) {
        $this->age_restriction = $age_restriction;
    }

    public function toArray() {
        return [
            $this->id,
            $this->title,
            $this->description,
            $this->release_date,
            $this->rating,
            $this->duration,
            $this->trailer_url,
            $this->poster_image,
            $this->created_at,
            $this->age_restriction
        ];
    }
}