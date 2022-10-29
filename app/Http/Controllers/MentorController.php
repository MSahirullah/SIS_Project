<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MentorController extends Controller
{
    /**
     * Index Function
     */
    public function Index()
    {
        $mentors = DB::table('mentors')
            ->where('mentors.status', 1)
            ->join('users', 'users.id', '=', 'mentors.lecturer_id')
            ->select('users.title', 'users.id as lecturer_id', 'users.name_with_initial', 'mentors.id', 'mentors.time', 'mentors.status', 'mentors.day', 'mentors.location')
            ->get();

        $mentorArray = json_decode($mentors, true);
        $tmp_array = [];

        foreach ($mentorArray as $arr) {
            $tmp_array[] = $arr['lecturer_id'];
        }

        $lecturers = DB::table('users')
            ->where('users.user_type', 4)
            ->select('users.id', 'users.title', 'users.name_with_initial', 'users.username', 'users.status')
            ->get();

        return view('admin.mentor.mentors', [
            'mentors' => json_decode($mentors, true),
            'lecturers' => json_decode($lecturers, true),
            'selectedLecturers' => $tmp_array,
        ]);
    }

    /**
     * ADD MENTOR
     */
    public function addMentor(Request $request)
    {
        $lecturer = $request->lecturer;
        $day = $request->day;
        $time = $request->time;
        $location = $request->location;


        $mentor = new Mentor();

        if ($request->lecturer) {
            $lecturerModal = User::whereId($lecturer)->first()->toArray();

            $mentor->lecturer_id = $lecturer;
            $mentor->day = $day;
            $mentor->time = $time;
            $mentor->location = $location;
            $mentor->url = $this->slug($request->name);
            $mentor->status = 1;
            $mentor->save();

            Mentor::where('id', $mentor->id)
                ->update(['url' => $this->slug('mentor' . '-' . $lecturerModal['full_name'] . '-' . $mentor->id)]);
        }

        // TODO : ADD FLASH
        return redirect()->route('mentors.index');
    }

    /**
     * EDIT MENTOR DETAILS
     */
    public function editMentor(Request $request)
    {

        $mentorId = $request->mentorId;
        $lecturer = $request->lecturer;
        $day = $request->day;
        $time = $request->time;
        $location = $request->location;

        if ($mentorId) {

            $lecturerModal = User::whereId($lecturer)->first()->toArray();

            $updateDetails = [
                'lecturer_id' => $lecturer,
                'day' => $day,
                'time' => $time,
                'location' => $location,
                'url' => $this->slug('mentor' . '-' . $lecturerModal['full_name'] . '-' . $mentorId)
            ];

            $affected = DB::table('mentors')
                ->where('id', $mentorId)
                ->update($updateDetails);
        }

        // TODO : ADD FLASH
        return redirect()->route('mentors.index');
    }

    /**
     * Remove Mentor
     */
    public function removeMentor(Request $request)
    {
        $mentorId = $request->mentorId;
        $status = 0;

        if ($mentorId) {
            Mentor::where('id', $mentorId)->delete();
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
