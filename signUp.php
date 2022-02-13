<!DOCTYPE html>
<html>

<head>
    <title>Bookstagram</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="signUpSS.css">
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Website for book and book art lovers">
</head>

<body>
    
    <section class="Form">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <img src="img/bg2.jpg" class="img-fluid" alt="Image of a book">
                </div>
                <div id="signUpForm" class="col-lg-7 px-5 pt-1">
                    <h1 class="mb-3"><a href="index.php">Bookstagram</a></h1>
                    <form action=""  method="post">
                        <div class="form-row">
                            <div class="col-lg-8">
                                <input type="firstName" placeholder="First Name" class="form-control my-3 p-2" name="first_name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-8">
                                <input type="lastName" placeholder="Last Name" class="form-control my-3 p-2" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-8">
                                <input type="email" placeholder="Email Address" class="form-control my-3 p-2" name="email_id" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-8">
                                <input type="username" placeholder="Username" class="form-control my-3 p-2" name="username" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-8">
                                <input type="phone" placeholder="Phone Number" class="form-control my-3 p-2" name="phone_no" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-8">
                                <input type="password" placeholder="Password" class="form-control my-3 p-2" name="password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-8">
                                <input type="submit" class="btn mt-5 rounded-pill btn-lg btn-custom btn-block text-uppercase" value="Sign Up">
                            </div>
                        </div>
                    </form>
                </div>

            
                <div id="denyForm1" class="confirm-deny-form col-lg-7 px-5 py-5" style="display: none;">
                    <h1 class="mb-5">Bookstagram</h1>
                    <form>
                        <div class="form-row">
                            <div class="col-lg-7">
                                
                                <br>
                                <p>Sorry!</p>
                                <p>This email address is already registered.</p>
                                <p>Please try registering with another email address.</p>
                                <p>Try <a href="signUp.php"><strong>Signing up</strong></a> again</p>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="denyForm2" class="confirm-deny-form col-lg-7 px-5 py-5" style="display: none;">
                    <h1 class="mb-5">Bookstagram</h1>
                    <form>
                        <div class="form-row">
                            <div class="col-lg-7">
                                
                                <br>
                                <p>Sorry!</p>
                                <p>This username is not available.</p>
                                <p>Please try registering with another username.</p>
                                <p>Try <a href="signUp.php"><strong>Signing up</strong></a> again</p>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div id="confirmForm" class="confirm-deny-form col-lg-7 px-5 py-5" style="display: none;">
                    <h1 class="mb-5">Bookstagram</h1>
                    <form>
                        <div class="form-row">
                            <div class="col-lg-7">
                                
                                <br>
                                <p>Congratulations!</p>
                                <p>You have successfully created a Bookstagram Account.</p>
                                <p>Sign in <a href="signIn.php"><strong>here</strong></a> to enjoy all things books.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
      

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

<footer>

</footer>

</html>

<?php 
    include 'db_connection(epizy).php';
    $conn = OpenCon();

    if (isset($_POST['first_name']) && ($_POST['last_name']) && ($_POST['email_id']) && ($_POST['username']) && ($_POST['phone_no']) && ($_POST['password'])  ) {

        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $email_id = $conn->real_escape_string($_POST['email_id']);
        $username = $conn->real_escape_string($_POST['username']);
        $phone_no = $conn->real_escape_string($_POST['phone_no']);
        $password = $conn->real_escape_string($_POST['password']);
    
        $query1 = $conn->query("SELECT * FROM user WHERE  email_id='" . $email_id . "'");
        $query2 = $conn->query("SELECT * FROM user WHERE  username='" . $username . "'");
        $query3 = "INSERT INTO user (user_id, first_name, last_name, email_id, username, phone_no, password)
        VALUES ('','".$first_name."','".$last_name."','".$email_id."','".$username."','".$phone_no."','".$password."')";
        
        if (mysqli_num_rows($query1) == 1) {
            echo '<script type="text/javascript">',
            'openDenyForm1();',
            '</script>';
        }
        else if (mysqli_num_rows($query2) == 1) {
            echo '<script type="text/javascript">',
            'openDenyForm2();',
            '</script>';
        }
        else {
            echo '<script type="text/javascript">',
            'openConfirmForm();',
            '</script>';
         
        
            $result1 = mysqli_query($conn,$query3);
        }
        
        
    }

    /*
    
    */ 
?>

