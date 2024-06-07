<?php
    require_once "config.php";

    session_start();
    include "config.php";

    $sql = "SELECT * FROM properties";
    $post = mysqli_query($conn,$sql);#get data

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page!!</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <script src="https://kit.fontawesome.com/118a820504.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="dashboard-container">
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
        <div class="left-right-margin">
            <div class="container">
                <section id="property-list">
                    <div class="header">
                        <div class="header-info">
                            <h2>Listed Real Estate</h2>
                            <p>select the real estates form below</p>
                        </div>
                        <a href="add-property.php"><button class="add-real-estate">+ Add New Property</button></a>
                    </div>
                    <div class="pro-container">
                        <?php if($post!=null){ ?>
                            <?php foreach($post as $row){ ?>
                                <div class="pro">
                                    <img src="assets/uploads/<?php echo $row["img"];?>" alt="">
                                    <div class="info">
                                        <h5><?php echo $row["title"];?></h5>
                                        <span><?php echo substr($row["description"], 0, 50)."...";?></span>
                                        <h4>Location:- <?php echo $row["location"];?></h4>
                                        <h4>Price:- $<?php echo $row["price"];?></h4>
                                        <h4>Area:- <?php echo $row["size"];?> cu. m</h4>
                                        <h4>Type:- <?php echo $row["type"];?></h4>
                                        <h4>Postby #<?php echo $row["id"];?></h4>
                                        <span><?php echo $row["created_at"];?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>
    </div>  
</body>
</html>