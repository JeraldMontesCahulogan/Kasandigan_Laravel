<?php

namespace App\Http\Controllers;

use App\Models\ComplaintLocation;
use App\Http\Requests\StoreComplaintLocationRequest;
use App\Http\Requests\UpdateComplaintLocationRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ComplaintLocationController extends Controller
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
    public function store(Request $request)
    {
        // Validate input
        $inputs = $request->validate([
            'complaintLocation_name' => ['required', 'max:255'],
        ]);

        // Create a new complaint location
        ComplaintLocation::create($inputs);

        return redirect()->route('barangayData')->with('success', 'Complaint location created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplaintLocation $complaintLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplaintLocation $complaintLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplaintLocation $complaintLocation)
    {

        // Validate input
        $inputs = $request->validate([
            'complaintLocation_name' => ['required', 'max:255'],
        ]);

        // Update the complaint location
        $complaintLocation->update($inputs);

        return redirect()->route('barangayData')->with('success', 'Complaint location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplaintLocation $complaintLocation)
    {
        try {
            $complaintLocation->delete();
            return redirect()->route('barangayData')->with('success', 'Complaint location deleted successfully!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') { // MySQL foreign key constraint violation
                return redirect()->route('barangayData')->with('error', 'Cannot delete: Location in use.');
            }

            // Optional: rethrow if it's a different type of error
            throw $e;
        }
    }
}
