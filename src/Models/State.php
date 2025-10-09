<?php

namespace Dpb\Extension\ModelState\Models;

use Spatie\ModelStates\State as BaseState;


class State extends BaseState
{
    public function label(): string 
    {
        return '';   
    }
}
