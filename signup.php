<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body style="background-color: #f9fcf6;">
    <h2 id="signupline" class="mental container d-flex justify-content-center" class="container">
        Start your unique and personalized exploration. Welcome!</h2>
        
        
    <div style="width:100%;" class="row">
        <div class="col-sm-6">
            <br>
            <img class="container" style="height:470px; width:100%;" src="logo.png" alt="">
        </div>
        <br>
        <div class="col-sm-6" class="container ">
            <br>
            <form class="container" method="post">
                <label for="name"><i class="fa-solid fa-user" style="color: #74C0FC;"></i> Name :-</label>  <br>
                <input type="text" name="name" id="age" placeholder="enter your name" required><br> <br>
                <label for="age"><i class="fa-solid fa-child" style="color: #74C0FC;"></i> Age :-</label> <br>
                <input type="number" name="age" id="number" placeholder="enter your age" required> <br> <br>
                <label for="email"><i class="fa-solid fa-envelope" style="color: #74C0FC;"></i> email :-</label> <br>
                <input type="email" name="email" id="email" placeholder="enter your email" required> <br><br>
                <label for="number"><i class="fa-solid fa-phone" style="color: #74C0FC;"></i> number :-</label> <br>
                <input type="tel" name="number" id="number" placeholder="enter your number" required> <br> <br>
                <label for="password"><i class="fa-solid fa-lock" style="color: #74C0FC;"></i> password :-</label> <br>
                <input type="password" name="password" id="password" placeholder="set your password" required> <br> <br> <br>
                <input type="submit" value="submit" name="submit" id="submit">    
            </form>
            <br>
            <label for="signin">Already have an account ?</label>
            <a style="font-size:22px;" href="signin.php">signin</a>
            <br>
        </div>
    </div>


    <?php
session_start();
$username ="";
$userage="";
$useremail ="";
$usernumber ="";
$userpassword = "";
$errors = array();
$db = mysqli_connect("localhost","root","","jubilantjunction");

if (isset($_POST['submit'])){
    $username =  mysqli_real_escape_string($db , $_POST["name"]);
    $userage = mysqli_real_escape_string($db , $_POST["age"]);
    $useremail = mysqli_real_escape_string($db , $_POST["email"]);
    $usernumber = mysqli_real_escape_string($db, $_POST["number"]);
    $userpassword = mysqli_real_escape_string($db , $_POST["password"]);
    


    if(empty($username)){
        array_push($errors , "name is required");
    }
    if(empty($userage)){
        array_push($errors , "age is required");
    }
    if(empty($useremail)){
        array_push($errors , "email is required");
    }
    if(empty($usernumber)){
        array_push($errors , "usernumber is required");
    }
    elseif (!preg_match("/^\+?[0-9]{10,}$/", $usernumber)) {
        array_push($errors, "Invalid phone number format");
    }
    if(empty($userpassword)){
        array_push($errors , "userpassword is required");
    }

    $user_check_query = "SELECT * from userssignup where name = '$username' OR email = '$useremail' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if($user){
        if ($user['name'] === $username){
            array_push($errors,"username already exists");
        }
        if ($user['email'] === $useremail){
            array_push($errors,"email already exists");
        }
    }

    if(count($errors) == 0){
        $user_encrypt_password = md5($userpassword);
        $query = "INSERT INTO userssignup (name , age , email , number , password) 
        VALUES ('$username','$userage','$useremail','$usernumber','$userpassword')";
    
    mysqli_query($db,$query);
    $_SESSION['name'] = $username;
    $_SESSION['success'] = "Your Account Is Created";
    header('location: index.html');
    }
}








    ?>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>