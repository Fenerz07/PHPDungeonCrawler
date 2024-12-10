<?php
class Player {
    public $class;
    public $pv;
    public $attack;
    public $defense;
    public $agility;

    public function __construct($class) {
        $this->class = $class;
        $this->initializeStats();
    }

    private function initializeStats() {
        if ($this->class == 'warrior') {
            $this->pv = 150;
            $this->attack = 10;
            $this->defense = 10;
            $this->agility = 5;
        } else if ($this->class == 'vampire') {
            $this->pv = 100;
            $this->attack = 15;
            $this->defense = 5;
            $this->agility = 10;
        }
    }

    public function displayStats() {
        echo "<div>You selected: $this->class</div>";
        echo "<div>PV: $this->pv, Attack: $this->attack, Defense: $this->defense, Agility: $this->agility</div>";
    }
}
?>