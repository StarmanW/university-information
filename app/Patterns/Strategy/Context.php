<?php

namespace App\Patterns\Strategy;

class Context
{
    private $strategy;

    public function __construct($strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy($request)
    {
        return $this->strategy->execute($request);
    }
}
