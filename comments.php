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
    <link rel="stylesheet" href="commentsSS.css">
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
        
            <form action="search.php" method="post" style="padding-left: 120px; width: 48%;">
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





<div class='modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' max-width: 45%;> 
    <div class='modal-dialog modal-dialog-centered' style='overflow-y: scroll;  margin-top: 30px; margin-bottom:50px;' > 
        <div class='modal-content'> 
            <div class='modal-header justify-content-center'> 
                <h3 class='modal-title'>Comments</h3> 
            </div> 
            <div class='modal-body'>

            <?php
            if(isset($_GET['post_id']) ){
                $post_id = $_GET['post_id'];
                $get_comments = "SELECT * FROM comments WHERE post_id='" . $post_id . "' ORDER BY com_id ASC";
                $run_comments = mysqli_query($conn, $get_comments);
                $check_comments = mysqli_num_rows($run_comments) > 0;
            
                if ($check_comments) {
                    while($row_comments = mysqli_fetch_array($run_comments)) {        
                        $comment = $row_comments['comment'];
                        $comment_author = $row_comments['comment_author'];
                    
            ?>

                    <p><b><?php echo $comment_author;?></b>&nbsp;&nbsp;<?php echo $comment;?></p>
                <?php 
                    }
                }
            else {
                ?>
                <p>No comments found</p>
                <?php
            }  
                
        }
            
        ?>
            
            
            </div> 
            <div class='modal-footer'>
                <a href="index.php"><b>Go back</b></a>
            </div> 
        </div> 
    </div> 
</div>
</body>
</html> 

