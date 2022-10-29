<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    /**
     * Index Function
     */
    public function Index()
    {
        $semesters = new Semester();
        $data = $semesters->all();

        return view('admin.settings.semesters', ['semesters' => $data]);
    }

    /**
     * Add Semester Function
     */
    public function addSemester(Request $request)
    {
        $semester = new Semester();
        if ($request->name) {
            $semester->name = $request->name;
            $semester->url = $this->slug($request->name);
            $semester->status = 1;
            $semester->save();

            Semester::where('id', $semester->id)
                ->update(['url' => $this->slug($request->name . '-' . $semester->id)]);
        }
        // TODO : ADD FLASH
        return redirect()->route('semesters.index');
    }

    /**
     * Edit Semester Function
     */
    public function editSemester(Request $request)
    {
        $semester_id = $request->id;
        $semester_name = $request->name;

        if ($semester_id) {

            $updateDetails = [
                'name' => $semester_name,
                'url' => $this->slug($semester_name . '-' . $semester_id),
            ];

            $affected = DB::table('semesters')
                ->where('id', $semester_id)
                ->update($updateDetails);
        }

        // TODO : ADD FLASH
        return redirect()->route('semesters.index');
    }

    /**
     * Remove Semester Function
     */
    public function removeSemester(Request $request)
    {
        $semester_id = $request->semesterId;
        if ($semester_id) {
            Semester::where('id', $semester_id)->delete();
        }

        return 1;
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
