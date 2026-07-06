document.addEventListener('DOMContentLoaded', () => {
    
    // --- Form Submission Animations ---
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if(submitBtn) {
                // Add a dynamic loading state
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = 'Processing... <span style="display:inline-block; animation: popIn 0.5s infinite alternate;">⏳</span>';
                submitBtn.style.opacity = '0.85';
                submitBtn.style.pointerEvents = 'none'; // Prevent double clicks
            }
        });
    });

    // --- Dashboard Card Micro-Interactions ---
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mousedown', () => {
            card.style.transform = 'scale(0.95) translateY(0)';
        });
        
        card.addEventListener('mouseup', () => {
            card.style.transform = 'translateY(-8px) scale(1.02)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });
});