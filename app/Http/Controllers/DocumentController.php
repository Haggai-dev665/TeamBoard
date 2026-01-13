<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents
     */
    public function index(Request $request)
    {
        $query = Document::with('uploader')->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('filename', 'like', "%{$search}%");
            });
        }

        $documents = $query->paginate(15);

        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new document
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created document
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $filepath = $file->store('documents', 'public');

        $document = Document::create([
            'title' => $validated['title'],
            'filename' => $filename,
            'filepath' => $filepath,
            'uploader_id' => auth()->id(),
        ]);

        // Create notifications for all users
        \App\Services\NotificationService::notifyNewDocument($document);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

    /**
     * Download the specified document
     */
    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->filepath)) {
            abort(404);
        }

        return Storage::disk('public')->download($document->filepath, $document->filename);
    }

    /**
     * Remove the specified document
     */
    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        if (Storage::disk('public')->exists($document->filepath)) {
            Storage::disk('public')->delete($document->filepath);
        }

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}
