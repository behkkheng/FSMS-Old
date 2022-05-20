<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

date_default_timezone_set("Asia/Bangkok");
$t = time();
$target_dir = "../images/product/";
$target_file = $target_dir . date("Ymdhisa", $t) .  basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"]) && isset($_FILES['image'])){
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 5e+6) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO `product` (`name`, `price`, `quantity`, `description`, `product_image`) VALUES ('$name', '$price', '$quantity', '$desc', '$target_file')";
    $result = mysqli_query($conn, $sql);

    if ($result && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "OK";
        header("Location: Product-Index.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}else{
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO `product` (`name`, `price`, `quantity`, `description`) VALUES ('$name', '$price', '$quantity', '$desc')";
    $result = mysqli_query($conn, $sql);
    header("Location: Product-Index.php");
}
