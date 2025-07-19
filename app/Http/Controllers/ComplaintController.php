<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\ComplaintLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ Correct import
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'official' || Auth::user()->role === 'admin') {
            $complaintsThisMonth = Complaint::with('category')->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->get();
        } else {
            $complaintsThisMonth = Complaint::with('category')->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->where('user_id', Auth::id())->get();
        }

        // dd($complaintsThisMonth);

        $complaintsCategory = ComplaintCategory::all();
        $complaintsLocation = ComplaintLocation::all();
        // $complaintsToPaginate = Complaint::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
        //     ->orderByDesc('created_at')
        //     ->paginate(10);

        if (Auth::user()->role === 'official' || Auth::user()->role === 'admin') {
            $complaintsToPaginate = Complaint::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->orderByDesc('created_at')
                ->paginate(10);
        } else {
            $complaintsToPaginate = Complaint::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->paginate(10);
        }


        // ✅ Count complaints by status for the status pie chart
        $statuses = Complaint::whereIn('id', $complaintsThisMonth->pluck('id'))
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $labels = $statuses->keys()->toArray(); // Status labels
        $data = $statuses->values()->toArray(); // Status counts

        // ✅ Count complaints by category for the category bar chart
        $categories = Complaint::whereIn('id', $complaintsThisMonth->pluck('id'))
            ->selectRaw('complaintCategory_id, COUNT(*) as count')
            ->groupBy('complaintCategory_id')
            ->pluck('count', 'complaintCategory_id');

        // Convert category IDs to their names for better readability
        $categoryLabels = ComplaintCategory::whereIn('id', $categories->keys())->pluck('complaintCategory_name', 'id');
        $categoryData = $categories->values()->toArray();

        // Pass all data to the view
        return view('pages.dashboard', [
            'complaintsToPaginate' => $complaintsToPaginate,
            'complaints' => $complaintsThisMonth,
            'labels' => $labels,
            'data' => $data,
            'categoryLabels' => $categoryLabels->values()->toArray(), // Convert to array for the chart
            'categoryData' => $categoryData,
            'complaintsCategory' => $complaintsCategory,
            'complaintsLocation' => $complaintsLocation,
        ]);
    }


    public function allComplaints()
    {
        if (Auth::user()->role === 'official' || Auth::user()->role === 'admin') {
            $complaintsToDisplay = Complaint::with('category')->get();
        } else {
            $complaintsToDisplay = Complaint::with('category')->where('user_id', Auth::id())->get();
        }

        $complaintsCategory = ComplaintCategory::all();
        $complaintsLocation = ComplaintLocation::all();
        if (Auth::user()->role === 'official' || Auth::user()->role === 'admin') {
            $complaintsToPaginate = Complaint::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->orderByDesc('created_at')
                ->paginate(10);
        } else {
            $complaintsToPaginate = Complaint::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->paginate(10);
        }
        // $complaints = Complaint::latest()->paginate(10);

        if (Auth::user()->role === 'official' || Auth::user()->role === 'admin') {
            $complaints = Complaint::latest()->paginate(10);
        } else {
            $complaints = Complaint::where('user_id', Auth::id())->latest()->paginate(10);
        }

        // ✅ Count complaints by status for the status pie chart
        $statuses = Complaint::whereIn('id', $complaintsToDisplay->pluck('id'))
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $labels = $statuses->keys()->toArray(); // Status labels
        $data = $statuses->values()->toArray(); // Status counts

        // ✅ Count complaints by category for the category bar chart
        $categories = Complaint::whereIn('id', $complaintsToDisplay->pluck('id'))
            ->selectRaw('complaintCategory_id, COUNT(*) as count')
            ->groupBy('complaintCategory_id')
            ->pluck('count', 'complaintCategory_id');

        // Convert category IDs to their names for better readability
        $categoryLabels = ComplaintCategory::whereIn('id', $categories->keys())->pluck('complaintCategory_name', 'id');
        $categoryData = $categories->values()->toArray();

        // Pass all data to the view
        return view('pages.allComplaints', [
            'complaintsToDisplay' => $complaintsToDisplay,
            'complaints' => $complaints,
            'labels' => $labels,
            'data' => $data,
            'categoryLabels' => $categoryLabels->values()->toArray(), // Convert to array for the chart
            'categoryData' => $categoryData,
            'complaintsCategory' => $complaintsCategory,
            'complaintsLocation' => $complaintsLocation,
        ]);
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

        // dd($request->all());
        // Validate input, including file type and max size
        $inputs = $request->validate([
            'description' => ['required'],
            // 'location' => ['required', 'max:255'],
            'attachment' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Allow only images
        ]);

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName(); // Unique filename
            $filepath = $file->storeAs('attachments', $filename, 'public'); // Store in storage/app/public/attachments
            $inputs['attachment'] = $filepath; // Save the file path in DB
        }

        $user = Auth::user();

        // Create the complaint with the file path if uploaded
        Complaint::create([
            'user_id' => $user->id,
            'complaintCategory_id' => $request->category,
            'complaintLocation_id' => $request->location,
            'complainant' => $user->name,
            ...$inputs
        ]);

        return redirect()->route('landing')->with('success', 'Complaint submitted successfully!');
    }

    public function storeAllComplaint(Request $request)
    {

        // dd($request->all());
        // Validate input, including file type and max size
        $inputs = $request->validate([
            'description' => ['required'],
            // 'location' => ['required', 'max:255'],
            'attachment' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Allow only images
        ]);

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName(); // Unique filename
            $filepath = $file->storeAs('attachments', $filename, 'public'); // Store in storage/app/public/attachments
            $inputs['attachment'] = $filepath; // Save the file path in DB
        }

        $user = Auth::user();

        // Create the complaint with the file path if uploaded
        Complaint::create([
            'user_id' => $user->id,
            'complaintCategory_id' => $request->category,
            'complaintLocation_id' => $request->location,
            'complainant' => $user->name,
            ...$inputs
        ]);

        return redirect()->route('allComplaints')->with('success', 'Complaint submitted successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Complaint $complaint)
    {
        // Validate inputs
        $inputs = $request->validate([
            'complaintCategory_id' => ['required', 'exists:complaint_categories,id'], // Ensure it exists in the DB
            'complaintLocation_id' => ['required', 'exists:complaint_locations,id'], // Ensure it exists in the DB
            'description' => ['required'],
            'status' => [Auth::user()->role === 'official' ? 'required' : 'nullable', 'max:255'],
            'attachment' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate new image
        ]);

        // Handle file upload (if a new file is provided)
        if ($request->hasFile('attachment')) {
            // Delete old attachment if it exists
            if ($complaint->attachment) {
                Storage::disk('public')->delete($complaint->attachment);
            }

            // Store new file
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storeAs('attachments', $filename, 'public'); // Store in public storage
            $inputs['attachment'] = $filepath; // Save new file path in DB
        } else {
            // If no new file is uploaded, keep the existing attachment
            $inputs['attachment'] = $complaint->attachment;
        }

        // Update the complaint with category and location
        $complaint->update([
            'complaintCategory_id' => $inputs['complaintCategory_id'],
            'complaintLocation_id' => $inputs['complaintLocation_id'],
            'description' => $inputs['description'],
            'status' => $inputs['status'] ?? $complaint->status,
            'attachment' => $inputs['attachment'],
        ]);

        return redirect()->route('landing')->with('success', 'Complaint updated successfully!');
    }

    public function updateAllComplaint(Request $request, Complaint $complaint)
    {
        // Validate inputs
        $inputs = $request->validate([
            'complaintCategory_id' => ['required', 'exists:complaint_categories,id'], // Ensure it exists in the DB
            'complaintLocation_id' => ['required', 'exists:complaint_locations,id'], // Ensure it exists in the DB
            'description' => ['required'],
            'status' => [Auth::user()->role === 'official' ? 'required' : 'nullable', 'max:255'],
            'attachment' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate new image
        ]);

        // Handle file upload (if a new file is provided)
        if ($request->hasFile('attachment')) {
            // Delete old attachment if it exists
            if ($complaint->attachment) {
                Storage::disk('public')->delete($complaint->attachment);
            }

            // Store new file
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = $file->storeAs('attachments', $filename, 'public'); // Store in public storage
            $inputs['attachment'] = $filepath; // Save new file path in DB
        } else {
            // If no new file is uploaded, keep the existing attachment
            $inputs['attachment'] = $complaint->attachment;
        }

        // Update the complaint with category and location
        $complaint->update([
            'complaintCategory_id' => $inputs['complaintCategory_id'],
            'complaintLocation_id' => $inputs['complaintLocation_id'],
            'description' => $inputs['description'],
            'status' => $inputs['status'] ?? $complaint->status,
            'attachment' => $inputs['attachment'],
        ]);

        return redirect()->route('allComplaints')->with('success', 'Complaint updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        // dd('ok');

        // Check if the complaint has an attachment and delete it from storage
        if ($complaint->attachment) {
            Storage::disk('public')->delete($complaint->attachment);
        }

        $complaint->delete(); // Delete the complaint from the database

        return redirect()->route('landing')->with('success', 'Complaint deleted successfully!');
    }

    public function destroyAllComplaint(Complaint $complaint)
    {
        // dd('ok');

        // Check if the complaint has an attachment and delete it from storage
        if ($complaint->attachment) {
            Storage::disk('public')->delete($complaint->attachment);
        }

        $complaint->delete(); // Delete the complaint from the database

        return redirect()->route('allComplaints')->with('success', 'Complaint deleted successfully!');
    }
}
