document.addEventListener('DOMContentLoaded', function() {
    let star = document.querySelector('.star')

    setTimeout(async function() {
        star.style.animation = "spin-linear 3s linear 0s infinite";
    },1200)

    const image = document.querySelector('.background-picture');
    
    window.addEventListener('scroll', function() {
        let scrollPosition = window.pageYOffset;
        image.style.transform = `translateY(${scrollPosition * 0.7}px)`;
    });

})