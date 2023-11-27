
@php
  $activeLocale = old('activeLocale', 'general');
  $activeLocale = 'general';
@endphp

<div class="card-body">
  @include('general::layouts.includes.messages')

  {{-- Tabs --}}
  <ul class="nav nav-tabs" id="langsTabs" role="tablist">
    <li class="nav-item d-none">
      <a class="nav-link " id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">
      {{ __('general::lang.general') }}</a>
    </li>
    @foreach ($langs as $lang)
      <li class="nav-item">
        <a class="nav-link {{  $loop->first ? 'active' : '' }}" id="{{ $lang->locale }}-tab" data-toggle="tab" href="#{{ $lang->locale }}"
          role="tab" aria-controls="{{ $lang->locale }}" aria-selected="false">
          {{ __('general::lang.'. $lang->locale) }}
        </a>
      </li>
    @endforeach
  </ul>

  {{-- Tabs Content --}}
  <div class="tab-content " id="langsTabsContent">
    <div class="tab-pane fade    " id="general" role="tabpanel" aria-labelledby="general-tab">
      <div class="row">
        <div class="col-lg-9">

          <div class="form-group row">
            <label class="col-md-3 col-form-label">{{ __('general::lang.status') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9 col-form-label">
              @php
                $status = old('infos_status', isset($info) ? $info->infos_status : 1);
              @endphp
              <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="active" type="radio" value="1" name="infos_status" {{ $status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="active">{{ __('general::lang.active') }}</label>
              </div>
              <div class="form-check form-check-inline mr-1">
                <input class="form-check-input" id="stopped" type="radio" value="0" name="infos_status" {{ $status == 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="stopped">{{ __('general::lang.stopped') }}</label>
              </div>
              @if ($errors->first('infos_status'))
                <div class="invalid-feedback">{{ $errors->first('infos_status') }}</div>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>
    {{-- Languages Tabs --}}
    @foreach ($langs as $lang)
    <div class="tab-pane fade {{   $loop->first ? 'show active' : '' }} " id="{{ $lang->locale }}" role="tabpanel" aria-labelledby="{{ $lang->locale }}-tab">


        <div class="row">

          <div class="col-lg-12">

              <div class="form-group row">
                <label class="col-md-2 col-form-label d-none">{{ __('general::lang.title') }}<span class="text-danger"> *</span></label>
                <div class="col-md-10">
                  <input type="hidden" id="infos_title" class="form-control {{ $errors->first($lang->locale .'.infos_title') ? 'is-invalid' : '' }}" name="{{ $lang->locale .'[infos_title]' }}" value="{{ old($lang->locale .'.infos_title', isset($info) && $info->translate($lang->locale) ? $info->translate($lang->locale)->infos_title : '') }}"  placeholder="{{ __('general::lang.title') }}">
                  @if ($errors->first($lang->locale .'.infos_title'))
                    <div class="invalid-feedback">{{ $errors->first($lang->locale .'.infos_title') }}</div>
                  @endif
                </div>
              </div>


          </div>

          <div class="col-lg-12">


              <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('general::lang.info_desc') }}<span class="text-danger"> *</span></label>
                <div class="col-md-10">
                  <textarea id="{{ $lang->locale }}-ckeditor" class="form-control ckeditor {{ $errors->first($lang->locale .'.infos_desc') ? 'is-invalid' : '' }}"
                   name="{{ $lang->locale .'[infos_desc]' }}" rows="9" placeholder="{{ __('general::lang.info_desc') }}"
                   >{{ old($lang->locale .'.infos_desc', isset($info) && $info->translate($lang->locale) ? $info->translate($lang->locale)->infos_desc : '') }}</textarea>
                  @if ($errors->first($lang->locale .'.infos_desc'))
                    <div class="invalid-feedback">{{ $errors->first($lang->locale .'.infos_desc') }}</div>
                  @endif
                </div>
              </div>


          </div>

        </div>



      </div>
    @endforeach
  </div>
</div>
