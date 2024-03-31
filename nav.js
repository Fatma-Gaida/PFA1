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
// Get a reference to the button element
const signupButton = document.getElementById("signup");

// Add event listener to the button
signupButton.addEventListener("click", function() {
  // Redirect to signup.html when the button is clicked
  window.location.href = "signup.html";
});