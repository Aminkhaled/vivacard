
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

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="countries_id">{{ __('main::lang.country') }}<span class="text-danger"> *</span></label>
                <div class="col-md-9">
                    {!! Form::select('countries_id', $countries, isset($city) ? $city->countries_id : null, ['class' =>  $errors->first('countries_id') ? 'form-control is-invalid' : 'form-control','placeholder'=>__('main::lang.country'),'id'=>'countries_id']) !!}
                    @if ($errors->first('countries_id'))
                        <div class="invalid-feedback">{{ $errors->first('countries_id') }}</div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="cities_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
                <div class="col-md-9">
                <input class="form-control {{ $errors->first('cities_position') ? 'is-invalid' : '' }}" id="cities_position" type="text" name="cities_position"
                placeholder="{{ __('main::lang.position') }}" value="{{ old('cities_position', isset($city) ? $city->cities_position : 1) }}">
                @if ($errors->first('cities_position'))
                    <div class="invalid-feedback">{{ $errors->first('cities_position') }}</div>
                @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
                <div class="col-md-9 col-form-label">
                    @php
                    $status = old('cities_status', isset($city) ? $city->cities_status : 1);
                    @endphp

                    <input type="hidden" id="cities_status_input" name="cities_status" value="{{ $status }}">
                    <input type="checkbox" name="cities_statuss" id="cities_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('general::lang.active')}}" data-off=" {{__('general::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('cities')">

                @if ($errors->first('cities_status'))
                    <div class="invalid-feedback">{{ $errors->first('cities_status') }}</div>
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
            <p class="text-primary h6">{{ __('main::lang.cityDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.title') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.cities_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[cities_name]' }}" placeholder="{{ __('main::lang.title') }}"
                 value="{{ old($lang->locale .'.cities_name', isset($city) && $city->translate($lang->locale)  ? $city->translate($lang->locale)->cities_name : '') }}">
                @if ($errors->first($lang->locale .'.cities_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.cities_name') }}</div>
                @endif
              </div>
            </div>

          </div>

        </div>



      </div>
    @endforeach


  </div>
</div>
