<?php

    include "config.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png"); 
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'assets/uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            }else {
                $_SESSION['error'] = "You can't upload files of this type";
                header("location: add-property.php");
            }
        }else {
            $_SESSION['error'] = "unknown error occurred!";
            header("location: add-property.php");
        }

        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $location = $_POST['location'];
        $size = $_POST['size'];
        $type = $_POST['type'];
        $id = $_SESSION['id'];

        $sql = "INSERT INTO properties(title, description, price , location, size,img, type, user_id) VALUES ('{$title}', '{$description}', '{$price}', '{$location}', '{$size}', '{$new_img_name}', '{$type}', '{$id}')";
        $query = mysqli_query($conn,$sql);#add properties
        if($query){
            $_SESSION['error'] = "Property Added!";
            header("location: home.php");
        }else{
            $_SESSION['error'] = "Property is not Added!";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/add-property.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <title>Add Property</title>
</head>
<body>

    <section class="">
        <div class="nav left-right-margin">
            <div class="logo">
                <h3>Real Estate Property</h3>
            </div>
            <div class="list">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="activity.php">Activities</a></li>
                    <li>
                        <?php if(isset($_SESSION['email'])) echo "<div class='logout'><a href='logout.php'>Log out</a></div>"; ?>
                        <?php if(!isset($_SESSION['email'])) echo "<div class='logout'><a href='login.php'>Log in</a></div>"; ?>
                    </li>
                </ul>
            </div>
            <div class="user_detail">
                <div class="email">
                    <i class="fa-solid fa-user"></i>
                    <?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>
                    (<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?>)
                </div>
            </div>
        </div>
        <div class="add-property-form left-right-margin">
            <div class="form-wrapper">
                <h1>Fill the form to add the property</h1>
                <h5>*Please fill the input fields</h5>
                <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                    <div class="field">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required placeholder="title">
                    </div>
                    <div class="field">
                        <label for="description">Description:</label>
                        <textarea  id="description" rows="5" cols="8" name="description" required placeholder="Desctiption"></textarea>
                    </div>
                    <div class="field">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" required placeholder="eg $500">
                    </div>
                    <div class="field">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" required placeholder="eg. sydney austeralia">
                    </div>
                    <div class="field">
                        <label for="size">Size:</label>
                        <input type="number" id="size" name="size" required placeholder="(sq ft)">
                    </div>
                    <div class="field">
                        <label for="type">Type:</label>
                        <select id="type" name="type" required>
                            <option value="House">House</option>
                            <option value="Apartment">Apartment</option>
                            <option value="Condo">Condo</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="images">Upload Images:</label>
                        <input type="file" id="images" name="image" multiple>
                    </div>
                    <div class="field">
                        <button type="submit">List Property</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
</body>
</html>