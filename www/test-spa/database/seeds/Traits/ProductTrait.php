<?php
namespace seeds\Traits;

use App\Models\Category;
use App\Models\Product;

trait ProductTrait {
    private function createProducts($category)
    {
        echo "Create products\n";
        factory(Product::class, 20)->make()
            ->each(function ($item) use ($category) {
                $item->category_id = $category->id;
                $item->save();
            });
    }
}
