<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\CategoryBerita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index() 
    {
        $berita = Berita::with('CategoryBerita')->get();
        // dd($berita);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $categoryBerita = CategoryBerita::pluck('name', 'id');
        return view('admin.berita.create', compact('categoryBerita'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image upload
            'title' =>  'required|max:255',
            'body' => 'required',
            'category_berita_id' => 'required|uuid',
        ]);

        // Upload File
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // $image->move(public_path('images'), $imageName);
            $image->storeAs('public', $imageName);
            $validatedData['photo'] = $imageName;
        }

        // Store data in the database
        $berita = new Berita();
        $berita->id = Str::uuid(); // Hasilkan UUID untuk kolom 'id'
        $berita->user_id = Str::uuid();
        // $berita->category_berita_id = Str::uuid();
        $berita->category_berita_id = $validatedData['category_berita_id'];
        $berita->title = $validatedData['title'];
        // $berita['slug'] = Str::slug($validatedData['slug'], '-');
        // $berita->slug = Str::slug($validatedData['slug'], '-');
        $berita->body = $validatedData['body'];
        // $berita->photo = $validatedData['photo'];
        $berita->slug = Str::slug($validatedData['title']);
        $berita->photo = $imageName;
        $berita->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show($id_or_slug)
    {
        $berita = Berita::where('id', $id_or_slug)->orWhere('slug', $id_or_slug)->firstOrFail();
        return view('admin.berita.detail', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $categoryBerita = CategoryBerita::pluck('name', 'id');
        return view('admin.berita.edit', compact('berita', 'categoryBerita'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_berita_id' => 'required|uuid',
            // 'slug' => 'required|max:255|unique:beritas,slug,'.$id,
            'title' =>  'required|max:255',
            'body' => 'required',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            Storage::delete('public/' . $berita->photo);

            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // $image->move(public_path('images'), $imageName);
            $image->storeAs('public', $imageName);
            $validatedData['photo'] = $imageName;
        }

        $berita->category_berita_id = $validatedData['category_berita_id'];
        $berita->title = $validatedData['title'];
        // $berita->slug = Str::slug($validatedData['slug'], '-');
        $berita->body = $validatedData['body'];

        if ($berita->isDirty('title')) {
            $berita->slug = Str::slug($validatedData['title']);
        }

        if(isset($validatedData['photo'])){
            $berita->photo = $validatedData['photo'];
        }
        $berita->save();

        return redirect()->back()->with('success', 'Berita berhasil diperbarui.');
    }

    public function delete($id)
    {
        $berita = Berita::findOrFail($id);
        Storage::delete($berita->photo);
        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }
}
