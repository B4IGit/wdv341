<?php
function formatTimestamp($timestamp) {
    $formatDate = date('m/d/y', $timestamp);

    return $formatDate;
}

$timestamp = 1695850092; //time() to find timestamp
$formatDate = formatTimestamp($timestamp);


function internationalTimestamp($timestamp) {
    $date = new DateTime('@' . $timestamp);

    $formatInternationalTimestamp = $date->format('d/m/y');

    return $formatInternationalTimestamp;
}

$timestamp =time();
$formatInternationalTimestamp = internationalTimestamp($timestamp);



function myString() {
    //echo length of string
    $num_characters = strlen('I am a STUDENT');
    echo 'Number of characters: ' . $num_characters . '<br>';

    //removes any whitespace or trailing
    $trimmed_string = trim('I am a STUDENT');
    echo 'Trimmed string is: ' . $trimmed_string . '<br>';

    //converts all letters in the string into lowercase
    $lowercase_string = strtolower('I am a STUDENT');
    echo 'Lowercase String: '. $lowercase_string . '<br>' ;

    //will check to see if $lowercase_string contains DMACC
    if (stripos($lowercase_string, 'DMACC') !==false) {
        echo 'The string contains "DMACC" . <br>';
    }
       else {
        echo 'The string does not contain DMACC.<br>';
    }
}


function entered_number($number) {
// this removes any characters that is not a number
$number = preg_replace('/[^0-9]/', '', $number);

//validate input that 10 numbers exist 
if (strlen($number) === 10) {
    $format_number = sprintf("(%s) %s-%s", substr($number, 0, 3), substr($number, 3, 3), substr($number, 6));
        return $format_number;
    } else {
        // sends error message if number is incorrect
        return "Incorrect number, try again!";
    }
}

$number = '1234567890';
$format_number = entered_number($number);

function format_currency($number) {
    $format_number = "$" . number_format($number, 2);
    return $format_number;
}

$number = 123456;
$format_currency = format_currency($number);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4-1: PHP Functions</title>
</head>
<body>
<h1>Intro to PHP</h1>

<h2>I created this assignment on <?php echo $formatDate;?>.</h2>

<h3>Change the format to display "d/m/y": <span style="color :red"><?php echo $formatInternationalTimestamp?></span>.</h3>

<p><?php myString();?></p>

<p>Create a function that will accept a number and display it as a formatted phone number: <br>
    <span style="color: red">
        <?php
            echo $format_number;
        ?>
    </span>
</p>

<p>Create a function that will accept a number and display it as US currency with a dollar sign.  Use 123456 for your testing: <br>
    <span style="color:blue">
        <?php
            echo $format_currency;
        ?>
    </span>
</p>
    
</body>
</html>