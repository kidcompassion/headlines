<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SimplePie;
use DB;
use Redirect;

class CtvController extends Controller
{
    /**
     * Generate a a list of data from an input RSS feed.
     *
     * @return Response
     */


    public function index()
    {

       $all_items = DB::table('ctv_fields')->orderBy('date', 'DESC')->get();

        return view('ctv-edmonton', ['all_items' => $all_items]);

        



        //return $all_items;
    }

    public function insert(){
        
        $url = 'https://edmonton.ctvnews.ca/rss/ctv-news-edmonton-1.822347'; //this should be passed in dynamically
        
        
        $all_items = array();    
        $thumbnail = '';
        $cats = array();      

        $i = 0;
        $x = 0;
        
        $feed = new SimplePie();
        $feed->set_cache_location(storage_path() . '/simplepie_cache');
        $feed->set_feed_url($url);
        $feed->init();
        $feed->handle_content_type();


    
            
        foreach ($feed->get_items() as $item){   

            $byline = $item->get_authors();

            $pubDate = $item->get_date();
            $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($pubDate));

            $x = 0;
            if ($enclosure = $item->get_enclosure())
            {

                $thumbnail = $enclosure->get_link();
                 echo '<pre>';
           
            echo '<pre>';
            
                
            }
            
            $exists = DB::table('ctv_fields')->where('title', $item->get_title())->first();

            if(!$exists):
   
            DB::table('ctv_fields')->insert(
                [
                'date'=> $pubDate,
                'title'=> $item->get_title(),
                'body'=>$item->get_description(),
                'link'=>$item->get_link(),
                'thumbnail'=>$thumbnail,
                'author'=> $byline[1]->name,
                'bookmark'=>false
                //'categories'=> $cats
                ]
            );
        endif;
            //$feed->__destruct(); // Do what PHP should be doing on it's own.
            //unset($feed); 
        }
        return Redirect::back()->with('message','Operation Successful !');

    }

     public function ctvapi()
    {

       $all_items = DB::table('ctv_fields')->orderBy('date', 'DESC')->get()->toArray();
        return $all_items;
    }


     public function clear(){
            DB::table('ctv_fields')->delete();
    }
 
}