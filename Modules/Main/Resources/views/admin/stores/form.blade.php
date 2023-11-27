
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
              <label class="col-md-2 col-form-label" for="stores_code">{{ __('main::lang.stores_code') }}<span class="text-danger"> *</span></label>
              <div class="col-md-6">
              <input class="form-control {{ $errors->first('stores_code') ? 'is-invalid' : '' }}" id="stores_code" type="text" name="stores_code" placeholder="{{ __('main::lang.stores_code') }}" value="{{ old('stores_code', isset($store) ? $store->stores_code : '') }}">
              @if ($errors->first('stores_code'))
                  <div class="invalid-feedback">{{ $errors->first('stores_code') }}</div>
              @endif
              </div>
            </div>
            
            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="stores_link">{{ __('main::lang.stores_link') }}<span class="text-danger"> *</span></label>
                <div class="col-md-6">
                <input class="form-control {{ $errors->first('stores_link') ? 'is-invalid' : '' }}" id="stores_link" type="url" name="stores_link" placeholder="{{ __('main::lang.stores_link') }}" value="{{ old('stores_link', isset($store) ? $store->stores_link : '') }}">
                @if ($errors->first('stores_link'))
                    <div class="invalid-feedback">{{ $errors->first('stores_link') }}</div>
                @endif
                </div>
            </div>

            
            <div class="form-group row ">
              <label class="col-md-2 col-form-label" for="stores_logo">{{ __('main::lang.stores_logo') }}<span class="text-danger">  </span></label>
              <div class="col-md-10">
                @include('main::layouts.includes.imagePreview', ['name' => 'stores_logo', 'value' => isset($store) ? $store->stores_logo : null,'type'=>'stores'])
                @if ($errors->first('stores_logo'))
                  <div class="invalid-feedback">{{ $errors->first('stores_logo') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="stores_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
                <div class="col-md-3">
                <input class="form-control {{ $errors->first('stores_position') ? 'is-invalid' : '' }}" id="stores_position" type="text" name="stores_position"
                placeholder="{{ __('main::lang.position') }}" value="{{ old('stores_position', isset($store) ? $store->stores_position : 1) }}">
                @if ($errors->first('stores_position'))
                    <div class="invalid-feedback">{{ $errors->first('stores_position') }}</div>
                @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
                <div class="col-md-6 col-form-label">
                    @php
                    $status = old('stores_status', isset($store) ? $store->stores_status : 1);
                    @endphp

                    <input type="hidden" id="stores_status_input" name="stores_status" value="{{ $status }}">
                    <input type="checkbox" name="stores_statuss" id="stores_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('general::lang.active')}}" data-off=" {{__('general::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('stores')">

                @if ($errors->first('stores_status'))
                    <div class="invalid-feedback">{{ $errors->first('stores_status') }}</div>
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
            <p class="text-primary h6">{{ __('main::lang.storeDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('main::lang.stores_name') }}<span class="text-danger"> *</span></label>

              <div class="col-md-6">
                <input class="form-control {{ $errors->first($lang->locale .'.stores_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[stores_name]' }}" placeholder="{{ __('main::lang.stores_name') }}"
                 value="{{ old($lang->locale .'.stores_name', isset($store) && $store->translate($lang->locale)  ? $store->translate($lang->locale)->stores_name : '') }}">
                @if ($errors->first($lang->locale .'.stores_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.stores_name') }}</div>
                @endif
              </div>
            </div>
         
            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('main::lang.stores_desc') }}<span class="text-danger"> *</span></label>

                <div class="col-md-10">
                  <textarea id="{{ $lang->locale }}-ckeditor" class="ckeditor form-control {{ $errors->first($lang->locale .'.stores_desc') ? 'is-invalid' : '' }}" type="text" rows="5" name="{{ $lang->locale .'[stores_desc]' }}" placeholder="{{ __('main::lang.stores_desc') }}">{{ old($lang->locale .'.stores_desc', isset($store) && $store->translate($lang->locale)  ? $store->translate($lang->locale)->stores_desc : '') }}</textarea>
                  @if ($errors->first($lang->locale .'.stores_desc'))
                    <div class="invalid-feedback">{{ $errors->first($lang->locale .'.stores_desc') }}</div>
                  @endif
                </div>
            </div>

          </div>

        </div>



      </div>
    @endforeach


  </div>
</div>
