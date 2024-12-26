<!DOCTYPE html>
<html>
<head>
    <title>Dungeon Crawler</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        session_start();
        require_once 'player.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['class'])) {
            $player = new Player($_POST['class']);
            $_SESSION['player'] = serialize($player);
            $_SESSION['player_pv'] = $player->pv;
            $player->displayStats();
        } else {
            echo "<div>No class selected.</div>";
        }

        require_once 'room.php';
        ?>
    </div>
</body>
</html>