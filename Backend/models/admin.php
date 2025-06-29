<?php  
require_once("Model.php");
class Admin extends Model {
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $created_at;
    protected static string $table = "admins";
    protected static string $primaryKey = "id";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->created_at = $data["created_at"];
    }
    public function getId(): int {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getPassword(): string {
        return $this->password;
    }
    public function getCreatedAt(): string {
        return $this->created_at;
    }
    public function setName(string $name) {
        $this->name = $name;
    }
    public function setEmail(string $email) {
        $this->email = $email;
    }
    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function toArray(): array {
        return [
            $this->id,
           $this->name,
            $this->email,
            $this->password,
          $this->created_at
        ];
    }



}