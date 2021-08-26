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
   
    
    
    public function __construct(string $heading , string $text , Asset $image, string $type,string $button_text = 'default', string $button_url = 'default' )
    {
        $this->heading = $heading;
        $this->text = $text;
        $this->image = $image;
        $this->type = $type;
        $this->button_text = $button_text;
        $this->button_url = $button_url;
        
    }
    



}