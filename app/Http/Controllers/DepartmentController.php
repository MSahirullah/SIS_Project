<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Index Function
     */
    public function Index()
    {
        $departments = new Department();
        $data = $departments->all();

        return view('admin.settings.departments', ['departments' => $data]);
    }

    /**
     * Add Department Function
     */
    public function addDepartment(Request $request)
    {
        $department = new Department();
        if ($request->name) {
            $department->name = $request->name;
            $department->url = $this->slug($request->name);
            $department->status = 1;
            $department->save();

            Department::where('id', $department->id)
                ->update(['url' => $this->slug($request->name . '-' . $department->id)]);
        }

        // TODO : ADD FLASH
        return redirect()->route('departments.index');
    }

    /**
     * Edit Department Function
     */
    public function editDepartment(Request $request)
    {
        $department_id = $request->departmentId;
        $department_name = $request->name;

        if ($department_id) {

            $updateDetails = [
                'name' => $department_name,
                'url' => $this->slug($department_name . '-' . $department_id),
            ];

            $affected = DB::table('departments')
                ->where('id', $department_id)
                ->update($updateDetails);
        }

        // TODO : ADD FLASH
        return redirect()->route('departments.index');
    }

    /**
     * Remove Department Function
     */
    public function removeDepartment(Request $request)
    {
        $department_id = $request->departmentId;
        $status = 0;

        if ($department_id) {
            Department::where('id', $department_id)->delete();
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
