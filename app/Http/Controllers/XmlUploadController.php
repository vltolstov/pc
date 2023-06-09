<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class XmlUploadController extends Controller
{

    public function index()
    {
        $productsList = self::prepare();

        DB::table('pages')
            ->where('page_type_id', 2)
            ->update(['active' => 0]);

        $categoryIds = [];
        $categories = Page::select('pages.id', 'parametr_sets.params')
            ->join('categories', 'pages.id', '=', 'categories.page_id')
            ->join('parametr_sets', 'pages.id', '=', 'parametr_sets.page_id')
            ->get();
        foreach ($categories as $category){
            if($category->params != null){
                $cid = json_decode($category->params);
                $categoryIds += [
                    $cid[0]->value => $category->id
                ];
            }
        }

        $goods = Page::all();
        $goodIds = [];
        foreach ($goods as $good) {
            if($good->parametrSet->params != null){
                $cid = json_decode($good->parametrSet->params);
                $goodIds += [
                    $cid[0]->value => $good->id
                ];
            }
        }

        foreach ($productsList as $product) {
            if(array_key_exists($product['product_id'], $goodIds)){
                self::update($product, $goodIds[$product['product_id']], $categoryIds);
            } else {
                self::add($product, $categoryIds);
            }
        }

        return 'ok';

    }

    public function prepare()
    {
        $file = Storage::path('/xml/products.xml');
        $xml = simplexml_load_file($file);
        $products = [];

        foreach ($xml->Elements->Element as $key => $item) {

            $productId = 'ID' . (string)$item['Kod'];
            $productName = (string)$item['Name'];
            $categoryId = 'ID' . (string)$item['KodGroup'];
            $productUnit = (string)$item['Ed'];

            $minimumQuantityString = (string)$item['Artikul'];
            preg_match('/\d+/', $minimumQuantityString, $arrayOfQuantity);
            $minimumQuantity = array_pop($arrayOfQuantity);
            if (empty($minimumQuantity)) {
                $minimumQuantity = 1;
            }

            $prices = [
                'xs' => (float)$item->Prices->El_Price[0]['Price'],
                's' => (float)$item->Prices->El_Price[1]['Price'],
                'm' => (float)$item->Prices->El_Price[2]['Price'],
                'l' => (float)$item->Prices->El_Price[3]['Price'],
            ];

            if (empty($prices)) {
                $products[$productId]['prices'] = [
                    'xs' => 0,
                    's' => 0,
                    'm' => 0,
                    'l' => 0,
                ];
            }

            $url = Str::slug($productName, '-');

            $products[$productId] = array(
                'product_id' => $productId,
                'name' => str_replace('"', '', $productName),
                'category_id' => $categoryId,
                'product_unit' => $productUnit,
                'minimum_quantity' => $minimumQuantity,
                'url' => $url . '-' . $productId,
                'prices' => $prices,
            );
        }

        return $this->products = $products;

    }

    public function add($product, $categoryIds)
    {

        $data = [
            'name' => Str::limit($product['name'], 100, ''),
            'page_type_id' => 2,
            'active' => 1,
            'urn' => Str::slug($product['name'], '-') . '-' .$product['product_id'],
            'title' => Str::limit($product['name'], 70, ''),
            'description' => Str::limit($product['name'], 160, ''),
            'keywords' => $product['name'],
            'introtext' => $product['name'],
            'content' => null,
            'image' => null,
        ];

        $paramArr[] = [
            'name' => '1cid',
            'value' => $product['product_id'],
            'active' => false,
            'hide' => true,
        ];
        $paramArr[] = [
            'name' => 'Минимальное количество' . ', ' . $product['product_unit'],
            'value' => $product['minimum_quantity'],
            'active' => false,
            'hide' => false,
        ];
        foreach ($product['prices'] as $key => $value){
            $paramArr[] = [
                'name' => $key,
                'value' => $value,
                'active' => false,
                'hide' => true,
            ];
        }
        $data['params'] = json_encode($paramArr);

        if(array_key_exists($product['category_id'], $categoryIds)){
            $data['parent_id'] = $categoryIds[$product['category_id']];
        } else {
            $data['parent_id'] = 92;
        }

        $page = Page::create($data);
        $data['page_id'] = $page->id;
        $page->slug()->create($data);
        $page->image()->create($data);
        $page->seoSet()->create($data);
        $page->parametrSet()->create($data);
        $page->contentSet()->create($data);

    }

    public function update($product, $id, $categoryIds)
    {

        $data = [
            'page_id' => $id,
        ];

        $page = Page::find($id);

        $page->name = Str::limit($product['name'], 50, '');
        $page->active = 1;
        $page->page_type_id = 2;
        $page->seoSet->update($data);
        $page->contentSet->update($data);

        $paramArr[] = [
            'name' => '1cid',
            'value' => $product['product_id'],
            'active' => false,
            'hide' => true,
        ];
        $paramArr[] = [
            'name' => 'Минимальное количество' . ', ' . $product['product_unit'],
            'value' => $product['minimum_quantity'],
            'active' => false,
            'hide' => false,
        ];
        foreach ($product['prices'] as $key => $value){
            $paramArr[] = [
                'name' => $key,
                'value' => $value,
                'active' => false,
                'hide' => true,
            ];
        }
        $data['params'] = json_encode($paramArr);
        $page->parametrSet->update($data);

        if(array_key_exists($product['category_id'], $categoryIds)){
            $page->parent_id = $categoryIds[$product['category_id']];
        } else {
            $page->parent_id = 92;
        }

        $page->save();

    }
}
