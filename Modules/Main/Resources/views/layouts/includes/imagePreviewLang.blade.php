
<input class="form-control {{ $errors->first($lang .'.'.$name) ? 'is-invalid' : '' }}" id="{{ $lang.'['.$name.']' }}" type="file"
 name="{{ $lang.'['.$name.']' }}" onchange="readURL(this, '{{ $lang }}-{{ $name }}-preview')" {{ isset($multiple) ? 'multiple' : '' }} >

<img src="{{ $value ? asset('uploads/images/original/'. $value) : asset('assets/adminPanel/img/no-image.png') }}" id="{{ $lang }}-{{ $name }}-preview" class="mt-2 img-fluid img-thumbnail">

