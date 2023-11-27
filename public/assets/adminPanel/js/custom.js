$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$('.titleItem').on('input', function(){

  $(this).parents('.tab-pane.active').find('.titleMetaTag').val($(this).val());

});

$('.deleteall-form').click(function(e) {
  e.preventDefault() // Don't post the form, unless confirmed
    ids = $("input[name='ids[]']").val();
    $("input[name=delete_ids]").val(ids);
    alertify.dialog('confirm')
      .set('title', '')
      .set({transition:'zoom',message: 'Are you Sure!?'})
      .set('onok', function(closeEvent){
          // Post the form
          $('#destroyAll').submit() // Post the surrounding form
      })
      .set('oncancel', function(closeEvent){

      })
      .show();
});

$('.delete-form').click(function(e) {
  e.preventDefault() // Don't post the form, unless confirmed

    alertify.dialog('confirm')
      .set('title', '')
      .set({transition:'zoom',message: 'Are you Sure!?'})
      .set('onok', function(closeEvent){
          // Post the form
          $(e.target).closest('form').submit() // Post the surrounding form
      })
      .set('oncancel', function(closeEvent){

      })
      .show();
});

function deleteTag(url){

  alertify.dialog('confirm')
      .set('title', '')
      .set({transition:'zoom',message: 'Are you Sure!?'})
      .set('onok', function(closeEvent){
          // Post the form
          if(url){
            window.location.href = url
          }

          // location.reload();
          console.log(url)
          // $(e.target).closest('form').submit() // Post the surrounding form
      })
      .set('oncancel', function(closeEvent){

      })
      .show();
}
$('.deletedds-form').click(function(e,) {

    e.preventDefault() // Don't post the form, unless confirmed
    alertify.dialog('confirm')
      .set('title', '')
      .set({transition:'zoom',message: 'Are you Sure!?'})
      .set('onok', function(closeEvent){
          // Post the form
          // window.location.href = e.target.href
          // location.reload();
          console.log(e.target)
          console.log(e.target.href)
          // $(e.target).closest('form').submit() // Post the surrounding form
      })
      .set('oncancel', function(closeEvent){

      })
      .show();
});

$('.showComment').click(function(e) {
  e.preventDefault() // Don't post the form, unless confirmed

    const txt = $(this).data('text');

    alertify.alert('', txt);

});


$('.search-reset').click(function(e) {

  $(':input:not([type=hidden])').val('');
  $('select').val('');
  $('.select2').val(null).trigger('change');

});


$('.select2').each(function() {

  let placeholder = $(this).attr('placeholder');
  $(this).select2({
      placeholder: placeholder,
      allowClear: false
  })
});


function readURL(input, preview) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#'+ preview).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}



function allPermissions(page) {
  if ($('#'+ page +'-permission').is(":checked"))
  {
    $('.'+ page +'-permission').prop('checked', true);
  } else {
    $('.'+ page +'-permission').prop('checked', false);
  }
}
