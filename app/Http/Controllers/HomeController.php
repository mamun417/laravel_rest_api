<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $r = Product::with('category')
//            ->orderBy(Category::select('name')
//                ->whereColumn('categories.id', '=', 'products.category_id'))
//            ->get()
//            ->pluck('category.name', 'id');
//
//        $r = collect($r)->unique()->toArray();
//
//        $r1 = Product::query()
//            ->join('categories', 'products.category_id', '=', 'categories.id')
//            ->select(['products.*', 'categories.name as category_name'])
//            ->orderBy('categories.name')
//            ->pluck('category_name', 'id');
//
//        $r1 = collect($r1)->unique()->toArray();
//
//        dd($r, $r1);

        return view('home');
    }
}
