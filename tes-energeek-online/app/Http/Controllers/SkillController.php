<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    public function createSkill(Request $request): JsonResponse
    {
        $validateSkill = [
            'name' => 'required',
        ];
        $messageError = [
            'required' => 'kolom harus diisi',
        ];
        
        $validator = Validator::make($request->all(), $validateSkill, $messageError);
        if ($validator->fails()) {
            return response()->json(['status' => 'failed','message' => $validator->messages()]);
        }

        $name = $request->input('name');
        $created_by = 1;
        $dataSkill = Skill::create(['name' => $name, 'created_by' => $created_by]);
    
        if ($dataSkill) {
            $status = 'success';
            $statusCode = 201;
        } else {
            $status = 'failed';
            $statusCode = 400;
        }

        return response()->json([
                'status' => $status,'data' => $dataSkill,
            ],
            $statusCode
        );
    }

    public function getSkill(Request $request): JsonResponse
    {
        $dataSkill = Skill::all();
        
        if ($dataSkill) {
            $status = "success";
            $statusCode = 200;
        } else {
            $status = "failed";
            $statusCode = 404;
        }

        return response()->json([
                'status' => $status,'data' => $dataSkill,
            ],
            $statusCode
        );
    }
}
