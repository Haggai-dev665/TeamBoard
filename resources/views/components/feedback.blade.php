@props(['item', 'type'])

@php
    $userFeedback = $item->userFeedback();
@endphp

<div x-data="{ showConcernModal: false }" class="mt-6 border-t border-gray-200 pt-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Your Feedback</h3>
    
    <div class="flex flex-wrap gap-3">
        <!-- Acknowledge Button -->
        <form action="{{ route('feedback.store') }}" method="POST" class="inline">
            @csrf
            <input type="hidden" name="feedbackable_type" value="{{ $type }}">
            <input type="hidden" name="feedbackable_id" value="{{ $item->id }}">
            <input type="hidden" name="type" value="acknowledge">
            <button type="submit" 
                    class="flex items-center gap-2 px-4 py-2.5 rounded-xl border-2 transition-all duration-300 
                           {{ $userFeedback?->type === 'acknowledge' ? 'bg-green-50 border-green-500 text-green-700' : 'border-gray-200 hover:border-green-500 hover:bg-green-50 text-gray-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Acknowledge</span>
                @if($userFeedback?->type === 'acknowledge')
                    <span class="text-xs bg-green-500 text-white px-2 py-0.5 rounded-full">✓</span>
                @endif
            </button>
        </form>

        <!-- Disagree Button -->
        <form action="{{ route('feedback.store') }}" method="POST" class="inline">
            @csrf
            <input type="hidden" name="feedbackable_type" value="{{ $type }}">
            <input type="hidden" name="feedbackable_id" value="{{ $item->id }}">
            <input type="hidden" name="type" value="disagree">
            <button type="submit" 
                    class="flex items-center gap-2 px-4 py-2.5 rounded-xl border-2 transition-all duration-300 
                           {{ $userFeedback?->type === 'disagree' ? 'bg-red-50 border-red-500 text-red-700' : 'border-gray-200 hover:border-red-500 hover:bg-red-50 text-gray-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Disagree</span>
                @if($userFeedback?->type === 'disagree')
                    <span class="text-xs bg-red-500 text-white px-2 py-0.5 rounded-full">✓</span>
                @endif
            </button>
        </form>

        <!-- Concern Button -->
        <button @click="showConcernModal = true" 
                type="button"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl border-2 transition-all duration-300 
                       {{ $userFeedback?->type === 'concern' ? 'bg-amber-50 border-amber-500 text-amber-700' : 'border-gray-200 hover:border-amber-500 hover:bg-amber-50 text-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <span class="font-medium">Raise Concern</span>
            @if($userFeedback?->type === 'concern')
                <span class="text-xs bg-amber-500 text-white px-2 py-0.5 rounded-full">✓</span>
            @endif
        </button>
    </div>

    @if($userFeedback && $userFeedback->message)
        <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
            <p class="text-sm text-gray-700"><strong>Your note:</strong> {{ $userFeedback->message }}</p>
            @if($userFeedback->attachment)
                <a href="{{ Storage::url($userFeedback->attachment) }}" target="_blank" class="text-xs text-primary hover:underline mt-2 inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>
                    View Attachment
                </a>
            @endif
        </div>
    @endif

    <!-- Concern Modal -->
    <div x-show="showConcernModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showConcernModal = false"></div>
            
            <div x-show="showConcernModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6">
                
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="text-2xl">⚠️</span>
                        Raise a Concern
                    </h3>
                    <button @click="showConcernModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('feedback.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="feedbackable_type" value="{{ $type }}">
                    <input type="hidden" name="feedbackable_id" value="{{ $item->id }}">
                    <input type="hidden" name="type" value="concern">

                    <div class="space-y-4">
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Describe your concern <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" id="message" rows="4" required
                                      class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary"
                                      placeholder="Please explain your concern in detail...">{{ old('message', $userFeedback?->type === 'concern' ? $userFeedback->message : '') }}</textarea>
                        </div>

                        <div>
                            <label for="attachment" class="block text-sm font-medium text-gray-700 mb-2">
                                Attach Document (Optional)
                            </label>
                            <input type="file" name="attachment" id="attachment"
                                   accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary
                                          file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium
                                          file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                            <p class="text-xs text-gray-500 mt-2">Max 10MB. Supported: PDF, Word, Images</p>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-amber-500 text-white rounded-xl font-semibold hover:bg-amber-600 transition-colors">
                            Submit Concern
                        </button>
                        <button type="button" @click="showConcernModal = false"
                                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Feedback Stats (for super admin) -->
    @if(auth()->user()->isSuperAdmin())
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
            <h4 class="text-sm font-semibold text-gray-900 mb-3">Feedback Summary</h4>
            <div class="grid grid-cols-3 gap-4">
                @php
                    $acknowledgeCount = $item->feedback()->where('type', 'acknowledge')->count();
                    $disagreeCount = $item->feedback()->where('type', 'disagree')->count();
                    $concernCount = $item->feedback()->where('type', 'concern')->count();
                @endphp
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $acknowledgeCount }}</div>
                    <div class="text-xs text-gray-600">Acknowledged</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $disagreeCount }}</div>
                    <div class="text-xs text-gray-600">Disagreed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-amber-600">{{ $concernCount }}</div>
                    <div class="text-xs text-gray-600">Concerns</div>
                </div>
            </div>
        </div>
    @endif
</div>
