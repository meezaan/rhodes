<?php

namespace Rhodes;


use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Header;
use Slim\Psr7\Headers;
use stdClass;
class Content extends GuzzleHttpClient

{
   
    public function getBySlug(string $slug='home'): \stdClass
    {
       
      

        $client = new GuzzleHttpClient(
            [
                'headers' =>
                    [
                        'User-Agent' => 'AAT8/Architecture'
                    ],
                'base_uri' => getenv('MANISA_URI')
            ]
                );
        //$client = new Client([$base_uri]);
        $response = $client->get('/' . $slug);
       

        //-START-Code to make the flat Json response by loopiong all entries
        $page = json_decode($response->getBody()->getContents());
     
        $entry = $page->includes->Entry;
        $page_title = $page->items[0]->fields->title; //page title
        $hid = $page->items[0]->fields->header->sys->id; //header Entry Id
        $fid = $page->items[0]->fields->footer->sys->id; //footer Entry Id
        $rid = $page->items[0]->fields->rows[0]->sys->id;   //rows Entry Id
        
        // Sample code to test Object initiation for each component
        
        /* $nav_name = "test";
        $link1 = new Link();
        $link2 = new Link();
        $links = array($link1,$link2);
        //var_dump($links);exit;
        $nav = new Navbar($nav_name,$links);
        $h_title="test_title";

        //$h = new Head($hid,$h_title,$nav);
        //var_dump($h);exit;
         */
        // Sample code to test Object initiation for each component
        

        foreach ($entry as $ent)  // First loop to identify the Header
        {
          $ctype = $ent->sys->contentType->sys->id;
          $eid = $ent->sys->id;
          if ( $eid == $hid) // It is a header entry
          {
             $h_title =    $ent->fields->title;
             $nav_id = $ent->fields->navbar->sys->id;
             break;

          }
          



          
        }

        foreach ($entry as $ent) // Second loop to get the Navbar and Link IDs
        { 
            $eid = $ent->sys->id; 
            if ($eid == $nav_id)
            {
                $nav_name = $ent->fields->name;
                $nav_links = $ent->fields->links;
                $link_ids = array();
                if($nav_links)
                {
                    foreach ($nav_links as $link)
                    {
                        
                        array_push($link_ids,$link->sys->id);

                    }
                    //var_dump($link_ids);

                }
            break;

            }

        }
        $links = array();
        foreach ($entry as $ent) // Third loop to get Links
        {

            $eid = $ent->sys->id;
            if (in_array($eid, $link_ids))
            {
                $link_url = $ent->fields->url;
                $link_text = $ent->fields->text;
                $link_title = $ent->fields->title;
                $link_Is_blank = $ent->fields->blank;
                $link= new Link($link_url,$link_text,$link_title,$link_Is_blank); //Create Link using link class
                array_push($links,$link); //Create an array of links


            } 



        }
       
        $navbar = new Navbar($nav_name,$links); // Instantiate a new Navbar class object
        $header = new Head($hid,$h_title,$navbar); // Instantiate a new Header class object
        //var_dump($header);exit;
        // Test if the Header object is working --START-->
        var_dump($header->id);
        var_dump($header->title);
        var_dump($header->navbar);
        exit; // Test if the Header object is working --END>
        


       //-END-Code to make the flat Json response by loopiong all entries
        //return json_decode($response->getBody()->getContents());
    }




}


    





