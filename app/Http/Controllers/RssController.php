<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use SimplePie;


class RssController extends Controller
{
    /**
     * Generate a a list of data from an RSS feed.
     *
     * @return Response
     */
    public function index()
    {



        $newsSources = array(
            "http://edmontonjournal.com/feed/",
            "http://edmonton.ctvnews.ca/rss/ctv-news-edmonton-1.822347",
            "http://edmontonsun.com/feed",
            "http://globalnews.ca/edmonton/feed/",
            "http://www.cbc.ca/cmlink/rss-canada-edmonton",
            "http://www.metronews.ca/feeds.articles.news.edmonton.rss",
            "http://aptnnews.ca/feed/"
            );


        /*

        on submit
        For each story item,  push the elements of thre sotry item into a table
        */

        $all_items = array();    
        $thumbnails = array();
        $cats = array();      

        $i = 0;
        $x = 0;
        

        foreach($newsSources as $url){
            $feed = new SimplePie();
            $feed->set_cache_location(storage_path() . '/simplepie_cache');
            $feed->set_feed_url($url);
            $feed->init();
            $feed->handle_content_type();
            
            

            foreach ($feed->get_items() as $item):

  
                
                $thumbnails = array();
                // Get thumbnails from enclosure
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
              

               $all_items[$i] = array(
                    'date'=> $item->get_date('j F Y | g:i a'),
                    'title'=> $item->get_title(),
                    'body'=>$item->get_description(),
                    'link'=>$item->get_link(),
                    'thumbnails'=>$thumbnails,
                    'categories'=> $cats
                ); 
        


                //$all_items[$i] = $item;
                $i++;

            endforeach;


            $feed->__destruct(); // Do what PHP should be doing on it's own.
            unset($feed); 
            }
            
               return $all_items;
 
        }

    public function save(){

    }
 
}