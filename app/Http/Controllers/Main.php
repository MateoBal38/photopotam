<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Main extends Controller
{
    public function index(){
        $album =  Album::orderby('creation')->take(3)->get();
        $tab = [];
        // for($i=0; $i < count($album); $i++) {
        //     $tab[$i] = $album->photos->take(1)->get();
        // }
        // dd::$tab;

        return view('index', ['albums' => $album, 'tab' => $tab]);
    }

    public function album(){
        return view('album');
    }

    public function detailAlbum($id){
        return view('detailAlbum', ['id' => $id]);
    }

    public function signin(){
        return view('signin');
    }

    public function login(){
        return view('login');
    }

}