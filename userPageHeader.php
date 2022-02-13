<?php
session_start();
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
        <a href="userHome.php" class="navbar-brand">
            <img src="img/logo.png" height="70" alt="logo">
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <form class="search-bar-form" action="userSearch.php" method="post">
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
                        <a class="dropdown-item" href="userGenre.php?genre=<?=$romance?>">Romance</a>
                        <a class="dropdown-item" href="userGenre.php?genre=<?=$thriller?>">Thriller</a>
                        <a class="dropdown-item" href="userGenre.php?genre=<?=$ya?>">Young Adult</a>
                        <a class="dropdown-item" href="userGenre.php?genre=<?=$fantasy?>">Fantasy</a>
                        <a class="dropdown-item" href="userGenre.php?genre=<?=$comedy?>">Comedy</a>
                        <a class="dropdown-item" href="userGenre.php?genre=<?=$sf?>">Science Fiction</a>
                        <a class="dropdown-item" href="userGenre.php?genre=<?=$nf?>">Non Fiction</a>
                      </div>
                </li>

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

                <li id="userProfile" class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Profile</a>
                    
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="userPosts.php?u_id=$user_id">My Posts</a>
                        <a class="dropdown-item" href="settings.php?u_id=$user_id">Settings</a>
                        <a class="dropdown-item" href="index.php">Log Out</a>
                      </div>
                </li>

            </ul>

        </div>
    </nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

<footer>

</footer>

</html>