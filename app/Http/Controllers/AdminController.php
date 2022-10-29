<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

        $admins = DB::table('users')
            ->where('users.user_type', 1)
            ->select('users.id', 'users.title', 'users.name_with_initial', 'users.username', 'users.status')
            ->get();

        return view('admin.admin.admins', [
            'admins' => json_decode($admins, true),
        ]);
    }

     /**
     * ADD ADMIN
     */
    public function addAdmin()
    {
        return view('admin.admin.newAdmin');
    }

    /**
     * EDIT ADMIN
     */
    public function editAdmin($username)
    {
        $user = User::whereUsername($username)->first()->toArray();

        if (!$user) {
            return redirect()->route('admins.index');
        }

        return view('admin.admin.editAdmin', [
            'user' => $user
        ]);
    }
}
