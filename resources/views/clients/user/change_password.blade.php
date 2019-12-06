{{-- ajax --}}
<script>
    $('#btn_change_password').click(function () {
      var formDataPassword = new FormData($('#change_password')[0]);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        }
      });
      request = $.ajax({
        url: "{{ route('client.users.changePassword') }}",
        method: 'POST',
        processData: false,  // Phải có để gửi file
        contentType: false, // both of two option : is required to submit the file data
        data: formDataPassword
      }).done(function(response) {
        //show noti
        if(response.success != null){
          $('#noti').html(response.success);
          $('#noti').addClass('alert');
          $('#noti').addClass('alert-success');
          $("html, body").animate({ scrollTop: 0 }, "fast");
        }
        if(response.failed != null){
          $('#noti').html(response.failed);
          $('#noti').addClass('alert');
          $('#noti').addClass('alert-danger');
          $("html, body").animate({ scrollTop: 0 }, "fast");
        }
        //remove noti after 5seconds
        setTimeout(function(){
        if ($('#noti').length > 0) {
            $('#noti').html('');
            $('#noti').removeClass('alert');
            $('#noti').removeClass('alert-success');
            $('#noti').removeClass('alert-danger');
        }
        }, 5000);
      });
      request.fail(function(jqXHR, textStatus) {
        console.log(jqXHR);
        $('#noti_old_password').html(jqXHR.responseJSON.errors.old_password);
        $('#noti_new_password').html(jqXHR.responseJSON.errors.new_password);
        $('#noti_re_password').html(jqXHR.responseJSON.errors.re_password);
        
        $('.noti').addClass('text-danger');
        setTimeout(function(){
        if ($('.noti').length > 0) {
            $('.noti').html('');
            $('.noti').removeClass('text-danger');
        }
        }, 4000);
      });
    });
  </script>