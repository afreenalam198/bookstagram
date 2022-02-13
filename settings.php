<?php

include 'userPageHeader.php';

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="settingsSS.css">
</head>

<body>

    
    

    <div class="wrapper bg-white mt-sm-5 my-5">
        <h4 class="pb-4 border-bottom">Account settings</h4>
        
        <form action="" method="post">
            
            <div class="py-4">
                <div class="row py-2">
                    <div class="col-md-6"> 
                        <label for="firstname">First Name</label> 
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $user_firstName; ?>" disabled> 
                    </div>
                
                    <div class="col-md-6 pt-md-0 pt-3"> 
                        <label for="lastname">Last Name</label> 
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $user_lastName; ?>" disabled> 
                    </div>
                </div>

                <div id="bottomPadding" class="row">
                    <div class="col-md-6"> 
                        <label for="email">Email Address</label> 
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $user_email; ?>" disabled>
                        <div id="editTag">
                            <a href="edit1.php" >Edit</a> 
                        </div>
                    </div>
                
                    <div class="col-md-6 pt-md-0 pt-3"> 
                        <label for="username">Username</label> 
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $user; ?>" disabled> 
                    </div>
                </div>

                <div id="bottomPadding" class="row">
                    <div class="col-md-6 pt-md-0 pt-3"> 
                        <label for="phone">Phone Number</label> 
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $user_phoneNo; ?>" disabled> 
                    </div>

                    <div class="col-md-6 pt-md-0 pt-3"> 
                        <label for="password">Password</label> 
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $user_password; ?>" disabled>
                        <div id="editTag">
                            <a href="edit2.php" >Edit</a> 
                        </div> 
                    </div>
                </div>
            </div>

            <div class="d-sm-flex align-items-center pt-3 border-top" id="deactivate">
                <div> 
                    <p> </p>
                    <p>Want to deactivate your account?</p>
                </div>
                <div class="ml-auto"> 
                    <input type="submit" class="btn danger" value="Deactivate" name="deactivate"> 
                </div>
            </div>
        </form>
        
        
    </div>

</body>

<footer>

</footer>

</html>

<?php
    
    if (isset($_POST['deactivate'])) {
        echo '<script type="text/javascript">',
            'window.location.replace("index.php");',
            '</script>';
        $_SESSION = array();
        session_destroy();
        $query1 = "DELETE FROM user WHERE user_id='" . $user_id . "'";
        $result1 = mysqli_query($conn,$query1);
        
    }
    
?>