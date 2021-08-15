<?php

namespace Rhodes;
use stdClass;


class Foot
{

    /**
     * @var string
     */
    public string $id;
    public string $name;
    public string $copyright;
    public string $right_text;
    public function __construct(string $id, string $name, string $copyright,string $right_text)
    {
        $this->id = $id;
        $this->name = $name;
        $this->copyright = $copyright;
        $this->right_text = $right_text;
    }
    



}