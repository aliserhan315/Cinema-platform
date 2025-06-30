<?php  
require_once("Model.php");
class User extends Model {
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private ?string $mobile;
    private ?string $date_of_birth;
    private ?string $profile_image;
    private string $created_at;
    protected static string $table = "users";
    protected static string $primaryKey = "id";
    private array $genres = [];

        public function __construct(array $data) {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->mobile = $data["mobile"] ?? null;
        $this->date_of_birth = $data["date_of_birth"] ?? null;
        $this->profile_image = $data["profile_image"] ?? null;
        $this->created_at = $data["created_at"];
    }

    public function getId():int {
        return $this->id;

    }
        public function getName():string {
        return $this->name;
        
    }
        public function getEmail():string {
        return $this->email;
        
    }
    public function getPassword(): string {
        return $this->password;
    }

    public function getMobile(): ?string {
        return $this->mobile;
    }

    public function getDateOfBirth(): ?string {
        return $this->date_of_birth;
    }

    public function getProfileImage(): ?string {
        return $this->profile_image;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function setName(string $name){
        $this->name=$name;
    }
    
    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function setMobile(?string $mobile) {
        $this->mobile = $mobile;
    }

    public function setDateOfBirth(?string $date_of_birth) {
        $this->date_of_birth = $date_of_birth;
    }

    public function setProfileImage(?string $profile_image) {
        $this->profile_image = $profile_image;
    }
    public function toArray(){
  return [
    "id" => $this->id,
    "name" => $this->name,
    "email" => $this->email,
    "password" => $this->password,
    "mobile" => $this->mobile,
    "date_of_birth" => $this->date_of_birth,
    "profile_image" => $this->profile_image,
    "created_at" => $this->created_at,
    "genres" => $this->genres
];
    }

   public function loadGenres(mysqli $mysqli): void {
    $sql = "SELECT genre_id FROM user_genres WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    $result = $stmt->get_result();

    $this->genres = [];
    while ($row = $result->fetch_assoc()) {
        $this->genres[] = (int) $row["genre_id"];
    }
}
public static function findByEmail(mysqli $mysqli, string $email): ?User {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data) {
        return new User($data);
    }
    return null;
}





}