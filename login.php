<?php 

session_start();

$conn = new mysqli('localhost', 'root', '', 'email');
if(!$conn){
    echo 'Not Connect';
}

if(isset($_POST['submit'])){
    $user_login_email = $_POST['user_email'];
    $user_login_password = $_POST['user_password'];
    
    
}
if(!empty($user_login_email) && !empty($user_login_password)){
    $sql = "SELECT * FROM users WHERE user_email = '$user_login_email' AND user_password = '$user_login_password'";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $_SESSION['login'] = "<span class='d-none'>login success</span>";
        header('location:dashboard.php');
    } 
}

$empty_email = $empty_password =  '';

if(isset($_POST['submit'])){
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    if(empty($user_email)){
        $empty_email = 'Fill up this field';
    }
    if(empty($user_password)){
        $empty_password = 'Fill up this field';
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="login.php" method="POST" class="fade-in glass p-4 rounded shadow text-white">
                    <h2 class="mb-4">Login</h2>
                    <div class="form-group">
                        <label for="username">Email:</label>
                        <input type="text" class="form-control" id="username" name="user_email" value="<?php if(isset($_POST['submit'])){
                            echo $user_email;
                        }  ?>" placeholder="Enter username">
                        <?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>$empty_email</span>";}  ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input name="user_password" type="password" class="form-control" id="password" placeholder="Enter password">
                        <?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>$empty_password</span>";}  ?>
                    </div>
                    <button name="submit" class="btn btn-danger">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- custom js -->
    <script>
        $(document).ready(function () {
            $(".fade-in").animate({ opacity: 1 }, 1000);
        });
    </script>
</body>

</html>