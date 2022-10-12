<!-- 
    sign up page to get user input and submit to signup submit page using POST request
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
        <form action="signup-submit.php" method="post">
            <fieldset>
                <legend>New User Signup:</legend>
                <label class="column" for="name">Name:</label>
                <input type="text" id="name" name="name" style="width:150px">
                <br><br>

                <label class="column" for="name">Gender:</label>
                <input type="radio" id="genderM" name="gender" value="M"> <span>Male</span>
                <input type="radio" id="genderF" name="gender" value="F" checked> <span>Female</span>
                <br><br>

                <label class="column" for="age">Age:</label>
                <input type="text" id="age" name="age" maxlength="2" style="width:60px">
                <br><br>

                <label class="column" for="personalityType">Personality type:</label>
                <input type="text" 
                        id="personalityType" 
                        name="personalityType" 
                        maxlength="4" 
                        style="width:60px; text-transform:uppercase"> 
                        (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp" target="_blank">Don't know your type?</a>)
                <br><br>

                <label class="column" for="favOS">Favorite OS:</label>
                <select name="favOS" id="favOS">
                    <option value="Windows">Windows</option>
                    <option value="Mac OS X">Mac OS X</option>
                    <option value="Linux">Linux</option>
                </select><br><br>

                <label class="column">Seeking age:</label>
                <input type="text" id="seekAgeFrom" 
                        name="seekAgeFrom" placeholder="Min" 
                        maxlength="2" style="width:60px"> 
                        to 
                <input type="text" id="seekAgeTo" 
                        name="seekAgeTo" placeholder="Max" 
                        maxlength="2" style="width:60px">
                <br><br>

                <input type="submit" value="Submit">
            </fieldset>
        </form>
    </main>
</body>
</html>