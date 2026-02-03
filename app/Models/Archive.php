<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archive extends Model
{
    protected $fillable = [
        'title',
        'category',
        'document_date',
        'fiscal_year',
        'type',
        'file_path',
        'status',
        'description',
        'user_id',
        'institution_profile_id'
    ];

    protected $casts = [
        'document_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function instantion() {
        return $this->belongsTo(InstitutionProfile::class, 'institution_profile_id', 'id');
    }
}
