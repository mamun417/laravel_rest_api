<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
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
