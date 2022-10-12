<!-- 
    matches page to pass in a user's name for look up
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
        <form action="matches-submit.php" method="get">
            <fieldset>
                <legend>Returning User:</legend>
                <label class="column" for="name">Name:</label>
                <input type="text" id="name" name="name" style="width:150px"><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
    </main>
</body>
</html>