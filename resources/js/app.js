import './bootstrap';
import confetti from 'canvas-confetti';
import lottie from 'lottie-web';

// Make confetti available globally
window.confetti = confetti;
window.lottie = lottie;

// Sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    
    // Desktop sidebar toggle
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-collapsed');
            document.body.classList.toggle('sidebar-is-collapsed');
        });
    }
    
    // Mobile sidebar toggle
    if (mobileSidebarToggle && sidebar && sidebarOverlay) {
        mobileSidebarToggle.addEventListener('click', function() {
            sidebar.classList.add('sidebar-mobile-open');
            sidebarOverlay.classList.remove('hidden');
        });
        
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('sidebar-mobile-open');
            sidebarOverlay.classList.add('hidden');
        });
    }
    
    // Initialize Lottie animations
    document.querySelectorAll('[data-lottie]').forEach(function(element) {
        const animationPath = element.dataset.lottie;
        if (animationPath) {
            lottie.loadAnimation({
                container: element,
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: animationPath
            });
        }
    });
    
    // Trigger confetti on specific actions
    window.triggerConfetti = function() {
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 },
            colors: ['#86e7b8', '#d6ffd8', '#b2ffa8', '#d0ffb7', '#f2f5de']
        });
    };
    
    // Success message confetti
    const successMessage = document.querySelector('[data-success-message]');
    if (successMessage) {
        window.triggerConfetti();
    }
});
