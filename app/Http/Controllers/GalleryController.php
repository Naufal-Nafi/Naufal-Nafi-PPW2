<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'id' => "posts",
            'menu' => 'Gallery',
            'galleries' => Post::where('picture', '!=',
            '')->whereNotNull('picture')->orderBy('created_at','asc')->paginate(30)
        );

        return view('gallery.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'photo' => 'image|nullable|max:9999'
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $basename = uniqid() . time();
            $smallFilename = "small {$basename} . {$extension}";
            $mediumFilename = "medium {$basename} . {$extension}";
            $largeFilename = "large {$basename} . {$extension}";
            $filenameSimpan = "{$basename} . {$extension}";
            $path = $request->file('photo')->storeAs('posts_image', $filenameSimpan);
        } else {
            $filenameSimpan = 'no-image.jpg';
        }

        $post = new Post();
        $post->picture = $filenameSimpan ;
        $post->title = $request->input('title');        
        $post->description = $request->input('description');                
        
        $post->save();

        return redirect('gallery')->with('success','Berhasil menambahkan data baru');
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
        $post = Post::find($id);
        return view('gallery.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'photo' => 'image|nullable|max:1999'
        ]);

        $post = Post::findOrFail($id);
        
        
        if ($request->hasFile('photo')) {
            if ($post->photo && \Storage::exists($post->photo)) {
                \Storage::delete($post->photo);
            }

            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $basename = uniqid() . time();
            $smallFilename = "small {$basename} . {$extension}";
            $mediumFilename = "medium {$basename} . {$extension}";
            $largeFilename = "large {$basename} . {$extension}";
            $filenameSimpan = "{$basename} . {$extension}";
            $path = $request->file('photo')->storeAs('posts_image', $filenameSimpan);
        } 
                      
        $post->picture = $filenameSimpan ;
        $post->title = $request->input('title');        
        $post->description = $request->input('description'); 
        $post->save();

        return redirect('gallery')->with('success','Berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Post::find($id);
        $buku->delete();

        return redirect('gallery');
    }
}
