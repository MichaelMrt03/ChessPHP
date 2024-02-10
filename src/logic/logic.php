<?php
require_once("chesspieces/pawn.php");

class Logic
{
    function __construct()
    {
        

        #check if inputs were filled out
        if ($this->check_inputs_filled()) {

            #reconstruct chessboard from json
           $chessboard = $this->reconstruct_chessboard_from_json($_POST['chessboard']);

            # get the coordinates
            $current_x = substr($_POST['piece_coordinates'],0,1);
            $current_y = substr($_POST['piece_coordinates'],2,1);
            $move_to_x = substr($_POST['move_to_coordinates'],0,1);
            $move_to_y = substr($_POST['move_to_coordinates'],2,1);

            #move the piece
            $chessboard = $chessboard[$current_x][$current_y]->move($chessboard, $move_to_x, $move_to_y);

            #print out updated board
            print_r($this->print_board($chessboard));
        } else {
            $chessboard = $this->create_board();
            $this->print_board($chessboard);
        }

        echo "<h3>Format to pick piece is x,y</h3>";

        echo "<form method='post' action='controller.php'>
                <label>Enter coordinates of the piece you want to move</label>
                <input name='piece_coordinates' type='text'>
                <br><br>
                <label>Move to coordinates</label>
                <input name='move_to_coordinates' type='text'>
                <br>
                <input name='chessboard' type='hidden' value='".htmlspecialchars(json_encode($chessboard),JSON_PRETTY_PRINT)."'></input>
                <input type='submit' value='Submit move'>
             </form>";
    }

    private function create_board()
    {
        #Creates an 8x8 array
        for ($x = 1; $x < 9; $x++) {
            for ($y = 1; $y < 9; $y++) {
                $chessboard[$x][$y] = "";
            }
        }
        #place white pawns
        for ($x = 1; $x < 9; $x++) {
            $y = 7;
            $chessboard[$x][$y] = new Pawn("white", $x, $y);
        }

        #place black pawns
        for ($x = 1; $x < 9; $x++) {
            $y = 2;
            $chessboard[$x][$y] = new Pawn("black", $x, $y);
        }

        return $chessboard;
    }

    # prints the board by checking each array/square content, temporary output for working in logic
    # and setting up the structure
    private function print_board($chessboard)
    {
        $boardnumeration = 1;
        echo "<div class='square-container center'>";

        for ($y = 1; $y < 9; $y++) {

            for ($x = 1; $x < 9; $x++) {

                if ($chessboard[$x][$y] == "") { #No piece in that square
                    echo "<div class='square'> </div>";
                } elseif (is_a($chessboard[$x][$y], 'Pawn')) { # Pawn in that square
                    if ($chessboard[$x][$y]->get_color() == "white") { # White Pawn
                        echo "<div class='square'>wp</div>";
                    }
                    if ($chessboard[$x][$y]->get_color() == "black") { # Black Pawn
                        echo "<div class='square'>bp</div>";
                    }
                }
                #... ToDo check for more pieces

                # bordnumeration right side
                if ($x == 8) {
                    echo "<div class='square'>$boardnumeration</div>";
                    $boardnumeration++;
                }
            }
        }

        #boardnumeration on the bottom
        for ($boardnumeration = 1; $boardnumeration < 9; $boardnumeration++) {
            echo "<div class='square'>$boardnumeration</div>";
        }
        echo "</div>";
    }

    #just for testing purpose
    function debug_output_board($chessboard)
    {
        echo "<pre>";
        print_r($chessboard);
        echo "</pre>";
    }

    function get_board()
    {
        global $chessboard;
        return $chessboard;
    }

    function check_inputs_filled(){
        return !empty($_POST['piece_coordinates']) && !empty($_POST['move_to_coordinates']);
    }

    private function reconstruct_chessboard_from_json($encoded_json){
        $decoded_json = json_decode($encoded_json,true);

        for ($x=1; $x < 9; $x++) {  
            for ($y=1; $y < 9; $y++) { 
                if($decoded_json[$x][$y]==""){
                    # no pawn on that square
                    $chessboard[$x][$y] = "";
                   }else{
                    # pawn on that square
                    $chessboard[$x][$y] = new Pawn($decoded_json[$x][$y]['color'],$x,$y);
                   }
            }
        }
       
        return $chessboard;
    }
}
