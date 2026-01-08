

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    <!-- Welcome Header with Lottie Animation -->
    <div class="relative overflow-hidden bg-gradient-to-br from-white via-[#f0fff4] to-[#d6ffd8] rounded-3xl border border-[#86e7b8]/30 shadow-lg p-6 lg:p-8 animate-slide-up">
        <!-- Background decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[#86e7b8]/20 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-[#b2ffa8]/20 to-transparent rounded-full blur-3xl"></div>
        
        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full text-sm font-medium text-[#2d6a4f] shadow-sm border border-[#86e7b8]/30">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <?php echo e(now()->format('l, F j, Y')); ?>

                    </span>
                </div>
                <h1 class="font-display text-3xl lg:text-4xl font-bold text-[#1b4332] mb-3">
                    Welcome back, <?php echo e(auth()->user()->name); ?>! 👋
                </h1>
                <p class="text-lg text-[#2d6a4f]/80 max-w-xl">
                    Here's what's happening with your team today. You have 
                    <span class="font-semibold text-[#2d6a4f]"><?php echo e($stats['high_priority_notices']); ?> urgent</span> 
                    notices that need your attention.
                </p>
                
                <!-- Quick Stats Pills -->
                <div class="flex flex-wrap gap-3 mt-6">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-900"><?php echo e($stats['employees']); ?></span>
                        <span class="text-sm text-gray-500">Employees</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-900"><?php echo e($stats['notices']); ?></span>
                        <span class="text-sm text-gray-500">Notices</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-900"><?php echo e($stats['documents']); ?></span>
                        <span class="text-sm text-gray-500">Documents</span>
                    </div>
                </div>
            </div>
            
            <!-- Lottie Animation -->
            <div class="hidden lg:block w-56 h-56 flex-shrink-0">
                <lottie-player
                    src="https://lottie.host/a0c2a1d4-d6b9-4b8c-8aa8-0c8e0e1f4e3a/rKJbQPzEQU.json"
                    background="transparent"
                    speed="1"
                    style="width: 100%; height: 100%;"
                    loop
                    autoplay>
                </lottie-player>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        <!-- Total Employees Card -->
        <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-[#86e7b8]/50 transition-all duration-300 overflow-hidden cursor-pointer card-hover animate-slide-up delay-100" onclick="triggerConfetti()">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        12%
                    </span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Employees</p>
                    <p class="text-4xl font-bold text-gray-900 font-display"><?php echo e($stats['employees']); ?></p>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="<?php echo e(route('employees.index')); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                        View all
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Notices Card -->
        <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-[#86e7b8]/50 transition-all duration-300 overflow-hidden cursor-pointer card-hover animate-slide-up delay-200" onclick="triggerConfetti()">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                        Active
                    </span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Notices</p>
                    <p class="text-4xl font-bold text-gray-900 font-display"><?php echo e($stats['notices']); ?></p>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="<?php echo e(route('notices.index')); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-amber-600 hover:text-amber-700 transition-colors">
                        View all
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Documents Card -->
        <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-[#86e7b8]/50 transition-all duration-300 overflow-hidden cursor-pointer card-hover animate-slide-up delay-300" onclick="triggerConfetti()">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">
                        <?php echo e($stats['documents']); ?> files
                    </span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Documents</p>
                    <p class="text-4xl font-bold text-gray-900 font-display"><?php echo e($stats['documents']); ?></p>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="<?php echo e(route('documents.index')); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">
                        View all
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- High Priority Card -->
        <div class="group relative bg-gradient-to-br from-red-50 to-white rounded-2xl border border-red-200 shadow-sm hover:shadow-xl hover:border-red-300 transition-all duration-300 overflow-hidden cursor-pointer card-hover animate-slide-up delay-400" onclick="triggerConfetti()">
            <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-lg shadow-red-500/30 group-hover:scale-110 transition-transform duration-300 animate-pulse-glow">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full animate-pulse">
                        Urgent
                    </span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">High Priority</p>
                    <p class="text-4xl font-bold text-red-600 font-display"><?php echo e($stats['high_priority_notices']); ?></p>
                </div>
                <div class="mt-4 pt-4 border-t border-red-100">
                    <a href="<?php echo e(route('notices.index')); ?>?priority=high" class="inline-flex items-center gap-2 text-sm font-medium text-red-600 hover:text-red-700 transition-colors">
                        View urgent
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Recent Notices - Takes 2 columns -->
        <div class="xl:col-span-2 animate-slide-up delay-200">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-[#86e7b8]/10 via-[#b2ffa8]/10 to-transparent">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-display text-lg font-bold text-gray-900">Recent Notices</h3>
                                <p class="text-sm text-gray-500">Latest announcements and updates</p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('notices.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-[#2d6a4f] to-[#40916c] rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                            View All
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <?php if($recentNotices->isEmpty()): ?>
                        <div class="text-center py-12">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <p class="text-gray-900 font-semibold mb-1">No notices available</p>
                            <p class="text-sm text-gray-500 mb-4">Create your first notice to get started</p>
                            <a href="<?php echo e(route('notices.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#2d6a4f] to-[#40916c] rounded-xl hover:shadow-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Notice
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $recentNotices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="group flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition-all duration-200 cursor-pointer border border-transparent hover:border-gray-200" 
                                     style="animation: slideInUp 0.5s ease-out <?php echo e($index * 0.1); ?>s forwards; opacity: 0;">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-[#86e7b8] to-[#2d6a4f] flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                                        <span class="text-sm font-bold text-white"><?php echo e(strtoupper(substr($notice->author->name ?? 'A', 0, 1))); ?></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                            <div class="flex-1">
                                                <a href="<?php echo e(route('notices.show', $notice)); ?>" class="font-semibold text-gray-900 hover:text-[#2d6a4f] transition-colors line-clamp-1">
                                                    <?php echo e($notice->title); ?>

                                                </a>
                                                <p class="mt-1 text-sm text-gray-500 line-clamp-2">
                                                    <?php echo e(Str::limit($notice->content, 120)); ?>

                                                </p>
                                            </div>
                                            <span class="flex-shrink-0 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold <?php echo e($notice->priority === 'high' ? 'bg-red-100 text-red-700' : ($notice->priority === 'medium' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700')); ?>">
                                                <?php echo e(ucfirst($notice->priority)); ?>

                                            </span>
                                        </div>
                                        <div class="mt-3 flex flex-wrap items-center gap-3 text-xs text-gray-400">
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <?php echo e($notice->author->name ?? 'Unknown'); ?>

                                            </span>
                                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <?php echo e($notice->created_at->diffForHumans()); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6 animate-slide-up delay-300">
            <!-- Quick Actions Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-[#b2ffa8]/10 to-transparent">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-gray-900">Quick Actions</h3>
                            <p class="text-xs text-gray-500">Common tasks</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 space-y-3">
                    <a href="<?php echo e(route('notices.create')); ?>" class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-[#2d6a4f] to-[#40916c] text-white font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 group">
                        <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span>Create Notice</span>
                        <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="<?php echo e(route('documents.create')); ?>" class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-900 font-medium hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group border border-gray-100">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <span>Upload Document</span>
                        <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="<?php echo e(route('employees.index')); ?>" class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-900 font-medium hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group border border-gray-100">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span>View Employees</span>
                        <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="<?php echo e(route('employees.create')); ?>" class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-900 font-medium hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group border border-gray-100">
                        <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <span>Add Employee</span>
                        <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Activity Timeline Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-gray-900">Recent Activity</h3>
                            <p class="text-xs text-gray-500">What's happening now</p>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-green-500 ring-4 ring-green-100"></div>
                                <div class="w-0.5 h-full bg-gray-200 mt-2"></div>
                            </div>
                            <div class="pb-4">
                                <p class="text-sm font-medium text-gray-900">System is running smoothly</p>
                                <p class="text-xs text-gray-500 mt-1">Just now</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-blue-500 ring-4 ring-blue-100"></div>
                                <div class="w-0.5 h-full bg-gray-200 mt-2"></div>
                            </div>
                            <div class="pb-4">
                                <p class="text-sm font-medium text-gray-900">You logged in</p>
                                <p class="text-xs text-gray-500 mt-1"><?php echo e(now()->diffForHumans()); ?></p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-purple-500 ring-4 ring-purple-100"></div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Dashboard loaded</p>
                                <p class="text-xs text-gray-500 mt-1"><?php echo e(now()->diffForHumans()); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Celebrate Widget -->
            <div class="bg-gradient-to-br from-[#86e7b8]/20 via-[#b2ffa8]/10 to-white rounded-2xl border border-[#86e7b8]/30 p-6 text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#86e7b8] to-[#2d6a4f] flex items-center justify-center shadow-lg">
                    <span class="text-3xl">🎉</span>
                </div>
                <h4 class="font-display font-bold text-[#1b4332] mb-2">Great work today!</h4>
                <p class="text-sm text-[#2d6a4f]/70 mb-4">Keep up the excellent team management</p>
                <button onclick="triggerConfetti()" class="px-6 py-2.5 bg-white rounded-xl text-sm font-medium text-[#2d6a4f] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 border border-[#86e7b8]/50">
                    🎊 Celebrate!
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hagga\Documents\GitHub\TeamBoard\resources\views/dashboard.blade.php ENDPATH**/ ?>