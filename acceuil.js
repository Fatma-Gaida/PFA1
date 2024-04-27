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
var monImage = document.getElementById("monImage");

// Définissez une fonction pour animer l'image
function animerImage() {
    monImage.style.transition = "transform 0.5s ease-in-out"; // Transition plus rapide
    monImage.style.transform = "rotate(5deg)"; // Rotation de 5 degrés
    setTimeout(function() {
        monImage.style.transform = "rotate(-5deg)"; // Rotation de -5 degrés
        setTimeout(function() {
            monImage.style.transform = "rotate(0deg)"; // Retour à la position initiale
        }, 500); // Durée d'attente avant de revenir à la position initiale (0.5 seconde)
    }, 500); // Durée d'attente avant de tourner dans l'autre sens (0.5 seconde)
}

// Appeler la fonction pour animer l'image à intervalles réguliers
setInterval(animerImage, 2000); // Répéter toutes les 2 secondes (2000 millisecondes)
// Options pour l'Intersection Observer
const options = {
  root: null,
  rootMargin: '0px',
  threshold: 0.2 // Intersection de 20%
};

function handleIntersect(entries, observer) {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-visible');
      observer.unobserve(entry.target); // Stop observing once element is visible
    }
  });
}

function setupIntersectionObserver() {
  const options = {
    rootMargin: '0px', // Adjust rootMargin as needed
  };

  const observer = new IntersectionObserver(handleIntersect, options);

  const div5 = document.querySelector('.div5');
  const div6 = document.querySelector('.div6');

  if (div5) {
    observer.observe(div5);
  }

  if (div6) {
    observer.observe(div6);
  }
}

document.addEventListener('DOMContentLoaded', setupIntersectionObserver);