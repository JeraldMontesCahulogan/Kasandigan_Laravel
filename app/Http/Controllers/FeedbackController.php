<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allFeedbacks = Feedback::latest()->paginate(10);
        $feedbackAll = Feedback::all();

        // dd($allFeedbacks->all());

        return view('pages.viewFeedbacks', ['feedbacks' => $allFeedbacks, 'feedbackAll' => $feedbackAll]);
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


        // Validate
        $inputs = $request->validate([
            'rating' => ['required'],
            'service_feedback' => ['nullable'],
            'improvement_suggestions' => ['nullable'],
            'anonymous' => ['nullable'],
        ]);


        // If anonymous is not present in the request, set it to 1, meaning the user wants to remain anonymous
        $inputs['anonymous'] = $inputs['anonymous'] ?? 1;

        // If user chose to remain anonymous, set user_id to null
        // Otherwise, set user_id to the authenticated user's id
        $user_id = $inputs['anonymous'] === "1" ? null : Auth::id();

        Feedback::create(['user_id' => $user_id, ...$inputs]);

        return redirect()->route('provideFeedback')->with('success', 'Feedback submitted successfully!');

        // $user = Auth::user();
        // Complaint::create(['user_id' => $user->id, 'complainant' => $user->name, ...$inputs]);

    }

    public function sendQuest(Request $request)
    {
        // Validate
        $inputs = $request->validate([
            'rating' => ['required'],
            'service_feedback' => ['nullable'],
            'improvement_suggestions' => ['nullable'],
        ]);

        $inputs['isQuest'] = 1;

        Feedback::create($inputs);

        return redirect()->route('welcome')->with('success', 'Feedback submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        // dd('ok');
        $feedback->delete(); // Delete the complaint from the database

        return redirect()->route('feedbacks')->with('success', 'Feedback deleted successfully!');
    }
}
