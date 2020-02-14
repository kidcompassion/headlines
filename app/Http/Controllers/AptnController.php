<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SimplePie;
use DB;
use Redirect;

class AptnController extends Controller
{
    /**
     * Generate a a list of data from an input RSS feed.
     *
     * @return Response
     */


    public function index()
    {

       $all_items = DB::table('aptn_fields')->orderBy('date', 'DESC')->get();

        return view('aptn', ['all_items' => $all_items]);

        



        //return $all_items;
    }

    public function insert(){
        
        $url = 'http://aptnnews.ca/feed/'; //this should be passed in dynamically
        $all_items = array();    
        $thumbnails = ['placeholder'];
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


            $cats = array();
            $categories = $item->get_categories();
            $y = 0;
            $cat_count = count($categories);
            if($categories){
                foreach($categories as $category){
                    $cats[$y] = $category->term;
                    $y++;
                }
            }

            $exists = DB::table('aptn_fields')->where('title', $item->get_title())->first();

            if(!$exists):
   
            DB::table('aptn_fields')->insert(
                [
                'date'=> $pubDate,
                'title'=> $item->get_title(),
                'body'=>$item->get_content(),
                'link'=>$item->get_link(),
                'thumbnail'=>$thumbnails[0],
                'author'=> $byline[0]->name,
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



     public function aptnapi()
    {

       $all_items = DB::table('aptn_fields')->orderBy('date', 'DESC')->get()->toArray();
        return $all_items;
    }
     public function clear(){
            DB::table('aptn_fields')->delete();
    }
 
}