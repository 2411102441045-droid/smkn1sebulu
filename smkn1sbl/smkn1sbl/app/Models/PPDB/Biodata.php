<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'ppdb_biodata';

    protected $fillable = [
        'registration_id', 'nik', 'name', 'place_of_birth', 'date_of_birth',
        'gender', 'religion', 'address', 'school_origin',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}