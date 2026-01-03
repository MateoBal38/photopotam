<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
    $search = $request->input('search');

    $albumWithPreview = Album::with('preview');

    if ($search) {
        $albumWithPreview->where(function ($q) use ($search) {
            $q->where('titre', 'LIKE', "%{$search}%")
              ->orWhere('creation', 'LIKE', "%{$search}%");
        });
    }

    $albums = $albumWithPreview->get();
    
    return view('album', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_album');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $search = $request->input('search');
        $album = Album::find($id); 
        $photos = Photo::where('album_id', $id)->get();

        $liste_tags = [];

        if($search) {
            $photos = Photo::where('album_id', $id)->where('titre', 'LIKE', "%{$search}%")->get();
        }
        
        return view('detailAlbum', ['id' => $id, 'album' => $album, 'liste_tags' => $liste_tags, 'photos' => $photos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Album::destroy($id);
        return redirect('/perso');
    }
}
