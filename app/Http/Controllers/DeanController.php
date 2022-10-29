<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeanController extends Controller
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

        $deans = DB::table('users')
            ->where('users.user_type', 2)
            ->select('users.id', 'users.title', 'users.name_with_initial', 'users.username', 'users.status')
            ->get();

        return view('admin.dean.deans', [
            'deans' => json_decode($deans, true),
        ]);
    }

     /**
     * ADD DEAN
     */
    public function addDean()
    {
        return view('admin.dean.newDean');
    }

    /**
     * EDIT DEAN
     */
    public function editDean($username)
    {
        $user = User::whereUsername($username)->first()->toArray();

        if (!$user) {
            return redirect()->route('deans.index');
        }

        return view('admin.dean.editDean', [
            'user' => $user
        ]);
    }
}
