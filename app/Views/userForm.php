<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form method="POST" action="../Controllers/UserController.php">
        <input type="text" name="firstname" placeholder="First Name">
        <input type="text" name="lastname" placeholder="Last Name">
        <input type="text" name="phonenumber" placeholder="Phone Number">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Register">
    </form>
</body>
</html>
