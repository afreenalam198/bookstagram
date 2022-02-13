<?php
include 'userPageHeader.php';



if(!isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="userSS.css">   
</head>
<body>
<br>
    

    <div class="container container">
            <div id="home" class="container"><br>
                <div class="row justify-content-center">
                    <div class="">

                    
                        <?php

                        $get_posts = "SELECT * FROM posts WHERE username='".$_SESSION['username']."' ORDER BY 1 DESC";
                        $run_posts = mysqli_query($conn, $get_posts);
                        $check_posts = mysqli_num_rows($run_posts) > 0;

                        

                        if ($check_posts) {
                            while($row_posts = mysqli_fetch_array($run_posts)) {
                                $user_id = $row_posts['user_id'];
                                $username = $row_posts['username'];
                                $post_id = $row_posts['post_id'];
                                $post_content = $row_posts['post_content'];
                                $post_image = $row_posts['post_image'];

                                $get_likes = "SELECT * FROM likes WHERE post_id='" . $post_id . "'";
                                $run_likes = mysqli_query($conn, $get_likes);
                                $total_likes = mysqli_num_rows($run_likes);
                                ?>
                                
                                    <div class='card mx-auto mt-5'>
                                        <div class='row post-header col-12 py-3 px-3'>
                                            <div class='col-6 float-left '><h4 style='font-size: 18px; margin-bottom: 0rem;'><?php echo $username;?></h4></div>
                                            
                                        </div>
                                        <img class='card-img' src='uploads/<?php echo $post_image?>' alt='Card image cap'>
                                        
                                        <div class='card-body px-3'>
                                            <h5 class='card-title' style='font-size: 16px;'><a href="commentAction.php?post_id=<?=$post_id?>&user_id=<?=$user_id?>"><i id="likeBtn" class='far fa-heart'></i></a>&nbsp; <?php echo $total_likes;?> Likes</h5>
                                            <p> </p>
                                            <p class='card-text'><b><?php echo $username?></b>&nbsp;&nbsp;<?php echo $post_content?></p>
                                        </div>
                                        
                                        <div class='row post-header px-3 pb-2'>
                                            <div class='col-10 float-left text-left'>
                                                <a href='commentsUser.php'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment'>
                                            </div>
                                            <div class='col-1 float-right '>
                                                <input type="hidden" name="post_id_val" value="<?php echo $post_id;?>">
                                                <input type="hidden" name="user_id_val" value="<?php echo $user_id;?>">
                                                <input class='btn btn-secondary btn-custom' style='margin-top: 0px; padding-bottom: 0.1rem; padding-top: 0.1rem;font-size: 16px;' type='submit' name='commentPost' value='Post'>
                                            </div>
                                        </div> 
                                        </form>      
                                    </div>
                                
                                
                                <?php
                                
                                
                            }
                        }
                        else {
                            echo 'No posts found';
                        }
                        ?>      
                            
                    </div>
                </div>    
            </div>    
        </div>

<br>
<br>    
</body>


<footer>

</footer>

</html>