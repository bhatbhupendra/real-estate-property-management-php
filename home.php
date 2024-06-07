<?php
    require_once "config.php";

    session_start();
    
    include "config.php";
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
        <div class="nav dashboard-body-area">
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
                    (<?php if(isset($_SESSION['role'])) echo $_SESSION['role']; ?>)
                </div>
            </div>
        </div>
        <div class="dashboard-body-area">
            <div class="container">
                <section id="product1" class="section-p1">
                    <div class="header">
                        <h2>Listed Real Estate</h2>
                        <p>select the real estates form below</p>
                    </div>
                    <div class="pro-container">
                        <div class="pro">
                            <img src="Img/Products/n1.jpg" alt="">
                            <div class="des">
                                <span>adidas</span>
                                <h5>Cartoon Astronaut T-Shirts</h5>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4>$78</h4>
                            </div>
                            <div class="cartIcon"><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>  
</body>
</html>