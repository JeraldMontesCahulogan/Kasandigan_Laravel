<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ComplaintCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'complaintCategory_name'
    ];

    // changed
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'complaintCategory_id');
    }
}
