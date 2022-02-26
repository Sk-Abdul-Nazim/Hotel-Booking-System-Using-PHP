$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else
    $('#message').html('Not Matching').css('color', 'red');
});

// Validate Email
function ValidateEmail() {

      var red = "#FF3333";
      var green = "#00CC00";
      var email = document.getElementById("txtEmail").value;
      var lblError = document.getElementById("lblError");
      lblError.innerHTML = "";
      var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
      if (!expr.test(email)) {
        lblError.style.color = red;
          lblError.innerHTML = "Invalid email address.";
      }
      else{
        lblError.style.color = green;
        lblError.innerHTML = "Valid email address";
      }

  }

function PhoneCheck(){
            $('#phone').keypress(function(e) {
                var a = [];
                var k = e.which;

                for (i = 48; i < 58; i++)
                    a.push(i);

                if (!(a.indexOf(k)>=0))
                    e.preventDefault();
            });
        }

$(document).ready(function(){
    $("#lastname").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {
            event.preventDefault();
        }
    });
});


$(document).ready(function(){
    $("#firstname").keypress(function(event){
    
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {
            event.preventDefault();
        }
    });
});
