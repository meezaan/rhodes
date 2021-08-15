<?php

namespace Rhodes;
use stdClass;


class Page
{

    /**
     * @var string
     */
    
    public function __construct(string $title, Head $header, $rows, Foot $footer)
    {
        $this->title = $title;
        $this->rows = $rows;
        $this->header = $header;
        $this->footer = $footer;
    }
    



}