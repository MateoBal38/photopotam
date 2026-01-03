<?php

namespace App\Http\Controllers;

// use App\Models\Album;
use App\Models\Tag;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Main extends Controller
{
    public function index(){

        $photos = Photo::inRandomOrder()->take(4)->get();
        return view('index', ['photos' => $photos]);
    }

    public function register(){   
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function perso(){
        $albums = Album::with('preview')->where('user_id', 'LIKE', Auth::id())->get(); 

        return view('perso', ['albums' => $albums]);
    }

}
