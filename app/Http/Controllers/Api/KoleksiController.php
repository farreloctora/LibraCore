<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Koleksi::with('category');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', (int) $request->get('category_id'));
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 12);
        $page = $request->get('page', 1);
        $koleksis = $query->paginate($perPage, ['*'], 'page', $page);

        // Transform data to include cover URL
        $transformedData = $koleksis->getCollection()->map(function ($koleksi) {
            if ($koleksi->cover_path) {
                if (str_starts_with($koleksi->cover_path, 'http')) {
                    $koleksi->cover_url = $koleksi->cover_path;
                } else {
                    $koleksi->cover_url = \Illuminate\Support\Facades\Storage::url($koleksi->cover_path);
                }
            } else {
                $koleksi->cover_url = \Illuminate\Support\Facades\Storage::url('covers/placeholder.jpg');
            }
            return $koleksi;
        });

        return response()->json([
            'success' => true,
            'data' => $transformedData->values()->all(),
            'pagination' => [
                'current_page' => $koleksis->currentPage(),
                'last_page' => $koleksis->lastPage(),
                'per_page' => $koleksis->perPage(),
                'total' => $koleksis->total(),
                'from' => $koleksis->firstItem(),
                'to' => $koleksis->lastItem(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'isbn' => 'nullable|string|unique:koleksis,isbn',
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
            'penerbit' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|in:tersedia,dipinjam,rusak,hilang',
            'cover_path' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $koleksi = Koleksi::create($validated);
        $koleksi->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Koleksi berhasil ditambahkan',
            'data' => $koleksi,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $koleksi = Koleksi::with('category')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $koleksi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $koleksi = Koleksi::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'penulis' => 'sometimes|required|string|max:255',
            'isbn' => 'nullable|string|unique:koleksis,isbn,' . $id,
            'tahun_terbit' => 'sometimes|required|integer|min:1000|max:' . date('Y'),
            'penerbit' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|in:tersedia,dipinjam,rusak,hilang',
            'cover_path' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $koleksi->update($validated);
        $koleksi->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Koleksi berhasil diperbarui',
            'data' => $koleksi,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $koleksi = Koleksi::findOrFail($id);
        $koleksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Koleksi berhasil dihapus',
        ]);
    }
}
