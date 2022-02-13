<?php

include 'userPageHeader.php';

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="editSS.css">
    <script src="script.js"></script>
</head>

<body>

    <?php
        $user = $_SESSION['username'];
        $get_user = "SELECT * FROM user WHERE username = BINARY '" . $user . "'";
        $run_user = mysqli_query($conn, $get_user);
        $row = mysqli_fetch_array($run_user);

        $user_id = $row['user_id'];
        $user_firstName = $row['first_name'];
        $user_lastName = $row['last_name'];
        $user_email = $row['email_id'];
        $user_phoneNo = $row['phone_no'];
        $user_password = $row['password'];

        $user_posts = $conn->query("SELECT * FROM posts WHERE user_id = '" . $user_id . "'");
        $posts = mysqli_num_rows($user_posts);

        
    ?>
    

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
                        <input type="text" class="bg-light form-control" placeholder="<?php echo $user_email; ?>" name="new_email_id">
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

            <div class="py-3 pb-4 border-bottom"> 
                <span id="denyLine" class="" style="display: none">Sorry! This email address is already in use.</span> 
                <input type="submit" class="btn border button mr-3 btn-custom" value="Save Changes" name="save">
                
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
    





    if (isset ($_POST['new_email_id']) ) {

        $email_id = $conn->real_escape_string($_POST['new_email_id']);

        $query1 = $conn->query("SELECT * FROM user WHERE  email_id='" . $email_id . "'");
        $query2 = "UPDATE user SET email_id='" . $email_id ."' WHERE user_id='" . $user_id . "'";
        

        if (mysqli_num_rows($query1) == 1) {
            echo '<script type="text/javascript">',
            'openDenyLine();',
            '</script>';
           
        }
        else {
            $result1 = mysqli_query($conn,$query2);
            echo '<script type="text/javascript">',
            'window.location.replace("settings.php");',
            '</script>';
        }

    }

    

?>