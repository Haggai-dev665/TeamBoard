<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'feedbackable_type',
        'feedbackable_id',
        'type',
        'message',
        'attachment',
    ];

    /**
     * Get the user that gave the feedback
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent feedbackable model (Notice or Document)
     */
    public function feedbackable()
    {
        return $this->morphTo();
    }
}
