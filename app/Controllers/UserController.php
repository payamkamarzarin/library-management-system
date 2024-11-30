<?php

require_once '../../config/connection.php';
require_once '../models/User.php';

class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->user->firstname = $_POST['firstname'];
            $this->user->lastname = $_POST['lastname'];
            $this->user->phonenumber = $_POST['phonenumber'];
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            if ($this->user->save()) {
                echo "User registered successfully!";
            } else {
                echo "Error: Unable to register user.";
            }
        }
    }
}
$controller = new UserController();
$controller->register();
