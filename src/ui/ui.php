<?php
class Ui
{
    function __construct()
    {
    }

    # prints the board by checking each array/square content, temporary output for working in logic
    # and setting up the structure
    public function print_board(mixed $chessboard): void
    {
        $boardnumeration = 8;

        $encoded_json = json_encode($chessboard);
      # $_SESSION['chessboard'] = $encoded_json;

        echo "<form method='post' action='chessgame.php'>
              <input name='chessboard' type='hidden' value='" . $encoded_json . "'></input>            
              <input name='whitesturn' type='hidden' value='".$_SESSION['whitesturn']."'></input>
              <input name='move_number' type='hidden' value='".$_SESSION['move_number']."'></input>
              ";  

        echo "<div class='square-container center'>";
       
        if(isset($_SESSION['pickedsquare'])){
            $picked_x = (int) substr($_SESSION['pickedsquare'],0,1);
            $picked_y = (int) substr($_SESSION['pickedsquare'],1,2);
        }else{
            $picked_x = null;
            $picked_y = null;
        }
        
        for ($y = 8; $y > 0; $y--) {
            for ($x = 1; $x < 9; $x++) {
                # set color based on position
                if($x==$picked_x && $y ==$picked_y){
                    $area_color = "yellow";
                }elseif ((($y % 2 == 1 && $x % 2 == 1) || ($y % 2 == 0 && $x % 2 == 0))) {
                    $area_color = "brown";
                } else {
                    $area_color = "white";
                }
                if ($chessboard[$x][$y] == "") { #No piece in that square
                    if(!isset($_SESSION['pickedsquare'])){
                        echo "<div class='square $area_color'><button class='square $area_color' type='submit' name='pickedsquare' value='$x$y'></button></div>";
                    }else{
 
                        echo "<div class='square $area_color'><button class='square $area_color' type='submit' name='movetosquare' value='$x$y'></button></div>";
                    }
                   
                } elseif (is_a($chessboard[$x][$y], 'Chesspiece')) { # chesspiece in that square
                    if ($chessboard[$x][$y]->get_color() == "white") { # white piece
                        if(!isset($_SESSION['pickedsquare'])){
                            echo "<div class='square $area_color'><button class='square $area_color' type='submit' name='pickedsquare' value='$x$y'>".$chessboard[$x][$y]->get_icon()."</button></div>";
                        }else{
     
                            echo "<div class='square $area_color'><button class='square $area_color' type='submit' name='movetosquare' value='$x$y'>".$chessboard[$x][$y]->get_icon()."</button></div>";
                        }
                    }
                    if ($chessboard[$x][$y]->get_color() == "black") { # black piece
                        if(!isset($_SESSION['pickedsquare'])){
                            echo "<div class='square $area_color'><button class='square $area_color' type='submit' name='pickedsquare' value='$x$y'>".$chessboard[$x][$y]->get_icon()."</button></div>";
                        }else{
                            echo "<div class='square $area_color'><button class='square $area_color' type='submit' name='movetosquare' value='$x$y'>".$chessboard[$x][$y]->get_icon()."</button></div>";
                        }
                    }
                } 

                # bordnumeration right side
                if ($x == 8) {
                    echo "<div class='square'>$boardnumeration</div>";
                    $boardnumeration--;
                }
            }
        }

        #boardnumeration on the bottom
        for ($boardnumeration = 1; $boardnumeration < 9; $boardnumeration++) {
            echo "<div class='square'>$boardnumeration</div>";
        }
        echo "</div>";
        echo "</form>";
    }
}
