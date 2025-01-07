<?php

function fight($player, $monsters) {
    $playerName = $player->class;
    $playerAttack = $player->attack;
    $playerDefense = $player->defense;
    $playerAgility = $player->agility;
    $playerPV = $player->pv;

    echo "<h2>Combat begins!</h2>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
        $action = $_POST['action'];
        $targetIndex = isset($_POST['target']) ? $_POST['target'] : 0;
        $targetMonster = $monsters[$targetIndex];

        if ($action == 'attack') {
            $playerDamage = max(0, $playerAttack - $targetMonster->defense);
            $targetMonster->pv -= $playerDamage;
            echo "$playerName hits $targetMonster->name for $playerDamage damage. $targetMonster->name has $targetMonster->pv PV left.<br>";

            if ($targetMonster->pv <= 0) {
                echo "$targetMonster->name has been defeated!<br>";
                array_splice($monsters, $targetIndex, 1);
            }
        }

        foreach ($monsters as $monster) {
            $monsterDamage = max(0, $monster->attack - $playerDefense);
            $playerPV -= $monsterDamage;
            echo "$monster->name hits $playerName for $monsterDamage damage. $playerName has $playerPV PV left.<br>";

            if ($playerPV <= 0) {
                echo "$playerName has been defeated by $monster->name!<br>";
                break;
            }
        }

        $_SESSION['player_pv'] = $playerPV;
        $_SESSION['monsters'] = serialize($monsters);
    }

    if ($playerPV > 0 && count($monsters) > 0) {
        echo "<form method='post'>";
        echo "<input type='hidden' name='action' value='attack'>";
        echo "<label for='target'>Choose a target:</label>";
        echo "<select name='target'>";
        foreach ($monsters as $index => $monster) {
            echo "<option value='$index'>{$monster->name} (PV: {$monster->pv})</option>";
        }
        echo "</select>";
        echo "<button type='submit'>Attack</button>";
        echo "</form>";
        return;
    }

    if ($playerPV > 0) {
        echo "$playerName has survived the room!<br>";
        unset($_SESSION['monsters']);
        $_SESSION['current_room'] += 1; // Move to the next room
        echo "<form method='post'>";
        echo "<button type='submit'>Continue to the next room</button>";
        echo "</form>";
    } else {
        echo "$playerName has been defeated in the room.<br>";
    }
}
?>