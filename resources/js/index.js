import Lenis from 'lenis';
import 'lenis/dist/lenis.css';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { BlurScrollEffect as BlurScrollEffect2 } from './blurScrollEffect.js';


if (window.location.pathname === '/' || window.location.pathname === '/') {
    let textWrapper = document.querySelector('.title-1')
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
    let tl = gsap.timeline();

    tl.fromTo('.brand-name', {
        opacity: 0,
        y: '-100'
    }, {
        opacity: 1,
        y: '0',
        duration: .7,
        ease: "back.out(1.7)",
    })

    tl.to('.title-1 .letter', { opacity: 1, y: '0', clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0 100%)', stagger: '.02' }, "-=.5")

    tl.fromTo('.hero-btn', {
        opacity: 0,
        y: '-100'
    }, {
        opacity: 1,
        y: '0',
        duration: .7,
        ease: "back.out(1.7)",
    }, "-=.5")

    tl.fromTo('.hero-subtitle', {
        opacity: 0,
        y: '100'
    }, {
        opacity: 1,
        y: '0',
        duration: .4,
    })
}
// Initializes smooth scrolling with Lenis and integrates it with GSAP's ScrollTrigger.
// Function to set up smooth scrolling.
const initSmoothScrolling = () => {
    // Initialize Lenis for smooth scroll effects. Lerp value controls the smoothness.
    const lenis = new Lenis({ lerp: 0.2 });

    // Sync ScrollTrigger with Lenis' scroll updates.
    lenis.on('scroll', ScrollTrigger.update);

    // Ensure GSAP animations are in sync with Lenis' scroll frame updates.
    gsap.ticker.add(time => {
        lenis.raf(time * 1000); // Convert GSAP's time to milliseconds for Lenis.
    });

    // Turn off GSAP's default lag smoothing to avoid conflicts with Lenis.
    gsap.ticker.lagSmoothing(0);
};

// Activate the smooth scrolling feature.
initSmoothScrolling();

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);


const effects = [
    { selector: '[data-effect-2]', effect: BlurScrollEffect2 },
];

// Iterate over each effect configuration and apply the effect to all matching elements
effects.forEach(({ selector, effect }) => {
    document.querySelectorAll(selector).forEach(el => {
        new effect(el);
    });
});



const parallaxIns = Array.from(document.querySelectorAll(".js-parallax-in"));

[...parallaxIns].forEach(p => {
    gsap.fromTo(p, {
        "--yPercent": -1
    }, {
        "--yPercent": 1,
        scrollTrigger: {
            trigger: p,
            start: "top bottom",
            end: "bottom top",
            scrub: true
        }
    });
});


gsap.to('.card-left', {
    yPercent: -50, // Moves the element up by 50% of its height
    scrollTrigger: {
        scrub: true,
        trigger: ".editions",
        start: "top+=600 top+=100", // Animation starts when .editions reaches the top of the viewport
        end: "bottom-=200 bottom", // Animation ends when .editions' bottom reaches the top of the viewport
    }
});

gsap.fromTo('.card-right',
    { yPercent: -50 }, // Starting position (from)
    {
        yPercent: 0, // Ending position (to)
        scrollTrigger: {
            scrub: true,
            trigger: ".editions",
            start: "top+=600 top+=100", // Animation starts when .card-left reaches the specified position
            end: "bottom-=200 bottom", // Animation ends when .card-left reaches the specified position
        }
    }
);


if (document.querySelector('.fav-products')) {

    ScrollTrigger.matchMedia({

        "(min-width: 900.02px)": function () {
            // setup animations and ScrollTriggers for screens 960px wide or greater...
            // These ScrollTriggers will be reverted/killed when the media query doesn't match anymore.


            const productCards = document.querySelectorAll('.product-card');

            // Apply staggered animation
            gsap.from(productCards, {
                y: 120, // Start position (50px below the current position)
                duration: 1, // Animation duration
                stagger: 0.2, // Delay between each card's animation
                ease: 'power2.out', // Animation easing
                scrollTrigger: {
                    trigger: '.fav-products', // Trigger animation when this section enters the viewport
                    start: 'top 80%', // Start when top of section is 80% down the viewport
                    end: 'bottom 20%', // End when bottom of section reaches 20% of viewport
                    scrub: true, // Smooth animation as user scrolls
                    markers: false, // Show position markers on the timeline
                },
            });

        }
    });
}
// Marquee component
initMarquee(190, 27)

function initMarquee(boxWidth, time) {
    const boxElement = $('.box');
    const boxLength = boxElement.length;
    const wrapperWidth = boxWidth * boxLength;
    const windowWidth = $(window).width();

    boxElement.parent().css('left', '-' + boxWidth + 'px');
    boxElement.css('width', boxWidth + 'px');

    gsap.set(".box", {
        x: (i) => i * boxWidth
    });

    gsap.to(".box", {
        duration: time,
        ease: "none",
        x: "-=" + wrapperWidth,
        modifiers: {
            x: gsap.utils.unitize(
                function (x) {
                    return parseFloat(x + windowWidth + boxWidth) % wrapperWidth
                }
            )
        },
        repeat: -1
    });

}

function delay(n) {
    n = n || 2000;
    return new Promise((done) => {
        setTimeout(() => {
            done();
        }, n);
    });
}

function pageTransition() {
    var tl = gsap.timeline();
    tl.to(".loading-screen", {
        duration: 1.2,
        width: "100%",
        left: "0%",
        ease: "Expo.easeInOut",
    });

    tl.to(".loading-screen", {
        duration: 1,
        width: "100%",
        left: "100%",
        ease: "Expo.easeInOut",
        delay: 0.3,
    });
    tl.set(".loading-screen", { left: "-100%" });
}


gsap.to(".highlight", {
    x: "80vw",
    y: "40vh",
    duration: 10,
    ease: "none",
    repeat: -1,
    yoyo: true,
    modifiers: {
        x: gsap.utils.unitize(x => parseFloat(x) % window.innerWidth),
        y: gsap.utils.unitize(y => parseFloat(y) % window.innerHeight)
    }
});
