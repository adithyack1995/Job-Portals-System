<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'company_name',
        'location',
        'salary',
        'closing_date',
        'is_active'
    ];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    protected function ClosingDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value) ? Carbon::parse($value)->format('M d, Y') : null,
        );
    }
}
