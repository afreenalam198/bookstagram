<?php 
include 'userPageHeader.php';
    /*session_start();*/

    if (isset($_POST['submit'])) {
        

        $content = htmlentities($_POST['content']);
        $upload_image = $_FILES['upload_image']['name'];
        $image_tmp = $_FILES['upload_image']['tmp_name'];

        $fileExt = explode('.', $upload_image);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if (strlen($content) > 500) {
                echo "<script>alert('Please use 500 or less words.')</script>";
                echo "<script>window.open('userHome.php', '_self')</script>";
            }
    
            else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                $new_image_name = uniqid('', true).".".$fileActualExt;
                $image_destination = 'uploads/' . $new_image_name;
                move_uploaded_file($image_tmp, $image_destination);
                
                

                $query1 = "INSERT INTO posts (post_id, user_id, username, post_content, post_image, post_date, genre, book_name, author_name) VALUES ('','".$user_id."', '".$_SESSION['username']."', '".$content."', '".$new_image_name."', NOW(), '".$_SESSION['genre']."', '".$_SESSION['book_name']."', '".$_SESSION['author_name']."')";
                $result = mysqli_query($conn, $query1);
                echo "<script>alert('Done!')</script>";
                echo '<script type="text/javascript">',
                'window.location.replace("userHome.php");',
                '</script>';
            }
            else {
                echo "<script>alert('You have not written a review.')</script>";
                echo "<script>window.open('userHome.php', '_self')</script>";
            }

        }
        else if (strlen($content) >= 1 && strlen($upload_image) == 0) {
            echo "<script>alert('You have not selected an image.')</script>";
            echo "<script>window.open('userHome.php', '_self')</script>";
        }

        else {
            echo "<script>alert('You can only upload jpg, jpeg and png file types.')</script>";
            echo "<script>window.open('userHome.php', '_self')</script>";
        }

    }
    /*genre, book_name, author_name
    , '".$genre."', '".$book_name."', '".$author_name."'
    */
?>
