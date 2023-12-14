<?php
    $yourName = "Devin Ledesma";

    $number1 = 13;
    $number2 = 27;
    $total = $number1 + $number2;

    



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
            let scriptLanguages = [
                "PHP",
                " HTML",
                " Javascript",
            ];
    </script>
</head>
<body>
    <h1>2-1: PHP Basics</h1>

    <h2><?php echo "My name is " . $yourName . ". "; ?></h2>

    <p>Number 1 = <?php echo $number1; ?></p>
    <p>Number 2 = <?php echo $number2; ?></p>
    <p>Total = <?php echo $total; ?></p>

    <p><?php $scriptLanguages = array("PHP", "HTML", "Javascript");
        foreach ($scriptLanguages as $val) {
            echo "$val \n" . "<br>";
        } ?></p>

    <p><script>document.write(scriptLanguages);</script></p>
    
    
</body>
</html>