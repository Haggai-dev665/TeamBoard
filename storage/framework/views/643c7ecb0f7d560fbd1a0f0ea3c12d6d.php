

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    <!-- Welcome Header with Animation -->
    <div class="animate-fade-in">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-primary via-accent to-primary bg-clip-text text-transparent">
                    Welcome back, <?php echo e(auth()->user()->name); ?>! 👋
                </h1>
                <p class="mt-2 text-lg text-muted-foreground">
                    Here's what's happening with your team today.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-4 py-2 bg-primary/10 rounded-full text-sm font-medium text-primary animate-pulse">
                    <?php echo e(now()->format('l, F j, Y')); ?>

                </span>
            </div>
        </div>
    </div>

    <!-- Stats Grid with Micro-interactions -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 stagger-animate">
        <!-- Total Employees -->
        <div class="stat-card group cursor-pointer" onclick="triggerConfetti()">
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-blue-500/20 to-blue-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+12%</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-muted-foreground">Total Employees</p>
                    <p class="text-4xl font-bold text-foreground mt-1 group-hover:text-primary transition-colors"><?php echo e($stats['employees']); ?></p>
                </div>
            </div>
        </div>

        <!-- Total Notices -->
        <div class="stat-card group cursor-pointer" onclick="triggerConfetti()">
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Active</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-muted-foreground">Total Notices</p>
                    <p class="text-4xl font-bold text-foreground mt-1 group-hover:text-primary transition-colors"><?php echo e($stats['notices']); ?></p>
                </div>
            </div>
        </div>

        <!-- Total Documents -->
        <div class="stat-card group cursor-pointer" onclick="triggerConfetti()">
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-orange-500/20 to-orange-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-orange-600 bg-orange-100 px-2 py-1 rounded-full"><?php echo e($stats['documents']); ?> files</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-muted-foreground">Total Documents</p>
                    <p class="text-4xl font-bold text-foreground mt-1 group-hover:text-primary transition-colors"><?php echo e($stats['documents']); ?></p>
                </div>
            </div>
        </div>

        <!-- High Priority Notices -->
        <div class="stat-card group cursor-pointer border-red-200 hover:border-red-400" onclick="triggerConfetti()">
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-red-500/20 to-red-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full animate-pulse">Urgent</span>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-muted-foreground">High Priority</p>
                    <p class="text-4xl font-bold text-red-600 mt-1"><?php echo e($stats['high_priority_notices']); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Notices - Takes 2 columns -->
        <div class="lg:col-span-2 animate-slide-in">
            <div class="bg-white rounded-2xl border border-border shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border bg-gradient-to-r from-primary/5 to-accent/5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-primary/10 rounded-xl">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-foreground">Recent Notices</h3>
                                <p class="text-sm text-muted-foreground">Latest announcements and updates</p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('notices.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-primary bg-primary/10 rounded-xl hover:bg-primary/20 transition-colors btn-animate">
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
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-muted/50 flex items-center justify-center">
                                <svg class="w-8 h-8 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <p class="text-muted-foreground font-medium">No notices available</p>
                            <p class="text-sm text-muted-foreground mt-1">Create your first notice to get started</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4 stagger-animate">
                            <?php $__currentLoopData = $recentNotices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="group flex items-start gap-4 p-4 rounded-xl hover:bg-muted/50 transition-all duration-200 cursor-pointer border border-transparent hover:border-border">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <span class="text-sm font-bold text-primary"><?php echo e(strtoupper(substr($notice->author->name ?? 'A', 0, 1))); ?></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <a href="<?php echo e(route('notices.show', $notice)); ?>" class="font-semibold text-foreground hover:text-primary transition-colors">
                                                    <?php echo e($notice->title); ?>

                                                </a>
                                                <p class="mt-1 text-sm text-muted-foreground line-clamp-2">
                                                    <?php echo e(Str::limit($notice->content, 120)); ?>

                                                </p>
                                            </div>
                                            <span class="flex-shrink-0 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold <?php echo e($notice->priority_color); ?>">
                                                <?php echo e(ucfirst($notice->priority)); ?>

                                            </span>
                                        </div>
                                        <div class="mt-3 flex items-center gap-3 text-xs text-muted-foreground">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <?php echo e($notice->author->name ?? 'Unknown'); ?>

                                            </span>
                                            <span>•</span>
                                            <span class="flex items-center gap-1">
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

        <!-- Quick Actions Sidebar -->
        <div class="animate-slide-in" style="animation-delay: 100ms;">
            <div class="bg-white rounded-2xl border border-border shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border bg-gradient-to-r from-accent/5 to-primary/5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-accent/20 rounded-xl">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-foreground">Quick Actions</h3>
                            <p class="text-sm text-muted-foreground">Common tasks</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 space-y-3">
                    <a href="<?php echo e(route('notices.create')); ?>" class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-primary to-primary/80 text-white font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 group">
                        <div class="p-2 bg-white/20 rounded-lg group-hover:bg-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span>Create Notice</span>
                        <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="<?php echo e(route('documents.create')); ?>" class="flex items-center gap-4 p-4 rounded-xl bg-muted/50 hover:bg-muted text-foreground font-medium hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group border border-transparent hover:border-border">
                        <div class="p-2 bg-orange-100 rounded-lg">
                            <svg class="w-5 h-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <span>Upload Document</span>
                        <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="<?php echo e(route('employees.index')); ?>" class="flex items-center gap-4 p-4 rounded-xl bg-muted/50 hover:bg-muted text-foreground font-medium hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group border border-transparent hover:border-border">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span>View Employees</span>
                        <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="<?php echo e(route('employees.create')); ?>" class="flex items-center gap-4 p-4 rounded-xl bg-muted/50 hover:bg-muted text-foreground font-medium hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group border border-transparent hover:border-border">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <span>Add Employee</span>
                        <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="mt-6 bg-white rounded-2xl border border-border shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border">
                    <h3 class="text-lg font-semibold text-foreground">Recent Activity</h3>
                    <p class="text-sm text-muted-foreground">What's happening now</p>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-green-500"></div>
                            <div>
                                <p class="text-sm text-foreground">System is running smoothly</p>
                                <p class="text-xs text-muted-foreground">Just now</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-blue-500"></div>
                            <div>
                                <p class="text-sm text-foreground">You logged in</p>
                                <p class="text-xs text-muted-foreground"><?php echo e(now()->diffForHumans()); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lottie Animation Container (optional) -->
<div data-lottie="https://assets5.lottiefiles.com/packages/lf20_UJNc2t.json" class="fixed bottom-4 right-4 w-24 h-24 pointer-events-none opacity-50" style="display: none;"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hagga\Documents\GitHub\TeamBoard\resources\views/dashboard.blade.php ENDPATH**/ ?>