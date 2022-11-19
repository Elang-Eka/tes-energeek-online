<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function createJob(Request $request): JsonResponse
    {
        $validateJob = [
            'name' => 'required',
        ];
        $messageError = [
            'required' => 'kolom harus diisi',
        ];
        
        $validator = Validator::make($request->all(), $validateJob, $messageError);
        if ($validator->fails()) {
            return response()->json(['status' => 'failed','message' => $validator->messages()]);
        }

        $name = $request->input('name');
        $created_by = 1;
        $dataJob = Job::create(['name' => $name, 'created_by' => $created_by]);
    
        if ($dataJob) {
            $status = 'success';
            $statusCode = 201;
            return response()->json([
                'status' => $status,'data' => $dataJob,
            ],
            $statusCode
        );
        } else {
            $status = 'failed';
            $statusCode = 400;
            return response()->json([
                'status' => $status,'data' => $dataJob,
            ],
            $statusCode
        );
        }
        
        
    }   

    public function getJob(): JsonResponse
    {
        $dataJob = Job::all();

        if ($dataJob) {
            $status = "success";
            $statusCode = 200;
            return response()->json([
                'status' => $status,'data' => $dataJob,
            ],
            $statusCode
        );
        } else {
            $status = "failed";
            $statusCode = 404;
            return response()->json([
                'status' => $status,'data' => $dataJob,
            ],
            $statusCode
        );
        }        
    }
}
