<form method="post">
    <button class="btn btn-primary" type="submit" name="class" value="warrior">Select Warrior</button>
    <button class="btn btn-primary" type="submit" name="class" value="vampire">Select Vampire</button>
</form>

<?php

function classSelected($class) {
    echo "You selected: $class";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['class'])) {
    classSelected($_POST['class']);
}

?>