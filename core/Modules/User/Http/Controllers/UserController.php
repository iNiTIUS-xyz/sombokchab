<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdatePasswordRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\Wallet\Http\Services\WalletService;

class UserController extends Controller {
    public function all_user() {
        $all_user = User::all();
        $country = Country::select("id", "name")->orderBy("name", "ASC")->get();
        $states = State::where("country_id", 31)->orderBy("name", "ASC")->get();
        $cities = City::orderBy("name", "ASC")->get();
        return view('user::backend.all-user')->with(['all_user' => $all_user, 'country' => $country, 'states' => $states, 'cities' => $cities]);
    }
    public function user_password_change(UpdatePasswordRequest $request) {
        $user = User::findOrFail($request->ch_user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with([
            'message'    => __('Password changed Successfully.'),
            'alert-type' => 'success',
        ]);
    }
    public function user_update(UpdateUserRequest $request) {
        User::find($request->user_id)->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'city'    => $request->city,
            'state'   => $request->state,
            'country' => $request->country,
            'phone'   => $request->phone,
        ]);
        return redirect()->back()->with([
            'message'    => __('User profile updated successfully.'),
            'alert-type' => 'success',
        ]);
    }
    public function new_user_delete(Request $request, $id) {
        User::find($id)->delete();
        return redirect()->back()->with([
            'message'    => __('User profile deleted.'),
            'alert-type' => 'success',
        ]);
    }

    public function new_user() {
        $data = [
            "country" => Country::select("id", "name")->orderBy("name", "ASC")->get(),
            "states"  => State::where("country_id", 31)->orderBy("name", "ASC")->get(),
            "cities"  => City::orderBy("name", "ASC")->get(),
        ];

        return view('user::backend.add-new-user', with($data));
    }

    public function new_user_add(StoreUserRequest $request) {
        $user = User::create([
            'username' => $request->username,
            'name'     => $request->name,
            'email'    => $request->email,
            'address'  => $request->address,
            'zipcode'  => $request->zipcode,
            'city'     => $request->city,
            'state'    => $request->state,
            'country'  => $request->country,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // create wallet fot this user if module exists
        if (moduleExists("Wallet")) {
            WalletService::createWallet($user->id, "user");
        }

        return redirect()->back()->with([
            'message'    => __('New user created successfully.'),
            'alert-type' => 'success',
        ]);
    }

    public function bulk_action(Request $request) {
        $all = User::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function email_status(Request $request) {
        User::where('id', $request->user_id)->update([
            'email_verified' => $request->email_verified == 0 ? 1 : 0,
        ]);
        return redirect()->back()->with([
            'message'    => __('Email verification status changed.'),
            'alert-type' => 'success',
        ]);
    }
}
