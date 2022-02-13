<?php
include 'userPageHeader.php';

if (isset($_POST['commentPost'])) {
    $query3 = $conn->query("INSERT INTO comments (com_id, post_id, user_id, comment, comment_author)
    VALUES ('','".$_POST['post_id_val']."','".$_POST['user_id_val']."','".$_POST['comment']."','".$_SESSION['username']."')");
    $result = mysqli_query($conn, $query3);
    echo "<script>alert('Done')</script>";
                echo '<script type="text/javascript">',
                'window.location.replace("userHome.php");',
                '</script>';
}

if(isset($_GET['post_id']) && ($_GET['user_id'])) {
        
    $post_id = $_GET['post_id'];
    $user_id = $_GET['user_id'];
    $query4 = $conn->query("SELECT * FROM likes WHERE post_id='" . $post_id . "' AND like_author='".$_SESSION['username']."'");
    $query5 = "INSERT INTO likes (like_id, user_id, post_id, like_author)
    VALUES ('','".$user_id."','".$post_id."','".$_SESSION['username']."')";
    //echo mysqli_num_rows($query4);
    if (mysqli_num_rows($query4) <= 0) {
        
        $result1 = mysqli_query($conn, $query5);
        echo "<script>alert('Done')</script>";
        echo '<script type="text/javascript">',
            'window.location.replace("userHome.php");',
            '</script>';
    }
    else if (mysqli_num_rows($query4) >= 1) {
        
        echo "<script>alert('You have alrady liked this post')</script>";
        echo '<script type="text/javascript">',
            'window.location.replace("userHome.php");',
            '</script>';
        
    }
}
?>

