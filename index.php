<?php
session_start();

/*Called to the main class that is in charge of having the main methods and functions to create the Bingo Cards  */
require_once 'classes/Bingo.php';

if(isset($_POST['restart'])){
    unset($_SESSION['bingo']);
}

if(!isset($_SESSION['bingo'])){
    $_SESSION['bingo'] = serialize(new Bingo());
}

$bingo = unserialize($_SESSION['bingo']);

if(isset($_POST['action'])){
    header('Content-type: application/json');
    echo $bingo->managePost();
    $_SESSION['bingo'] = serialize($bingo);
    exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Bingo!!</title>
    
    <meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Alberto Jiménez" />
    
    <link rel="stylesheet" type="text/css" href="css/bingo.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.min.css" />
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script>
        var init = <?php echo $bingo->getLastFive(); ?>;
    </script>
    <script src="js/bingo.js"></script>
</head>
<body>
<?php  
    echo '<div class="container">';
        echo '<h1>Bingo by Alberto Jiménez</h1>';
        
        echo '<div class="called">';
        echo '</div>';
        
        echo '<div class="bingo-board">';
            /* We print the Bingo card */
                echo $bingo;
        echo '</div>';
        
        echo '<button type="button" id="bingo">¡¡BINGO!!</button>';
    echo '</div>';
?>
</body>
</html>