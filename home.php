<?php
    require_once "config.php";

    session_start();
    include "config.php";

    if(isset($_POST["query"])){
        $query=$_POST["query"];
        $sql = "SELECT * FROM properties p JOIN users u ON p.user_id=u.id WHERE title LIKE '%$query%'";
    }elseif (isset($_POST['filter'])) {
        $min_price = isset($_POST['min_price']) ? (float) $_POST['min_price'] : 0;
        $max_price = (isset($_POST['max_price']) && $_POST['max_price'] !='' )? (float) $_POST['max_price'] : PHP_INT_MAX;
        $min_area = isset($_POST['min_area']) ? (float) $_POST['min_area'] : 0;
        $max_area = (isset($_POST['max_area']) && $_POST['max_area'] !='') ? (float) $_POST['max_area'] : PHP_INT_MAX;
        $sql = "SELECT * FROM properties p JOIN users u ON p.user_id=u.id WHERE  price BETWEEN '{$min_price}' AND '{$max_price}' AND size BETWEEN '{$min_area}' AND '{$max_area}'";
    }else{
        $sql = "SELECT * FROM properties p JOIN users u ON p.user_id=u.id";
    }
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
                    <!-- <li><a href="activity.php">Activities</a></li> -->
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
                    <div class="search-filter">
                        <div class="filter">
                            <form action="<?php $_PHP_SELF?>" method="POST">
                                <div class="fields">
                                    <label for="min_price">Min Price:</label>
                                    <input type="number" name="min_price" id="min_price" placeholder="Minimum price">
                                </div>
                                <div class="fields">
                                    <label for="max_price">Max Price:</label>
                                    <input type="number" name="max_price" id="max_price" placeholder="Maximum price">
                                </div>
                                <div class="fields">
                                    <label for="min_area">Min Area:</label>
                                    <input type="number" name="min_area" id="min_area" placeholder="Minimum area in sq ft">
                                </div>
                                <div class="fields">
                                    <label for="max_area">Max Area:</label>
                                    <input type="number" name="max_area" id="max_area" placeholder="Maximum area in sq ft">
                                </div>
                                <input class="filter" name="filter" id type="submit" value="Filter">
                            </form>
                        </div>
                        <div class="search">
                            <h4>Search</h4>
                            <form action="<?php $_PHP_SELF?>" method="POST">
                                <input type="text" name="query" id="query" placeholder="Enter search term" required>
                                <input class="submit" type="submit" value="Search">
                            </form>
                        </div>
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
                                        <h4>Postby:- <?php echo $row["full_name"];?></h4>
                                        <h4>Contact:- <?php echo $row["contact"];?></h4>
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