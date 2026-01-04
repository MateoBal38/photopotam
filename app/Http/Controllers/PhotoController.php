<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        'album_id' => 'required|exists:albums,id',
        'titre' => 'required|min:2',
        'image' => 'required|image|max:5120',
        'tags' => 'nullable|array',
        'tags.*' => 'exists:tags,id',

        'new_tags' => 'nullable|array',
        'new_tags.*' => 'nullable|string|min:2|max:50',

        'note' => 'required',
        ]);

        $name = $request->file('image')->hashName();
        $request->file('image')->move("photos/", $name);
        $data['image'] = "/photos/" . $name;

        $photo = Photo::create([
            'titre' => $data['titre'],
            'url' => $data['image'],
            'album_id' => $data['album_id'],
            'user_id' => Auth::id(),
            'note' => $data['note']
            ]);

        if (!empty($data['tags'])) {
        $photo->tags()->attach($data['tags']);
        }

        if (!empty($data['new_tags'])) {
        foreach ($data['new_tags'] as $tagName) {
            if (!empty($tagName)) {

                    $tag = Tag::firstOrCreate([
                        'nom' => strtolower(trim($tagName))
                    ]);

                    $photo->tags()->attach($tag->id);
                }
            }
        }


        return back();

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
