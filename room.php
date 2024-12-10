<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Dungeon Crawler</title>
</head>
<body>
    <?php
    require_once 'monster.php';
    $monster = new Monster('Goblin', 80, 8, 5, 3);
    function generateDungeonRooms($totalRooms) {
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
                require_once 'fight.php';
                if ($totalRooms % 10 == 0){
                    $monster = new Monster('Goblin10boost', 100, 8, 5, 3);
                }
            }
        }
        return $rooms;
    }

    $totalRooms = 30;
    $dungeonRooms = generateDungeonRooms($totalRooms);

    foreach ($dungeonRooms as $index => $room) {
        echo "Salle " . ($index + 1) . ": " . $room . "<br>";
        if ($room == "Salle de combat") {
            $monster->displayStats();
        }
    }
    ?>
</body>
</html>