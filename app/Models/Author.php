<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model {

    protected $filliable = [
        'name'
    ];
    protected $visible = [
        'id',
        'name',
        'books'
    ];

    public function books() {
        return $this->belongsToMany(Book::class, 'authors_has_books', 'author_id', 'book_id');
    }

}
