<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminReceivesUserVerification;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'address_id',
        'contact_number',
        'profilePic',
        'barangay_id',
        'email_verified_at',
    ];

    public function sendEmailVerificationNotification()
    {
        // Get the admin email from .env
        $adminEmail = env('ADMIN_EMAIL');

        // Send the email to the admin
        \Notification::route('mail', $adminEmail)
            ->notify(new AdminReceivesUserVerification($this));
    }
    
    public function location()
    {
        return $this->belongsTo(ComplaintLocation::class, 'address_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
}

