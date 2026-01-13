<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a welcome notification for a new user
     */
    public static function createWelcomeNotification(User $user)
    {
        Notification::create([
            'user_id' => $user->id,
            'type' => 'welcome',
            'title' => 'Welcome to TeamBoard! 🎉',
            'message' => 'Thank you for joining TeamBoard. Explore notices, documents, and connect with your team.',
            'icon' => '👋',
            'link' => route('dashboard'),
        ]);
    }

    /**
     * Create notification for new notice
     */
    public static function notifyNewNotice($notice)
    {
        $users = User::where('id', '!=', $notice->author_id)->get();

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'notice',
                'title' => 'New Notice: ' . $notice->title,
                'message' => 'A new ' . $notice->priority . ' priority notice has been posted.',
                'icon' => '📢',
                'link' => route('notices.show', $notice),
            ]);
        }
    }

    /**
     * Create notification for new document
     */
    public static function notifyNewDocument($document)
    {
        $users = User::where('id', '!=', $document->uploader_id)->get();

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'document',
                'title' => 'New Document: ' . $document->title,
                'message' => $document->uploader->name . ' shared a new document.',
                'icon' => '📄',
                'link' => route('documents.index'),
            ]);
        }
    }

    /**
     * Create notification when user is added as employee
     */
    public static function notifyEmployeeAdded($employee)
    {
        $user = User::where('email', $employee->email)->first();

        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'employee',
                'title' => 'You\'ve been added to the Employee Directory! 🎊',
                'message' => 'You are now listed in the employee directory as ' . $employee->position . ' in ' . $employee->department . '.',
                'icon' => '👤',
                'link' => route('employees.show', $employee),
            ]);
        }
    }
}
