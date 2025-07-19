<?php

namespace App\Http\Controllers;

use App\Models\BarangayID;
use App\Http\Requests\StoreBarangayIDRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BarangayIDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarangayIDRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangayID $barangayID)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangayID $barangayID)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the specific Barangay ID record
        $barangayID = BarangayID::findOrFail($id);

        // Validate input
        $inputs = $request->validate([
            'barangay_id' => ['required', 'max:255'],
        ]);

        // Update the Barangay ID
        $barangayID->update($inputs);

        // Find all users with the old Barangay ID and role 'resident'
        $users = User::where('barangay_id', $barangayID->id)
            ->where('role', 'resident')
            ->get();

        // Log out affected users by clearing their sessions
        foreach ($users as $user) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
            // redirect()->route('welcome')->with('success', 'Barangay ID updated successfully! Affected users have been logged out.');
        }

        return redirect()->route('barangayData')->with('success', 'Barangay ID updated! Affected users logged out.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangayID $barangayID)
    {
        //
    }
}
