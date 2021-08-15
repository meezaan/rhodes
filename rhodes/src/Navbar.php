<?php

namespace Rhodes;
use stdClass;


class Navbar
{

    /**
     * @var string
     */
    public string $name;
    public array $links;
    
    public function __construct(string $name, array $links)
    {
        $this->name = $name;
        $this->links = $links;
    }
    



}