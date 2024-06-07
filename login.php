<?php
    session_start();
    if(isset($_SESSION['email'])){
        header("location: logout.php");
        exit;
    }

    require_once "config.php";


    if ($_SERVER['REQUEST_METHOD'] == "POST"){  
        $email = trim($_POST['email']);     
        $password = trim($_POST['password']);    
        if(!empty($email) || !empty($password)){
            $sql = "SELECT * FROM users WHERE email='{$email}'";
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query)>0){
                $row = mysqli_fetch_assoc($query);
                if(password_verify($password,$row['password'])){
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['full_name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['contact'] = $row['contact'];
                    header("location: home.php");
                }else{
                    $_POST['error']='Password is not valid';
                }
            }else{
                $_POST['error']='User is not registred.';
            }
        }else{
            $_POST['error']='All input fields are required';
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Log in !!</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://kit.fontawesome.com/e5f4960269.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="form_wrapper">
      <section class="signup_form">
        <h1>Log in Form</h1>
        <form action="<?php $_PHP_SELF?>" method="post">
          <div class="field email">
            <label for="email">Email Address</label>
            <input type="text" id="email" name="email" placeholder="Enter email Address">
          </div>
          <div class="field password">
              <label for="password">Password</label>
              <div class="password_eye">
                <input type="password" id="password" name="password" placeholder="Enter Password">
                <i class="fas fa-eye"></i>
              </div>
          </div> 
          <div class="field button_submit">
            <input type="submit" value="Log In">
          </div>
        </form>
        <div class="link">Don't have account. Create one!! <a href=register.php>SignUp</a></div>
        <?php 
            if(isset($_POST["error"])){ 
              $errorData = $_POST['error'];
                echo "<div class='error-txt'> $errorData </div>";
            }
        ?>
      </section>
    </div>
    <script src="assets/js/script.js"></script>
  </body>
</html>
