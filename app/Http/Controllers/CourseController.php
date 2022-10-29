<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class CourseController extends Controller
{
    /**
     * Index Function
     */
    public function Index()
    {
        // $courses = new Course();
        // $data = $courses->all();

        $courses = DB::table('courses')
            ->where('courses.status', 1)
            ->join('departments', 'departments.id', '=', 'courses.department_id')
            ->select('courses.*', 'departments.name as department_name', 'departments.id as department_id')
            ->get();

        $departments = DB::table('departments')
            ->where('departments.status', 1)
            ->select('departments.*')
            ->get();

        return view('admin.settings.courses', [
            'courses' => json_decode($courses, true),
            'departments' => json_decode($departments, true)
        ]);
    }

    /**
     * Add Course Function
     */
    public function addCourse(Request $request)
    {
        $course = new Course();
        if ($request->name) {

            $course->name = $request->name;
            $course->code = $request->code;
            $course->department_id = $request->department;
            $course->type = $request->type;
            $course->duration = $request->duration;
            $course->url = $this->slug($request->name);
            $course->status = 1;
            $course->save();

            Course::where('id', $course->id)
                ->update(['url' => $this->slug($request->name . '-' . $course->id)]);
        }

        // TODO : ADD FLASH
        return redirect()->route('courses.index');
    }

    /**
     * Edit Course Function
     */
    public function editCourse(Request $request)
    {
        $course_id = $request->id;
        $course_name = $request->name;

        if ($course_id) {

            $updateDetails = [
                'name' => $course_name,
                'code' => $request->code,
                'department_id' => $request->department,
                'type' => $request->type,
                'duration' => $request->duration,
                'url' => $this->slug($course_name . '-' . $course_name),
            ];

            DB::table('courses')
                ->where('id', $course_id)
                ->update($updateDetails);
        }

        // TODO : ADD FLASH
        return redirect()->route('courses.index');
    }

    /**
     * Remove Course Function
     */
    public function removeCourse(Request $request)
    {
        $course_id = $request->courseId;
        $status = 0;

        if ($course_id) {
            Course::where('id', $course_id)->delete();
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
