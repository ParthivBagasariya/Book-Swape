<?php
    session_start();
    include_once "../config.php";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);

    if(!empty($username) && !empty($phone) && !empty($email) && !empty($password) && !empty($c_password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                header("location: ../Auth/auth.php?auth=signup");
                $_SESSION['alertError'] = "$email - This email already exists!";
            }else{
                if($password == $c_password){
                    $ran_id = rand(time(), 100000000);
                    $encrypt_pass = md5($password);
                    $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, username, phone, email, password)
                    VALUES ('{$ran_id}', '{$username}', '{$phone}', '{$email}', '{$encrypt_pass}')");
                    if($insert_query){
                        $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        if(mysqli_num_rows($select_sql2) > 0){
                            $result = mysqli_fetch_assoc($select_sql2);
                            $_SESSION['unique_id'] = $result['unique_id'];
                            $_SESSION['username'] = $result['username'];
                            header("location: ../index.php");
                            $_SESSION['alertSuccess'] = "You just Logged In!";
                        }else{
                            header("location: ../Auth/auth.php?auth=signup");
                            $_SESSION['alertError'] = "This email address does not exist!";
                        }
                    }else{
                        header("location: ../Auth/auth.php?auth=signup");
                        $_SESSION['alertError'] = "Something went wrong. Please try again!";
                    }
                }else{
                    header("location: ../Auth/auth.php?auth=signup");
                    $_SESSION['alertError'] = "Password & Confirm Password are different!";
                }
            }
        }else{
            header("location: ../Auth/auth.php?auth=signup");
            $_SESSION['alertError'] = "$email is not a valid email!";
        }
    }else{
        header("location: ../Auth/auth.php?auth=signup");
        $_SESSION['alertError'] = "All input fields are required!";
    }
?>