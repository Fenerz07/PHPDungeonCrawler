<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Dungeon Crawler</title>
</head>
<body>
    <?php
    require_once 'monster.php';
    require_once 'game.php';
    require_once 'fight.php';

    function generateMonster($baseMonster, $roomNumber) {
        $pv = $baseMonster->pv + ($roomNumber * 2);
        $attack = $baseMonster->attack + ($roomNumber * 0.5);
        $defense = $baseMonster->defense + ($roomNumber * 0.5);
        $agility = $baseMonster->agility + ($roomNumber * 0.2);
        return new Monster($baseMonster->name, $pv, $attack, $defense, $agility);
    }

    $difficulty = 2;

    $baseMonsters = [
        new Monster('Skeleton', round(50 / $difficulty), round(5 / $difficulty), round(5 / $difficulty), round(5 / $difficulty)),
        new Monster('Zombie', round(52 / $difficulty), round(6 / $difficulty), round(5 / $difficulty), round(5 / $difficulty)),
        new Monster('Spider', round(49 / $difficulty), round(5 / $difficulty), round(6 / $difficulty), round(5 / $difficulty)),
        new Monster('Wolf', round(55 / $difficulty), round(7 / $difficulty), round(6 / $difficulty), round(6 / $difficulty)),
        new Monster('Goblin', round(51 / $difficulty), round(5 / $difficulty), round(5 / $difficulty), round(5 / $difficulty)),
        new Monster('Golem', round(70 / $difficulty), round(5 / $difficulty), round(10 / $difficulty), round(3 / $difficulty)),
        new Monster('Werewolf', round(58 / $difficulty), round(8 / $difficulty), round(7 / $difficulty), round(6 / $difficulty)),
        new Monster('Deamon', round(62 / $difficulty), round(8 / $difficulty), round(7 / $difficulty), round(6 / $difficulty)),
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


    $player = unserialize($_SESSION['player']);
    $player->pv = $_SESSION['player_pv'];

    foreach ($dungeonRooms as $index => $room) {
        echo "Salle " . ($index + 1) . ": " . $room . "<br>";
        if ($room == "Salle de combat") {
            $monsters = [];
            for ($j = 0; $j < $monsterByRoom; $j++) {
                $baseMonster = $baseMonsters[array_rand($baseMonsters)];
                $monsters[$j] = generateMonster($baseMonster, ($index + 1));
                $monsters[$j]->displayStats();
                echo '<img width="200px" src="assets/images/' . $monsters[$j]->name . '.png" alt="' . $monsters[$j]->name . '">';
                echo "<br>";
            }
            echo '<img width="200px" src="assets/images/' . $player->name . '.png" alt="' . $player->name . '">';
            echo "<br>";
            fight($player, $monsters);
        }
    }

    $_SESSION['player'] = serialize($player);
    ?>
</body>
</html>