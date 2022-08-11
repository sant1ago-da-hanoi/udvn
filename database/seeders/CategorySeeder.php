<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        Category::factory()
            ->count(100)
            ->has(
                Product::factory()
                    ->count(10)
                    ->hasProductTranslations(1)
            )
            ->hasCategoryTranslations(1)
            ->create();

        echo "\n Update categories path";
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->path = \Str::slug($category->translate('vi')->name);
            $category->save();
        }

        echo "\n Update products slug";
        $products = Product::all();

        foreach ($products as $product) {
            $product->slug = \Str::slug($product->translate('vi')->name);
            $product->save();
        }
    }
}
