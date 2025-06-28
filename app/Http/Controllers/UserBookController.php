<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class UserBookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();
        if ($request->search) {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }
        $books = $query->get();
        return view('user.books', compact('books'));
    }
} 