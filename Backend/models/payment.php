<?php
require_once("Model.php");

class Payment extends Model {
    protected static string $tableName = "payments";
    protected static string $primaryKey = "id";

    private int $id;
    private int $booking_id;
    private float $amount;
    private ?string $payment_method;
    private string $payment_status;
    private ?string $paid_at;

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->booking_id = $data["booking_id"];
        $this->amount = $data["amount"];
        $this->payment_method = $data["payment_method"] ?? null;
        $this->payment_status = $data["payment_status"];
        $this->paid_at = $data["paid_at"] ?? null;
    }

    public function getId(): int { 
        return $this->id;
     }
    public function getBookingId(): int { 
        return $this->booking_id;
     }
    public function getAmount(): float {
         return $this->amount; 
        }
    public function getPaymentMethod(): ?string {
         return $this->payment_method;
         }
    public function getPaymentStatus(): string { 
        return $this->payment_status; 
    }
    public function getPaidAt(): ?string {
         return $this->paid_at;
         }

    public function toArray() {
        return [
            $this->id,
            $this->booking_id,
            $this->amount,
            $this->payment_method,
            $this->payment_status,
            $this->paid_at
        ];
    }
}