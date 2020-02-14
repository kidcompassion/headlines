<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SimplePie;
use DB;
use Redirect;
use Response;

class EJController extends Controller
{
    /**
     * Generate a a list of data from an input RSS feed.
     *
     * @return Response
     */


    public function index()
    {

       $all_items = DB::table('ej_fields')->orderBy('date', 'DESC')->get();

        return view('edmonton-journal', ['all_items' => $all_items]);
    }

    public function insert(Request $request, Response $response){
        
        
        $url = 'http://edmontonjournal.com/feed/'; //this should be passed in dynamically
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
            $byline = $item->get_authors();
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

            $exists = DB::table('ej_fields')->where('title', $item->get_title())->first();

            if(!$exists):
   
            DB::table('ej_fields')->insert(
                [
                'date'=> $pubDate,
                'title'=> $item->get_title(),
                'body'=>$content,
                'link'=>$item->get_link(),
                'author'=>$byline['0']->name,
                'thumbnail'=>$thumbnails[0],
                'bookmark'=>false
                //'categories'=> $cats
                ]
            );
        endif;

        }
       

          
        return Redirect::back()->with('message','Operation Successful !');

    }


    public function ejapi()
    {

       $all_items = DB::table('ej_fields')->orderBy('date', 'DESC')->get()->toArray();
        return $all_items;
    }

     public function clear(){
            DB::table('ej_fields')->delete();
    }


 
}