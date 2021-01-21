<?php

class Druid extends Character
{
    private $careLife = False;

    public function attack(Character $target)
    {
        $rand = rand(1, 10);
        if ($rand  <= 1 || $this->careLife) {
            $status = $this->careLife();
        }
        return $status;
    }

    public function careLife()
    {
    }
}
