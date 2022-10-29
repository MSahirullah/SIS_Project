<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\ScholStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScholarshipController extends Controller
{
    /**
     * Index Function
     */
    public function Index()
    {
        $scholarships = new Scholarship();
        $data = $scholarships->all();

        return view('admin.settings.scholarships', ['scholarships' => $data]);
    }

    /**
     * Add Scholarships Function
     */
    public function addScholarships(Request $request)
    {
        $scholarship = new Scholarship();
        if ($request->name) {
            $scholarship->name = $request->name;
            $scholarship->type = $request->type;
            $scholarship->institution = $request->institution;
            $scholarship->amount = $request->amount;
            $scholarship->url = $this->slug($request->name . '-' . $scholarship->id);
            $scholarship->status = 1;
            $scholarship->save();

            Scholarship::where('id', $scholarship->id)
                ->update(['url' => $this->slug($request->name . '-' . $scholarship->id)]);
        }

        // TODO : ADD FLASH
        return redirect()->route('scholarships.index');
    }

    /**
     * Edit Scholarships Function
     */
    public function editScholarships(Request $request)
    {
        $scholarships_id = $request->id;
        $scholarships_name = $request->name;
        $scholarships_type = $request->type;
        $scholarships_institution = $request->institution;
        $scholarship_amount = $request->amount;

        if ($scholarships_id) {

            $updateDetails = [
                'name' => $scholarships_name,
                'url' => $this->slug($scholarships_name . '-' . $scholarships_id),
                'type' => $scholarships_type,
                'institution' => $scholarships_institution,
                'amount' => $scholarship_amount
            ];

            DB::table('scholarships')
                ->where('id', $scholarships_id)
                ->update($updateDetails);
        }

        // TODO : ADD FLASH
        return redirect()->route('scholarships.index');
    }

    /**
     * Remove Scholarships Function
     */
    public function removeScholarships(Request $request)
    {
        $scholarship_id = $request->scholarshipId;
        $status = 0;

        if ($scholarship_id) {
            Scholarship::where('id', $scholarship_id)->delete();
            $status = 1;
        }

        return $status;
    }


    /**
     * Scholarship Students Function
     */
    public function scholarshipStudents($scUrl)
    {
        $scholarship = Scholarship::whereUrl($scUrl)->first();

        if (!$scholarship) {
            return redirect()->route('scholarships.index');
        }

        $data = DB::table('schol_students')
            ->where('schol_students.scholarship_id', $scholarship['id'])
            ->join('users', 'users.id', '=', 'schol_students.student_id')
            ->select('schol_students.id', 'users.name_with_initial', 'schol_students.amount', 'schol_students.status')
            ->get();

        return view('admin.settings.scholarshipStudents', [
            'students' => json_decode($data, true),
            'scholarship' => $scholarship,
            'scUrl' => $scUrl
        ]);
    }

    /**
     * 
     */
    public function scholarshipAddStudents($scUrl, Request $request)
    {

        $student_email = $request->email;

        $scholarship = Scholarship::whereUrl($scUrl)->first();
        $student = User::whereEmail($student_email)->first();

        if ($scholarship and $student) {

            $scholarship_student = new ScholStudent();
            $scholarship_student->scholarship_id = $scholarship->toArray()['id'];
            $scholarship_student->student_id = $student->toArray()['id'];
            $scholarship_student->amount = $scholarship->toArray()['amount'];
            $scholarship_student->status = 1;
            $scholarship_student->save();
        }

        // TODO : ADD FLASH
        return redirect()->route('scholarships.students', ['scUrl' => $scUrl]);
    }

    /**
     * REMOVE SCHOLARSHIP STUDENT
     */
    public function scholarshipRemoveStudents($scUrl, Request $request)
    {
        $student_id = $request->studentId;
        $status = 0;

        if ($student_id) {
            ScholStudent::where('id', $student_id)->delete();
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
