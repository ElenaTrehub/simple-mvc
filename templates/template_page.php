<?php /**
 * @var $test

 */ ?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link media="screen" rel="stylesheet" href="../public/css/style.css">

</head>

<body>
<div class="wrapper">
    <div class="strap">
        <img src="../public/images/rec.png" alt="">
    </div>
    <div class="container">
        <?php include __DIR__ . "\\". $content_view; ?>
    </div>

</div>
</body>



</html>