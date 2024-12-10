<?php
class Monster {
    public $name;
    public $pv;
    public $attack;
    public $defense;
    public $agility;

    public function __construct($name, $pv, $attack, $defense, $agility) {
        $this->name = $name;
        $this->pv = $pv;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->agility = $agility;
    }

    public function displayStats() {
        echo "<div>Monster: $this->name</div>";
        echo "<div>PV: $this->pv, Attack: $this->attack, Defense: $this->defense, Agility: $this->agility</div>";
    }
}
?>