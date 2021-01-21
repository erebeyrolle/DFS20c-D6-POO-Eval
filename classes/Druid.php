<?php

class Druid extends Character
{
    private $careLife = False;
    private $forestStrenght = False;

    public function attack(Character $target)
    {
        $rand = rand(1, 10);
        if ($rand  <= 1 || $this->careLife) {
            $status = $this->careLife();
        } else if ($rand > 1 && $rand < 6 || $this->forestStrenght) {
            $status = $this->forestStrenght($target);
        } else if ($rand >= 6) {
            $status = $this->stick($target);
        }
        echo '<pre>', var_dump($rand), '</pre>';
        return $status;
    }

    private function stick(Character $target)
    {
        $attack = rand(5, 15);
        if ($this->careLife && ($this->lifePoints > 0 || $this->lifePoints < 100)) {
            $restant = $this->getLifePoints();
            $ajout = 100 - $restant;
            $renew = $ajout + $this->getLifePoints();
            $this->setLifePoints($renew);
            $this->careLife = False;
        } else if ($this->forestStrenght) {
            $i = 1;
            while ($i <= 3) {
                $attack *= 1.5;
                $this->forestStrenght = False;
                $target->setLifePoints($attack);
            }
        }
        $target->setLifePoints($attack);
        $status = "$this->name attaque {$target->name}! Il reste {$target->getLifePoints()} à {$target->name} !";
        return $status;
    }

    private function careLife()
    {
        $this->careLife = True;
        $status = "{$this->name} récupère tous ses poins de vie. Il a maintenant : {$this->getLifePoints()} de vie.";
        return $status;
    }

    private function forestStrenght()
    {
        $this->forestStrenght = True;
        $status = "{$this->name} invoque la force de la forêt pour taper plus fort ! ";
        return $status;
    }
}
