<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
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

        $staffMembers = DB::table('users')
            ->where('users.user_type', 3)
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->select('users.id', 'users.title', 'users.name_with_initial', 'departments.name as dep_name', 'users.username', 'users.status')
            ->get();

        return view('admin.staffMember.staffMembers', [
            'staffMembers' => json_decode($staffMembers, true),
        ]);
    }

    /**
     * ADD STAFF MEMBER
     */
    public function addStaffMember()
    {
        $departments = DB::table('departments')
            ->where('departments.status', 1)
            ->select('departments.*')
            ->get();

        return view('admin.staffMember.newStaffMember', [
            'departments' => json_decode($departments, true)
        ]);
    }

    /**
     * EDIT STAFF MEMBERS 
     */
    public function editStaffMember($username)
    {
        $user = User::whereUsername($username)->first()->toArray();

        if (!$user) {
            return redirect()->route('staffMembers.index');
        }

        $departments = DB::table('departments')
            ->where('departments.status', 1)
            ->select('departments.*')
            ->get();

        return view('admin.staffMember.editStaffMember', [
            'departments' => json_decode($departments, true),
            'user' => $user
        ]);
    }

}
