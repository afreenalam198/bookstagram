<?php 
include 'db_connection(epizy).php';
$conn = OpenCon();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Bookstagram</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Website for book and book art lovers">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light">
        <a href="index.php" class="navbar-brand">
            <img src="img/logo.png" height="70" alt="logo">
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
        
            <form action="search.php" method="post">
            <div class="input-group mx-auto">
                <input name="search" type="text" class="form-control" placeholder="Look for authors or books" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                <div class="input-group-append">
                    <input name="submit" type="submit" class="btn btn-secondary" value="Search">
                </div>
            </div>
            </form>
        
        
            <ul class="navbar-nav ml-auto">
                <li id="genre" class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Genres</a>
                        <?php 
                        $romance = "romance";
                        $thriller = "thriller";
                        $ya = "young adult";
                        $fantasy = "fantasy";
                        $comedy = "comedy";
                        $sf = "science fiction";
                        $nf = "non fiction";
                        
                        ?>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="genre.php?genre=<?=$romance?>">Romance</a>
                        <a class="dropdown-item" href="genre.php?genre=<?=$thriller?>">Thriller</a>
                        <a class="dropdown-item" href="genre.php?genre=<?=$ya?>">Young Adult</a>
                        <a class="dropdown-item" href="genre.php?genre=<?=$fantasy?>">Fantasy</a>
                        <a class="dropdown-item" href="genre.php?genre=<?=$comedy?>">Comedy</a>
                        <a class="dropdown-item" href="genre.php?genre=<?=$sf?>">Science Fiction</a>
                        <a class="dropdown-item" href="genre.php?genre=<?=$nf?>">Non Fiction</a>
                      </div>
                </li>

                <li class="nav-item">
                    <a href="signUp.php" class="nav-link">Sign Up</a>
                </li>

                <li class="nav-item">
                    <a href="signIn.php" class="nav-link">Sign In</a>
                </li>

            </ul>

        </div>
    </nav>

<div class="container container">
            <div id="home" class="container"><br>
                <div class="row justify-content-center">
                    <div class="">

<?php
if(isset($_GET['genre']) ){

    if(isset($_GET['genre']) == "romance" ) {
        $genre = $_GET['genre'];
        $get_posts = "SELECT * FROM posts WHERE genre='" . $genre . "' ORDER BY 1 DESC";
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
                                            <h5 class='card-title' style='font-size: 16px;'><a href=""><i id="likeBtn" class='far fa-heart'></i></a>&nbsp; <?php echo $total_likes;?> Likes</h5>
                                            <p> </p>
                                            <p class='card-text'><b><?php echo $username?></b>&nbsp;&nbsp;<?php echo $post_content?></p>
                                        </div>
                                        
                                        <div class='row post-header px-3 pb-2'>
                                            <div class='col-10 float-left text-left'>
                                                <a href='comments.php?post_id=<?=$post_id?>'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment' disabled>
                                            </div>
                                            <div class='col-1 float-right '>
                                                <input type="hidden" name="post_id_val" value="<?php echo $post_id;?>">
                                                <input type="hidden" name="user_id_val" value="<?php echo $user_id;?>">
                                                <input class='btn btn-secondary btn-custom' style='margin-top: 0px; padding-bottom: 0.1rem; padding-top: 0.1rem;font-size: 16px;' type='submit' name='commentPost' value='Post' disabled>
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
        <?php

    }

    else if (isset($_GET['genre']) == "thriller" ) {
        $genre = $_GET['genre'];
        $get_posts = "SELECT * FROM posts WHERE genre='" . $genre . "' ORDER BY 1 DESC";
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
                                            <h5 class='card-title' style='font-size: 16px;'><a href=""><i id="likeBtn" class='far fa-heart'></i></a>&nbsp; <?php echo $total_likes;?> Likes</h5>
                                            <p> </p>
                                            <p class='card-text'><b><?php echo $username?></b>&nbsp;&nbsp;<?php echo $post_content?></p>
                                        </div>
                                        
                                        <div class='row post-header px-3 pb-2'>
                                            <div class='col-10 float-left text-left'>
                                                <a href='comments.php?post_id=<?=$post_id?>'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment' disabled>
                                            </div>
                                            <div class='col-1 float-right '>
                                                <input type="hidden" name="post_id_val" value="<?php echo $post_id;?>">
                                                <input type="hidden" name="user_id_val" value="<?php echo $user_id;?>">
                                                <input class='btn btn-secondary btn-custom' style='margin-top: 0px; padding-bottom: 0.1rem; padding-top: 0.1rem;font-size: 16px;' type='submit' name='commentPost' value='Post' disabled>
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
        <?php

    }

    else if(isset($_GET['genre']) == "young adult" ) {
        $genre = $_GET['genre'];
        $get_posts = "SELECT * FROM posts WHERE genre='" . $genre . "' ORDER BY 1 DESC";
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
                                            <h5 class='card-title' style='font-size: 16px;'><a href=""><i id="likeBtn" class='far fa-heart'></i></a>&nbsp; <?php echo $total_likes;?> Likes</h5>
                                            <p> </p>
                                            <p class='card-text'><b><?php echo $username?></b>&nbsp;&nbsp;<?php echo $post_content?></p>
                                        </div>
                                        
                                        <div class='row post-header px-3 pb-2'>
                                            <div class='col-10 float-left text-left'>
                                                <a href='comments.php?post_id=<?=$post_id?>'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment' disabled>
                                            </div>
                                            <div class='col-1 float-right '>
                                                <input type="hidden" name="post_id_val" value="<?php echo $post_id;?>">
                                                <input type="hidden" name="user_id_val" value="<?php echo $user_id;?>">
                                                <input class='btn btn-secondary btn-custom' style='margin-top: 0px; padding-bottom: 0.1rem; padding-top: 0.1rem;font-size: 16px;' type='submit' name='commentPost' value='Post' disabled>
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
        <?php

    }
    else if(isset($_GET['genre']) == "fantasy" ) {
        $genre = $_GET['genre'];
        $get_posts = "SELECT * FROM posts WHERE genre='" . $genre . "' ORDER BY 1 DESC";
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
                                            <h5 class='card-title' style='font-size: 16px;'><a href=""><i id="likeBtn" class='far fa-heart'></i></a>&nbsp; <?php echo $total_likes;?> Likes</h5>
                                            <p> </p>
                                            <p class='card-text'><b><?php echo $username?></b>&nbsp;&nbsp;<?php echo $post_content?></p>
                                        </div>
                                        
                                        <div class='row post-header px-3 pb-2'>
                                            <div class='col-10 float-left text-left'>
                                                <a href='comments.php?post_id=<?=$post_id?>'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment' disabled>
                                            </div>
                                            <div class='col-1 float-right '>
                                                <input type="hidden" name="post_id_val" value="<?php echo $post_id;?>">
                                                <input type="hidden" name="user_id_val" value="<?php echo $user_id;?>">
                                                <input class='btn btn-secondary btn-custom' style='margin-top: 0px; padding-bottom: 0.1rem; padding-top: 0.1rem;font-size: 16px;' type='submit' name='commentPost' value='Post' disabled>
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
        <?php

    }
    else if(isset($_GET['genre']) == "comedy" ) {
        $genre = $_GET['genre'];
        $get_posts = "SELECT * FROM posts WHERE genre='" . $genre . "' ORDER BY 1 DESC";
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
                                            <h5 class='card-title' style='font-size: 16px;'><a href=""><i id="likeBtn" class='far fa-heart'></i></a>&nbsp; <?php echo $total_likes;?> Likes</h5>
                                            <p> </p>
                                            <p class='card-text'><b><?php echo $username?></b>&nbsp;&nbsp;<?php echo $post_content?></p>
                                        </div>
                                        
                                        <div class='row post-header px-3 pb-2'>
                                            <div class='col-10 float-left text-left'>
                                                <a href='comments.php?post_id=<?=$post_id?>'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment' disabled>
                                            </div>
                                            <div class='col-1 float-right '>
                                                <input type="hidden" name="post_id_val" value="<?php echo $post_id;?>">
                                                <input type="hidden" name="user_id_val" value="<?php echo $user_id;?>">
                                                <input class='btn btn-secondary btn-custom' style='margin-top: 0px; padding-bottom: 0.1rem; padding-top: 0.1rem;font-size: 16px;' type='submit' name='commentPost' value='Post' disabled>
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
        <?php

    }
    else if(isset($_GET['genre']) == "science fiction" ) {
        $genre = $_GET['genre'];
        $get_posts = "SELECT * FROM posts WHERE genre='" . $genre . "' ORDER BY 1 DESC";
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
                                            <h5 class='card-title' style='font-size: 16px;'><a href=""><i id="likeBtn" class='far fa-heart'></i></a>&nbsp; <?php echo $total_likes;?> Likes</h5>
                                            <p> </p>
                                            <p class='card-text'><b><?php echo $username?></b>&nbsp;&nbsp;<?php echo $post_content?></p>
                                        </div>
                                        
                                        <div class='row post-header px-3 pb-2'>
                                            <div class='col-10 float-left text-left'>
                                                <a href='comments.php?post_id=<?=$post_id?>'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment' disabled>
                                            </div>
                                            <div class='col-1 float-right '>
                                                <input type="hidden" name="post_id_val" value="<?php echo $post_id;?>">
                                                <input type="hidden" name="user_id_val" value="<?php echo $user_id;?>">
                                                <input class='btn btn-secondary btn-custom' style='margin-top: 0px; padding-bottom: 0.1rem; padding-top: 0.1rem;font-size: 16px;' type='submit' name='commentPost' value='Post' disabled>
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
        <?php

    }
    else if(isset($_GET['genre']) == "non fiction" ) {
        $genre = $_GET['genre'];
        $get_posts = "SELECT * FROM posts WHERE genre='" . $genre . "' ORDER BY 1 DESC";
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
                                            <h5 class='card-title' style='font-size: 16px;'><a href=""><i id="likeBtn" class='far fa-heart'></i></a>&nbsp; <?php echo $total_likes;?> Likes</h5>
                                            <p> </p>
                                            <p class='card-text'><b><?php echo $username?></b>&nbsp;&nbsp;<?php echo $post_content?></p>
                                        </div>
                                        
                                        <div class='row post-header px-3 pb-2'>
                                            <div class='col-10 float-left text-left'>
                                                <a href='comments.php?post_id=<?=$post_id?>'>View comments</a>
                                            </div>
                                        </div>
                                        <form action='commentAction.php' method='post'>
                                        <div class='row post-header px-3 pb-3'>
                                            <div class='col-10 float-left text-left'>
                                                <input style='border: none; outline: none; color: #212529;' placeholder='Add a comment' name='comment' disabled>
                                            </div>
                                            <div class='col-1 float-right '>
                                                <input type="hidden" name="post_id_val" value="<?php echo $post_id;?>">
                                                <input type="hidden" name="user_id_val" value="<?php echo $user_id;?>">
                                                <input class='btn btn-secondary btn-custom' style='margin-top: 0px; padding-bottom: 0.1rem; padding-top: 0.1rem;font-size: 16px;' type='submit' name='commentPost' value='Post' disabled>
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
        <?php

    }
    
}
?>
<br>
<br>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>