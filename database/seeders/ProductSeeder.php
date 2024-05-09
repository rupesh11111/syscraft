<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'product 1',
                'description' => 'description for product 1',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 1,
            ],
            [
                'name' => 'product 2',
                'description' => 'description for product 2',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 2,
            ],
            [
                'name' => 'product 3',
                'description' => 'description for product 3',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 3,
            ],
            [
                'name' => 'product 4',
                'description' => 'description for product 4',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 4,
            ],
            [
                'name' => 'product 5',
                'description' => 'description for product 5',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 5,
            ],
            [
                'name' => 'product 6',
                'description' => 'description for product 6',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 6,
            ],
            [
                'name' => 'product 7',
                'description' => 'description for product 7',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 7,
            ],
            [
                'name' => 'product 8',
                'description' => 'description for product 8',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 8,
            ],
            [
                'name' => 'product 9',
                'description' => 'description for product 9',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 9,
            ],
            [
                'name' => 'product 10',
                'description' => 'description for product 10',
                'image' => 'https://m.media-amazon.com/images/G/31/IMG20/Home/2024/HFRevamp/Peach_Fuzz._SS400_QL85_.jpg',
                'price' => 10,
            ],
        ]);
    }
}
