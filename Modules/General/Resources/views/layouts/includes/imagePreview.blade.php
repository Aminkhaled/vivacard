
<input class="form-control {{ $errors->first($name) ? 'is-invalid' : '' }}" id="{{ $name }}" type="file"
 name="{{ $name }}" onchange="readURL(this, '{{ $name }}-preview')" {{ isset($multiple) ? 'multiple' : '' }} >

 <?php $type = isset($type) ? $type : 'images'; ?>
<img src="{{ $value ? asset('uploads/'.$type.'/original/'. $value) : asset('assets/adminPanel/img/no-image.png') }}" id="{{ $name }}-preview" class="mt-2 img-fluid img-thumbnail">
