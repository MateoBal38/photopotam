<?php

namespace App\Http\Controllers;

// use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Main extends Controller
{
    public function index(){
        //$album =  Album::orderby('creation')->take(3)->get();
        //$tab = [];
        // for($i=0; $i < count($album); $i++) {
        //     $tab[$i] = $album->photos->take(1)->get();
        // }
        // dd::$tab;

        $photos = db::SELECT('SELECT * FROM albums JOIN photos ON photos.album_id = albums.id ORDER BY RAND() LIMIT 4;');
        // dd($photos);
        return view('index', ['photos' => $photos]);
    }

    public function album(){
        $albums = db::SELECT('SELECT albums.*, MIN(photos.url) AS photo_url FROM albums JOIN photos ON photos.album_id = albums.id GROUP BY albums.id;');

        //dd($albums);

        return view('album', ['albums' => $albums]);
    }

    public function detailAlbum($id){
        $album = db::SELECT('SELECT *, albums.titre as titre_album FROM albums JOIN photos ON photos.album_id = albums.id WHERE albums.id = ?;', [$id]);

        dd($album);

        return view('detailAlbum', ['album' => $album]);
    }

    public function signin(){   
        return view('signin');
    }

    public function login(){
        return view('login');
    }

}