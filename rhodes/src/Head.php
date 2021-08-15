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
    public object $navbar;
    public function __construct(string $id, string $title,object $navbar)
    {
        $this->id = $id;
        $this->title = $title;
        $this->navbar = $navbar;
    }
    



}