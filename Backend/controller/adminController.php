<?php
require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ .  "/../models/Genre.php";
require_once __DIR__ . "/BaseController.php";
require_once __DIR__ . "/../services/AdminService.php";
require_once __DIR__ . "/../models/Admin.php";

class AdminController extends BaseController {
    public function  getAllAdmins() {

        global $mysqli;
        try{
            $admins = Admin::all($mysqli);
           
            echo $this->success_response(adminService::AdminToArray($admins));

        }catch (Exception $e) {
        echo $this->error_response($e->getMessage());
        }
    }
    public function loginAdmin() {
        global $mysqli;
        try {
             $data = json_decode(file_get_contents("php://input"), true);
             if (!isset($data["email"], $data["password"])) {
                  throw new Exception('Missing required fields');
                }
            $admin = Admin::findByEmail($mysqli, $data['email']);
            if (!$admin || $data['password'] !== $admin->getPassword()) {
                throw new Exception('Invalid credentials.');
            }

             
            echo $this->success_response($admin->toArray());
        

        }catch (Exception $e) {
            echo $this->error_response($e->getMessage());
        }
    }
     public function deleteAdmin() {
        global $mysqli;
        try {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                throw new Exception('Missing admin id.');
            }

            $admin = Admin::find($mysqli, $id);
            if (!$admin) {
                throw new Exception('Admin not found.');
            }

            $deleted = Admin::delete($mysqli, $id);
            if (!$deleted) {
                throw new Exception('Failed to delete admin.');
            }

            echo $this->success_response('Admin deleted successfully.');
        } catch (Exception $e) {
            echo $this->error_response($e->getMessage());
        }
    }

    }







?> 
