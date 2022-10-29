<?php

namespace App\Http\Controllers;

use App\Models\ScholStudent;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
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

    /**
     * SAVE NEW USER DETAILS
     */
    public function saveUser(Request $request)
    {
        // USER CRETE AND EDIT USES SAME ACTION
        // userId WILL ONLY AVALIBLE IN EDIT

        $userId = $request->userId;
        $userType = $request->userType;

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
                'user_type' => $userType,
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
            $student->user_type = $userType; // (TYPES ON THE TOP OF THE CODE)
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

        $route = 'students.index';

        if ($userType == 4) {
            $route = 'lecturers.index';
        }

        if ($userType == 3) {
            $route = 'staffMembers.index';
        }

        if ($userType == 2) {
            $route = 'deans.index';
        }

        if ($userType == 1) {
            $route = 'admins.index';
        }


        // TODO : ADD FALSH
        return redirect()->route($route);
    }


    /**
     * Remove Year Function
     */
    public function removeUser(Request $request)
    {
        $userId = $request->userId;
        $status = 0;

        if ($userId) {
            User::where('id', $userId)->delete();
            $status = 1;
        }

        return $status;
    }

    /**
     * CHECK USER STATUS
     */
    public function checkUserStatus(Request $request)
    {

        $username = $request->username;
        $email = $request->email;
        $uid = $request->uid;
        $avalibility = $request->avalibility;
        $status = 0;

        if ($avalibility) {
            $emailCheck = User::whereEmail($email)->first();
            $scholStatus = 0;

            if ($emailCheck) {

                $scholStudent = ScholStudent::whereStudent_id($emailCheck->toArray()['id'])->first();

                if ($scholStudent) {
                    $scholStatus = 1;
                } else {
                    $scholStatus = 2;
                }
            } else {
                $scholStatus = 3;
            }

            return $scholStatus;
        }

        if ($username) {
            $usernameCheck = User::whereUsername($username)->first();
            if ($usernameCheck) {
                if ($usernameCheck->toArray()['id'] != $uid) {
                    $status = 1;
                }
            }
        }

        if ($email) {
            $emailCheck = User::whereEmail($email)->first();
            if ($emailCheck) {
                if ($emailCheck->toArray()['id'] != $uid) {
                    $status = 1;
                }
            }
        }

        return $status;
    }
}
