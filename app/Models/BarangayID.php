<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayID extends Model
{
    /** @use HasFactory<\Database\Factories\BarangayIDFactory> */
    use HasFactory;

    protected $fillable = [
        'barangay_id',
    ];
}
