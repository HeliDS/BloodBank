<?php 
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

<!-- <body class="bg-danger"> -->
<body class="bg-danger" style="background-image: url('./blood-donation.jpg'); background-repeat: repeat-y; background-size: cover;">
    <div id="template-bg-1">
        <div
            class="d-flex flex-column min-vh-100 justify-content-center align-items-center pt-5">
            <div class="card p-4 text-light bg-dark mb-5 col-4">
                <div class="card-header">
                    <h3>Sign Up</h3>
                </div>
                <div class="card-body w-100">
                    <form name="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="input-group form-group mt-3">
                            <div class="bg-secondary rounded-start">
                                <span class="m-3"><i
                                    class="fas fa-user mt-2"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                placeholder="your name" name="name">
                        </div>
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
                        <div class="input-group form-group mt-3">
                            <div class="bg-secondary rounded-start">
                                <span class="m-3"><i class="fas fa-key mt-2"></i></span>
                            </div>
                            <input type="password" class="form-control"
                                placeholder="verify password" name="password2">
                        </div>
    
                        <div class="form-group mt-3 justify-content-center">
                            <!-- <input type="submit" value="Register" class="btn bg-success float-end text-white w-100" name="login-btn"> -->
                            <input type="submit" value="Register" class="btn btn-success float-end text-white w-100" name="login-btn">
                        </div>
                    </form>
                    <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $name = test_input($_POST['name']);  
                            $username = test_input($_POST['username']);  
                            $password = test_input($_POST['password']);  
                            $password2 = test_input($_POST['password2']);  
                            
                            //to prevent from mysqli injection  
                            $name = stripcslashes($name);  
                            $username = stripcslashes($username);  
                            $password = stripcslashes($password);  
                            $password2 = stripcslashes($password2);  
                            $name = mysqli_real_escape_string($conn, $name);  
                            $username = mysqli_real_escape_string($conn, $username);  
                            $password = mysqli_real_escape_string($conn, $password);  
                            $password2 = mysqli_real_escape_string($conn, $password2);  

                            if($password == $password2 && !empty($password) && !empty($password2)){
                                $password = password_hash($password, PASSWORD_BCRYPT);
                                // echo "<script>console.log('h-password','$password');</script>";

                                $sql = "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')";  

                                try{
                                    if ($conn->query($sql) === TRUE) {
                                        $regResultSuccess = "User registered successfully!";
                                    } else {
                                        $regResult = "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                } catch(Exception $e){
                                    $regResult = "Error: " . $sql . ";<br>" . $conn->error;
                                }
                                

                            }else{
                                $regResult = "Please verify password correctly!";

                            }
                        }

                        function test_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }

                        if(!empty($regResult)){
                    ?>
                    <div class="text-danger"><?php echo $regResult;?></div>
                    <?php }

                        if(!empty($regResultSuccess)){  
                    ?>
                    <div class="text-success"><?php echo $regResultSuccess;?></div>
                    <?php } ?>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="index.php" class="btn btn-primary btn-sm">Login</a>
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