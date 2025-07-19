<?php

namespace App\Http\Controllers;

use App\Models\BarangayID;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\ComplaintLocation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminReceivesUserVerification;

class AuthController extends Controller
{

    public function index()
    {
        $complaintsLocation = ComplaintLocation::all();
        // Pass all data to the view
        return view('auth.signup', ['complaintsLocation' => $complaintsLocation,]);
    }

    // SIGNUP USER
    public function signup(Request $request)
    {
        // Validations or conditions

        // dd(request()->all());

        $barangay_id = BarangayID::first();
        if (!$barangay_id) {
            return back()->withErrors(['barangayID' => 'Barangay ID not found.']);
        }
        $barangayConfirm = $barangay_id->barangay_id;

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'username' => ['required', 'max:255', 'unique:users'],
            'password' => ['required',  'confirmed', 'string', 'min:7', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'], // 'string', 'min:7', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/',
            'address_id' => ['required'],
            'barangayID' => [function ($attribute, $value, $fail) use ($barangayConfirm) {
                if (empty($value)) {
                    $fail('The barangay id field is required.');
                } elseif ($value !== $barangayConfirm) {
                    $fail('The provided barangay id is incorrect.');
                }
            }],
        ]);

        $inputs = $request->only('name', 'email', 'username', 'password', 'address_id',) + ['barangay_id' => $barangay_id->id];

        // Register
        $user = User::create($inputs);

        event(new Registered($user)); // Sends email to admin

        // Login
        Auth::login($user);

        // Redirect
        return redirect()->route('landing');
    }

    // LOGIN USER
    public function login(Request $request)
    {
        // Validations or conditions

        $barangay_id = BarangayID::first();
        if (!$barangay_id) {
            return back()->withErrors(['barangayID' => 'Barangay ID not found.']);
        }
        $barangayConfirm = $barangay_id->barangay_id;

        $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required', 'string', 'min:7', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'], // 'string', 'min:7', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/',
            'barangayID' => [function ($attribute, $value, $fail) use ($barangayConfirm) {
                if (empty($value)) {
                    $fail('The barangay id field is required.');
                } elseif ($value !== $barangayConfirm) {
                    $fail('The provided barangay id is incorrect.');
                }
            }],

        ]);

        $inputs = $request->only('email', 'password');

        // Try to login
        if (Auth::attempt($inputs, $request->remember)) {
            return redirect()->route('landing');
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records.'
            ]);
        }
    }

    // LOGOUT USER
    public function logout(Request $request)
    {
        // logout the user
        Auth::logout();

        // invalidate user's session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect()->route('welcome');
    }

    // GET AUTH USER
    public function user()
    {

        $user = Auth::user();
        $complaints = Complaint::where('user_id', $user->id)->get();

        $statuses = $complaints->pluck('status')->all();
        $solved = count(array_keys($statuses, 'solved'));
        $processing = count(array_keys($statuses, 'processing'));
        $closed = count(array_keys($statuses, 'closed'));
        $pending = count(array_keys($statuses, 'pending'));

        $complaintsLocation = ComplaintLocation::all();
        $complaintsCategory = ComplaintCategory::all();
        $userPendingComplaints = Complaint::where('user_id', $user->id)->where('status', 'pending')->get();

        // dd($closed);

        return view('pages.profile',  [
            'user' => $user,
            'solved' => $solved,
            'processing' => $processing,
            'closed' => $closed,
            'pending' => $pending,
            'complaintsLocation' => $complaintsLocation,
            'complaintsCategory' => $complaintsCategory,
            'complaints' => $userPendingComplaints
        ]);
    }

    public function resendVerificationEmail(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is already verified
        if ($user->email_verified_at) {
            return back()->with('success', 'Your email is already verified.');
        }

        // Get the admin email from .env
        $adminEmail = env('ADMIN_EMAIL');

        // Resend the verification email to the admin
        Notification::route('mail', $adminEmail)->notify(new AdminReceivesUserVerification($user));

        return back()->with('success', 'Verification email has been resent to the admin.');
    }

    // UPDATE USER
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate input fields
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email,' . $user->id],
            'username' => ['required', 'max:255', 'unique:users,username,' . $user->id],
            'contact_number' => ['max:255', 'regex:/^[0-9]+$/', 'nullable'],
            'address_id' => ['required', 'max:255'],
            'profilePic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Collect updated user data (excluding profile picture)
        $inputs = $request->only(['name', 'email', 'username', 'contact_number', 'address_id']);

        // Handle profile picture upload (if a new file is provided)
        if ($request->hasFile('profilePic')) {
            // Delete old profile picture if it exists
            if ($user->profilePic) {
                Storage::disk('public')->delete($user->profilePic);
            }

            // Store new profile picture
            $profilePicPath = $request->file('profilePic')->store('profile_pics', 'public');

            // Update profile picture in the database
            $user->profilePic = $profilePicPath;
        } else {
            // If no new profile picture is uploaded, keep the existing one
            $user->profilePic = $user->profilePic;
        }

        // Update user details
        if ($user->update($inputs)) {
            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('profile')->withErrors(['error' => 'Profile update failed.']);
        }
    }
}
