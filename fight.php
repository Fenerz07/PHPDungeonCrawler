<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

    function fight($player, $monster) {
        $playerAttack = $player['attack'];
        $playerDefense = $player['defense'];
        $playerAgility = $player['agility'];
        $playerPV = $player['pv'];

        $monsterAttack = $monster['attack'];
        $monsterDefense = $monster['defense'];
        $monsterAgility = $monster['agility'];
        $monsterPV = $monster['pv'];

        $playerDamage = $playerAttack - $monsterDefense;
        $monsterDamage = $monsterAttack - $playerDefense;

        while ($playerPV > 0 && $monsterPV > 0) {
            $playerHit = rand(1, 20) + $playerAgility;
            $monsterHit = rand(1, 20) + $monsterAgility;

            if ($playerHit > $monsterHit) {
                $monsterPV -= $playerDamage;
                echo "Player hits monster for $playerDamage damage. Monster has $monsterPV PV left.<br>";
            } else {
                $playerPV -= $monsterDamage;
                echo "Monster hits player for $monsterDamage damage. Player has $playerPV PV left.<br>";
            }
        }

        if ($playerPV <= 0) {
            echo "Player has been defeated!";
        } else {
            echo "Monster has been defeated!";
        }
    }

    ?>
    
</body>
</html>