<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidMail extends Model
{
    use HasFactory;

    Protected $fillable = [
        'employer_id',
        'email',
        'role',
    ];

    /**
     * Get the employer that owns the ValidMail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }
}
