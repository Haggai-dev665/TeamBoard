<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Notice;
use App\Models\Document;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Store feedback for a notice or document
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'feedbackable_type' => 'required|in:notice,document',
            'feedbackable_id' => 'required|integer',
            'type' => 'required|in:acknowledge,disagree,concern',
            'message' => 'nullable|required_if:type,concern|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        // Get the model
        $model = $validated['feedbackable_type'] === 'notice' 
            ? Notice::findOrFail($validated['feedbackable_id'])
            : Document::findOrFail($validated['feedbackable_id']);

        // Handle attachment upload if concern
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('feedback', 'public');
        }

        // Create or update feedback
        $feedback = Feedback::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'feedbackable_type' => get_class($model),
                'feedbackable_id' => $model->id,
            ],
            [
                'type' => $validated['type'],
                'message' => $validated['message'] ?? null,
                'attachment' => $attachmentPath,
            ]
        );

        // Notify super admin about concern
        if ($validated['type'] === 'concern') {
            $this->notifySuperAdmin($feedback, $model);
        }

        return back()->with('success', 'Your feedback has been submitted successfully!');
    }

    /**
     * Show all feedback for super admin
     */
    public function index()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $feedback = Feedback::with(['user', 'feedbackable'])
            ->latest()
            ->paginate(20);

        return view('feedback.index', compact('feedback'));
    }

    /**
     * Notify super admin about concern
     */
    private function notifySuperAdmin($feedback, $model)
    {
        $superAdmins = \App\Models\User::where('email', config('app.super_admin_email'))->get();

        $modelType = $model instanceof Notice ? 'Notice' : 'Document';
        $modelTitle = $model->title;

        foreach ($superAdmins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'type' => 'concern',
                'title' => '⚠️ Concern Raised: ' . $modelTitle,
                'message' => $feedback->user->name . ' has raised a concern about a ' . $modelType . '.',
                'icon' => '⚠️',
                'link' => route('feedback.index'),
            ]);
        }
    }
}
