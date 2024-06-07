<?php
    include "config.php";  

    function checkEmail($email){
        include "config.php";
        $sql = "SELECT email FROM users WHERE email = '{$email}'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0){ #check if the user already exists
            return TRUE;
        }else{
            return FALSE;
        }
    }

  function createUser($name,$email,$contact,$hashed_password){
        include "config.php";
        $sql = "INSERT INTO users (full_name, email, contact , password) VALUES ('{$name}', '{$email}', '{$contact}', '{$hashed_password}')";
        $query = mysqli_query($conn,$sql);#Register a new user
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
  }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){ 
        $name = trim($_POST["fullName"]); 
        $email = trim($_POST["email"]);
        $contact = trim($_POST["contact"]);
        $password = trim($_POST['password']); 
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        if(!empty(trim($_POST["email"])) && !empty(trim($_POST["password"]))){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if(!checkEmail($email)){
                        if(createUser($name,$email,$contact,$hashed_password)){
                            header("location: login.php");
                        }else{    
                            $_POST['error']='Contact Admin';
                          }
                      }else{
                        $_POST['error']='Email is already registred';
                      }
                    }else{
                      $_POST['error']='Email is not valid ';
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
    <title>Register!!</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://kit.fontawesome.com/e5f4960269.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="form_wrapper">
      <section class="signup_form">
        <h2>Register Form</h2>
        <form action="<?php $_PHP_SELF ?>" method="post">
          <div class="name-details">
              <div class="field full_name">
                  <label for="fullName">First Name</label>
                  <input type="text" id="fullName" name="fullName" placeholder="Full Name">
              </div>
          </div>
          <div class="field email">
            <label for="email">Email Address</label>
            <input type="text" id="email" name="email" placeholder="Enter your email Address">
          </div>
          <div class="field contact">
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" placeholder="Enter your contact">
          </div>
          <div class="field password">
              <label for="password">Password</label>
              <div class="password_eye">
                <input type="password" id="password" name="password" placeholder="Enter new Password">
                <i class="fas fa-eye"></i>
              </div>
          </div> 
          <div class="field button_submit">
            <input type="submit" value="Register">
          </div>
        </form>
        <div class="link">Already signed up? <a href="login.php">Login now</a></div>
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

