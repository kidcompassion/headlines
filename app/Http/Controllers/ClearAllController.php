<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SimplePie;
use DB;
use Redirect;

class ClearAllController extends Controller
{
    /**
     * Generate a a list of data from an input RSS feed.
     *
     * @return Response
     */


    public function delete()
    {

       DB::table('aptn_fields')->delete();
       DB::table('cbc_fields')->delete();
       DB::table('ctv_fields')->delete();
       DB::table('ej_fields')->delete();
       DB::table('global_fields')->delete();
       DB::table('metro_fields')->delete();
       DB::table('sun_fields')->delete();
       DB::table('bookmark_fields')->delete();
       
        

        



        //return $all_items;
    }

 
}