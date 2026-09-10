<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Todo List Account Sign Up</h2>
    <form method='POST' action='signup.php'>
        <label for='email'>Email Address:</label><br>
        <input type='email' name='email' required><br>
        <label for='password'>Password:</label><br>
        <input type='password' name='password' required><br>
        <label for='confirm_password'>Confirm Password:</label><br>
        <input type='password' name='confirm_password' required>
        <br><br>
        <input type='submit' name='signup' value='Sign Up'>
    </form>
</body>
</html>
<?php
$host = "localhost";
$dbname = "userList";
$user = "root";
$pass = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if(empty($email) || empty($password) || empty($confirmPassword)){
        echo '<p style="color: red;">Please fill in the form!</p>';
    } else if($password !== $confirmPassword) {
        echo '<p style="color: red;">Password not match!!</p>';
    }

$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

};
?>