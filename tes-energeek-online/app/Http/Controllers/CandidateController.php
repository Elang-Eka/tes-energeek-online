<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    public function createCandidate(Request $request): JsonResponse
    {
        $validateCandidate = [
            'name' => 'required',
            'email' => 'required|email:rfc|unique:candidates',
            'phone' => 'required|numeric|unique:candidates',
            'year' => 'required|numeric',
            'set_skills.*' => 'required|distinct',
            'job_id' => 'required'
        ];
        $messageError = [
            'required' => 'kolom harus diisi',
            'email' => 'email tidak valid',
            'unique' => 'data sudah ada',
            'numeric' => 'data yang diisi harus angka',
            'distinct' => 'data harus berbeda'
        ];
        $validator = Validator::make($request->all(),$validateCandidate,$messageError);
        if ($validator->fails()){
            return response()->json(['status' => 'failed','message'=>$validator->messages()]);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $year = $request->input('year');
        $job_id = $request->input('job_id');
        $skillCandidate = $request->input('set_skills.*');
        $created_by = 1;
        
        $data = Candidate::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'year' => $year,
            'job_id' => $job_id,
            'created_by' => $created_by,
        ]);

        $setSkill = Skill::find($skillCandidate);
        $data->Skill()->attach($setSkill);
        
        if ($data) {
            $status = 'success';
            $statusCode = 201;
        } else {
            $status = 'failed';
            $statusCode = 400;
        }

        $response = response()->json([
            'status' => $status,'data' => $data,
        ],
        $statusCode);

        return $response;
    }

    public function getCandidate(): JsonResponse
    {
        $dataCandidate = Candidate::all();

        if ($dataCandidate) {
            $status = "success";
            $statusCode = 200;
        } else {
            $status = "failed";
            $statusCode = 404;
        }

        $response = response()->json([
                'status' => $status,'data' => $dataCandidate,
            ],
            $statusCode
        );

        return $response;
    }
}

