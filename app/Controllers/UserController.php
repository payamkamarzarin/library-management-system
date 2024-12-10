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

    public function input_data($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public function register()
    {
        $errors = [];
        $input = [
            'firstname' => '',
            'lastname' => '',
            'phonenumber' => '',
            'email' => '',
            'password' => ''
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // دریافت و پردازش داده‌ها
            $input['firstname'] = $this->input_data($_POST['firstname'] ?? '');
            $input['lastname'] = $this->input_data($_POST['lastname'] ?? '');
            $input['phonenumber'] = $this->input_data($_POST['phonenumber'] ?? '');
            $input['email'] = $this->input_data($_POST['email'] ?? '');
            $input['password'] = $this->input_data($_POST['password'] ?? '');

            // اعتبارسنجی نام کوچک
            if (empty($input['firstname'])) {
                $errors['firstname'] = 'نام کوچک اجباری است.';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $input['firstname'])) {
                $errors['firstname'] = 'فقط حروف و فاصله مجاز است.';
            }

            // اعتبارسنجی نام خانوادگی
            if (empty($input['lastname'])) {
                $errors['lastname'] = 'نام خانوادگی اجباری است.';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $input['lastname'])) {
                $errors['lastname'] = 'فقط حروف و فاصله مجاز است.';
            }

            // اعتبارسنجی شماره تلفن
            if (empty($input['phonenumber'])) {
                $errors['phonenumber'] = 'شماره تلفن اجباری است.';
            } elseif (!preg_match("/^[0-9]{10}$/", $input['phonenumber'])) {
                $errors['phonenumber'] = 'شماره تلفن باید ۱۰ رقم باشد.';
            }

            // اعتبارسنجی ایمیل
            if (empty($input['email'])) {
                $errors['email'] = 'ایمیل اجباری است.';
            } elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'ایمیل نامعتبر است.';
            }

            // اعتبارسنجی رمز عبور
            if (empty($input['password'])) {
                $errors['password'] = 'رمز عبور اجباری است.';
            } elseif (strlen($input['password']) < 6) {
                $errors['password'] = 'رمز عبور باید حداقل ۶ کاراکتر باشد.';
            }

            // بررسی و ذخیره‌سازی داده‌ها
            if (empty($errors)) {
                $this->user->firstname = $input['firstname'];
                $this->user->lastname = $input['lastname'];
                $this->user->phonenumber = $input['phonenumber'];
                $this->user->email = $input['email'];
                $this->user->password = password_hash($input['password'], PASSWORD_DEFAULT); // رمزنگاری رمز عبور

                if ($this->user->save()) {
                    echo "User registered successfully!";
                    header('Location: ../Views/userForm.php');
                    exit();
                } else {
                    echo "Error: Unable to register user.";
                }
            } else {
                // نمایش خطاها
                foreach ($errors as $field => $error) {
                    echo "<p class='text-danger'>${error}</p>";
                }
            }
        }
    }
}

$controller = new UserController();
$controller->register();
