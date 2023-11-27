
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


            <!-- image field  -->
            <div class="form-group row">
              <label class="col-md-2 col-form-label" for="countries_image">{{ __('main::lang.img') }}<span class="text-danger"> *</span></label>
                <div class="col-md-6">
                @include('main::layouts.includes.imagePreview', ['name' => 'countries_image', 'value' => isset($country) ? $country->countries_image : null,'type' => 'countries'])
                @if ($errors->first('countries_image'))
                    <div class="invalid-feedback">{{ $errors->first('countries_image') }}</div>
                @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="countries_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
                <div class="col-md-9">
                <input class="form-control {{ $errors->first('countries_position') ? 'is-invalid' : '' }}" id="countries_position" type="text" name="countries_position"
                placeholder="{{ __('main::lang.position') }}" value="{{ old('countries_position', isset($country) ? $country->countries_position : 1) }}">
                @if ($errors->first('countries_position'))
                    <div class="invalid-feedback">{{ $errors->first('countries_position') }}</div>
                @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
                <div class="col-md-9 col-form-label">
                    @php
                    $status = old('countries_status', isset($country) ? $country->countries_status : 1);
                    @endphp

                    <input type="hidden" id="countries_status_input" name="countries_status" value="{{ $status }}">
                    <input type="checkbox" name="countries_statuss" id="countries_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('general::lang.active')}}" data-off=" {{__('general::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('countries')">

                @if ($errors->first('countries_status'))
                    <div class="invalid-feedback">{{ $errors->first('countries_status') }}</div>
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
            <p class="text-primary h6">{{ __('main::lang.countryDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.title') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.countries_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[countries_name]' }}" placeholder="{{ __('main::lang.title') }}"
                 value="{{ old($lang->locale .'.countries_name', isset($country) && $country->translate($lang->locale)  ? $country->translate($lang->locale)->countries_name : '') }}">
                @if ($errors->first($lang->locale .'.countries_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.countries_name') }}</div>
                @endif
              </div>
            </div>

          </div>

        </div>



      </div>
    @endforeach


  </div>
</div>
