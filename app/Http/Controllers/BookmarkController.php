<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SimplePie;
use DB;
use Redirect;
use Response;

class BookmarkController extends Controller
{
    /**
     * Generate a a list of data from an input RSS feed.
     *
     * @return Response
     */


    public function index(Request $request, Response $response)
    {

        
        $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($request->input('date')));

        $exists = DB::table('bookmark_fields')->where('title', $request->input('title'))->exists();
        if(!$exists):
            DB::table('bookmark_fields')->insert(
                [
                'date'=> $pubDate,
                'title'=> $request->input('title'),
                'body'=>$request->input('body'),
                'link'=>$request->input('link'),
                'author'=>$request->input('author'),
                'thumbnail'=>$request->input('thumbnail'),
                'bookmark'=>true,

                ]
            );

        else:

            DB::table('bookmark_fields')->where('title', $request->input('title'))->delete();
            
  
        endif;

        if ($request->isMethod('post')){    
            return response()->json(['response' => 'This is post method']); 
            die();
        }


    }

     public function bookmarkapi()
    {

       $all_items = DB::table('bookmark_fields')->orderBy('id', 'DESC')->get()->toArray();
        return $all_items;
    }
 
}