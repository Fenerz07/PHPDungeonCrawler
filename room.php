<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Dungeon Crawler</title>
    <link rel="stylesheet" href="assets/css/room.module.css">
</head>
<body>
    <?php

    require_once 'monster.php';
    require_once 'player.php';
    require_once 'fight.php';

    function generateMonster($baseMonster, $roomNumber) {
        $pv = $baseMonster->pv + ($roomNumber * 2);
        $attack = $baseMonster->attack + ($roomNumber * 0.5);
        $defense = $baseMonster->defense + ($roomNumber * 0.5);
        $agility = $baseMonster->agility + ($roomNumber * 0.2);
        return new Monster($baseMonster->name, $pv, $attack, $defense, $agility);
    }

    $baseMonsters = [
        new Monster('Skeleton', 50, 5, 5, 5),
        new Monster('Zombie', 52, 6, 5, 5),
        new Monster('Spider', 49, 5, 6, 5),
        new Monster('Wolf', 55, 7, 6, 6),
        new Monster('Goblin', 51, 5, 5, 5),
        new Monster('Golem', 70, 5, 10, 3),
        new Monster('Werewolf', 58, 8, 7, 6),
        new Monster('Deamon', 62, 8, 7, 6),
    ];

    function generateDungeonRooms($totalRooms, $baseMonsters) {
        $rooms = [];
        for ($i = 1; $i <= $totalRooms; $i++) {
            if ($i % 10 == 0) {
                $rooms[] = "Salle avec un marchand";
            } elseif ($i % 5 == 0) {
                $rooms[] = "Salle de repos";
            } elseif ($i % 3 == 0) {
                $rooms[] = "Salle piège";
            } else {
                $rooms[] = "Salle de combat";
            }
        }
        return $rooms;
    }

    $totalRooms = 30;
    $monsterByRoom = 3;
    $dungeonRooms = generateDungeonRooms($totalRooms, $baseMonsters);

    if (!isset($_SESSION['player'])) {
        if (isset($_POST['class'])) {
            $playerClass = $_POST['class'];
        } else {
            $playerClass = 'Warrior'; 
        }
        $player = new Player($playerClass);
        $_SESSION['player'] = serialize($player);
        $_SESSION['player_pv'] = $player->pv;
        $_SESSION['current_room'] = 1;
    } else {
        $player = unserialize($_SESSION['player']);
        $player->pv = $_SESSION['player_pv'];
    }

    if (!isset($_SESSION['monsters'])) {
        foreach ($dungeonRooms as $index => $room) {
            echo "<div class='room'>";
            echo "<p>Salle " . ($index + 1) . ": " . $room . "</p>";
            if ($room == "Salle de combat") {
                $monsters = [];
                for ($j = 0; $j < $monsterByRoom; $j++) {
                    $baseMonster = $baseMonsters[array_rand($baseMonsters)];
                    $monsters[$j] = generateMonster($baseMonster, ($index + 1));
                    echo "<div class='monster'>";
                    $monsters[$j]->displayStats();
                    echo '<img width="200px" src="assets/images/' . $monsters[$j]->name . '.png" alt="' . $monsters[$j]->name . '">';
                    echo "</div>";
                }
                $_SESSION['monsters'] = serialize($monsters);
                $_SESSION['current_room'] = $index + 1; 
                echo "<div class='player'>";
                echo '<img width="200px" src="assets/images/' . $player->name . '.png" alt="' . $player->name . '">';
                echo "</div>";
                fight($player, $monsters);
                if ($monsters != []) {
                    break;
                }
            }
            echo "</div>";
        }
    } else {
        echo "<div class='room'>";
        if (isset($_SESSION['current_room'])) {
            echo "<p>Salle " . $_SESSION['current_room'] . ": Salle de combat</p>";
        } else {
            echo "<p>Salle de combat</p>";
        }
        $monsters = unserialize($_SESSION['monsters']);
        foreach ($monsters as $monster) {
            echo "<div class='monster'>";
            $monster->displayStats();
            echo '<img width="200px" src="assets/images/' . $monster->name . '.png" alt="' . $monster->name . '">';
            echo "</div>";
        }
        echo "<div class='player'>";
        echo '<img width="200px" src="assets/images/' . $player->name . '.png" alt="' . $player->name . '">';
        echo "</div>";
        fight($player, $monsters);
        echo "</div>";
    }

    $_SESSION['player'] = serialize($player);
    ?>
</body>
</html>