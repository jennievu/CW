<!-- 
    matches submit page to show any matches that are found
    getting the current user by comparing the parameter string with the array from singles.txt
    then using the provided validation rules to find comparable matches
 -->
<?php
    $currentUser = [];
    $foundMatches = False;
    $singles = file("singles.txt");
    foreach($singles as $single) {   
        $singleArr = explode(',',$single);
        if(strcasecmp($singleArr[0],$_GET['name']) == 0) {
            $currentUser = $singleArr;
        }
    }

    function getImage($name) { // returning an image element with image matches the given name
        return '<img src="./images/'.$name.'.jpg" alt="'.$name.'">';
    }
?>
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
        <?php if(count($currentUser) == 0) { ?>
            <div>No user found</div>
        <?php } else { ?>
            <div>
                <strong>Matches for <?= $currentUser[0] ?></strong>
                <?php foreach($singles as $single): ?>
                    <?php 
                        $singleArr = explode(',',$single);
                        $singlePerTypechars = str_split($singleArr[3]);
                        $currentPerTypechars = str_split($currentUser[3]);
                        $name = strtolower(str_replace(' ','_',$singleArr[0]));
                        $matchPersonality = False;
                        for ($index = 0; $index < 4; $index++) {
                            if(strtolower($singlePerTypechars[$index]) == strtolower($currentPerTypechars[$index])) { // Compare personality by index
                                $matchPersonality = True;
                            }
                        }
                        if (strcmp($singleArr[1], $currentUser[1]) !== 0 && // Compare gender
                            strcmp($singleArr[4], $currentUser[4]) == 0 && // Compare OS
                            $singleArr[2] >= $currentUser[5] && // Compare age
                            $singleArr[2] <= $currentUser[6] && // Compare age
                            $matchPersonality) { // Compare personality
                    ?>
                        <div class="match">
                            <div><?= getImage($name) ?></div>
                            <ul>
                                <li><p><?= $singleArr[0] ?></p></li>
                                <li><strong>gender:</strong> <?= $singleArr[1] ?></li>
                                <li><strong>age:</strong> <?= $singleArr[2] ?></li>
                                <li><strong>type:</strong> <?= $singleArr[3] ?></li>
                                <li><strong>OS:</strong> <?= $singleArr[4] ?></li>
                            </ul>
                        </div>
                    <?php }?>
                <?php endforeach; ?>
            </div>
        <?php } ?>   
    </main>
</body>
</html>