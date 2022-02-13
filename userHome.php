<?php
include 'userPageHeader.php';

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="userSS.css">
    <script src="script.js"></script>
</head>
<body> 
    
    <div class="container container">
            <div id="home" class="container"><br>
                <div class="row justify-content-center">
                    <div class="">

                        <div class="card mx-auto border-light custom-card" id="uploadContainer">
                            <br>
                            <form action="postAction.php" method="post" id="upForm" enctype="multipart/form-data">
                                <textarea class="form-control" id="content" rows="2" name="content" placeholder="Write a book review"></textarea>
                                <input type="button" class="btn btn-secondary btn-custom" value="Book Info" onclick="openBookInfo()">
                                <label class="btn btn-secondary btn-custom" id="img_upload_btn" style="margin-bottom: auto;">Choose Image
                                <input type="file" size="30" style="display: none;" name="upload_image">
                                </label>
                                <input type="submit" class="btn btn-secondary btn-custom float-right" value="Post" name="submit">
                                
                            </form>
                            
                        </div>

                        <?php

                        $get_posts = "SELECT * FROM posts ORDER BY 1 DESC";
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
                                                <a href='commentsUser.php?post_id=<?=$post_id?>'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input class="comment-box" style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment'>
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

        <div class="d-flex justify-content-center align-items-center login-container">
            <form id="bookInfo" action="" class="login-form text-center" method="post" style="display: none;">
                <h1 class="mb-5">Book Information</h1>
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill form-control-lg" placeholder="Genre" name="genre" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill form-control-lg" placeholder="Book Title" name="book_name" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill form-control-lg" placeholder="Author" name="author_name" required>
                </div>
            
                <input type="submit" class="btn mt-5 rounded-pill btn-lg btn-custom1 btn-block text-uppercase" value="Submit" name="bookInfoSubmit">
                <br>
            </form>
    
        </div>
<br>
<br>
</body>

<?php 


    
    if (isset($_POST['bookInfoSubmit'])) {

        $_SESSION['genre'] = $conn->real_escape_string($_POST['genre']);
        $_SESSION['book_name'] = $conn->real_escape_string($_POST['book_name']);
        $_SESSION['author_name'] = $conn->real_escape_string($_POST['author_name']);

        echo '<script type="text/javascript">',
            'window.location.replace("userHome.php");',
            '</script>';
    }

    
?>
