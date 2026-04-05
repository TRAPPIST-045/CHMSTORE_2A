

function lerp(start, end, t) {
    return start + (end - start) * t;
}
 
function hexToRgb(hex) {
    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}
 
const colorStart = hexToRgb('#FCF6F5');
const colorEnd   = hexToRgb('#f8498c');
const textStart  = hexToRgb('#f8498c');
const textEnd    = hexToRgb('#FCF6F5');
const colorEnd2  = hexToRgb('#2B85C1');
 
const cardLeft   = document.querySelector('.card-left');
const cardRight  = document.querySelector('.card-right');
const stackTop   = document.querySelector('.stack-top');
const cardPop    = document.querySelector('.card-pop');
const cardPop2   = document.querySelector('.card-pop2');
const cardMiddle = document.querySelector('.card-middle');
 
const showcaseStacked = document.querySelector('.section-showcase-stacked');

const circleEl = document.querySelector('.circle-expand');
const circleText = document.querySelector('.circle-text');

const rectPop = document.querySelector('.rect-pop');
const rectText = document.querySelector('.rect-text');

const ctaFinal = document.querySelector('.cta-final-rect');

const productCards = document.querySelectorAll('.product-card');
 
window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    const heroHeight = window.innerHeight;

    // --- DEFINE PHASES EARLY ---
    const unleashStart = heroHeight * 3.5;
    const unleashTotal = heroHeight * 3;

    //Circle Pop
    const circleStart = heroHeight * 6.5;
    const circleTotal = heroHeight * 2;

    //Rec Pop
    const rectStart = circleStart + circleTotal;
    const rectTotal = heroHeight * 2;

    //Rec cards
    const productsStart = rectStart + rectTotal;
    const productStep = heroHeight * 0.8;

    //Rec CTA
    const exitStart = productsStart + (4 * productStep) + heroHeight;
    const ctaFinalStart = exitStart + heroHeight * 1.5;
    const ctaFinalTotal = heroHeight * 0.8;

    // --- BG SNAP ---
    const inDeck = scrollY > (heroHeight * 2) + 360;
    const inShowcase = scrollY > 350;

    const inUnleash1 = scrollY > unleashStart + (heroHeight * 0.8/2);
    const inUnleash2 = scrollY > unleashStart + (heroHeight * 0.8 * 1.2);
    const inUnleash3 = scrollY > unleashStart + (heroHeight * 0.8 * 2);
    const inUnleash4 = scrollY > unleashStart + (heroHeight * 0.8 * 3);
    

    const inFinale = scrollY > ctaFinalStart + ctaFinalTotal;

    if (inFinale) {
        document.body.style.backgroundColor = '#f8498c';
    } else if (inUnleash4) {
        document.body.style.backgroundColor = '#a11b1bff';
    } else if (inUnleash3) {
        document.body.style.backgroundColor = '#777777';
    } else if (inUnleash2) {
        document.body.style.backgroundColor = '	#2c3a47';
    } else if (inUnleash1) {
        document.body.style.backgroundColor = '#6db7e9ff';
    } else if (inDeck) {
        document.body.style.backgroundColor = '#2B85C1';
    } else if (inShowcase) {
        document.body.style.backgroundColor = '#f8498c';
    } else {
        document.body.style.backgroundColor = '#FCF6F5';
    }
 
    // ─── TEXT SNAP ─────────────────────────────────────────────
    const snapProgress = scrollY > 350 ? 1 : 0;
    const tr = Math.round(lerp(textStart.r, textEnd.r, snapProgress));
    const tg = Math.round(lerp(textStart.g, textEnd.g, snapProgress));
    const tb = Math.round(lerp(textStart.b, textEnd.b, snapProgress));
    stackTop.style.color = `rgb(${tr}, ${tg}, ${tb})`;
 
    // ─── PHASE 1: INITIAL HERO STACKING ────────────────────────
    const stackTotal    = heroHeight * 1.5;
    const stackProgress = Math.min(scrollY / stackTotal, 1);
    const staggerStart  = heroHeight * 2;
 
    if (stackProgress < 0.3) {
        const fanP = stackProgress / 0.3;
        cardLeft.style.transform  = `translateX(${lerp(40, 80, fanP)}px) translateY(20px) rotate(${lerp(-8, -15, fanP)}deg)`;
        cardRight.style.transform = `translateX(${lerp(-40, -80, fanP)}px) translateY(20px) rotate(${lerp(8, 15, fanP)}deg)`;
        cardLeft.style.zIndex  = 1;
        cardRight.style.zIndex = 1;
    } else {
        const stackP = Math.min((stackProgress - 0.3) / 0.7, 1);
        if (scrollY <= staggerStart) {
            cardLeft.style.transform  = `translateX(${lerp(80, 260, stackP)}px) translateY(${lerp(20, 0, stackP)}px) rotate(${lerp(-15, -2, stackP)}deg)`;
            cardRight.style.transform = `translateX(${lerp(-80, -260, stackP)}px) translateY(${lerp(20, 0, stackP)}px) rotate(${lerp(15, 2, stackP)}deg)`;
        }
    }
 
    // ─── PHASE 2: 5-CARD STAGGERED DECK ────────────────────────
    const staggerTotal    = heroHeight * 1.5;
    const staggerProgress = Math.max(0, Math.min((scrollY - staggerStart) / staggerTotal, 1));
 
    // Final resting base positions after Phase 2 completes
    const BASE = {
        middle: 0,
        pop:    10,
        pop2:   20,
        right:  -270,
        left:   340,
    };
 
    if (scrollY > staggerStart && scrollY <= unleashStart) {
        const newWidth  = lerp(260, 300, staggerProgress);
        const newHeight = lerp(400, 450, staggerProgress);
        cardLeft.style.width   = `${newWidth}px`;
        cardLeft.style.height  = `${newHeight}px`;
        cardRight.style.width  = `${newWidth}px`;
        cardRight.style.height = `${newHeight}px`;
 
        cardLeft.style.transform  = `translateX(${lerp(260, BASE.left, staggerProgress)}px) translateY(0px)`;
        cardRight.style.transform = `translateX(${lerp(-260, BASE.right, staggerProgress)}px) translateY(0px)`;
        cardPop.style.transform   = `translateX(${lerp(0, BASE.pop, staggerProgress)}px) translateY(0px)`;
        cardPop2.style.transform  = `translateX(${lerp(0, BASE.pop2, staggerProgress)}px) translateY(0px)`;
 
    } else if (scrollY <= staggerStart) {
        cardLeft.style.width   = `280px`;
        cardLeft.style.height  = `410px`;
        cardRight.style.width  = `280px`;
        cardRight.style.height = `410px`;
        cardPop.style.transform  = `translateX(0px)`;
        cardPop2.style.transform = `translateX(0px)`;
    }
 
    // ─── PHASE 3: CONVEYOR BELT ────────────────────────────────
    if (!showcaseStacked) return;
 
    const sectionTop       = showcaseStacked.getBoundingClientRect().top + window.scrollY;
    const conveyorScrolled = window.scrollY - sectionTop;
 
    // Only activate once scrolled into the section
    if (conveyorScrolled <= 0) return;
 
    const PER_STEP_VH = heroHeight * 0.8; // scroll runway per pull event
    const CARD_WIDTH  = 260;
    const CARD_GAP    = 60;
    const STEP        = CARD_WIDTH + CARD_GAP; // 280px per pull
    const convoy = [
        { el: cardMiddle, base: BASE.middle },  // 0 — leader
        { el: cardPop,    base: BASE.pop    },  // 1
        { el: cardPop2,   base: BASE.pop2   },  // 2
        { el: cardRight,  base: BASE.right  },  // 3
        // card-left = anchor, stays put
    ];
 
    const NUM_PULLS = convoy.length; // 4 pull events total
    convoy.forEach(({ el, base }, cardIndex) => {
        if (!el) return;
 
        let totalTravel = 0;
 
        for (let pull = 0; pull < NUM_PULLS; pull++) {
            // Card only participates in pulls >= its index
            if (pull < cardIndex) continue;
 
            const pullScrollStart = pull * PER_STEP_VH;
            const pullScrollEnd   = (pull + 1) * PER_STEP_VH;
 
            const local = Math.max(0, Math.min(
                (conveyorScrolled - pullScrollStart) / (pullScrollEnd - pullScrollStart),
                1
            ));
 
            // Ease in-out cubic per pull
            const eased = local < 0.5
                ? 4 * local * local * local
                : 1 - Math.pow(-2 * local + 2, 3) / 2;
 
            totalTravel += eased * STEP;
        }
 
        el.style.transform = `translateX(${base + totalTravel}px) translateY(0px)`;
    });
        // --- PHASE 4: CIRCLE EXPAND ---
    const circleProgress = Math.max(0, Math.min((scrollY - circleStart) / circleTotal, 1));

    if (scrollY > circleStart) {
        const maxSize = Math.sqrt(window.innerWidth ** 2 + window.innerHeight ** 2) * 2;
        const size = lerp(0, maxSize, circleProgress);
        circleEl.style.setProperty('--circle-size', `${size}px`);

        // Text rises after halfway
        if (circleProgress > 0.5) {
            const textP = (circleProgress - 0.5) / 0.5;
            circleText.style.opacity = textP;
            circleText.style.transform = `translateY(${lerp(100, 0, textP)}px)`;
        } else {
            circleText.style.opacity = 0;
            circleText.style.transform = `translateY(100px)`;
        }
    } else {
        circleEl.style.setProperty('--circle-size', '0px');
        circleText.style.opacity = 0;
    }

    // --- PHASE 5: RECTANGLE POP ---
    const rectProgress = Math.max(0, Math.min((scrollY - rectStart) / rectTotal, 1));

    if (scrollY > rectStart) {
        rectPop.style.transform = `translate(-50%, -50%) scale(${lerp(0, 1, rectProgress)})`;

        if (rectProgress > 0.5) {
            const textP = (rectProgress - 0.5) / 0.5;
            rectText.style.opacity = textP;
            rectText.style.transform = `translate(-50%, -50%) scale(${lerp(0.5, 1, textP)})`;
        } else {
            rectText.style.opacity = 0;
            rectText.style.transform = `translate(-50%, -50%) scale(0.5)`;
        }
    } else {
        rectPop.style.transform = `translate(-50%, -50%) scale(0)`;
        rectText.style.opacity = 0;
        rectText.style.transform = `translate(-50%, -50%) scale(0.5)`;
    }

    // --- PHASE 6: PRODUCT CARDS SLIDE UP + DOWN ---

    productCards.forEach((card, i) => {
        const cardStart = productsStart + (i * productStep);
        const cardProgress = Math.max(0, Math.min((scrollY - cardStart) / (heroHeight * 0.8), 1));

        const eased = cardProgress < 0.5
            ? 4 * cardProgress * cardProgress * cardProgress
            : 1 - Math.pow(-2 * cardProgress + 2, 3) / 2;

        const exitProgress = Math.max(0, Math.min((scrollY - exitStart) / (heroHeight * 0.8), 1));
        const exitEased = exitProgress < 0.5
            ? 4 * exitProgress * exitProgress * exitProgress
            : 1 - Math.pow(-2 * exitProgress + 2, 3) / 2;

        const bottomVal = lerp(-100, 5, eased) - lerp(0, 105, exitEased);
        card.style.bottom = `${bottomVal}%`;
        card.style.opacity = 1;
    });

    // Rect text shrinks to zero no fade
    if (scrollY >= productsStart) {
        const exitProgress = Math.max(0, Math.min((scrollY - exitStart) / (heroHeight * 0.8), 1));
        const scale = lerp(1, 0, exitProgress);
        rectText.style.opacity = 1;
        rectText.style.transform = `translate(-50%, -50%) scale(${scale})`;
        rectPop.style.transform = `translate(-50%, -50%) scale(1)`;
    }

    // --- PHASE 7: CTA FINAL POP ---
    const ctaFinalProgress = Math.max(0, Math.min((scrollY - ctaFinalStart) / ctaFinalTotal, 1));

    if (scrollY > ctaFinalStart) {
        const scale = lerp(0, 1, ctaFinalProgress);
        const rotate = lerp(60, 0, ctaFinalProgress);
        ctaFinal.style.transform = `translate(-50%, -50%) rotate(${rotate}deg) scale(${scale})`;
        ctaFinal.style.pointerEvents = ctaFinalProgress >= 1 ? 'all' : 'none';
    } else {
        ctaFinal.style.transform = `translate(-50%, -50%) rotate(60deg) scale(0)`;
        ctaFinal.style.pointerEvents = 'none';
    }

});
 
// ─── HOVER PARALLAX (hero only) ────────────────────────────
const wrappers = document.querySelectorAll('.card-wrapper');
 
wrappers.forEach(wrapper => {
    wrapper.addEventListener('mousemove', (e) => {
        if (window.scrollY > 50) return;
        const rect = wrapper.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top  - rect.height / 2;
        wrapper.style.transform = `translate(${-x / 3}px, ${-y / 3}px)`;
    });
 
    wrapper.addEventListener('mouseleave', () => {
        wrapper.style.transform = `translate(0px, 0px)`;
    });
});