<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'department',
        'phone',
        'photo',
        'bio',
    ];

    /**
     * Get the photo URL
     */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        
        // Return default avatar with initials
        $initials = collect(explode(' ', $this->name))
            ->map(fn($word) => strtoupper($word[0] ?? ''))
            ->take(2)
            ->join('');
            
        return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&color=fff&background=3b82f6';
    }
}
