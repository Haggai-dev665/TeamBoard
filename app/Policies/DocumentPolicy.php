<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    /**
     * Determine if the given document can be viewed by the user.
     */
    public function view(?User $user, Document $document): bool
    {
        return true; // All users can view documents
    }

    /**
     * Determine if the user can create documents.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can upload documents
    }

    /**
     * Determine if the given document can be deleted by the user.
     */
    public function delete(User $user, Document $document): bool
    {
        return $user->id === $document->uploader_id || $user->isAdmin();
    }
}
