<?php

namespace App\Http\Controllers;

use App\Product;
use App\Skill;
use Illuminate\Http\Request;

class SkillController extends ApiController
{
    public function index()
    {
        $skills = Skill::all()->take(10);
        return $this->successResponse(['skills' => $skills], 200);
    }

    public function store(Request $request)
    {
        info($request->all());

//        $request->validate([
//            'name' => 'required'
//        ]);
//
//        $requested_data = $request->only(['name']);
//
//        $product = Product::create($requested_data);
//
//        return $this->successResponse(['skills' => $product], 200);
    }

    public function getSkillList()
    {
        $keyword = trim(request('keyword'));

        if ($keyword) {
            $skills = Skill::where('name', 'like', '%' . $keyword . '%')
                ->select('name', 'id')
                ->take(15)->get()
                ->map(function ($item) {
                    return ['label' => $item->name, 'code' => $item->id];
                });

            return response()->json($skills);
        }

        return [];
    }
}
