<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    /** @use HasFactory<\Database\Factories\ComplaintFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'complaintCategory_id', // Updated field name', //changed
        'description',
        'complaintLocation_id',
        'status',
        'attachment',
    ];

    // changed
    public function category()
    {
        return $this->belongsTo(ComplaintCategory::class, 'complaintCategory_id');
    }

    public function location()
    {
        return $this->belongsTo(ComplaintLocation::class, 'complaintLocation_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
