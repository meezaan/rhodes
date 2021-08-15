<?php

namespace Rhodes;
use stdClass;


class Row
{

    /**
     * @var string
     */
 
    public string $name;
    public array $components;
    
    public function __construct(string $name, array $components)
    {
        $this->name = $name;
        $this->components = $components;
    }
    



}