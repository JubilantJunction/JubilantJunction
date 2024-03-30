<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body style="background-color: #f9fcf6;">
    <h2 id="signupline" class="mental container d-flex justify-content-center" class="container">
        Welcome back! It's great to see you again    </h2>
        
        
    <div style="width:100%;" class="row">
        <div class="col-sm-6">
            <br>
            <img class="container" style="height:470px; width:100%;" src="logo.png" alt="">
        </div>
        <br>
        <div class="col-sm-6 container format">
        <br>
<form class="container" method="POST">
    <label for="email"><i class="fa-solid fa-user" style="color: #74C0FC;"></i> Email :-</label><br>
    <input type="email" name="emailsign" id="email" placeholder="enter your email" required><br><br>
    <label for="password"><i class="fa-solid fa-lock" style="color: #74C0FC;"></i> password :-</label><br>
    <input type="password" name="passwordsign" id="password" placeholder="your password" required><br><br><br>
    <input style="width:40%;" type="submit" value="submit" name="submit"> <!-- Changed 'submitlogin' to 'submit' -->
</form>
<br>

        </div>
    </div>

    <?php
session_start();

$useremail = "";
$userpassword = "";
$errors = array();
$db = mysqli_connect("localhost", "root", "", "jubilantjunction");

if ($_POST) {
    $useremail = mysqli_real_escape_string($db, $_POST['emailsign']);
    $userpassword = mysqli_real_escape_string($db, $_POST['passwordsign']);

    if (empty($useremail)) {
        array_push($errors, "Useremail is required");
    }
    if (empty($userpassword)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        // $userpassword = md5($userpassword);
        $query = "SELECT * FROM userssignup WHERE email ='$useremail' AND password='$userpassword'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['email'] = $useremail; // Change this to 'name' if you want to use username
            $_SESSION['success'] = "You are now logged in";
            header('location: index.html');
            exit(); // Add exit() to prevent further execution
        } else {
            array_push($errors, "Wrong email/password combination");
            echo "<h2>Wrong email or password</h2>";
        }
    }
}
?>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>