<?php

namespace Modules\CountryManage\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:admin");
    }

    public function all_city(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'country' => 'required',
                'state' => 'required',
                'city' => 'required|unique:cities,name|max:191',
            ]);

            City::create([
                'name' => $request->city,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'status' => $request->status,
            ]);

            return back()->with(['msg' => __('City created successfully.'), 'type' => 'success',]);
        }

        $all_countries = Country::get();
        $all_states = State::get();
        $all_cities = City::with("state", "country")->latest()->get();

        return view('countrymanage::city.all-city', compact('all_states', 'all_countries', 'all_cities'));
    }

    public function edit_city(Request $request)
    {
        $request->validate([
            'city' => 'required|max:191|unique:cities,name,' . $request->city_id,
            'country' => 'required',
            'state' => 'nullable',
        ]);


        City::where('id', $request->city_id)
            ->update([
                'name' => $request->city,
                'state_id' => $request->state,
                'country_id' => $request->country,
                // 'status' => $request->status,
            ]);

        return back()->with([
            'msg' => __('City updated successfully.'),
            'type' => 'success',
        ]);

    }

    public function city_status($id)
    {
        $city = City::select('status')->where('id', $id)->first();
        $city->status == 'publish' ? $status = 'draft' : $status = 'publish';
        City::where('id', $id)->update(['status' => $status]);

        return back()->with([
            'msg' => __('City status changed successfully.'),
            'type' => 'success',
        ]);

    }

    public function statusUpdate(Request $request, $id)
    {
        $updated = City::findOrFail($request->id)->update([
            'status' => $request->status,
        ]);

        return $updated
            ? back()->with(['msg' => __('City status changed successfully.'), 'type' => 'success'])
            : back()->with(['msg' => __('Something went wrong. Please try again.'), 'type' => 'error']);
    }

    public function delete_city($id)
    {
        City::find($id)->delete();

        return back()->with([
            'msg' => __('City deleted successfully.'),
            'type' => 'success',
        ]);

    }

    public function bulk_action_city(Request $request)
    {
        City::whereIn('id', $request->ids)->delete();

        return back()->with([
            'msg' => __('Selected city deleted successfully.'),
            'type' => 'success',
        ]);

    }

    public function import_settings()
    {
        return view('countrymanage::backend.import-city');
    }

    public function update_import_settings(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:150000'
        ]);

        // work on file mapping
        if ($request->hasFile('csv_file')) {
            $file = $request->csv_file;
            $extenstion = $file->getClientOriginalExtension();
            if ($extenstion == 'csv') {
                //copy file to temp folder

                $old_file = Session::get('import_csv_file_name');
                if (file_exists('assets/uploads/import/' . $old_file)) {
                    @unlink('assets/uploads/import/' . $old_file);
                }
                $file_name_with_ext = $file->getClientOriginalName();

                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_tmp_name = $file_name . time() . '.' . $extenstion;
                $file->move('assets/uploads/import', $file_tmp_name);

                $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));
                $csv_data = array_slice($data, 0, 1);

                Session::put('import_csv_file_name', $file_tmp_name);
                return view('countrymanage::backend.import-city', [
                    'import_data' => $csv_data,
                ]);
            }

        }

        return back()->with([
            'msg' => __('something went wrong try again!'),
            'type' => 'success',
        ]);
    }

    public function import_to_database_settings(Request $request)
    {
        $request->validate([
            'city' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $file_tmp_name = Session::get('import_csv_file_name');
        $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));

        $csv_data = current(array_slice($data, 0, 1));
        $csv_data = array_map(function ($item) {
            return trim($item);
        }, $csv_data);

        $imported_cities = 0;
        $x = 0;
        $city = array_search($request->city, $csv_data, true);

        foreach ($data as $index => $item) {
            if ($x == 0) {
                $x++;
                continue;
            }
            if ($index === 0) {
                continue;
            }
            if (empty($item[$city])) {
                continue;
            }

            $find_city = City::where('name', $item[$city])
                ->where('country_id', $request->country_id)
                ->where('state_id', $request->state_id)
                ->count();

            if ($find_city < 1) {
                $city_data = [
                    'name' => $item[$city] ?? '',
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'status' => $request->status,
                ];
            }
            if ($find_city < 1) {
                City::create($city_data);
                $imported_cities++;
            }
        }

        return back()->route('admin.city.import.csv.settings')->with([
            'msg' => __('City imported successfully.'),
            'type' => 'success',
        ]);

    }

    function pagination(Request $request)
    {
        if ($request->ajax()) {
            $all_cities = City::with("state", "country")
                ->latest()
                ->paginate(10);

            return view('countrymanage::city.search-result', compact('all_cities'))->render();
        }
    }

    public function search_city(Request $request)
    {
        $all_cities = City::with("state", "country")
            ->where('name', 'LIKE', "%" . strip_tags($request->string_search) . "%")
            ->paginate(10);
        if ($all_cities->total() >= 1) {
            return view('countrymanage::city.search-result', compact('all_cities'))->render();
        } else {
            return response()->json([
                'status' => __('nothing')
            ]);
        }
    }

}
