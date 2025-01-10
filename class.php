<!DOCTYPE html>
<html>
<head>
    <title>Dungeon Crawler</title>
    <link rel="stylesheet" href="assets/css/class.module.css">
</head>
<body>
    <div class="container">
        <h1>Choose Your Class</h1>
        <form method="post" action="game.php">
            <button class="btn btn-primary" type="submit" name="class" value="Warrior"><img src="assets/images/Warrior.png" alt="Warrior"></button>
            <button class="btn btn-primary" type="submit" name="class" value="Vampire"><img src="assets/images/Vampire.png" alt="Vampire"></button>
            <button class="btn btn-primary" type="submit" name="class" value="Wizard"><img src="assets/images/Wizard.png" alt="Wizard"></button>
            <button class="btn btn-primary" type="submit" name="class" value="Rogue"><img src="assets/images/Rogue.png" alt="Rogue"></button>
        </form>
        <div class=text>
            <div class="title">
                <p>Warrior</p>
                <p>Vampire</p>
                <p>Wizard</p>
                <p>Rogue</p>
            </div>
            <div class="description">
                <p>Here to save his General</p>
                <p>Here to kidnap the General</p>
                <p>Here to steal the General</p>
                <p>Here to kill the General</p>
            </div>
        </div>
    </div>
</body>
</html>