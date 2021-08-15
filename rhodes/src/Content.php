<?php

namespace Rhodes;


use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Header;
use Slim\Psr7\Headers;
use stdClass;
class Content extends GuzzleHttpClient

{
   
    public function getBySlug(string $slug='home'): Page
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
     
        //A contentful page will have list of Entries and list of Assets in the Includes"
        $entry = $page->includes->Entry; // List of Entry types
        $assets = $page->includes->Asset; //List of Asset types




        
        $items = $page->items;
        foreach ($items as $item)  //Loop through each Item - Each Item has a header, footer and array of Rows
        {

            $page_title = $item->fields->title; //page title
            $hid = $item->fields->header->sys->id; //header Entry Id
            $fid = $item->fields->footer->sys->id; //footer Entry Id
            $rows = $item->fields->rows;
            $row_ids = array();
            foreach($rows as $row) //Loop through rows
            {
                $rid = $row->sys->id;   //row Entry Id
                array_push($row_ids,$row->sys->id);

            }
           $Rows = array(); 
           foreach($row_ids as $rid)
           {
                foreach($entry as $ent)
                {
                    $eid = $ent->sys->id;
                    if ($eid == $rid)
                    {
                        $row_name = $ent->fields->name;
                        $component_ids= array();
                        $comps = $ent->fields->components;
                        foreach($comps as $comp)
                        {
                            array_push($component_ids,$comp->sys->id);

                        }
                       
                    }
                }
                if($component_ids)
                {
                    $component_list = array();
                    foreach($entry as $ent)
                    {
                        $eid = $ent->sys->id;
                        if(in_array($eid,$component_ids))
                        {
                            $comp_heading = $ent->fields->heading;
                            $comp_text = $ent->fields->text;
                            if($ent->fields->image->sys->id)
                            
                            {
                                $asset_id = $ent->fields->image->sys->id;
                                if($ent->fields->image->sys->linkType == 'Asset')
                                {
                                    foreach($assets as $a) //$assets is list of arrays collected at the starting
                                    {
                                        if($asset_id == $a->sys->id)
                                        {
                                            $a_title = $a->fields->title;
                                            $a_descrition = $a->fields->description;
                                            $a_url = $a->fields->file->url;
                                            $comp_asset = new Asset($a_title,$a_descrition,$a_url);
                                        }
                                    }
                                }
                            }
                            $component = new Component($comp_heading,$comp_text,$comp_asset);
                            array_push($component_list,$component);
                            //var_dump($component_list);
                        }
                    }
                }
                $Row = new Row($row_name,$component_list);
                array_push($Rows,$Row);
        
            }
           // var_dump($Row);exit;







            if ($hid)
            {
                foreach($entry as $ent)
                {
                    $eid = $ent->sys->id;
                    if ( $eid == $hid) // It is a header entry
                    {
                        $h_title =  $ent->fields->title;
                        $nav_id = $ent->fields->navbar->sys->id;
                        break;
                    }

                }
                if ($nav_id)
                {
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
                            }
                            break;
                        }
                    }
                    $links = array();
                    if ($link_ids)
                    {
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
                    }
                }
                $navbar = new Navbar($nav_name,$links); // Instantiate a new Navbar class object
                $header = new Head($hid,$h_title,$navbar); // Instantiate a new Header class object       
            }
            //var_dump($header);
            if($fid)
            
            {
                foreach ($entry as $ent)
                {
                    $eid = $ent->sys->id;
                    if ($eid == $fid) //It is a footer Entry
                    {
                        
                        
                        $fname = $ent->fields->name;
                       
                       
                        $cr = $ent->fields->copyright->content[0]->content[0]->value;
                        $rt = $ent->fields->rightText->content[0]->content[0]->value;
                        $footer = new Foot($fid,$fname,$cr,$rt);
                        //var_dump($footer);
                        break;
                    }

                }
            }
        }


        $p = new Page($page_title,$header,$Rows,$footer);
        //var_dump($p);exit;
        return($p);
        

        //exit;
       // return json_decode($response->getBody()->getContents());


        
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
  
        //var_dump($header);exit;
        // Test if the Header object is working --START-->
       // var_dump($header->id);
        //var_dump($header->title);
        //var_dump($header->navbar);

       // Test if the Header object is working --END>
        //var_dump($footer);
    

        


       //-END-Code to make the flat Json response by loopiong all entries
        //
    }




}


    





