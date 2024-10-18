<?php
// Fixed code
if (isset($_POST['upload'])) {
    $target_directory = "uploads/"; // Ensure this directory is not within the public webroot
    $max_file_size = 2 * 1024 * 1024; // 2MB limit for file size
    $allowed_file_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf']; // Only allow specific file types

    // Extract file extension and filename safely
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_size = $_FILES["fileToUpload"]["size"];

    // Generate a safe, random file name to prevent filename-based attacks
    $new_file_name = uniqid() . '.' . $file_extension;
    $target_file = $target_directory . $new_file_name;

    // Check for allowed file types
    if (!in_array($file_extension, $allowed_file_types)) {
        echo "Error: Only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        exit();
    }

    // Check file size
    if ($file_size > $max_file_size) {
        echo "Error: File is too large. Maximum allowed size is 2MB.";
        exit();
    }

    // Check if the file is actually an image (optional, for image uploads)
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false && in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Error: File is not a valid image.";
        exit();
    }

    // Move the file to the safe upload directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars($new_file_name) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!-- Vulnerable Code -->
<?php
// if (isset($_POST['upload'])) {
//     $target_directory = "uploads/";
//     $target_file = $target_directory . basename($_FILES["fileToUpload"]["name"]);

//     // File upload without proper validation
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//         echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
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
    <title>File Upload Page</title>


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

                        <!-- Card for File Upload Form -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center">Upload Your File</h2>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <!-- File Input Field -->
                                    <div class="form-group">
                                        <label for="fileToUpload">Select file to upload</label>
                                        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" required>
                                        <small class="form-text text-muted">
                                            Filetypes allowed: JPG, PNG, GIF
                                        </small>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary btn-block" name="upload">Upload File</button>
                                </form>
                            </div>
                        </div>
                        <!-- End of File Upload Form -->
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