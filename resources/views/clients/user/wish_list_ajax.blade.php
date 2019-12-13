<script>
  $(document).ready(function(){
    $('.removeToWishList').click(function(){
    let btnCurent = $(this);
    let data = btnCurent.attr('data-id');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
      }
    });
    request = $.ajax({
      url: "{{ route('client.users.removeToWishList') }}",
      method: 'POST',
      data: {
        id: data
      }
    }).done(function(response) {
      btnCurent.removeClass('removeToWishList');
      btnCurent.addClass('addToWishList');
      location.reload();
    });
    request.fail(function(jqXHR, textStatus) {
      console.log("looix");
    });
  });
  $('.addToWishList').click(function(){
    let btnCurent = $(this);
    let data = btnCurent.attr('data-id');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
      }
    });
    request = $.ajax({
      url: "{{ route('client.users.addWishList') }}",
      method: 'POST',
      data: {
        id: data
      }
    }).done(function(response) {
      btnCurent.addClass('removeToWishList');
      btnCurent.removeClass('addToWishList');
      $('#countWishList').html(response.count);
      console.log('Thêm thành công');
    });
    request.fail(function(jqXHR, textStatus) {
      console.log("looix");
    });
  });
  })
</script>