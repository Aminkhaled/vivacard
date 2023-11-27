<script>

	 CKEDITOR.replace( 'ar-ckeditor',
	  {
	     filebrowserBrowseUrl: "{{ asset('vendors/ckfinder/ckfinder.html?Type=Files') }}",
	     filebrowserImageBrowseUrl: "{{ asset('vendors/ckfinder/ckfinder.html?Type=Images') }}",
	     filebrowserUploadUrl: "{{ asset('vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
	     filebrowserImageUploadUrl: "{{ asset('vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
	  });

	 CKEDITOR.replace( 'en-ckeditor',
	  {
	     filebrowserBrowseUrl: "{{ asset('vendors/ckfinder/ckfinder.html?Type=Files') }}",
	     filebrowserImageBrowseUrl: "{{ asset('vendors/ckfinder/ckfinder.html?Type=Images') }}",
	     filebrowserUploadUrl: "{{ asset('vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
	     filebrowserImageUploadUrl: "{{ asset('vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
	  });


</script>
