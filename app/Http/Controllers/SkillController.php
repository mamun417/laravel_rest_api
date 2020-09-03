<?php

namespace App\Http\Controllers;

use App\Product;
use App\Skill;
use Illuminate\Http\Request;

class SkillController extends ApiController
{
    public function index()
    {
        $skills = Skill::latest()->get()->take(5);
        return $this->successResponse(['skills' => $skills], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|max:25|distinct|unique:skills,name'
        ], [
            'name.*.required' => 'The field is required.',
            'name.*.max' => 'The field may not be greater than 25 characters.',
            'name.*.distinct' => 'The field has a duplicate value.',
            'name.*.unique' => 'The name has already exits.',
        ]);

        $requested_data = $request->only(['name']);

        foreach ($requested_data['name'] as $name) {
            Skill::firstOrCreate(['name' => $name]);
        }

        return $this->successResponse(['skills' => []], 200);
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

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return $this->successResponse(['skill' => $skill], 200);
    }
}
