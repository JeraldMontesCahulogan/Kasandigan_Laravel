<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintLocation extends Model
{
    /** @use HasFactory<\Database\Factories\ComplaintLocationFactory> */
    use HasFactory;

    protected $fillable = [
        'complaintLocation_name'
    ];

    // changed
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'complaintLocation_id');
    }
}
