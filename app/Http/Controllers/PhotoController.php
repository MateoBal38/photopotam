<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'titre' => 'required|min:2',
            'url' => 'required'
        ]);

        $name = $request->file('url')->hashName();
        $request->file('url')->move("photos/", $name);
        $data['url'] = "/photos/" . $name;

        $photo = Photo::create($data);
        $photo->save();

        return back();

        // $data = $request->validate([

        //     "titre"=> "required|min:2",
        //     "image"=> "required|image",
        //     "annee"=> "required",
        //     "nbSpectateurs"=> "required",
        //     "idRealisateur"=> "",
        //     "idGenre"=> ""

  
        // ]);

        // $name = $request->file('image')->hashName();
        // $request->file('image')->move("photos/", $name);
        // $data['image'] = "/photos/" . $name;

        // $photo = Photo::create($data);
        // $photo->save();

        // return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        Photo::destroy($id);
        return back();
    }
}
