<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YearController extends Controller
{
    /**
     * Index Function
     */
    public function Index()
    {
        $year = new Year();
        $data = $year->all();

        return view('admin.acadamicYears', ['years' => $data]);
    }

    /**
     * Add Year Function
     */
    public function addYear(Request $request)
    {
        $year = new Year();
        if ($request->name) {
            $year->name = $request->name;
            $year->url = $this->slug($request->name);
            $year->status = 1;
            $year->save();

            Year::where('id', $year->id)
                ->update(['url' => $this->slug($request->name . '-' . $year->id)]);
        }

        // TODO : ADD FLASH
        return redirect()->route('acadamic_years.index');
    }

    /**
     * Edit Year Function
     */
    public function editYear(Request $request)
    {
        $year_id = $request->yearId;
        $year_name = $request->name;

        if ($year_id) {

            $updateDetails = [
                'name' => $year_name,
                'url' => $this->slug($year_name . '-' . $year_id),
            ];

            $affected = DB::table('years')
                ->where('id', $year_id)
                ->update($updateDetails);
        }

        // TODO : ADD FLASH
        return redirect()->route('acadamic_years.index');
    }

    /**
     * Remove Year Function
     */
    public function removeYear(Request $request)
    {
        $year_id = $request->yearId;
        $status = 0;

        if ($year_id) {
            Year::where('id', $year_id)->delete();
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
