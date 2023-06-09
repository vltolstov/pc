<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('configs')->insert([
            'name' => 'baseUrl',
            'value' => 'http://127.0.0.1:8000',
        ]);

        DB::table('configs')->insert([
            'name' => 'siteName',
            'value' => 'Название сайта',
        ]);

        DB::table('configs')->insert([
            'name' => 'companyName',
            'value' => 'Название компании',
        ]);

        DB::table('configs')->insert([
            'name' => 'postAddress',
            'value' => 'Почтовый адрес',
        ]);

        DB::table('configs')->insert([
            'name' => 'email',
            'value' => 'email@email.email',
        ]);

        DB::table('configs')->insert([
            'name' => 'phone',
            'value' => '+7 (383) 000-00-00',
        ]);

        DB::table('configs')->insert([
            'name' => 'mobilePhone',
            'value' => '+7 900 000-00-00',
        ]);

        DB::table('configs')->insert([
            'name' => 'companyLogo',
            'value' => '/img/logo.png',
        ]);

        DB::table('configs')->insert([
            'name' => 'companySlogan',
            'value' => 'Слоган компании',
        ]);

        DB::table('page_types')->insert([
            'name' => 'web',
        ]);

        DB::table('page_types')->insert([
            'name' => 'product',
        ]);

        DB::table('page_types')->insert([
            'name' => 'article',
        ]);

        DB::table('page_types')->insert([
            'name' => 'document',
        ]);

        DB::table('page_types')->insert([
            'name' => 'project',
        ]);



        DB::table('pages')->insert([
            'page_type_id' => 1,
            'name' => 'Главная',
            'parent_id' => 0,
        ]);

        DB::table('slugs')->insert([
            'page_id' => 1,
            'urn' => 'index',
        ]);

        DB::table('seo_sets')->insert([
            'page_id' => 1,
            'title' => 'Заголовок страницы',
            'description' => 'Описание страницы',
            'keywords' => 'ключевые слова',
            'priority' => '0.5',
            'changefreq' => 'weekly',
        ]);

        DB::table('images')->insert([
            'page_id' => 1,
            'image' => NULL,
        ]);

        DB::table('content_sets')->insert([
            'page_id' => 1,
            'introtext' => 'Интро',
            'content' => 'Контент',
        ]);

        DB::table('parametr_sets')->insert([
            'page_id' => 1,
            'params' => NULL,
        ]);



        DB::table('pages')->insert([
            'page_type_id' => 1,
            'name' => 'Каталог',
            'parent_id' => 0,
        ]);

        DB::table('slugs')->insert([
            'page_id' => 2,
            'urn' => 'katalog',
        ]);

        DB::table('categories')->insert([
            'page_id' => 2,
        ]);

        DB::table('seo_sets')->insert([
            'page_id' => 2,
            'title' => 'Заголовок каталога',
            'description' => 'Описание каталога',
            'keywords' => 'ключевые, слова',
            'priority' => '0.5',
            'changefreq' => 'weekly',
        ]);

        DB::table('images')->insert([
            'page_id' => 2,
            'image' => NULL,
        ]);

        DB::table('content_sets')->insert([
            'page_id' => 2,
            'introtext' => 'Интро каталога',
            'content' => 'Контент каталога',
        ]);

        DB::table('parametr_sets')->insert([
            'page_id' => 2,
            'params' => NULL,
        ]);



        DB::table('pages')->insert([
            'page_type_id' => 2,
            'name' => 'Продукт',
            'parent_id' => 2,
        ]);

        DB::table('slugs')->insert([
            'page_id' => 3,
            'urn' => 'product',
        ]);

        DB::table('seo_sets')->insert([
            'page_id' => 3,
            'title' => 'Заголовок продукта',
            'description' => 'Описание продукта',
            'keywords' => 'продукт',
            'priority' => '0.5',
            'changefreq' => 'weekly',
        ]);

        DB::table('images')->insert([
            'page_id' => 3,
            'image' => NULL,
        ]);

        DB::table('content_sets')->insert([
            'page_id' => 3,
            'introtext' => 'Интро продукта',
            'content' => 'Контент продукта',
        ]);

        DB::table('parametr_sets')->insert([
            'page_id' => 3,
            'params' => NULL,
        ]);

    }
}
