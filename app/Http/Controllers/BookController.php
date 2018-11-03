<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller {

    public function index(Request $request) {

        $query = Book::query();

        if ($request->filled('name')) {
            $query->where("name", "like", "%" . $request->get('name') . "%");
        }

        if ($request->filled('hasAuthors')) {
            $query->whereHas("authors", null, ">=", $request->get('hasAuthors'));
        }

        if ($request->filled('author-name')) {
            $query->whereHas("authors", function($query) use ($request) {
                $query->where("name", "like", "%" . $request->get('author-name') . "%");
            });
        }

        $books = $query->with('authors')->paginate();

        return response()->json(["data" => $books]);
    }

}
