<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job_title;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'job_title_name' => 'required|string|max:70|unique:job_titles,job_title_name'
        ], [
            'job_title_name.required' => 'الاسم مطلوب!',
            'job_title_name.max' => 'لقد تجاوزت العدد المسموح به من عدد الحروف!',
            'job_title_name.unique' => 'المسمى الوظيفي مكرر!'
        ]);

        $jobTitle = Job_title::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إضافة اسم المسمى الوظيفي بنجاح',
            'data' => $jobTitle
        ], 201);
    }

    public function update(Request $request, string $job_titleHashed)
    {
        $jobTitleId = DecodeId($job_titleHashed);

        if (!$jobTitleId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $jobTitle = Job_title::findOrFail($jobTitleId);

        $newData = $request->validate([
            'job_title_name' => 'required|string|max:70|unique:job_titles,job_title_name,' . $jobTitle->id,
        ], [
            'job_title_name.required' => 'لا يمكن ترك هذه الخانة فارغة!',
            'job_title_name.max' => 'لقد تجاوزت عدد الأحرف المسموحة!',
            'job_title_name.unique' => 'المسمى الوظيفي مكرر!'
        ]);

        if (!$jobTitle->fill($newData)->isDirty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'لم تقم بأي تعديل!'
            ], 422);
        }

        $jobTitle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'تم التعديل بنجاح',
            'data' => $jobTitle
        ]);
    }

    public function destroy(string $job_titleHashed)
    {
        $jobTitleId = DecodeId($job_titleHashed);

        if (!$jobTitleId) {
            return response()->json([
                'status' => 'warning',
                'message' => 'معرف غير صالح'
            ], 404);
        }

        $jobTitle = Job_title::findOrFail($jobTitleId);

        if ($jobTitle->employees()->exists()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'يجب أن لا يكون هناك موظف مرتبط بهذا المسمى الوظيفي!'
            ], 400);
        }

        $jobTitle->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف المسمى الوظيفي بنجاح'
        ]);
    }
}
