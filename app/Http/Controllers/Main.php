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

    public function album(Request $request){
        $search = $request->input("search");

        $sql_albums = 'SELECT albums.*, MIN(photos.url) AS photo_url FROM albums JOIN photos ON photos.album_id = albums.id ';
        $group_by = 'GROUP BY albums.id;';

        if($search) {
            $albums = db::SELECT($sql_albums . 'WHERE albums.titre LIKE ? OR albums.creation LIKE ? ' . $group_by, ["%{$search}%", "%{$search}%"]);
        }else {
            $albums = db::SELECT($sql_albums . $group_by);
        }

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
                            WHERE albums.id = ?', [$id]);
        
        if($search) {
            $album = db::SELECT($sql_album . 'AND photos.titre LIKE ?;', [$id, "%{$search}%"]);
        }

        $liste_tags = db::SELECT('SELECT DISTINCT tags.nom, tags.id
                                FROM tags
                                JOIN possede_tag ON possede_tag.tag_id = tags.id
                                JOIN photos ON photos.id = possede_tag.photo_id
                                JOIN albums ON albums.id = photos.album_id
                                WHERE albums.id = ?;', [$id]);

        //dd($album);

        return view('detailAlbum', ['album' => $album, 'tags' => $tags, 'id' => $id, 'liste_tags' => $liste_tags]);
    }

    public function signin(){   
        return view('signin');
    }

    public function login(){
        return view('login');
    }

}