<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'book']);

        // Jika user biasa, filter hanya peminjaman miliknya
        if (auth()->user()->role === 'user') {
            $query->where('id_user', auth()->user()->id_user);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q2) use ($search) {
                    $q2->where('nama', 'like', "%$search%");
                })->orWhereHas('book', function($q2) use ($search) {
                    $q2->where('judul', 'like', "%$search%");
                });
            });
        }

        $peminjaman = $query->paginate(10);
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create(Request $request)
    {
        $users = User::all();
        $books = Book::all();
        $selectedBook = null;
        if ($request->has('id_buku')) {
            $selectedBook = Book::find($request->id_buku);
        }
        return view('peminjaman.create', compact('users', 'books', 'selectedBook'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_buku' => 'required|exists:books,id_buku',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        // Kurangi stok buku
        $book = Book::find($validated['id_buku']);
        $book->decrement('stok');

        Peminjaman::create($validated);
        return redirect()->route('user.books.index')->with('success', 'Peminjaman berhasil!');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Kembalikan stok buku
        $peminjaman->book->increment('stok');
        
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}