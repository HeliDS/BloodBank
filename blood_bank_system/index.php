<?php 
    ob_start(); //prevent  Warning: Cannot modify header information - headers already sent in 000webhost
    require_once('connection.php'); 
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Coustard">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Blood Bank</title>
</head>

<body class="bg-info">
    <div id="template-bg-1">
        <div
            class="d-flex flex-column min-vh-100 justify-content-center align-items-center pt-5">
            <div class="card p-4 text-light bg-dark mb-5">
                <div class="card-header">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body w-100">
                    <form name="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="input-group form-group mt-3">
                            <div class="bg-secondary rounded-start">
                                <span class="m-3"><i
                                    class="fas fa-user mt-2"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                placeholder="username" name="username">
                        </div>
                        <div class="input-group form-group mt-3">
                            <div class="bg-secondary rounded-start">
                                <span class="m-3"><i class="fas fa-key mt-2"></i></span>
                            </div>
                            <input type="password" class="form-control"
                                placeholder="password" name="password">
                        </div>
    
                        <div class="form-group mt-3">
                            <input type="submit" value="Login"
                                class="btn bg-secondary float-end text-white w-100"
                                name="login-btn">
                        </div>
                    </form>
                    <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $username = test_input($_POST['username']);  
                            $password = test_input($_POST['password']);  
                            
                            //to prevent from mysqli injection  
                            $username = stripcslashes($username);  
                            $password = stripcslashes($password);  
                            $username = mysqli_real_escape_string($conn, $username);  
                            $password = mysqli_real_escape_string($conn, $password);  
                            
                            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";  
                            $result = mysqli_query($conn, $sql);  
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                            $count = mysqli_num_rows($result);  
                                
                            if($count == 1){  
                                $_SESSION['login_user'] = $username;
                                header("Location:home.php");
                                exit();
                            }  
                            else{  
                                $loginResult = "Login failed. Invalid username or password.";
                            }

                        }

                        function test_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        if(!empty($loginResult)){
                    ?>
                    <div class="text-danger"><?php echo $loginResult;?></div>
                    <?php }?>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <div class="row">
                        <div class="text-primary">If you are a registered
                            user, login here.</div>
                        </div>
                        <div class="row">
                        <a href="register.php" class="btn btn-success mt-5">Register</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>