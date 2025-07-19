<?php

namespace App\Http\Controllers;

use App\Models\ComplaintCategory;
use App\Http\Requests\StoreComplaintCategoryRequest;
use App\Http\Requests\UpdateComplaintCategoryRequest;
use App\Models\BarangayID;
use App\Models\ComplaintLocation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ComplaintCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaintsCategory = ComplaintCategory::all();
        $complaintsLocation = ComplaintLocation::all();
        $barangayID = BarangayID::all();
        // dd($complaintsCategory);
        return view('pages.barangayData', ['complaintsCategory' => $complaintsCategory, 'complaintsLocation' => $complaintsLocation, 'barangayID' => $barangayID]);
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
            'complaintCategory_name' => ['required', 'max:255'],
        ]);

        // Create a new complaint category
        ComplaintCategory::create($inputs);

        return redirect()->route('barangayData')->with('success', 'Complaint category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplaintCategory $complaintCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplaintCategory $complaintCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplaintCategory $complaintCategory)
    {

        // Validate input
        $inputs = $request->validate([
            'complaintCategory_name' => ['required', 'max:255'],
        ]);

        // Update the complaint category
        $complaintCategory->update($inputs);

        return redirect()->route('barangayData')->with('success', 'Complaint category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplaintCategory $complaintCategory)
    {
        try {
            $complaintCategory->delete();
            return redirect()->route('barangayData')->with('success', 'Complaint category deleted successfully!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') { // MySQL foreign key constraint violation
                return redirect()->route('barangayData')->with('error', 'Cannot delete: Category in use');
            }

            // Optional: rethrow if it's a different kind of error
            throw $e;
        }
    }
}
