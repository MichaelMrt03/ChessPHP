<?php
    require_once("controller.php");

    session_start();

    if(isset($_SESSION['current_x']) & isset($_SESSION['current_y']))
    {
        $_POST['current_x'] = $_SESSION['current_x'];
        $_POST['current_y'] = $_SESSION['current_y'];
    }

    if(isset($_SESSION['chessboard'])){
        $_POST['chessboard'] = $_SESSION['chessboard'];
    }

    if(isset($_SESSION['whitesturn'])){
        $_POST['whitesturn'] = $_SESSION['whitesturn'];
    }

    # resets the board in logic constructor
    if(isset($_POST['reset'])){
        $_POST = array();
        $_SESSION = array();
    }

    $_SESSION = $_POST;

    echo "<link rel='stylesheet' href='style.css'>";
   # echo "<h1>Chessgame</h1>";

   # header
    echo "<div><h1>HEADER</h2></div>";

    # middle
    echo "<div class='container'>";

        # left div

        echo "
        <div class='inner-div'>
        <form method='post' action='chessgame.php'>
            <h3>left</h3>
            <input type='hidden' name='reset' value='true'>
            <input type='submit' value='reset'> </input>
        </form>
        </div>";

        echo "<div class='inner-div'>";
        $controller = new Controller();
        echo "</div>";

        # right div
        echo "<div class='inner-div'><h3>right</h3></div>";

    echo "</div>";

    # footer
    echo "<div><h1>footer</h1></div>";
?>