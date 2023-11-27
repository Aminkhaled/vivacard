
@php
  $activeLocale = old('activeLocale', 'general');
  $activeLocale = 'general';
@endphp

<div class="card-body">
  @include('main::layouts.includes.messages')

  {{-- Tabs --}}
  <ul class="nav nav-tabs" id="langsTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link {{ $activeLocale == 'general' ? 'active' : '' }}" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">
      {{ __('main::lang.general') }}</a>
    </li>
    @foreach ($langs as $lang)
      <li class="nav-item">
        <a class="nav-link {{ $activeLocale == $lang->locale ? 'active' : '' }}" id="{{ $lang->locale }}-tab" data-toggle="tab" href="#{{ $lang->locale }}"
          role="tab" aria-controls="{{ $lang->locale }}" aria-selected="false">
          {{ __('main::lang.'. $lang->locale) }}
        </a>
      </li>
    @endforeach
  </ul>

  {{-- Tabs Content --}}
  <div class="tab-content" id="langsTabsContent">
    <div class="tab-pane fade {{ $activeLocale == 'general' ? 'show active' : '' }}" id="general" role="tabpanel" aria-labelledby="general-tab">
      <div class="row">
        <div class="col-lg-9">
            
            <div class="form-group row ">
              <label class="col-md-2 col-form-label" for="offers_image">{{ __('main::lang.img') }}<span class="text-danger">  </span></label>
              <div class="col-md-10">
                @include('main::layouts.includes.imagePreview', ['name' => 'offers_image', 'value' => isset($offer) ? $offer->offers_image : null,'type'=>'offers'])
                @if ($errors->first('offers_image'))
                  <div class="invalid-feedback">{{ $errors->first('offers_image') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="offers_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
                <div class="col-md-3">
                <input class="form-control {{ $errors->first('offers_position') ? 'is-invalid' : '' }}" id="offers_position" type="text" name="offers_position"
                placeholder="{{ __('main::lang.position') }}" value="{{ old('offers_position', isset($offer) ? $offer->offers_position : 1) }}">
                @if ($errors->first('offers_position'))
                    <div class="invalid-feedback">{{ $errors->first('offers_position') }}</div>
                @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
                <div class="col-md-6 col-form-label">
                    @php
                    $status = old('offers_status', isset($offer) ? $offer->offers_status : 1);
                    @endphp

                    <input type="hidden" id="offers_status_input" name="offers_status" value="{{ $status }}">
                    <input type="checkbox" name="offers_statuss" id="offers_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('general::lang.active')}}" data-off=" {{__('general::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('offers')">

                @if ($errors->first('offers_status'))
                    <div class="invalid-feedback">{{ $errors->first('offers_status') }}</div>
                @endif
                </div>
            </div>


        </div>
      </div>
    </div>


    {{-- Languages Tabs --}}
    @foreach ($langs as $lang)
      <div class="tab-pane fade {{ $activeLocale == $lang->locale ? 'show active' : '' }}" id="{{ $lang->locale }}" role="tabpanel" aria-labelledby="{{ $lang->locale }}-tab">

        <div class="row">

          <div class="col-lg-9">
            <p class="text-primary h6">{{ __('main::lang.offerDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('main::lang.offers_name') }}<span class="text-danger"> *</span></label>

              <div class="col-md-6">
                <input class="form-control {{ $errors->first($lang->locale .'.offers_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[offers_name]' }}" placeholder="{{ __('main::lang.offers_name') }}"
                 value="{{ old($lang->locale .'.offers_name', isset($offer) && $offer->translate($lang->locale)  ? $offer->translate($lang->locale)->offers_name : '') }}">
                @if ($errors->first($lang->locale .'.offers_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.offers_name') }}</div>
                @endif
              </div>
            </div>
         
            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('main::lang.offers_desc') }}<span class="text-danger"> *</span></label>

                <div class="col-md-10">
                  <textarea id="{{ $lang->locale }}-ckeditor" class="ckeditor form-control {{ $errors->first($lang->locale .'.offers_desc') ? 'is-invalid' : '' }}" type="text" rows="5" name="{{ $lang->locale .'[offers_desc]' }}" placeholder="{{ __('main::lang.offers_desc') }}">{{ old($lang->locale .'.offers_desc', isset($offer) && $offer->translate($lang->locale)  ? $offer->translate($lang->locale)->offers_desc : '') }}</textarea>
                  @if ($errors->first($lang->locale .'.offers_desc'))
                    <div class="invalid-feedback">{{ $errors->first($lang->locale .'.offers_desc') }}</div>
                  @endif
                </div>
            </div>

          </div>

        </div>



      </div>
    @endforeach


  </div>
</div>
