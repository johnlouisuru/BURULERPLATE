
    const validateEmail = (email) => {
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      );
    };
    $(document).ready(function() {
      $('#myModal').hide();
        $('#submit').prop('disabled',true);
        $('input:checkbox').click(function() {
          if ($(this).is(':checked')) {
           $('#submit').prop("disabled", false);
           } else {
           if ($('.checks').filter(':checked').length < 1){
           $('#submit').attr('disabled',true);}
           }
        });
      
     $('#submit').on("click", function() {
      const email_add = $('#email').val();
      //alert('hehe');
          //var x = $(this).val();
          //var y = $('#aa'+x).val();
          //Value of Trainee ID is x
          //Value of Case Status is y
          //alert('value is of TID '+x+' // Value of Case is '+y);
      
      if($('#fullname').val() == "" && $('#fullname').val().length <5){
        var sel2 = $(".toast-body");
            sel2.empty();
            sel2.append("<p class='alert alert-danger'>Full Name Must Not Be Empty or Less than 5 Characters.</p>");
              $('.toast').toast('show');
      }
      else if(!validateEmail(email_add)){
        var sel2 = $(".toast-body");
            sel2.empty();
            sel2.append("<p class='alert alert-danger'>Invalid Email</p>");
              $('.toast').toast('show');
              
      }
      else {
      //alert();
      //return;
          if (confirm("Detail Confirmation: "+$('#fullname').val()+" ?") == true) {
            $('.modal').show();
              var fullname = $('#fullname').val();
              var position = $('#position').val();
              //var email = $('#email').val();
              
             var formData = {
                  fullname_ : fullname,
                  position_ : position,
                  email_ : email_add
                };
                /*alert("til dito");
              return;*/
              $.ajax({
                  type: "POST",
                  url: "process_register_user.php",
                  data: formData,
                  dataType: "json",
                  encode: true,
                }).done(function(data) {
                  $('.modal').hide();
                  var sel2 = $(".toast-body");
                sel2.empty();
                sel2.append(data['message']);
                  $('.toast').toast('show');
                });
          } else {
            
          }
        }
             event.preventDefault();
     });
     
     
    });
