document.addEventListener("DOMContentLoaded", function() {
  var myInput = document.getElementById("psw");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");

  myInput.onfocus = function() {
      document.getElementById("message").style.display = "block";
  }

  myInput.onblur = function() {
      document.getElementById("message").style.display = "none";
  }

  myInput.onkeyup = function() {
      var lowerCaseLetters = /[a-z]/g;
      if (myInput.value.match(lowerCaseLetters)) {
          letter.classList.remove("invalid");
          letter.classList.add("valid");
      } else {
          letter.classList.remove("valid");
          letter.classList.add("invalid");
      }

      var upperCaseLetters = /[A-Z]/g;
      if (myInput.value.match(upperCaseLetters)) {
          capital.classList.remove("invalid");
          capital.classList.add("valid");
      } else {
          capital.classList.remove("valid");
          capital.classList.add("invalid");
      }

      var numbers = /[0-9]/g;
      if (myInput.value.match(numbers)) {
          number.classList.remove("invalid");
          number.classList.add("valid");
      } else {
          number.classList.remove("valid");
          number.classList.add("invalid");
      }

      if (myInput.value.length >= 5) {
          length.classList.remove("invalid");
          length.classList.add("valid");
      } else {
          length.classList.remove("valid");
          length.classList.add("invalid");
      }
  }
});

var modal = document.getElementById("exampleModal");
var btn = document.getElementById("registerBtn");
var closeBtn = document.getElementById("closeBtn");

btn.onclick = function() {
  
    var fullname = document.querySelector('input[name="fullname"]').value.trim();
    var email = document.querySelector('input[name="email"]').value.trim();
    var username = document.querySelector('input[name="username"]').value.trim();
    var password = document.querySelector('input[name="password"]').value.trim();

    console.log("Username:", username); 

    if (fullname === '' || email === '' ||username === ''|| password === '') {
        alert("Please fill in all the fields.");
    } else {
        
        document.getElementById("fullname2").value = fullname;
        document.getElementById("email2").value = email;
        document.getElementById("username2").value = username;
        document.getElementById("password2").value = password;
       
        modal.style.display = "block";
    }
};

closeBtn.onclick = function() {
  modal.style.display = "none";
};