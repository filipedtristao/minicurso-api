<?php

use Illuminate\Database\Seeder;

//use \DB;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        $this->clearTables();

        //Usuário
        $this->insertRows(\collect([[
        "name" => "Admin",
        "email" => "admin@admin.com",
        "password" => bcrypt("password")
    ]]), "users", false);

        //Categories
        $categories = $this->repeat(function(Faker\Generator $faker) {
            return [
                'name' => $faker->word()
            ];
        });
        $categoriesIds = $this->insertRows($categories, "categories");

        //Books
        $books = $this->repeat(function(Faker\Generator $faker) use ($categoriesIds) {
            return [
                'name' => $faker->word(),
                'category_id' => $faker->randomElement($categoriesIds)
            ];
        });
        $booksIds = $this->insertRows($books, "books");

        //Authors
        $authors = $this->repeat(function(Faker\Generator $faker) {
            return [
                'name' => $faker->name(),
            ];
        });
        $authorsIds = $this->insertRows($authors, "authors");

        //Authors has books
        $authorsHasBooks = $this->repeat(function(Faker\Generator $faker) use ($authorsIds, $booksIds) {
            return [
                'author_id' => $faker->randomElement($authorsIds),
                'book_id' => $faker->randomElement($booksIds),
            ];
        });
        $this->insertRows($authorsHasBooks, "authors_has_books", false);

        //Tags
        $tags = $this->repeat(function(Faker\Generator $faker) {
            return [
                'name' => $faker->word(),
            ];
        });
        $this->insertRows($tags, "tags", false);
    }

    public function clearTables() {
        \DB::statement("SET foreign_key_checks=0");
        \DB::table('categories')->truncate();
        \DB::table('books')->truncate();
        \DB::table('authors')->truncate();
        \DB::table('authors_has_books')->truncate();
        \DB::table('tags')->truncate();
        \DB::table('taggables')->truncate();
        \DB::table('users')->truncate();
        \DB::statement("SET foreign_key_checks=1");
    }

    public function repeat($fn, $times = 100) {
        $data = [];
        $faker = Faker\Factory::create();
        for ($i = 0; $i < $times; $i++) {
            $data[] = $fn($faker);
        }

        return \collect($data);
    }

    public function insertRows($collection, $table, $return = true) {
        foreach ($collection->chunk(200) as $chunk) {
            foreach ($chunk as $row) {
                \DB::table($table)->insert($row);
            }
        }

        $this->command->info("Table [$table] seeded!");

        if ($return) {
            return \DB::table($table)->select('id')->get()->pluck('id');
        }
    }

}
