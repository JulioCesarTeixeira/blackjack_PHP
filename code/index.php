<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';
require 'Dealer.php';

session_start();
?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link href="style.css" rel="stylesheet">
    <title>BlackJack - OOP</title>
</head>
<body>
<?php
//create new game session if one doesn't exist
if (!isset($_SESSION['blackjack'])) {
    $_SESSION['blackjack'] = new Blackjack();
}
//destroy session and create a new one

$blackjack = $_SESSION['blackjack'];
$disabled = "";
$outcome = "";
handleButtons($_SESSION['blackjack'], $disabled, $outcome);
showScores($_SESSION['blackjack']->getPlayer()->getScore(), $_SESSION['blackjack']->getDealer()->getScore());
showCards($_SESSION['blackjack']->getPlayer()->getCards());


function handleButtons(Blackjack $blackjack, &$disabled, &$outcome){
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case"hit":
                $blackjack->getPlayer()->hit($blackjack->getDeck());
                if ($blackjack->getPlayer()->hasLost()) {
                    $disabled = "disabled";
                    $outcome = "you lose, bobby";
                } else {
                    $disabled = "disabled";
                    $outcome = "you win, bobby";
                }
                break;
            case"surrender":
                $blackjack->getPlayer()->surrender();
                $disabled = "disabled";
                $outcome = "you lose, bobby";
                break;
            case"stand":
                $disabled = "disabled";
                $blackjack->getDealer()->hit($blackjack->getDeck());
                //condition if Win or lose
                if($blackjack->getPlayer()->isWinner($blackjack->getDealer())){
                    $outcome = "you win, bobby";
                } else {
                    $outcome = "you lose, bobby";
                }
                break;
            case"reset":
                $_SESSION['blackjack'] = new Blackjack();
                break;
        }
    }
}


function showScores($playerScore, $dealerScore): void
{
    echo 'Dealer: ' . $dealerScore . PHP_EOL;
    echo '<br>';
    echo 'Your total: ' . $playerScore . PHP_EOL;
}

function showCards($cards): void
{
    foreach ($cards as $card) {
        echo $card->getUnicodeCharacter(true) . PHP_EOL;
    }
}

?>

<div>
    <span><?php echo $outcome ?></span>
</div>
<form method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="hit">One more:</label>
            <button type="submit" name="action" value="hit" <?php echo $disabled ?> class="btn btn-primary">Hit</button>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="stand">No more cards</label>
            <button type="submit" name="action" value="stand" <?php echo $disabled ?> class="btn btn-primary">Stand
            </button>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="surrender">No more playing</label>
            <button type="submit" name="action" value="surrender" <?php echo $disabled ?> class="btn btn-primary">
                Surrender
            </button>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="reset">No more playing</label>
            <button type="submit" name="action" value="reset" class="btn btn-primary">reset</button>
        </div>
    </div>
</form>
