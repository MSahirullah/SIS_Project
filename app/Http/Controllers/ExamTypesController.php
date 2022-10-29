<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamTypesController extends Controller
{
    /**
     * Index Function
     */
    public function Index()
    {
        $examTypes = new ExamType();
        $data = $examTypes->all();

        return view('admin.settings.examTypes', ['examTypes' => $data]);
    }

    /**
     * Add Exam Types Function
     */
    public function addExamType(Request $request)
    {
        $examType = new ExamType();
        if ($request->name) {
            $examType->name = $request->name;
            $examType->url = $this->slug($request->name);
            $examType->status = 1;
            $examType->save();

            ExamType::where('id', $examType->id)
                ->update(['url' => $this->slug($request->name . '-' . $examType->id)]);
        }
        // TODO : ADD FLASH
        return redirect()->route('exam_types.index');
    }

    /**
     * Edit Exam Type Function
     */
    public function editExamType(Request $request)
    {
        $exam_type_id = $request->examTypeId;
        $exam_type_name = $request->name;

        if ($exam_type_id) {

            $updateDetails = [
                'name' => $exam_type_name,
                'url' => $this->slug($exam_type_name . '-' . $exam_type_id),
            ];

            $affected = DB::table('exam_types')
                ->where('id', $exam_type_id)
                ->update($updateDetails);
        }

        // TODO : ADD FLASH
        return redirect()->route('exam_types.index');
    }

    /**
     * Remove Exam Type Function
     */
    public function removeExamType(Request $request)
    {
        $exam_type_id = $request->examTypeId;
        $status = 0;

        if ($exam_type_id) {
            ExamType::where('id', $exam_type_id)->delete();
            $status = 1;
        }

        return $status;
    }

    /**
     * Slug Function
     */
    public static function slug($text)
    {
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = str_replace(' ', '-', $text);
        // remove duplicate -
        $text = str_replace(',', '-', $text);
        // remove duplicate 
        $text = str_replace('/', '-', $text);
        $text = str_replace('--', '-', $text);
        $text = str_replace('---', '-', $text);
        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
