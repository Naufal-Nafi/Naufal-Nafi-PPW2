<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class GalleryController extends Controller
{
    // untuk coba api 
    /**
     * @OA\Get(
     *     path="/api/gallery",
     *     tags={"Gallery"},
     *     summary="Get all gallery posts with images",
     *     description="Returns a paginated list of posts that have pictures.",
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=30)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="data", type="array", @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Sample Title"),
     *                     @OA\Property(property="picture", type="string", example="path/to/image.jpg"),
     *                     @OA\Property(property="description", type="string", example="Sample description")
     *                 )),
     *                 @OA\Property(property="total", type="integer", example=50)
     *             )
     *         )
     *     )
     * )
     */

    public function galery(Request $request)
    {
        $perPage = $request->input('per_page', 30); // Default 30 items per page
        $galleries = Post::where('picture', '!=', '')
            ->whereNotNull('picture')
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $galleries
        ]);
    }
    public function index()
    {
        $data = array(
            'id' => "posts",
            'menu' => 'Gallery',
            'galleries' => Post::where(
                'picture',
                '!=',
                ''
            )->whereNotNull('picture')->orderBy('created_at', 'asc')->paginate(30)
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
        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        $post->save();

        return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
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

        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect('gallery')->with('success', 'Berhasil mengedit data');
    }


    public function destroy(string $id)
    {
        $buku = Post::find($id);
        $buku->delete();

        return redirect('gallery');
    }
}
