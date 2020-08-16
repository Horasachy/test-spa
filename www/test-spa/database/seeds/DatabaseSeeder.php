<?php

use Illuminate\Database\Seeder;
use seeds\Traits\ProductTrait;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use ProductTrait;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->runCreateUsers();
        $this->runCreateCategoryAndProducts();
    }

    public function runCreateCategoryAndProducts()
    {
        echo "Create categories\n";
        $categories = factory(Category::class, 20)->create();

        foreach ($categories as $category) {
            $this->createProducts($category);
        }

        echo "Categories: " . count($categories) . "\n";
    }

    public function runCreateUsers()
    {
        echo "Create users\n";
        $users = factory(User::class, 50)->create();
        echo "Users: " . count($users) . "\n";
    }
}
