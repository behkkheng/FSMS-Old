<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fsms";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['deletedata'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['delete_id']);
    $query = "DELETE FROM product WHERE productID='$product_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "Employee Deleted Successfully";
        echo $_POST['delete_id'];

        header("Location: Product-Index.php");

    } else {
        echo "Employee Not Deleted";
        header("Location: Product-Index.php");

    }
}

if (isset($_POST['update'])) {
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

    if (isset($_POST["update"]) && isset($_FILES['image'])) {
        // Check if image file is a actual image or fake image
        if (isset($_POST["update"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "<script>alert('Sorry, file is not an image.');
        window.location.href = window.history.go(-1);</script>";
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
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
        window.location.href = window.history.go(-1);;</script>";
            // if everything is ok, try to upload file
        } else {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $desc = $_POST['desc'];
            $id = $_POST['id'];

            $sql = "UPDATE `product` SET `name` = '$name', `price` = '$price', `quantity` = '$quantity', `description` = '$desc', `product_image` = '$target_file' WHERE `product`.`productID` = $id";

            //$sql = "UPDATE product SET name='$name', price='$price', quantity='$quantity', description='$desc', productPath='$target_file' WHERE productID='$id";
            $result = mysqli_query($conn, $sql);

            if ($result && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "OK";
                header("Location: Product-Index.php");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $desc = $_POST['desc'];
        $id = $_POST['id'];

        $sql = "UPDATE product SET name='$name', price='$price', quantity='$quantity', description='$desc' WHERE productID='$id'";
        $result = mysqli_query($conn, $sql);
        if($result){

            foreach ($_POST as $key => $value) {
                echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
            }
            header("Location: Product-Index.php");
        }else{
            echo "Error";
        }
        
    }
}


