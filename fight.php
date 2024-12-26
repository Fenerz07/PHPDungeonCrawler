<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
function fight($player, $monsters) {
    $playerName = $player->class;
    $playerAttack = $player->attack;
    $playerDefense = $player->defense;
    $playerAgility = $player->agility;
    $playerPV = $player->pv;

    echo "<h2>Combat begins!</h2>";

    while ($playerPV > 0 && count($monsters) > 0) {
        $targetMonster = $monsters[0]; 
        $playerDamage = max(0, $playerAttack - $targetMonster->defense);
        $targetMonster->pv -= $playerDamage;
        echo "$playerName hits $targetMonster->name for $playerDamage damage. $targetMonster->name has $targetMonster->pv PV left.<br>";

        if ($targetMonster->pv <= 0) {
            echo "$targetMonster->name has been defeated!<br>";
            array_shift($monsters);
        }

        foreach ($monsters as $monster) {
            $monsterDamage = max(0, $monster->attack - $playerDefense);
            $playerPV -= $monsterDamage;
            echo "$monster->name hits $playerName for $monsterDamage damage. $playerName has $playerPV PV left.<br>";

            if ($playerPV <= 0) {
                echo "$playerName has been defeated by $monster->name!<br>";
                break 2;
            }
        }
    }

    if ($playerPV > 0) {
        echo "$playerName has survived the room!<br>";
    } else {
        echo "$playerName has been defeated in the room.<br>";
    }

    $_SESSION['player_pv'] = $playerPV;
}
?>
    
</body>
</html>