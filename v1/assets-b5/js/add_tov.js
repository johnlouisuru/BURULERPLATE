
 
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
        var position = $('#position').val();
        var is_active = $('#is_active').val();
        // alert(is_active);
        // return;
      if($('#position').val() == "" && $('#position').val().length <3){
        var sel2 = $(".toast-body");
            sel2.empty();
            sel2.append("<p class='alert alert-danger'>Type of Vessel Must Not Be Empty or Less than 3 Characters.</p>");
              $('.toast').toast('show');
      }
      else if(is_active != 1 && is_active != 0){
        var sel2 = $(".toast-body");
            sel2.empty();
            sel2.append("<p class='alert alert-danger'>Altering the Status wont affect.</p>");
              $('.toast').toast('show');
      }
      else {
      //alert();
      //return;
          if (confirm("Detail Confirmation: "+$('#position').val()+" ?") == true) {
            $('.modal').show();
              
              //var email = $('#email').val();
             var wholePost =  $("#form :input").serializeArray();
            //  var formData = {
            //     'data' : wholePost
            //     //   is_active_ : is_active,
            //     //   position_ : position
            //     };
                /*alert("til dito");
              return;*/
              $.ajax({
                  type: "POST",
                  url: "process_register_position.php",
                  data: wholePost,
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
 