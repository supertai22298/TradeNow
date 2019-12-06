{{-- ajax --}}
<script>
  $('#btn_profile').click(function () {
    var formData = new FormData($('#form_profile')[0]);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
      }
    });
    request = $.ajax({
      url: "{{ route('client.users.update') }}",
      method: 'POST',
      processData: false,  // Phải có để gửi file
      contentType: false, // both of two option : is required to submit the file data
      data: formData
    }).done(function(response) {
      //show noti
      $('#noti').html(response.success);
      $('#noti').addClass('alert');
      $('#noti').addClass('alert-success');
      $("html, body").animate({ scrollTop: 0 }, "fast");
      //remove noti after 5seconds
      setTimeout(function(){
      if ($('#noti').length > 0) {
          $('#noti').html('');
          $('#noti').removeClass('alert');
          $('#noti').removeClass('alert-success');
      }
      }, 5000);
    });
    request.fail(function(jqXHR, textStatus) {
      $('#noti_name').html(jqXHR.responseJSON.errors.name);
      $('#noti_date_of_birth').html(jqXHR.responseJSON.errors.date_of_birth);
      $('#noti_address').html(jqXHR.responseJSON.errors.address);
      $('#noti_gender').html(jqXHR.responseJSON.errors.gender);
      $('#noti_phone_number').html(jqXHR.responseJSON.errors.phone_number);
      $('#noti_description').html(jqXHR.responseJSON.errors.description);
      $('#noti_city').html(jqXHR.responseJSON.errors.city);

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