<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $koleksis = Koleksi::with('category')
            ->latest()
            ->paginate(15);

        return view('admin.koleksi.index', compact('koleksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.koleksi.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255|unique:koleksis,isbn',
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
            'penerbit' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:tersedia,dipinjam,rusak,hilang',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'isbn.unique' => 'ISBN sudah terdaftar.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.min' => 'Tahun terbit tidak valid.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun saat ini.',
            'status.required' => 'Status wajib dipilih.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'cover.image' => 'File harus berupa gambar.',
            'cover.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'cover.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Handle cover upload
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $validated['cover_path'] = $coverPath;
        }

        unset($validated['cover']);

        Koleksi::create($validated);

        return redirect()->route('admin.koleksi.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Koleksi $koleksi)
    {
        $koleksi->load('category');
        return view('admin.koleksi.show', compact('koleksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Koleksi $koleksi)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.koleksi.edit', compact('koleksi', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Koleksi $koleksi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255|unique:koleksis,isbn,' . $koleksi->id,
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
            'penerbit' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:tersedia,dipinjam,rusak,hilang',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'isbn.unique' => 'ISBN sudah terdaftar.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.min' => 'Tahun terbit tidak valid.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun saat ini.',
            'status.required' => 'Status wajib dipilih.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'cover.image' => 'File harus berupa gambar.',
            'cover.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'cover.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Handle cover upload
        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($koleksi->cover_path) {
                Storage::disk('public')->delete($koleksi->cover_path);
            }

            $coverPath = $request->file('cover')->store('covers', 'public');
            $validated['cover_path'] = $coverPath;
        }

        unset($validated['cover']);

        $koleksi->update($validated);

        return redirect()->route('admin.koleksi.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Koleksi $koleksi)
    {
        // Delete cover if exists
        if ($koleksi->cover_path) {
            Storage::disk('public')->delete($koleksi->cover_path);
        }

        $koleksi->delete();

        return redirect()->route('admin.koleksi.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
