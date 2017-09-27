<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
        	'imagepath' => '/img/Layer-160-400x400.png',
        	'title'     => 'Tintoreto',
        	'description' => 'Bom tinto e tal',
        	'price' => 12
        ]);
        $product->save();
        $product = new \App\Product([
        	'imagepath' => '/img/Layer-160-400x400.png',
        	'title'     => 'Branco',
        	'description' => 'Bom branco e tal',
        	'price' => 9
        ]);
        $product->save();        
    }
}
