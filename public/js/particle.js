$(document).ready(() => {
    particlesJS('particles-js', {
        particles: {
            number: {
                value: 100,
            },
            shape: {
                type: 'circle',
            },
            size: {
                value: 2,
                random: true,
            },
            line_linked: {
                enable: true,
            },
            move: {
                enable: true,
                speed: 1,
                direction: 'none',
                straight: false,
            },
        },
        interactivity: {
            detect_on: 'canvas',
            events: {
                onhover: {
                    enable: false,
                },
            },
            modes: {
                push: {
                    particles_nb: 12,
                },
            },
        },
    });
});
