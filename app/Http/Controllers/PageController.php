<?php

namespace App\Http\Controllers;

use App\Models\Advantage;
use App\Models\Category;
use App\Models\CompleteSolution;
use App\Models\Config;
use App\Models\ContentSet;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Page;
use App\Models\PageType;
use App\Models\ParametrSet;
use App\Models\RelatedPage;
use App\Models\SeoSet;
use App\Models\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IntrotextController;
use App\Http\Controllers\CompleteSolutionController;

class PageController extends Controller
{

    public function index()
    {

        $page = Page::find(1);

        $slides = Page::select('pages.*', 'seo_sets.title', 'content_sets.content', 'images.image as images', 'parametr_sets.params')
            ->leftJoin('content_sets', 'pages.id', '=', 'content_sets.page_id')
            ->leftJoin('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->leftjoin('parametr_sets', 'pages.id','=','parametr_sets.page_id')
            ->join('images', 'pages.id','=','images.page_id')
            ->where('parent_id', 67)
            ->where('active', 1)
            ->limit(3)
            ->orderBy('pages.updated_at', 'asc')
            ->get();

        $offers = Page::select('*')
            ->leftJoin('offers', 'pages.id', '=', 'offers.page_id')
            ->leftJoin('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->leftJoin('slugs', 'pages.id', '=', 'slugs.page_id')
            ->leftJoin('images', 'pages.id', '=', 'images.page_id')
            ->whereNotNull('offer_category_id')
            ->limit(12)
            ->inRandomOrder()
            ->get();

        $specialOffer = Page::select('*')
            ->leftJoin('offers', 'pages.id', '=', 'offers.page_id')
            ->leftJoin('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->leftJoin('content_sets', 'pages.id', '=', 'content_sets.page_id')
            ->leftJoin('slugs', 'pages.id', '=', 'slugs.page_id')
            ->leftJoin('images', 'pages.id', '=', 'images.page_id')
            ->whereNotNull('offer_category_id')
            ->inRandomOrder()
            ->first();
        if(isset($specialOffer)){
            if(isset($specialOffer->introtext)){
                $specialOffer->introtext = IntrotextController::generateIntro($specialOffer->introtext, 2);
            } else {
                $specialOffer->introtext = IntrotextController::generateIntro(DB::table('configs')->where('name', 'defaultIntro')->value('value'), 1);
            }
        }

        $priorityNews = Page::select('pages.*', 'slugs.urn', 'seo_sets.title', 'content_sets.introtext')
            ->leftJoin('content_sets', 'pages.id', '=', 'content_sets.page_id')
            ->leftJoin('slugs', 'pages.id', '=', 'slugs.page_id')
            ->leftJoin('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->leftjoin('parametr_sets', 'pages.id','=','parametr_sets.page_id')
            ->where('parent_id', 10)
            ->where('active', 1)
            ->whereNotNull('parametr_sets.params')
            ->orderBy('pages.updated_at', 'desc')
            ->first();

        $news = Page::select('pages.*', 'slugs.urn', 'seo_sets.title', 'content_sets.introtext')
            ->leftJoin('content_sets', 'pages.id', '=', 'content_sets.page_id')
            ->leftJoin('slugs', 'pages.id', '=', 'slugs.page_id')
            ->leftJoin('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->leftjoin('parametr_sets', 'pages.id','=','parametr_sets.page_id')
            ->where('parent_id', 10)
            ->where('active', 1)
            ->whereNull('parametr_sets.params')
            ->limit(2)
            ->orderBy('pages.updated_at', 'asc')
            ->get();

        $categories = Page::join('slugs', 'pages.id','=','slugs.page_id')
            ->join('images', 'pages.id','=','images.page_id')
            ->join('categories', 'pages.id', '=', 'categories.page_id')
            ->select('pages.*', 'slugs.urn', 'images.image as images')
            ->whereIn('pages.id', [34,18,42,41,40,39,38,26,23,13,14,15])
            ->where('active', 1)
            ->orderBy('pages.created_at', 'asc')
            ->get();

        foreach ($categories as $category){
            $category['images'] = json_decode($category->images, true);
        }

        return view('index', [
            'id' => $page->id,
            'parent_id' => $page->parent_id,
            'name' => $page->name,
            'title' => $page->seoset->title,
            'description' => $page->seoset->description,
            'keywords' => $page->seoset->keywords,
            'content' => $page->contentset->content,
            'introtext' => IntrotextController::generateIntro($page->contentset->introtext, 2),
            'urn' => $page->slug->urn,
            'offers' => $offers,
            'specialOffer' => $specialOffer,
            'categories' => $categories,
            'advantages' => json_decode($page->advantage->advantages, true),
            'priorityNews' => $priorityNews,
            'news' => $news,
            'slides' => $slides,
        ]);

    }

    public function page($slug)
    {

        $page = DB::table('pages')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->join('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->join('content_sets', 'pages.id', '=', 'content_sets.page_id')
            ->join('parametr_sets', 'pages.id', '=', 'parametr_sets.page_id')
            ->join('images', 'pages.id', '=', 'images.page_id')
            ->leftJoin('complete_solutions', 'pages.id', '=', 'complete_solutions.page_id')
            ->leftJoin('advantages', 'pages.id', '=', 'advantages.page_id')
            ->leftJoin('categories', 'pages.id', '=', 'categories.page_id')
            ->leftJoin('related_pages', 'pages.id', '=', 'related_pages.page_id')
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
                'complete_solutions.solution_text',
                'complete_solutions.solution_image',
                'advantages.advantages',
                'related_pages.related_page_id',
                'related_pages.related_page_text',
                )
            ->first();

        if ($page == null) return abort(404);

        $data = [
            'id' => $page->id,
            'parent_id' => $page->parent_id,
            'name' => $page->name,
            'title' => $page->title,
            'description' => $page->description,
            'introtext' => IntrotextController::generateIntro($page->introtext, 2),
            'urn' => $page->urn,
            'keywords' => $page->keywords,
            'content' => $page->content,
            'params' => json_decode($page->params, true),
            'images' => json_decode($page->image, true),
            'solution_text' => IntrotextController::generateIntro($page->solution_text, 2),
            'solution_image' => $page->solution_image,
            'advantages' => json_decode($page->advantages, true),
        ];

        $data['menuItems'] = MenuController::generateMenu();

        $relatedPage = Page::where('id', $page->related_page_id)
            ->first();
        if ($relatedPage !== null) {
            $data['related_page_text'] = IntrotextController::generateIntro($page->related_page_text, 2);
            $data['related_page_name'] = $relatedPage->name;
            $data['related_page_images'] = json_decode($relatedPage->image->image, true);
            $data['related_page_urn'] = $relatedPage->slug->urn;
        }

        $specialOffer = Page::select('*')
            ->leftJoin('offers', 'pages.id', '=', 'offers.page_id')
            ->leftJoin('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->leftJoin('content_sets', 'pages.id', '=', 'content_sets.page_id')
            ->leftJoin('slugs', 'pages.id', '=', 'slugs.page_id')
            ->leftJoin('images', 'pages.id', '=', 'images.page_id')
            ->where('offer_category_id', $page->parent_id)
            ->orWhere('offer_category_id', $page->id)
            ->inRandomOrder()
            ->first();

        if (isset($specialOffer)) {
            if (isset($specialOffer->introtext)) {
                $specialOffer->introtext = IntrotextController::generateIntro($specialOffer->introtext, 2);
            } else {
                $specialOffer->introtext = IntrotextController::generateIntro(DB::table('configs')->where('name', 'defaultIntro')->value('value'), 1);
            }
            $data['specialOffer'] = $specialOffer;
        }

        $data['categories'] = Page::join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->join('images', 'pages.id', '=', 'images.page_id')
            ->join('categories', 'pages.id', '=', 'categories.page_id')
            ->select('pages.*', 'slugs.urn', 'images.image as images')
            ->where('parent_id', $page->id)
            ->where('active', 1)
            ->orderBy('pages.created_at', 'asc')
            ->get();
        if (!isset($data['categories'][0])) {
            $data['categories'] = null;
        } else {
            foreach ($data['categories'] as $category) {
                $category['images'] = json_decode($category->images, true);
            }
        }

        $data['products'] = Page::join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->join('images', 'pages.id', '=', 'images.page_id')
            ->join('parametr_sets', 'pages.id', '=', 'parametr_sets.page_id')
            ->join('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->select('pages.*', 'slugs.urn', 'seo_sets.title', 'images.image as images', 'parametr_sets.params as params')
            ->where('parent_id', $page->id)
            ->where('page_type_id', 2)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();

        if (!isset($data['products'][0])) {
            $data['products'] = null;
        } else {
            foreach ($data['products'] as $product) {
                $product['images'] = json_decode($product->images, true);
                $product['params'] = json_decode($product->params, true);
            }
        }

        if($page->id == 10 || $page->id == 11 || $page->id == 55) {
            $data['pages'] = Page::select('pages.*', 'slugs.urn', 'seo_sets.title', 'content_sets.introtext', 'images.image as images')
                ->leftJoin('content_sets', 'pages.id', '=', 'content_sets.page_id')
                ->leftJoin('slugs', 'pages.id', '=', 'slugs.page_id')
                ->leftJoin('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
                ->leftJoin('images', 'pages.id', '=', 'images.page_id')
                ->where('parent_id', $page->id)
                ->where('active', 1)
                ->orderBy('pages.created_at', 'desc')
                ->simplePaginate(12);
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

            'solution_text' => 'nullable',
            'solution_image' => 'nullable',

            'related_page_id' => 'nullable',
            'related_page_text' => 'nullable',

            'offer_category_id' => 'nullable',
            'offer_price' => 'nullable',

        ]);

        if($request->file()) {
            if($request->input('watermark')){
                $validationData['image'] = ImageController::imageDataProcessing($request, $validationData['urn']);
            } else {
                $validationData['image'] = ImageController::imageDataProcessing($request, $validationData['urn'], false);
            }
        }
        if($request->input('solution_image') !== null && $request->file()){
            $validationData['solution_image'] = CompleteSolutionController::imageSolutionProcessing($request, $validationData['urn']);
        }

        $validationData['params'] = ParametrSetController::ParametrDataProcessing($request);
        $validationData['advantages'] = AdvantageController::AdvantageDataProcessing($request);

        try{
            $validationData['page_id'] = Page::create($validationData)->id;
            Slug::create($validationData);
            ContentSet::create($validationData);
            Image::create($validationData);
            ParametrSet::create($validationData);
            SeoSet::create($validationData);
            Advantage::create($validationData);
            RelatedPage::create($validationData);
            Offer::create($validationData);

            if($validationData['category']){
                Category::create($validationData);
                CompleteSolution::create($validationData);
            }
        }
        catch (QueryException $exception){
            return redirect(route('page.create'))->withErrors('Ошибки в форме');
        }

        return redirect()->route('page.edit', $validationData['page_id']);
    }

    public function edit(Page $page)
    {

//         наполнение null данными
//        $pages = Page::select('*')
//            ->get();
//        foreach ($pages as $item){
//            Offer::create([
//                'page_id' => $item->id,
//                'offer_category_id' => null,
//                'offer_rice' => null,
//            ]);
//        }
//        die;

        $menuPages = Page::select('*')
            ->where('parent_id', '=', '0')
            ->get();

        $images = json_decode($page->image->image, true);
        $params = json_decode($page->parametrSet->params, true);
        $advantages = json_decode($page->advantage->advantages, true);

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
            ->join('categories', 'pages.id', '=', 'categories.page_id')
            ->where('pages.id', '=', $page->id)
            ->exists();

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
            'solution' => $page->completeSolution,
            'advantages' => $advantages,
            'relatedPage' => $page->relatedPage,
            'offer' => $page->offer,
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

            'solution_text' => 'nullable',
            'solution_image' => 'nullable',

            'related_page_id' => 'nullable',
            'related_page_text' => 'nullable',

            'offer_category_id' => 'nullable',
            'offer_price' => 'nullable',

        ]);

        $validationData['page_id'] = $page->id;

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
            Category::create($validationData);
        }
        if($validationData['category']){
            if(!array_key_exists('solution_text', $validationData)) {
                $validationData['solution_text'] = null;
            }
            if($request->input('solution_image') == null && !$request->file()){
                $validationData['solution_image'] = null;
            }
            else {
                $validationData['solution_image'] = CompleteSolutionController::imageSolutionProcessing($request, $validationData['urn']);
            }
            CompleteSolution::updateOrCreate(
                ['page_id' => $page->id],
                ['solution_text' => $validationData['solution_text'], 'solution_image' => $validationData['solution_image']]
            );
        }

        if($request->input('upload-images') == null && !$request->file()){
            $validationData['image'] = null;
        }
        else {
            if($request->input('watermark')){
                $validationData['image'] = ImageController::imageDataProcessing($request, $validationData['urn']);
            } else {
                $validationData['image'] = ImageController::imageDataProcessing($request, $validationData['urn'], false);
            }
        }
        $page->image->update($validationData);

        $validationData['params'] = ParametrSetController::ParametrDataProcessing($request);
        $page->parametrSet->update($validationData);

        $validationData['advantages'] = AdvantageController::AdvantageDataProcessing($request);
        $page->advantage->update($validationData);

        $page->relatedPage->update($validationData);
        $page->offer->update($validationData);

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
        $page->advantage->delete();
        $page->relatedPage->delete();
        $page->offer->delete();

        $isCategory = Page::select('categories.id')
            ->leftJoin('categories', 'pages.id', '=', 'categories.page_id')
            ->where('pages.id', '=', $page->id)
            ->first();

        if($page->completeSolution !== null){
            $page->completeSolution->delete();
        }

        if($isCategory->id){
            $page->category->delete();
        }

        $page->delete();

        return redirect()->route('admin');
    }

}
