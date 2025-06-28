<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $query = Book::query();
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                  ->orWhere('penulis', 'like', "%$search%")
                  ->orWhere('kategori', 'like', "%$search%")
                  ->orWhere('penerbit', 'like', "%$search%")
                ;
            });
        }
        $books = $query->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'penulis' => 'required|string|max:255',
                'penerbit' => 'required|string|max:255',
                'kategori' => 'required|string|max:255',
                'tahun_terbit' => 'required|integer',
                'stok' => 'required|integer',
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'deskripsi' => 'nullable|string',
            ]);
            
            $book = new Book($validated);
            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/covers'), $filename);
                $book->cover = $filename;
            }
            $book->save();
            
            return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput($request->except(['password', 'password_confirmation']));
        }
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);
        if ($request->hasFile('cover')) {
            if ($book->cover && file_exists(public_path('uploads/covers/'.$book->cover))) {
                unlink(public_path('uploads/covers/'.$book->cover));
            }
            $file = $request->file('cover');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/covers'), $filename);
            $validated['cover'] = $filename;
        }
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate!');
    }

    public function destroy(Book $book)
    {
        try {
            // Cek apakah ada peminjaman yang terkait dengan buku ini
            $peminjamanCount = Peminjaman::where('id_buku', $book->id_buku)->count();
            
            if ($peminjamanCount > 0) {
                return redirect()->route('books.index')
                    ->with('error', 'Buku tidak dapat dihapus karena masih ada ' . $peminjamanCount . ' data peminjaman yang terkait. Silakan hapus data peminjaman terlebih dahulu.');
            }
            
            // Hapus file cover jika ada
            if ($book->cover && file_exists(public_path('uploads/covers/'.$book->cover))) {
                unlink(public_path('uploads/covers/'.$book->cover));
            }
            
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
            
        } catch (QueryException $e) {
            // Jika masih ada foreign key constraint error
            return redirect()->route('books.index')
                ->with('error', 'Buku tidak dapat dihapus karena masih memiliki data terkait. Silakan hapus data peminjaman terlebih dahulu.');
        } catch (\Exception $e) {
            return redirect()->route('books.index')
                ->with('error', 'Terjadi kesalahan saat menghapus buku: ' . $e->getMessage());
        }
    }
}