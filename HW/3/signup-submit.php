<!-- 
    sign up submit page to process the data from signup page
    saving the submitted data to an array then write it as a newline into the single.txt file
    including validations for field forms, each validation rule is put into its own function
    for better maintainability.
 -->
<?php
    $submittedData = array('name' => $_POST['name'],
        'gender' => $_POST['gender'], 
        'age' => $_POST['age'], 
        'personalityType' => $_POST['personalityType'], 
        'favOS' => $_POST['favOS'], 
        'seekAgeFrom' => $_POST['seekAgeFrom'], 
        'seekAgeTo' => $_POST['seekAgeTo']);

    function checkAge($age) {
        return $age >= 0 && $age <= 99;
    }
    function checkGender($gender) {
        return strcmp($gender, 'M') === 0 || strcmp($gender, 'F') === 0;
    }
    function checkOS($OSType) {
        return strcasecmp($OSType, 'Windows') || 
                strcasecmp($OSType, 'Mac OS X') || 
                strcasecmp($OSType, 'Linux');
    }
    function checkPersonalityType($type) {
        $typeEach = str_split($type);
        $isCorrectType = 0;
        for ($i=0; $i < count($typeEach); $i++) {
            switch($i){
                case 0:
                    if(strcasecmp($typeEach[$i],'I') == 0 || strcasecmp($typeEach[$i],'E') == 0) $isCorrectType++;
                    break;
                case 1:
                    if(strcasecmp($typeEach[$i],'N') == 0 || strcasecmp($typeEach[$i],'S') == 0) $isCorrectType++;
                    break;
                case 2:
                    if(strcasecmp($typeEach[$i],'F') == 0 || strcasecmp($typeEach[$i],'T') == 0) $isCorrectType++;
                    break;
                case 3:
                    if(strcasecmp($typeEach[$i],'J') == 0 || strcasecmp($typeEach[$i],'P') == 0) $isCorrectType++;
                    break;
                default:
                    return 0;
            }
        }
        return $isCorrectType == 4;
    }

    function validCheck($data) {
        if(!isset($data)) return false;
        if(strcmp($data['name'], '') !== 0 &&
            is_numeric($data['age']) &&
            checkAge($data['age']) &&
            checkGender($data['gender']) &&
            checkPersonalityType($data['personalityType']) &&
            checkOS($data['favOS']) &&
            is_numeric($data['seekAgeFrom']) &&
            is_numeric($data['seekAgeTo']) &&
            checkAge($data['seekAgeFrom']) &&
            checkAge($data['seekAgeTo']) &&
            $data['seekAgeFrom'] <= $data['seekAgeTo']
        ) {
            return true;
        } else {
            return false;
        }
    }

   
    if(validCheck($submittedData))
    {
        $singles = file_get_contents('singles.txt');
        $singles .= "\r\n";
        $singles .= implode(',',$submittedData);
        file_put_contents('singles.txt', $singles);
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
        <?php if(validCheck($submittedData)) { ?>
            <h3>Sign Up successful</h3>
            <a href="matches.php">Log in to see your matches!</a>
        <?php } else { ?>
            We're sorry. You submitted invalid user information. Please go back and try again.
        <?php } ?>

    </main>
</body>

</html>