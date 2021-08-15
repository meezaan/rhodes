<?php

namespace Rhodes;
use stdClass;


class Head
{

    /**
     * @var string
     */
    public string $id;
    public string $title;
    public Navbar $navbar;
    public function __construct(string $id, string $title,Navbar $navbar)
    {
        $this->id = $id;
        $this->title = $title;
        $this->navbar = $navbar;
    }
    



}