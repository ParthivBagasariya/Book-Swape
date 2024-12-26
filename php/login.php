<?php 
    session_start();
    include_once "../config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass){
                $_SESSION['unique_id'] = $row['unique_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['alertSuccess'] = "You just Logged In";
                
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 1){
                    header("location: ../checkout.php");
                }else{
                    header("location: ../index.php");
                }
            }else{
                header("location: ../Auth/auth.php?auth=login");
                $_SESSION['alertError'] = "Email or Password is Incorrect!";
            }
        }else{
            header("location: ../Auth/auth.php?auth=login");
            $_SESSION['alertError'] = "$email - This email does not exist!";
        }
    }else{
        header("location: ../Auth/auth.php?auth=login");
        $_SESSION['alertError'] = "All input fields are required!";
    }
?>