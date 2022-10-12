<!-- 
    Nga Vu
    CSC4370
    index file to show the 2 links for sign up and search for matches
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./nerdluv.css">
    <title>nerdLuv</title>
</head>
<body>
    <?php
        include('common.php');
    ?>
    <main>
        <p><strong>Welcome!</strong></p>
        <a href="signup.php">
            <img src="./assets/pen-to-square-solid.svg" alt="sign up" height="25">
            Sign up for a new account
        </a><br>
        <a href="matches.php">
            <img src="./assets/heart-solid.svg" alt="sign up" height="25">
            Check your matches
        </a>
    </main>

</body>
</html>