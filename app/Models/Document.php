<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'filename',
        'filepath',
        'uploader_id',
    ];

    /**
     * Get the uploader of the document
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    /**
     * Get all feedback for this document
     */
    public function feedback()
    {
        return $this->morphMany(Feedback::class, 'feedbackable');
    }

    /**
     * Get user's feedback for this document
     */
    public function userFeedback($userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $this->feedback()->where('user_id', $userId)->first();
    }

    /**
     * Get the file size in human-readable format
     */
    public function getFileSizeAttribute(): string
    {
        if (Storage::exists($this->filepath)) {
            $bytes = Storage::size($this->filepath);
            $units = ['B', 'KB', 'MB', 'GB'];
            
            for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
                $bytes /= 1024;
            }
            
            return round($bytes, 2) . ' ' . $units[$i];
        }
        
        return 'N/A';
    }

    /**
     * Get the file extension
     */
    public function getFileExtensionAttribute(): string
    {
        return pathinfo($this->filename, PATHINFO_EXTENSION);
    }

    /**
     * Get download URL
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('documents.download', $this);
    }
}
