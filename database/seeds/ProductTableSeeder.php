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
        	'imagePath' => 'http://ecx.images-amazon.com/images/I/51ZU%2BCvkTyL.jpg',
        	'title' => 'Harry Potter',
        	'description' => 'Super cool - at least as a child',
        	'price' => 10
        ]);
        $product->save();

        $product = new \App\Product([
        	'imagePath' => 'https://d2sofvawe08yqg.cloudfront.net/php7-mudancasenovidades/hero2x?1549483166',
        	'title' => 'PHP 7 - Mudanças e Novidades',
        	'description' => 'leanpub',
        	'price' => 15
        ]);
        $product->save();

        $product = new \App\Product([
        	'imagePath' => 'https://www.pontofrio-imagens.com.br/livros/InformaticaCertificacao/livrosdeinformatica/1503772692/1349029780/full-stack-vuejs-2-and-laravel-5-1503772692.jpg',
        	'title' => 'Full-Stack Vue.js 2 and Laravel 5',
        	'description' => 'Packt Publishing',
        	'price' => 20
        ]);
        $product->save();

        $product = new \App\Product([
        	'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/61gW3D30kCL.jpg',
        	'title' => 'Laravel Para Ninjas',
        	'description' => 'Novatec',
        	'price' => 30
        ]);
        $product->save();

        $product = new \App\Product([
        	'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/51LA0Ve3wVL._SX357_BO1,204,203,200_.jpg',
        	'title' => 'Desenvolvendo com Laravel',
        	'description' => 'Novatec',
        	'price' => 35,
        ]);
        $product->save();
    }
}
