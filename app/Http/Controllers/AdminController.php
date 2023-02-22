<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index(Request $request){
        $response = Gate::inspect('view-admin-part', [self::class]);
        if($response->denied()){
            abort($response->code(), $response->message());
        }

        $menuPages = Page::select('*')
            ->where('parent_id', '=', '0')
            ->get();

        return view('admin.index', [
            'title' => 'Панель управления',
            'menuPages' => $menuPages,
        ]);
    }
}
