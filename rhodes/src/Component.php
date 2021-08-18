<?php

namespace Rhodes;
use stdClass;


class Component
{

    /**
     * @var string
     */
    public string $heading;
    public String $text;
    public Asset $image;
    
    
    public function __construct(string $heading , string $text , Asset $image, string $type )
    {
        $this->heading = $heading;
        $this->text = $text;
        $this->image = $image;
        $this->type = $type;
        
    }
    



}