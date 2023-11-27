
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
            <label class="col-md-3 col-form-label" for="coupons_code">{{ __('main::lang.coupons_code') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('coupons_code') ? 'is-invalid' : '' }}" id="coupons_code" type="text" name="coupons_code"
               placeholder="{{ __('main::lang.coupons_code') }}" value="{{ old('coupons_code', isset($coupon) ? $coupon->coupons_code : '') }}">
              @if ($errors->first('coupons_code'))
                <div class="invalid-feedback">{{ $errors->first('coupons_code') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="stores_id">{{ __('main::lang.store') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              {!! Form::select('stores_id', $stores, isset($coupon) ? $coupon->stores_id : null, ['class' => $errors->first('stores_id') ? 'form-control is-invalid' : 'form-control','placeholder'=>__('main::lang.store'),'id'=>'stores_id']) !!}
              @if ($errors->first('stores_id'))
                <div class="invalid-feedback">{{ $errors->first('stores_id') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="offers_id">{{ __('main::lang.offer') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              {!! Form::select('offers_id', $offers, isset($coupon) ? $coupon->offers_id : null, ['class' => $errors->first('offers_id') ? 'form-control is-invalid' : 'form-control','placeholder'=>__('main::lang.offer'),'id'=>'offers_id']) !!}
              @if ($errors->first('offers_id'))
                <div class="invalid-feedback">{{ $errors->first('offers_id') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="categories">{{ __('main::lang.categories') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              {!! Form::select('categories[]', $categories, isset($coupon) ? $coupon->categories : null, ['class' => $errors->first('categories') ? 'form-control is-invalid select2' : 'form-control select2','id'=>'categories','multiple'=>'multiple']) !!}
              @if ($errors->first('categories'))
                <div class="invalid-feedback">{{ $errors->first('categories') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="countries">{{ __('main::lang.countries') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              {!! Form::select('countries[]', $countries, isset($coupon) ? $coupon->countries : null, ['class' => $errors->first('offers_id') ? 'form-control is-invalid select2' : 'form-control select2','id'=>'countries','multiple'=>'multiple']) !!}
              @if ($errors->first('offers_id'))
                <div class="invalid-feedback">{{ $errors->first('countries') }}</div>
              @endif
            </div>
          </div>
   
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="coupons_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('coupons_position') ? 'is-invalid' : '' }}" id="coupons_position" type="text" name="coupons_position"
               placeholder="{{ __('main::lang.position') }}" value="{{ old('coupons_position', isset($coupon) ? $coupon->coupons_position : 1) }}">
              @if ($errors->first('coupons_position'))
                <div class="invalid-feedback">{{ $errors->first('coupons_position') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row ">
            <label class="col-md-3 col-form-label" for="coupons_image">{{ __('main::lang.img') }}<span class="text-danger">  </span></label>
            <div class="col-md-9">
              @include('main::layouts.includes.imagePreview', ['name' => 'coupons_image', 'value' => isset($coupon) ? $coupon->coupons_image : null,'type'=>'coupons'])
              @if ($errors->first('coupons_image'))
                <div class="invalid-feedback">{{ $errors->first('coupons_image') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9 col-form-label">
              @php
                $status = old('coupons_status', isset($coupon) ? $coupon->coupons_status : 1);
              @endphp
              <input type="hidden" id="coupons_status_input" name="coupons_status" value="{{ $status }}">
              <input type="checkbox" name="coupons_statuss" id="coupons_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('coupons')">

              @if ($errors->first('coupons_status'))
                <div class="invalid-feedback">{{ $errors->first('coupons_status') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label">{{ __('main::lang.available') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9 col-form-label">
              @php
                $available = old('coupons_available', isset($coupon) ? $coupon->coupons_available : 1);
              @endphp
              <input type="hidden" id="coupons_available_input" name="coupons_available" value="{{ $available }}">
              <input type="checkbox" name="coupons_availables" id="coupons_available"  {{ $available ? 'checked' : '' }}  data-on=" {{__('main::lang.available')}}" data-off=" {{__('main::lang.not_available')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="150px" onChange="changeToggleInput('coupons_available')">

              @if ($errors->first('coupons_available'))
                <div class="invalid-feedback">{{ $errors->first('coupons_available') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label">{{ __('main::lang.is_special') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9 col-form-label">
              @php
                $is_special = old('coupons_is_special', isset($coupon) ? $coupon->coupons_is_special : 1);
              @endphp
              <input type="hidden" id="coupons_is_special_input" name="coupons_is_special" value="{{ $is_special }}">
              <input type="checkbox" name="coupons_is_specials" id="coupons_is_special"  {{ $is_special ? 'checked' : '' }}  data-on=" {{__('main::lang.special')}}" data-off=" {{__('main::lang.not_special')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="150px" onChange="changeToggleInput('coupons_is_special')">

              @if ($errors->first('coupons_is_special'))
                <div class="invalid-feedback">{{ $errors->first('coupons_is_special') }}</div>
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
            <p class="text-primary h6">{{ __('main::lang.couponDetails') }}</p>

            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('main::lang.name') }}<span class="text-danger"> *</span></label>

              <div class="col-md-10">
                <input class="form-control {{ $errors->first($lang->locale .'.coupons_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[coupons_name]' }}" placeholder="{{ __('main::lang.name') }}"
                 value="{{ old($lang->locale .'.coupons_name', isset($coupon) ? $coupon->translate($lang->locale)->coupons_name : '') }}">
                @if ($errors->first($lang->locale .'.coupons_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.coupons_name') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('main::lang.coupons_long_name') }}<span class="text-danger"> </span></label>

              <div class="col-md-10">
                <input class="form-control {{ $errors->first($lang->locale .'.coupons_long_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[coupons_long_name]' }}" placeholder="{{ __('main::lang.coupons_long_name') }}"
                 value="{{ old($lang->locale .'.coupons_long_name', isset($coupon) ? $coupon->translate($lang->locale)->coupons_long_name : '') }}">
                @if ($errors->first($lang->locale .'.coupons_long_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.coupons_long_name') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('main::lang.coupons_desc') }}<span class="text-danger"> *</span></label>

              <div class="col-md-10">
                <textarea id="{{ $lang->locale }}-ckeditor2" class="ckeditor form-control {{ $errors->first($lang->locale .'.coupons_desc') ? 'is-invalid' : '' }}" type="text" rows="5" name="{{ $lang->locale .'[coupons_desc]' }}" placeholder="{{ __('main::lang.coupons_desc') }}">{{ old($lang->locale .'.coupons_desc', isset($coupon) && $coupon->translate($lang->locale)  ? $coupon->translate($lang->locale)->coupons_desc : '') }}</textarea>
                @if ($errors->first($lang->locale .'.coupons_desc'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.coupons_desc') }}</div>
                @endif
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('main::lang.coupons_offers_desc') }}<span class="text-danger"> </span></label>

              <div class="col-md-10">
                <textarea id="{{ $lang->locale }}-ckeditor2" class="ckeditor form-control {{ $errors->first($lang->locale .'.coupons_offers_desc') ? 'is-invalid' : '' }}" type="text" rows="5" name="{{ $lang->locale .'[coupons_offers_desc]' }}" placeholder="{{ __('main::lang.coupons_offers_desc') }}">{{ old($lang->locale .'.coupons_offers_desc', isset($coupon) && $coupon->translate($lang->locale)  ? $coupon->translate($lang->locale)->coupons_offers_desc : '') }}</textarea>
                @if ($errors->first($lang->locale .'.coupons_offers_desc'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.coupons_offers_desc') }}</div>
                @endif
              </div>
            </div>

          </div>
        </div>

      </div>
 
    @endforeach
  </div>
</div>
 
