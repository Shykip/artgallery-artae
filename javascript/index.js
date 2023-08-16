document.addEventListener('DOMContentLoaded', function(){

  homeAnimationCompletion = false

  setTimeout(async function() {

    let revealContainer1 = document.querySelector(".reveal-container1")
    let revealContainer2 = document.querySelector(".reveal-container2")
    let revealContainer3 = document.querySelector(".reveal-container3")
    let revealContainer4 = document.querySelector(".reveal-container4")
    let revealContainer5 = document.querySelector(".frame-front-reveal-container")
    revealContainer1.style.display = "none"
    revealContainer2.style.display = "none"
    revealContainer3.style.display = "none"
    revealContainer4.style.display = "none"
    revealContainer5.style.display = "none"

    let backgroundLight = document.querySelector(".background-light")
    backgroundLight.style.display = "flex"

    let artFront = document.querySelector(".art-front")
    artFront.style.animation = "normalize .5s ease 0s both"

    let spinStar = document.querySelector(".star")
    spinStar.style.opacity = "1"
    spinStar.style.animation = "spin-linear 3s linear 0s infinite"

    let artBack = document.querySelector(".art-back")
    artBack.style.animation = "normalize2 .5s ease 0s both"

    setTimeout(intervalAnimation(),500)

  },4000)

  
  var artIteration = 1
  function intervalAnimation() {
    setInterval(async function() {

      let headerArt = document.querySelector(".header-art")
      let artDate = document.querySelector(".art-date")
      headerArt.style.animation = "slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both"
      artDate.style.animation = "slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both"

      let artFront = document.querySelector(".art-front")
      artFront.style.animation = "slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both"

      let frameRing = document.querySelector(".frame-ring")
      frameRing.style.animation = "slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both"

      let artBack = document.querySelector(".art-back")
      artBack.style.animation = "frame-back-move-to-front .9s ease 0s both"

      setTimeout(async function() {

        // frame art changer
        if (artIteration == 6) {
          artIteration = 1;
        }else {
          artIteration++
        }

        let artFrontImg = document.querySelector(".front-art-image")
        let artBackImg = document.querySelector(".back-art-image")
        let artTitle = document.querySelector(".art-title")
        let artist = document.querySelector(".artist")
        let date = document.querySelector(".date")

        

        switch (artIteration) {
          case 1 :  artFrontImg.src = 'assets/images/showcase/anato-banished.jpg'
                    artBackImg.src = 'assets/images/showcase/wlop-violin.jpg'
                    artTitle.innerHTML = "Banished"
                    artist.innerHTML = "by Anato Finnstart"
                    date.innerHTML = "Sept <span>'22<span>"
            break;

          case 2 :  artFrontImg.src = 'assets/images/showcase/wlop-violin.jpg'
                    artBackImg.src = 'assets/images/showcase/boat.jpg'
                    artTitle.innerHTML = "Civilization"
                    artist.innerHTML = "by WLOP"
                    date.innerHTML = "Dec <span>'20<span>"
            break;

          case 3 :  artFrontImg.src = 'assets/images/showcase/boat.jpg'
                    artBackImg.src = 'assets/images/showcase/wolf.jpg'
                    artTitle.innerHTML = "Gotheborg"
                    artist.innerHTML = "by Peter Xiao"
                    date.innerHTML = "Aug <span>'22<span>"
            break;

          case 4 :  artFrontImg.src = 'assets/images/showcase/wolf.jpg'
                    artBackImg.src = 'assets/images/showcase/ahri.jpg'
                    artTitle.innerHTML = "Skellige"
                    artist.innerHTML = "by Anna Podedworna"
                    date.innerHTML = "Oct <span>'22<span>"
            break;

          case 5 :  artFrontImg.src = 'assets/images/showcase/ahri.jpg'
                    artBackImg.src = 'assets/images/showcase/rossdraw.jpg'
                    artTitle.innerHTML = "Light"
                    artist.innerHTML = "by Ghost HB"
                    date.innerHTML = "Jan <span>'19<span>"
            break;  

          case 6 :  artFrontImg.src = 'assets/images/showcase/rossdraw.jpg'
                    artBackImg.src = 'assets/images/showcase/anato-banished.jpg'
                    artTitle.innerHTML = "Skybreak"
                    artist.innerHTML = "by Rossdraws"
                    date.innerHTML = "Nov <span>'11<span>"
            break;  
        }
        
        headerArt.style.animation = "slide-in-bottom .5s cubic-bezier(0.250, 0.460, 0.450, 0.940) .5s both"
        artDate.style.animation = "slide-in-bottom .5s cubic-bezier(0.250, 0.460, 0.450, 0.940) .5s both"
        
        artFront.style.animation = "normalize .5s cubic-bezier(0.250, 0.460, 0.450, 0.940) .5s both"

        artBack.style.animation = "frame-back-normalize 1s ease 0s both"

        frameRing.style.animation = "fade .5s ease .5s both"
        
      },800)

  },4000)
  }

  setInterval(async function() {
    
  },3000)

  // Mouse parallax animation
  document.addEventListener("mousemove", function(event) {
    this.querySelectorAll(".parallax").forEach((shift) => {
        const position = shift.getAttribute("value");
        const x = (window.innerWidth - event.pageX * position) / 90;
        const y = (window.innerHeight - event.pageY * position) / 90;
  
        shift.style.transform = `translateX(${x}px) translateY(${y}px)`;
      });
  });

})