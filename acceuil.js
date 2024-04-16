// Login Form

$(function() {
  var button = $('#loginButton');
  var box = $('#loginBox');
  var form = $('#loginForm');
  button.removeAttr('href');
  button.mouseup(function(login) {
      box.toggle();
      button.toggleClass('active');
  });
  form.mouseup(function() { 
      return false;
  });
  $(this).mouseup(function(login) {
      if(!($(login.target).parent('#loginButton').length > 0)) {
          button.removeClass('active');
          box.hide();
      }
  });
}); 
 var textWrapper = document.querySelector('.ml14 .letters');
  var words = textWrapper.textContent.split(' ');

  var html = '';
  for (var i = 0; i < words.length; i++) {
    var word = words[i];
    var wordHtml = '';

    // Check if the word contains the interrupted part
    if (word.includes('point')) {
      var wordParts = word.split('point');
      for (var j = 0; j < wordParts.length; j++) {
        var part = wordParts[j];
        wordHtml += "<span class='letter'>" + part + "</span>"; 
        if (j < wordParts.length - 1) {
          wordHtml += "<span class='letter'>point</span>";
        }
      }
    }
    else if (word.includes('vous')) {
      var wordParts = word.split('vous');
      for (var j = 0; j < wordParts.length; j++) {
        var part = wordParts[j];
        wordHtml += "<span class='letter'>" + part + "</span>";
        if (j < wordParts.length - 1) {
          wordHtml += "<span class='letter'>vous</span>";
        }
      }
    }
     else {
      wordHtml = "<span class='letter'>" + word + "</span>";
    }

    html += "<span class='word'>" + wordHtml + "</span> ";
  }

  textWrapper.innerHTML = html;

  anime.timeline({ loop: true })
    .add({
      targets: '.ml14 .line',
      scaleX: [0, 1],
      opacity: [0.5, 1],
      easing: "easeInOutExpo",
      duration: 900
    }).add({
      targets: '.ml14 .word',
      opacity: [0, 1],
      translateX: [40, 0],
      translateZ: 0,
      scaleX: [0.3, 1],
      easing: "easeOutExpo",
      duration: 800,
      offset: '-=600',
      delay: (el, i) => 150 * i
    }).add({
      targets: '.ml14',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 1000
    });
  // Wrap every letter in a span
var textWrapper = document.querySelector('.ml9 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml9 .letter',
    scale: [0, 1],
    duration: 1500,
    elasticity: 600,
    delay: (el, i) => 45 * (i+1)
  }).add({
    targets: '.ml9',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });



  // Get a reference to the button element
const signupButton = document.getElementById("signup");

// Add event listener to the button
signupButton.addEventListener("click", function() {
  // Redirect to signup.html when the button is clicked
  window.location.href = "signup.html";
});