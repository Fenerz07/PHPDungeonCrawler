<!DOCTYPE html>
<html>
<head>
    <title>Dungeon Crawler</title>
</head>
<body>
    <div>
        <h1>Choose Your Class</h1>
        <form method="post">
            <button class="btn btn-primary" type="submit" name="class" value="warrior">Select Warrior</button>
            <button class="btn btn-primary" type="submit" name="class" value="vampire">Select Vampire</button>
        </form>

        <?php

        $pv = 100;
        $attack = 10;
        $defense = 5;
        $agility = 5;
        
        function classSelected($class) {
            echo "<div>You selected: $class</div>";
            if ($class == 'warrior') {
                $pv = 150;
                $attack = 10;
                $defense = 10;
                $agility = 5;
            } else if ($class == 'vampire') {
                $pv = 100;
                $attack = 15;
                $defense = 5;
                $agility = 10;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['class'])) {
            classSelected($_POST['class']);
        }

        ?>

    </div>
</body>
</html>