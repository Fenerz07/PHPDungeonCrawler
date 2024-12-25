<?php
class Player {
    public $class;
    public $name;
    public $pv;
    public $attack;
    public $defense;
    public $agility;

    public function __construct($class) {
        $this->class = $class;
        $this->initializeStats();
    }

    private function initializeStats() {
        if ($this->class == 'Warrior') {
            $this->name = 'Warrior';
            $this->pv = 100;
            $this->attack = 10;
            $this->defense = 15;
            $this->agility = 5;
        } else if ($this->class == 'Vampire') {
            $this->name = 'Vampire';
            $this->pv = 100;
            $this->attack = 10;
            $this->defense = 10;
            $this->agility = 10;
        }
        else if ($this->class == 'Wizard') {
            $this->name = 'Wizard';
            $this->pv = 100;
            $this->attack = 20;
            $this->defense = 5;
            $this->agility = 5;
        }
        else if ($this->class == 'Rogue') {
            $this->name = 'Rogue';
            $this->pv = 100;
            $this->attack = 10;
            $this->defense = 5;
            $this->agility = 15;
        }
    }

    public function displayStats() {
        echo "<div>You selected: $this->class</div>";
        echo "<div>Name: $this->name, PV: $this->pv, Attack: $this->attack, Defense: $this->defense, Agility: $this->agility</div>";
    }
}
?>