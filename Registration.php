<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password length
    if (strlen($password) <= 5) {
        echo "Password must be more than five characters.";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Login Form | CodingLab </title>
    <link rel="stylesheet" href="Register.css"/>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }
    html,body{
        display: grid;
        height: 100vh;
        place-items:center;
        background-color: #dfd3c7;

    }
    .main_div{
        width: 365px;
        background: #dfd3c7;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
    }
    .main_div .title{
        text-align: center;
        font-size: 30px;
        font-weight: 600;
        color: #0d0d0d;
    }
    .main_div .social_icons{
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    .social_icons a{
        display: block;
        height: 45px;
        width: 100%;
        line-height: 45px;
        text-align: center;
        border-radius: 5px;
        font-size: 20px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s linear;
    }
    .social_icons a span{
        margin-left: 5px;
        font-size: 18px;
    }
    .social_icons a:first-child{
        margin-right: 5px;
        background: #4267B2;
    }
    .social_icons a:first-child:hover{
        background: #375695;
    }
    .social_icons a:last-child{
        margin-left: 5px;
        background: #1DA1F2;
    }
    .social_icons a:last-child:hover{
        background: #0d8bd9;
    }

    form {
        margin-top: 25px;
    }
    form .input_box{
        height: 50px;
        width: 100%;
        position: relative;
        margin-top: 15px;
    }
    .input_box input{
        height: 100%;
        width: 100%;
        outline: none;
        border: 1px solid lightgrey;
        border-radius: 5px;
        padding-left: 45px;
        font-size: 17px;
        transition: all 0.3s ease;
    }
    .input_box input:focus{
        border-color: #be2edd;
    }
    .input_box .icon{
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        color: grey;
    }
    form .option_div{
        margin-top: 5px;
        display: flex;
        justify-content: space-between;
    }
    .option_div .check_box{
        display: flex;
        align-items: center;
    }
    .option_div span{
        margin-left: 5px;
        font-size: 16px;
        color: #333;
    }
    .option_div .forget_div a{
        font-size: 16px;
        color: #8d4e2b;
    }
    .button input{
        padding-left: 0;
        background: #8d4e2b;
        color: #fff;
        border: none;
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s linear;
    }
    .button input:hover{
        background: #8d6e63;
    }
    form .sign_up{
        text-align: center;
        margin-top: 25px;
    }
    .sign_up a{
        color: #8d4e2b;
    }
    form a{
        text-decoration: none;
    }
    form a:hover{
        text-decoration: underline;
    }

</style>
<body>
<form method="POST" action="Registration.php">
<img src="Apollomain.jpg.png" alt="Apollo main" style="height: 60%;width: 100%">
<div class="main_div">
    <div class="title">Registration</div>
    <form action="#">
        <div class="input_box">
            Email: <input type="email" placeholder="Email" required>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="input_box">
            <input type="password" placeholder="Password" required>
            <div class="icon"><i class="fas fa-lock"></i></div>
        </div>
        <div class="input_box">
            <input type="password" placeholder="Confirm Password" required>
            <div class="icon"><i class="fas fa-lock"></i></div>
        </div>

        <div class="option_div">
            <div class="check_box">
                <input type="checkbox">
                <span>Remember me</span>
            </div>
        </div>
        <div class="input_box button">
            <input type="submit" value="Register">
        </div>
        <div class="sign_up">
            Already a member? <a href="#">Login now</a>
        </div>
    </form>
        <div class="social_icons">
            <a href="https://www.facebook.com/ApolloApparrel/"><i class="fab fa-facebook-f"></i> <span>Facebook</span></a>
            <a href="#"><i class="fab fa-twitter"></i><span>Twitter</span></a>
        </div>
    </form>
</div>

</body>
</html>
