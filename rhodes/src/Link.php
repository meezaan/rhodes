<?php

namespace Rhodes;
use stdClass;


class Link
{

    /**
     * @var string
     */
    public string $uri;
    public String $text;
    public String $title;
    public bool $blank;
    
    public function __construct(string $uri = 'default-uri', string $text = 'default-text', string $title = 'default-title', bool $blank = false )
    {
        $this->uri = $uri;
        $this->text = $text;
        $this->title = $title;
        $this->blank = $blank;
    }
    



}