document.querySelectorAll('.marquee').forEach(marquee => {
    const content = marquee.querySelector('.marquee-content');
    const wrapper = marquee.querySelector('.marquee-wrapper');

    const contentWidth = content.offsetWidth;
    const containerWidth = marquee.offsetWidth;

    console.log(contentWidth);
    console.log(containerWidth);

    const copies = Math.ceil(containerWidth / contentWidth) + 1;
    console.log(copies);

    for (let i = 0; i < copies; i++){
        wrapper.appendChild(content.cloneNode(true));
    }

    const animations = []
    wrapper.querySelectorAll('.marquee-content').forEach(element => {
        const animation = gsap.to(element, {
            xPercent: -100,
            ease: 'none',
            duration: 10,
            repeat: -1,
        });
        animations.push(animation);
    });
});