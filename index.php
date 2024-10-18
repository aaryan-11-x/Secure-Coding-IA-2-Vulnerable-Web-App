<?php
// Vulnerable Code
include('config.php');
include('functions.php');
$msg = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vulnerable SQL query for both username and password
    $res = mysqli_query($con, "select * from users where username='$username' AND password='$password'");

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        // No password_verify here! Password checked directly in the query
        $_SESSION['UID'] = $row['id'];
        $_SESSION['UNAME'] = $row['username'];
        $_SESSION['UROLE'] = $row['role'];
        if ($_SESSION['UROLE'] == 'User') {
            redirect('dashboard.php');
        } else {
            redirect('category.php');
        }
    } else {
        $msg = "Please enter valid username or password";
    }
}
?>

<!-- Fixed code -->
<?php
// if (isset($_POST['login'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // Prepare an SQL statement with placeholders (?)
//     $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");

//     // Bind the input parameters to the placeholders
//     $stmt->bind_param("s", $username);  // "s" indicates that the username is a string

//     // Execute the query
//     $stmt->execute();

//     // Get the result of the query
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();

//         // Now verify the password using password_verify (assuming passwords are hashed)
//         if (password_verify($password, $row['password'])) {
//             $_SESSION['UID'] = $row['id'];
//             $_SESSION['UNAME'] = $row['username'];
//             $_SESSION['UROLE'] = $row['role'];

//             // Redirect based on user role
//             if ($_SESSION['UROLE'] == 'User') {
//                 redirect('dashboard.php');
//             } else {
//                 redirect('category.php');
//             }
//         } else {
//             $msg = "Invalid password.";
//         }
//     } else {
//         $msg = "Please enter a valid username or password.";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>


    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">



    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name='login'>sign in</button>

                            </form>
                            <div id="msg"><?php echo $msg ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->