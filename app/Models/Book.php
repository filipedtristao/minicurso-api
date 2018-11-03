<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

    protected $filliable = [
        "name"
    ];
    protected $visible = [
        "id",
        "name",
        "authors"
    ];

    public function authors() {
        return $this->belongsToMany(Author::class, 'authors_has_books', 'book_id', 'author_id');
    }

}
