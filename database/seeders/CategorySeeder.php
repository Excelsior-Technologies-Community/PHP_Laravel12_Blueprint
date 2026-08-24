<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'status' => true],
            ['name' => 'Clothing', 'status' => true],
            ['name' => 'Books', 'status' => true],
            ['name' => 'Home Appliances', 'status' => true],
            ['name' => 'Sports', 'status' => true],
            ['name' => 'Toys & Games', 'status' => true],
            ['name' => 'Beauty', 'status' => true],
            ['name' => 'Grocery', 'status' => true],
            ['name' => 'Furniture', 'status' => true],
            ['name' => 'Automotive', 'status' => true],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['name' => $cat['name']],
                ['status' => $cat['status']]
            );
        }
    }
}
