<?php

$version = "V1";

\Route::get("/$version", function() use ($version) {
    echo "<h1>Minicurso API - $version</h1>";
});

\Route::post("/$version/login", "LoginController@login");

\Route::group(["middleware" => ["auth"], "prefix" => $version], function() {

    //Books
    Route::get("books", "BookController@index");
    Route::get("books/:id", "BookController@view");
    Route::post("books", "BookController@store");
    Route::put("books/:id", "BookController@update");
    Route::delete("books/:id", "BookController@destroy");
});
