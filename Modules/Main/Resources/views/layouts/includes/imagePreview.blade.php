
<input class="form-control {{ $errors->first($name) ? 'is-invalid' : '' }}" id="{{ $name }}" type="file"
 name="{{ $name }}" onchange="readURL(this, '{{ $name }}-preview')" {{ isset($multiple) ? 'multiple' : '' }} >

 @php
	$size = isset($size) ? $size : 'original'
@endphp

@if(isset($type))
    @php $url = $value ? asset('uploads/'.$type.'/'.$size.'/'. $value) : asset('assets/adminPanel/img/no-image.png') ; @endphp
    <img src="{{ $url }}" id="{{ $name }}-preview" class="mt-2 img-fluid img-thumbnail img-prev">
@else
 <img src="{{ $value ? asset('uploads/images/'.$size.'/'. $value) : asset('assets/adminPanel/img/no-image.png') }}" id="{{ $name }}-preview" class="mt-2 img-fluid img-thumbnail img-prev">
@endif
