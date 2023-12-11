<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    //

    public function index(Request $request) {
        $keyword = $request->get('search');
        $perPage = 5;
        if(empty($keyword)) {
            $books = Book::latest()->paginate($perPage);
        } else {
            $books = Book::where('book_name', 'LIKE', "%$keyword%")
                ->orWhere('category', 'LIKE', "%$keyword%")
                ->orWhere('author', 'LIKE', "%$keyword%")
                ->orWhere('publication_year', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        }
        return view('books.index', ['books' => $books])->with('1',(request()->input('page', 1) -1) * 5);
    }

    public function create()
    {
        $title = "Add Books";
        return view('books.create', compact('title'));
    }

    public function store(Request $request) {

        $request->validate([
            'bookName' => 'required',
            'cover' => 'required|image|mimes:jpg,png,giv,webp|max:1024',
            'author' => 'required',
            'category' => 'required',
            'publicationYear' => 'required'

        ]);

        $book = new Book;

        $cover = time().'.'.$request->cover->getClientOriginalExtension();
        $request->cover->move(public_path('images'), $cover);

        $book->book_name = $request->bookName;
        $book->author = $request->author;
        $book->category = $request->category;
        $book->cover = $cover;
        $book->publication_year = $request->publicationYear;

        $book->save();

        return redirect()->route('books.index')->with('success', 'Books Added Successfully');

    }

    public function edit($id)
    {
        $row = Book::findOrFail($id);
        return view('books.edit',['row' => $row]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'bookName' => 'required',
            'author' => 'required',
            'category' => 'required',
            'publicationYear' => 'required'
        ]);

        $cover = $request->hidden_img;
        if($request->cover != '') {
            $cover = time().'.'.request()->getClientOriginalExtension();
            request()->cover->move(public_path('images'), $cover);
        }

        $id = $request->hidden_id;

        $book = Book::find($id);
        $book->book_name = $request->bookName;
        $book->author = $request->author;
        $book->category = $request->category;
        $book->publication_year = $request->publicationYear;


        $book->save();
        return redirect()->route('books.index')->with('success', 'Book Successfully updated');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $cover = public_path().'/images/'.$book->cover;

        if(file_exists($cover)) {
            @unlink($cover);
        }
        $book->delete();

        return redirect('books')->with('success', 'Book Deleted Successfully');
    }
}
