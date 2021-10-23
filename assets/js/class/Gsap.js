/**
 * CLASSE OBSERVER
 */
export default class Gsap {

        iconAnimation() {

        gsap.registerPlugin(ScrollTrigger);

        gsap.from(".item1", {

            y: 30,
            duration: 0.5,
            delay: 0.1,
            scrollTrigger: {
                trigger: ".skills-items", 
                toggleActions: "restart",
            }

        })
        gsap.from(".item2", {

            y: 30,
            duration: 0.5,
            delay: 0.15,
            scrollTrigger: {
                trigger: ".item2", 
                toggleActions: "restart"
            }

        })
        gsap.from(".item3", {

            y: 30,
            duration: 0.5,
            delay: 0.2,
            scrollTrigger: {
                trigger: ".item3", 
                toggleActions: "restart"
            }

        })
        gsap.from(".item4", {

            y: 30,
            duration: 0.5,
            delay: 0.25,
            scrollTrigger: {
                trigger: ".item4", 
                toggleActions: "restart"
            }

        })
        gsap.from(".item5", {

            y: 30,
            duration: 0.5,
            delay: 0.3,
            scrollTrigger: {
                trigger: ".item5", 
                toggleActions: "restart"
            }

        })
        gsap.from(".item6", {

            y: 30,
            duration: 0.5,
            delay: 0.35,
            scrollTrigger: {
                trigger: ".item6", 
                toggleActions: "restart"
            }

        })
        gsap.from(".item7", {

            y: 30,
            duration: 0.5,
            delay: 0.4,
            scrollTrigger: {
                trigger: ".item7", 
                toggleActions: "restart"
            }

        })

    }

}