document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger, ScrollSmoother);
    
    // Initialize ScrollSmoother
    let smoother = ScrollSmoother.create({
        smooth: 0.8,
        wrapper: '#smooth-wrapper',
        content: '#smooth-content',
    });
});