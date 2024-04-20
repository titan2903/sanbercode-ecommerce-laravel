<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\UserAddress;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        // Get the authenticated user with their address
        $user = Auth::user();
        $user->load('userAddress');

        // Check if the user exists
        if (!$user) {
            // You can redirect the user to the login page or any other page
            return redirect('/');
        }

        // Return the user data
        return view('pages.user.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Fetch the user data along with their address
        $dataUser = User::with('userAddress')->findOrFail($user->id);
    
        // Pass the user data to the view for editing
        return view('pages.user.edit', compact('dataUser'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|email|unique:users,email,'.$id,
            'address' => 'required',
            'postal_code' => 'required|max:10',
            'state' => 'required|max:255|string',
        ]);
    
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->update();
    
        // Retrieve the user's address
        $userAddress = UserAddress::where('user_id', $user->id)->first();
        // Update the user's address fields
        $userAddress->state = $request['state'];
        $userAddress->address = $request['address'];
        $userAddress->postal_code = $request['postal_code'];
        // Save the changes to the user's address
        $userAddress->save();
    
        return redirect('/profile')->with('success', 'Profile updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
