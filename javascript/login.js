document.addEventListener('DOMContentLoaded', function(){

  // let loginBtn = document.querySelector(".submit")
  // loginBtn.addEventListener("click", function() {

  //   loginAnim()

  // })

  // function loginAnim() {

  //   alert('helo')

  //   let loginBox = document.querySelector(".login-box")
  //   loginBox.style.animation = "slide-out-top .5s ease 0s both"

  //   let loginBoxContainer = document.querySelector(".left-container")
  //   loginBoxContainer.style.animation = "login-box-increase 1s ease 1s both"

  //   setTimeout(async function() {
  //     loginBoxContainer.style.border = "none"
  //   },2000)

  //   setTimeout(async function() {
  //     loginBoxContainer.style.border = "none"
  //   },2000)
  // }

  let createAccBtn = document.querySelector(".create-acc")
  let submitBtn = document.querySelector(".submit")
  var login = true
  createAccBtn.addEventListener("click", function() {

    let confirmPassField = document.querySelector(".confirm-pass")

    if (login) {
      confirmPassField.style.display = "flex"
      confirmPassField.innerHTML = "Already have a account?"
      submitBtn.setAttribute('value','Signup');
      login = false
    }else {
      confirmPassField.style.display = "none"
      confirmPassField.innerHTML = "Create new account?"
      submitBtn.setAttribute('value','Login');
      login = true
    }
  })

  // var bright = true;
  // let loginImage = document.querySelector(".login-banner")
  // setInterval(async function() {

  //   if (bright) {
  //     bright = false

  //     loginImage.src = "assets/images/login_banner_dark.jpg"

  //     setTimeout(async function() {
  //       loginImage.src = "assets/images/login_banner_bright.jpg"
  //     },100)
  //     setTimeout(async function() {
  //       loginImage.src = "assets/images/login_banner_dark.jpg"
  //     },200)
  //     setTimeout(async function() {
  //       loginImage.src = "assets/images/login_banner_bright.jpg"
  //     },300)
  //     setTimeout(async function() {
  //       loginImage.src = "assets/images/login_banner_dark.jpg"
  //     },500)
  //   }else {
  //     bright = true

  //     loginImage.src = "assets/images/login_banner_bright.jpg"

  //     setTimeout(async function() {
  //       loginImage.src = "assets/images/login_banner_dark.jpg"
  //     },100)
  //     setTimeout(async function() {
  //       loginImage.src = "assets/images/login_banner_bright.jpg"
  //     },200)
  //     setTimeout(async function() {
  //       loginImage.src = "assets/images/login_banner_dark.jpg"
  //     },300)
  //     setTimeout(async function() {
  //       loginImage.src = "assets/images/login_banner_bright.jpg"
  //     },500)
  //   }

  // },8000)

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