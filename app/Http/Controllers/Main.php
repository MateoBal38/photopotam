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

    public function album(Request $request){

    $search = $request->input('search');

    $albumWithPreview = Album::query()->with(['photos' => function ($query) {
            $query->orderBy('url')->limit(1);
        }]); 

    if ($search) {
        $albumWithPreview->where(function ($q) use ($search) {
            $q->where('titre', 'LIKE', "%{$search}%")
              ->orWhere('creation', 'LIKE', "%{$search}%");
        });
    }

    $albums = $albumWithPreview->get();
    
    return view('album', ['albums' => $albums]);
    }


    // public function detailAlbum(Request $request, $id) {
    // $search = $request->input("search");

    // $albumQuery = Album::with(['photos.tags'])->where('id', $id);

    // $albumQuery = Album::with(['photos' => function ($q) use ($search) {
    //     $q->with('tags');

    //     if ($search) {
    //         $q->where(function ($q2) use ($search) {
    //             $q2->where('titre', 'LIKE', "%{$search}%")
    //                ->orWhereHas('tags', function ($q3) use ($search) {
    //                    $q3->where('nom', 'LIKE', "%{$search}%");
    //                });
    //         });
    //     }
    // }]);

    // $album = $albumQuery->firstOrFail();
    // $album = $albumQuery->where('id', $id)->firstOrFail();

    // $liste_tags = Tag::whereHas('photos', function ($q) use ($id) {
    //     $q->where('album_id', $id);
    // })->distinct()->get();

    // $tags = Tag::select('tags.*', 'possede_tag.photo_id')
    //     ->join('possede_tag', 'possede_tag.tag_id', '=', 'tags.id')
    //     ->join('photos', 'photos.id', '=', 'possede_tag.photo_id')
    //     ->where('photos.album_id', $id)
    //     ->get();

    // return view('detailAlbum', ['album' => $album, 'tags' => $tags, 'id' => $id, 'liste_tags' => $liste_tags]);
    // }


    public function detailAlbum(Request $request, $id) {
        
        $search = $request->input('search');
        $album = Album::find($id); 
        $photos = Photo::where('album_id', $id)->get();

        $liste_tags = [];

        if($search) {
            $photos = Photo::where('album_id', $id)->where('titre', 'LIKE', "%{$search}%")->get();
        }

        return view('detailAlbum', ['id' => $id, 'album' => $album, 'liste_tags' => $liste_tags, 'photos' => $photos]);
    }


    public function register(){   
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function create_album(){
        return view('create_album');
    }

    public function store_album(Request $request) {
        $data = $request->validate([
            'titre' => 'required|min:2'
        ]);

        Album::create([
            "titre" => $data['titre'],
            "creation" => date("Y-m-d"),
            "user_id" => Auth::id()
        ]);
        
        return redirect ("/album");
    }

    public function perso(){
        $albums = Album::query()->with(['photos' => function ($query) {
            $query->orderBy('url')->limit(1);
        }])->where('id', 'LIKE', Auth::id())->get(); 

        dd($albums);

        return view('perso', ['albums' => $albums]);
    }

}