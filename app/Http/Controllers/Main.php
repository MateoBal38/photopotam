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

    public function detailAlbum(Request $request, $id){
        $search = $request->input("search");

        $sql_album = 'SELECT *, albums.titre as titre_album FROM albums JOIN photos ON photos.album_id = albums.id WHERE albums.id = ? ';
        $album = db::SELECT($sql_album, [$id]);

        $tags = db::SELECT('SELECT tags.nom, tags.id, possede_tag.photo_id FROM tags 
                            JOIN possede_tag ON possede_tag.tag_id = tags.id
                            JOIN photos ON photos.id = possede_tag.photo_id
                            JOIN albums ON albums.id = photos.album_id
                            WHERE albums.id = ?;', [$id]);
        
        if($search) {
            $album = db::SELECT($sql_album . 'AND photos.titre LIKE ?;', [$id, "%{$search}%"]);
        }

        //dd($album);

        return view('detailAlbum', ['album' => $album, 'tags' => $tags, 'id' => $id]);
    }

    public function signin(){   
        return view('signin');
    }

    public function login(){
        return view('login');
    }

}