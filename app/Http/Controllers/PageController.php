<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContentSet;
use App\Models\Image;
use App\Models\Page;
use App\Models\PageType;
use App\Models\ParametrSet;
use App\Models\SeoSet;
use App\Models\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ImageController;

class PageController extends Controller
{

    public function index()
    {

        $page = Page::find(1);

        return view('index', [
            'id' => $page->id,
            'parent_id' => $page->parent_id,
            'name' => $page->name,
            'title' => $page->seoset->title,
            'description' => $page->seoset->description,
            'keywords' => $page->seoset->keywords,
            'content' => $page->contentset->content,
            'introtext' => $page->contentset->introtext,
            'urn' => $page->slug->urn,
            'menuItems' => MenuController::generateMenu(),
        ]);

    }

    public function page($slug)
    {

        $page = DB::table('pages')
            ->join('slugs','pages.id','=','slugs.page_id')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('content_sets', 'pages.id','=','content_sets.page_id')
            ->join('parametr_sets', 'pages.id','=','parametr_sets.page_id')
            ->join('images', 'pages.id','=','images.page_id')
            ->leftJoin('categories', 'pages.id', '=', 'categories.page_id')
            ->where('urn', $slug)
            ->select('pages.*',
                'slugs.urn',
                'seo_sets.title',
                'seo_sets.description',
                'seo_sets.keywords',
                'content_sets.introtext',
                'content_sets.content',
                'parametr_sets.params',
                'images.image',
                'categories.id as category_id',
            )
            ->first();

        if($page == null) return abort(404);

        $data = [
            'id' => $page->id,
            'parent_id' => $page->parent_id,
            'name' => $page->name,
            'title' => $page->title,
            'description' => $page->description,
            'introtext' => $page->introtext,
            'urn' => $page->urn,
            'keywords' => $page->keywords,
            'content' => $page->content,
            'params' => json_decode($page->params, true),
            'images' => json_decode($page->image, true),
        ];

        $data['categories'] = Page::join('slugs', 'pages.id','=','slugs.page_id')
            ->join('images', 'pages.id','=','images.page_id')
            ->join('categories', 'pages.id', '=', 'categories.page_id')
            ->select('pages.*', 'slugs.urn', 'images.image as images')
            ->where('parent_id', $page->id)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
        if (!isset($data['categories'][0])){
            $data['categories'] = null;
        } else {
            foreach ($data['categories'] as $category){
                $category['images'] = json_decode($category->images, true);
            }
        }

        $data['products'] = Page::join('slugs', 'pages.id','=','slugs.page_id')
            ->join('images', 'pages.id','=','images.page_id')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->select('pages.*', 'slugs.urn','seo_sets.title', 'images.image as images')
            ->where('parent_id', $page->id)
            ->where('page_type_id', 2)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();

        if (!isset($data['products'][0])){
            $data['products'] = null;
        } else {
            foreach ($data['products'] as $product){
                $product['images'] = json_decode($product->images, true);
            }
        }

        $data['menuItems'] = MenuController::generateMenu();

        if($page->category_id){
            return view('pages.category', $data);
        }

        if($page->page_type_id){
            $types = PageType::where('id', $page->page_type_id)->first();
            return view('pages.' . $types->name, $data);
        }

        return view('pages.default', $data);

    }

    public function create()
    {

        $menuPages = Page::select('*')
            ->where('parent_id', '=', '0')
            ->get();

        $categories = Category::select('*')
            ->join('pages', 'categories.page_id', '=', 'pages.id')
            ->get();

        $pageTypes = PageType::all();

        return view('admin.index', [
            'createNew' => true,
            'menuPages' => $menuPages,
            'categories' => $categories,
            'pageTypes' => $pageTypes,
            'title' => 'Создание страницы'
        ]);
    }

    public function store(Request $request)
    {

        $validationData = $request->validate([
            'name' => ['required','string','max:100'],
            'page_type_id' => 'present',

            'urn' => ['required', 'string', 'unique:slugs,urn'],

            'introtext' => 'present',
            'content' => 'present',

            'title' => ['required','string','max:70'],
            'description' => ['required', 'string', 'max:160'],
            'keywords' => 'present',

            'category' => 'present',
            'parent_id' => 'present',

            'active' => 'present',

        ]);

        if($request->file()) {
            $validationData['image'] = ImageController::imageDataProcessing($request, $validationData['urn']);
        }

        $validationData['params'] = ParametrSetController::ParametrDataProcessing($request);

        try{
            $validationData['page_id'] = Page::create($validationData)->id;
            Slug::create($validationData);
            ContentSet::create($validationData);
            Image::create($validationData);
            ParametrSet::create($validationData);
            SeoSet::create($validationData);

            if($validationData['category']){
                Category::create($validationData);
            }
        }
        catch (QueryException $exception){
            return redirect(route('page.create'))->withErrors('Ошибки в форме');
        }

        return redirect()->route('page.edit', $validationData['page_id']);
    }

    public function edit(Page $page)
    {

        $menuPages = Page::select('*')
            ->where('parent_id', '=', '0')
            ->get();

        $images = json_decode($page->image->image, true);
        $params = json_decode($page->parametrSet->params, true);

        $categories = Category::select('*')
            ->join('pages', 'categories.page_id', '=', 'pages.id')
            ->where('page_id', '!=', $page->id)
            ->get();

        $pages = Page::select('pages.id', 'pages.name', 'pages.active', 'images.image')
            ->join('images', 'pages.id','=','images.page_id')
            ->where('parent_id', '=', $page->id)
            ->orderBy('pages.name', 'ASC')
            ->get();

        $pageTypes = PageType::select('*')
            ->get();

        $isCategory = Page::select('categories.id')
            ->leftJoin('categories', 'pages.id', '=', 'categories.page_id')
            ->where('pages.id', '=', $page->id)
            ->first();

        if($isCategory->id !== null){
            $isCategory = false;
        }

        return view('admin.index', [
            'pages' => $pages,
            'menuPages' => $menuPages,
            'categories' => $categories,
            'pageTypes' => $pageTypes,
            'currentPage' => $page,
            'isCategory' => $isCategory,
            'seoSet' => $page->seoSet,
            'contentSet' => $page->contentSet,
            'slug' => $page->slug->urn,
            'images' => $images,
            'params' => $params,
            'title' => 'Редактирование страницы'
        ]);

    }

    public function update(Request $request, Page $page)
    {

        $validationData = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'page_type_id' => 'present',

            'urn' => 'required',

            'introtext' => 'present',
            'content' => 'present',

            'title' => ['required', 'string', 'max:70'],
            'description' => ['required', 'string', 'max:160'],
            'keywords' => 'present',

            'category' => 'present',
            'parent_id' => 'present',

            'active' => 'present',

        ]);

        $page->update($validationData);
        $page->contentSet->update($validationData);
        $page->seoSet->update($validationData);


        $isCategory = Page::select('categories.id')
            ->leftJoin('categories', 'pages.id', '=', 'categories.page_id')
            ->where('pages.id', '=', $page->id)
            ->first();
        if(!$validationData['category'] && $isCategory->id){
            $page->category->delete($validationData);
        }
        elseif ($validationData['category'] && !$isCategory->id) {
            $validationData['page_id'] = $page->id;
            Category::create($validationData);
        }


        if($request->input('upload-images') == null && !$request->file()){
            $validationData['image'] = null;
            $page->image->update($validationData);
        }
        else {
            $validationData['image'] = ImageController::imageDataProcessing($request, $validationData['urn']);
            $page->image->update($validationData);
        }

        $validationData['params'] = ParametrSetController::ParametrDataProcessing($request);
        $page->parametrSet->update($validationData);

        if($page->parent_id > 0){
            return redirect()->route('page.edit', [$page->parent_id]);
        }
        return redirect()->route('page.edit', [$page->id]);

    }

    public function destroy(Page $page)
    {

        $page->contentSet->delete();
        $page->image->delete();
        $page->parametrSet->delete();
        $page->seoSet->delete();
        $page->slug->delete();

        $isCategory = Page::select('categories.id')
            ->leftJoin('categories', 'pages.id', '=', 'categories.page_id')
            ->where('pages.id', '=', $page->id)
            ->first();

        if($isCategory->id){
            $page->category->delete();
        }

        $page->delete();

        return redirect()->route('admin');
    }

}
