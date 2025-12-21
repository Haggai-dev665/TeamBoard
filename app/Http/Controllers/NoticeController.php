<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of notices
     */
    public function index(Request $request)
    {
        $query = Notice::with('author')->latest();

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $notices = $query->paginate(10);

        return view('notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new notice
     */
    public function create()
    {
        return view('notices.create');
    }

    /**
     * Store a newly created notice
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['author_id'] = auth()->id();

        Notice::create($validated);

        return redirect()->route('notices.index')->with('success', 'Notice created successfully.');
    }

    /**
     * Display the specified notice
     */
    public function show(Notice $notice)
    {
        $notice->load('author');
        return view('notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified notice
     */
    public function edit(Notice $notice)
    {
        $this->authorize('update', $notice);
        return view('notices.edit', compact('notice'));
    }

    /**
     * Update the specified notice
     */
    public function update(Request $request, Notice $notice)
    {
        $this->authorize('update', $notice);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $notice->update($validated);

        return redirect()->route('notices.show', $notice)->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove the specified notice
     */
    public function destroy(Notice $notice)
    {
        $this->authorize('delete', $notice);

        $notice->delete();

        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully.');
    }
}
