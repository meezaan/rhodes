<?php

namespace Rhodes;
use stdClass;


class Asset
{

    /**
     * @var string
     */
    public string $title;
    public String $description;
    public String $url;
  
    
    public function __construct(string $title , string $description , string $url)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        
    }
    



}