<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$data_buku = Buku::all();
        $data_buku = Buku::all()->sortByDesc('id');
        //$data_buku = Buku::orderByDesc('id')->get();

        $total_buku = $data_buku->count();
        $total_harga = $data_buku->sum('harga');
        
        // if (Auth::check()) {
        //     return view('buku.index', compact('data_buku', 'total_buku', 'total_harga'));
        // }
        // return redirect()->route('login')
        //     ->withErrors([
        //         'email' => 'please login to access the dashboard.'
        //     ])->onlyInput('email');
        return view('buku.index', compact('data_buku', 'total_buku', 'total_harga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth::check()) {
        //     return view('buku.create');
        // }
        // return redirect()->route('login')
        //     ->withErrors([
        //         'email' => 'please login to access the dashboard.'
        //     ])->onlyInput('email');
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('photos', $filenameSimpan);
        } 

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->photo = $path ?? null;
        
        $buku->save();

        return redirect('/buku');
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
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'photo' => 'image|nullable|max:1999',
    ]);

    // Temukan buku berdasarkan ID
    $buku = Buku::findOrFail($id);

    // Update kolom data buku
    $buku->judul = $request->judul;
    $buku->penulis = $request->penulis;
    $buku->harga = $request->harga;
    $buku->tgl_terbit = $request->tgl_terbit;

    // Cek apakah ada file baru yang diunggah
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($buku->photo && \Storage::exists($buku->photo)) {
            \Storage::delete($buku->photo);
        }

        // Simpan foto baru
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenameSimpan = $filename . '_' . time() . '.' . $extension;
        $path = $request->file('photo')->storeAs('photos', $filenameSimpan);

        // Update kolom photo dengan path baru
        $buku->photo = $path;
    }

    // Simpan perubahan ke database
    $buku->save();

    // Redirect atau respons sesuai kebutuhan
    return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }
}
