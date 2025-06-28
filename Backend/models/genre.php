<?php
require_once("Model.php");

class Genre extends Model {
    protected static string $tableName = "genres";
    protected static string $primaryKey = "id";

    private int $id;
    private string $name;

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->name = $data["name"];
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }

    public function toArray() {
        return [
            $this->id,
            $this->name
        ];
    }
}