<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SimplePie;
use DB;
use Redirect;

class SunController extends Controller
{
    /**
     * Generate a a list of data from an input RSS feed.
     *
     * @return Response
     */


    public function index()
    {

       $all_items = DB::table('sun_fields')->orderBy('date', 'DESC')->get();

        return view('edmonton-sun', ['all_items' => $all_items]);

        



        //return $all_items;
    }

    public function insert(){
        
        $url = 'http://edmontonsun.com/feed/'; //this should be passed in dynamically
        $all_items = array();    
        $thumbnails = array();
        $cats = array();      

        $i = 0;
        $x = 0;
        
        $feed = new SimplePie();
        $feed->set_cache_location(storage_path() . '/simplepie_cache');
        $feed->set_feed_url($url);
        $feed->init();
        $feed->handle_content_type();


    
            
        foreach ($feed->get_items() as $item){   

            $byline = $item->get_author();
  
            $pubDate = $item->get_date();
            $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($pubDate));

            $content = preg_replace("/<img[^>]+\>/i", "", $item->get_description()); 

            $thumbnails = array();
            $x = 0;
            if ($enclosure = $item->get_enclosure())
            {
                foreach ((array) $enclosure->get_thumbnails() as $key=>$thumbnail)
                {
                    $thumbnails[$key] = $thumbnail;
                    $x++;
                }
            }

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
          /*
            $all_items[$i] = array(
                'date'=> $item->get_date('j F Y | g:i a'),
                'title'=> $item->get_title(),
                'body'=>$item->get_description(),
                'link'=>$item->get_link(),
                'thumbnails'=>$thumbnails,
                'categories'=> $cats
            ); 
        
            $i++;
*/

            $exists = DB::table('sun_fields')->where('title', $item->get_title())->first();

            if(!$exists):
   
            DB::table('sun_fields')->insert(
                [
                'date'=> $pubDate,
                'title'=> $item->get_title(),
                'author' => $byline->name,
                'body'=>$content,
                'link'=>$item->get_link(),
                'thumbnail'=>$thumbnails[0],
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


      public function sunapi()
    {

       $all_items = DB::table('sun_fields')->orderBy('date', 'DESC')->get()->toArray();
        return $all_items;
    }
 

     public function clear(){
            DB::table('sun_fields')->delete();
    }
}