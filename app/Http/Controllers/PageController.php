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

        $page = Page::join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('content_sets', 'pages.id','=','content_sets.page_id')
            ->join('images', 'pages.id','=','images.page_id')
            ->join('parametr_sets', 'pages.id','=','parametr_sets.page_id')
            ->select('*')
            ->first();

        return view('index', [
            'name' => $page->name,
            'title' => $page->title,
            'description' => $page->description,
            'introtext' => $page->introtext,
            'urn' => $page->urn,
            'keywords' => $page->keywords,
            'content' => $page->content,
        ]);

    }

    public function page($slug)
    {

        $page = Page::join('slugs','pages.id','=','slugs.page_id')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('content_sets', 'pages.id','=','content_sets.page_id')
            ->join('images', 'pages.id','=','images.page_id')
            ->join('parametr_sets', 'pages.id','=','parametr_sets.page_id')
            ->leftJoin('categories', 'pages.id', '=', 'categories.page_id')
            ->select('*','categories.id as category_id')
            ->where('urn', $slug)
            ->first();

        if($page == null) return abort(404);

        $data = [
            'name' => $page->name,
            'title' => $page->title,
            'description' => $page->description,
            'introtext' => $page->introtext,
            'urn' => $page->urn,
            'keywords' => $page->keywords,
            'content' => $page->content,
            'params' => $page->params,
        ];

        if($page->image){
            $images = json_decode($page->image);
            $data['images'] = (array)$images;
        }

        if($page->params){
            $params = json_decode($page->params);
            $data['params'] = (array)$params;
        }

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

        //получение всего
        $pages = Page::select('pages.id', 'pages.name')
            ->orderBy('pages.id', 'ASC')
            ->get();

        $categories = Category::select('*')
            ->join('pages', 'categories.page_id', '=', 'pages.id')
            ->get();

        $pageTypes = PageType::all();

        return view('admin.index', [
            'createNew' => true,
            'pages' => $pages,
            'menuPages' => $menuPages,
            'categories' => $categories,
            'pageTypes' => $pageTypes,
            'title' => 'Создание страницы'
        ]);
    }

    public function store(Request $request)
    {

        $validationData = $request->validate([
            'name' => ['required','string','max:50'],
            'page_type_id' => 'present',

            'urn' => ['required', 'string', 'unique:slugs,urn'],

            'introtext' => 'present',
            'content' => 'present',

            'title' => ['required','string','max:70'],
            'description' => ['required', 'string', 'max:160'],
            'keywords' => 'present',

            'category' => 'present',
            'parent_id' => 'present',

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
        return redirect(route('admin'));
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

        $pages = Page::select('pages.id', 'pages.name')
            ->where('parent_id', '=', $page->id)
            ->orderBy('pages.id', 'ASC')
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
            'name' => ['required', 'string', 'max:50'],
            'page_type_id' => 'present',

            'urn' => 'required',

            'introtext' => 'present',
            'content' => 'present',

            'title' => ['required', 'string', 'max:70'],
            'description' => ['required', 'string', 'max:160'],
            'keywords' => 'present',

            'category' => 'present',
            'parent_id' => 'present',

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
