<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LecturerController extends Controller
{
    /**
     * Index Function
     */
    public function Index()
    {
        //////////////////////
        //    USER TYPES    //
        //////////////////////
        // 1 = ADMIN
        // 2 = DEAN OFFICE
        // 3 = STAFF
        // 4 = LECTURERS
        // 5 = STUDENTS
        //////////////////////

        $lecturers = DB::table('users')
            ->where('users.user_type', 4)
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->select('users.id', 'users.title', 'users.name_with_initial', 'departments.name as dep_name', 'users.username', 'users.status')
            ->get();

        return view('admin.lecturer.lecturers', [
            'lecturers' => json_decode($lecturers, true),
        ]);
    }

    /**
     * ADD LECTURER PAGE
     */
    public function addLecturer()
    {
        $departments = DB::table('departments')
            ->where('departments.status', 1)
            ->select('departments.*')
            ->get();

        return view('admin.lecturer.newLecturer', [
            'departments' => json_decode($departments, true)
        ]);
    }


     /**
     * SAVE NEW STUDENT DETAILS
     */
    public function saveLecturer(Request $request)
    {
        // LECTURER CRETE AND EDIT USES SAME ACTION
        // userId WILL ONLY AVALIBLE IN EDIT

        $userId = $request->userId;
        $title = $request->title;
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $nameWithInitial = $request->nameWithInitial;
        $fullName = $request->fullName;
        $gender = $request->gender;
        $department = $request->department;
        $year = $request->year;
        $course = $request->course;
        $semester = $request->semester;
        $email = $request->email;
        $nic = $request->nic;
        $address = $request->address;
        $homwtown = $request->hometown;
        $contactNo = $request->contactNo;
        $username =  $request->username;
        $password = $request->password;

        if ($userId) {

            $updateDetails = [
                'title' => $title,
                'name_with_initial' => $nameWithInitial,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'full_name' => $fullName,
                'gender' => $gender,
                'nic' => $nic,
                'user_type' => 4,
                'username' => $username,
                'password' => Hash::make($password),
                'address' => $address,
                'hometown' => $homwtown,
                'contact_no' => $contactNo,
                'email' => $email,
                'department_id' => $department,
                'course_id' => $course,
                'semester_id' => $semester,
                'year_id' => $year,
            ];

            DB::table('users')
                ->where('id', $userId)
                ->update($updateDetails);

        } else {

            $student = new User();
            $student->title = $title;
            $student->name_with_initial = $nameWithInitial;
            $student->first_name = $firstName;
            $student->last_name = $lastName;
            $student->full_name = $fullName;
            $student->gender = $gender;
            $student->nic = $nic;
            $student->user_type = 4; // 4 = LECTURER (OTHER TYPES ON THE TOP OF THE CODE)
            $student->username = $username;
            $student->password = Hash::make($password);
            $student->address = $address;
            $student->hometown = $homwtown;
            $student->contact_no = $contactNo;
            $student->email = $email;

            $student->department_id = $department;
            $student->course_id = $course;
            $student->semester_id = $semester;
            $student->year_id = $year;
            $student->status = 1;
            $student->save();
        }

        // TODO : ADD FALSH
        return redirect()->route('lecturers.index');
    }

    /**
     * EDIT LECTURER DETAILS
     */
    public function editLecturer($username)
    {
        $user = User::whereUsername($username)->first()->toArray();

        if (!$user) {
            return redirect()->route('lecturers.index');
        }

        $departments = DB::table('departments')
            ->where('departments.status', 1)
            ->select('departments.*')
            ->get();

        return view('admin.lecturer.editLecturer', [
            'departments' => json_decode($departments, true),
            'user' => $user
        ]);
    }

     /**
     * Remove Year Function
     */
    public function removeLecturer(Request $request)
    {
        $lecturer_id = $request->lecturerId;
        $status = 0;

        if ($lecturer_id) {
            User::where('id', $lecturer_id)->delete();
            $status = 1;
        }

        return $status;
    }

}
