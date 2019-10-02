<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\ProfileStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Show the user profile view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account.profile.index');
    }

    /**
     * Store user's profile details in storage.
     *
     * @param ProfileStoreRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileStoreRequest $request)
    {
        //update user
        $request->user()->update($request->except('password'));

        //redirect with success
        return back()->withSuccess('Profile updated successfully.');
    }
}
