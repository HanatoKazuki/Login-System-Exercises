<?php

session_start();

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] ==true){
    header('Location:index.php');
    exit;
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $email =$_POST['email'];
    $password =$_POST['password'];

    //validate inputs
    if(empty($email) || empty($password)){
        echo"All fields are required.";
        exit;
    }
    //PDO object to connect to DB
 $db = new PDO("mysql:host=localhost;dbname=login_auth", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //check the user by email
    $statement =$db->prepare("SELECT * FROM users WHERE email = :email");
    $statement ->execute([':email'=>$email]);
    $user =$statement->fetch(PDO::FETCH_OBJ);

    //verify the password
    if($user &&password_verify($password, $user->password)){
        $_SESSION['authenticated']=true;
        $_SESSION['email'] =$user ->email;
        header('Location:index.php');
        exit;
    }else{
        echo"Invaild email or password";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<div class="d-flex flex-column align-items-center vh-100">
    <h2>Login</h2>

    <form method="POST" action="login.php" style="max-width: 100;">
        <label class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" required><br><br>

        <label class="form-label">Password:</label>
        <input class="form-control" type="password" name="password" required><br><br>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>