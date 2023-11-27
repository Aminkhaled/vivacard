
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
            <label class="col-md-3 col-form-label" for="daily_offers_code">{{ __('main::lang.daily_offers_code') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('daily_offers_code') ? 'is-invalid' : '' }}" id="daily_offers_code" type="text" name="daily_offers_code"
               placeholder="{{ __('main::lang.daily_offers_code') }}" value="{{ old('daily_offers_code', isset($daily_offer) ? $daily_offer->daily_offers_code : '') }}">
              @if ($errors->first('daily_offers_code'))
                <div class="invalid-feedback">{{ $errors->first('daily_offers_code') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="stores_id">{{ __('main::lang.store') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              {!! Form::select('stores_id', $stores, isset($daily_offer) ? $daily_offer->stores_id : null, ['class' => $errors->first('stores_id') ? 'form-control is-invalid' : 'form-control','placeholder'=>__('main::lang.store'),'id'=>'stores_id']) !!}
              @if ($errors->first('stores_id'))
                <div class="invalid-feedback">{{ $errors->first('stores_id') }}</div>
              @endif
            </div>
          </div>
   
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="daily_offers_url">{{ __('main::lang.daily_offers_url') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('daily_offers_url') ? 'is-invalid' : '' }}" id="daily_offers_url" type="text" name="daily_offers_url"
               placeholder="{{ __('main::lang.daily_offers_url') }}" value="{{ old('daily_offers_url', isset($daily_offer) ? $daily_offer->daily_offers_url : '') }}">
              @if ($errors->first('daily_offers_url'))
                <div class="invalid-feedback">{{ $errors->first('daily_offers_url') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="daily_offers_price">{{ __('main::lang.daily_offers_price') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('daily_offers_price') ? 'is-invalid' : '' }}" id="daily_offers_price" type="number" min="0" step="0.01" name="daily_offers_price"
               placeholder="{{ __('main::lang.daily_offers_price') }}" value="{{ old('daily_offers_price', isset($daily_offer) ? $daily_offer->daily_offers_price : '') }}">
              @if ($errors->first('daily_offers_price'))
                <div class="invalid-feedback">{{ $errors->first('daily_offers_price') }}</div>
              @endif
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="daily_offers_price_before_sale">{{ __('main::lang.daily_offers_price_before_sale') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('daily_offers_price_before_sale') ? 'is-invalid' : '' }}" id="daily_offers_price_before_sale" type="number" min="0" step="0.01" name="daily_offers_price_before_sale"
               placeholder="{{ __('main::lang.daily_offers_price_before_sale') }}" value="{{ old('daily_offers_price_before_sale', isset($daily_offer) ? $daily_offer->daily_offers_price_before_sale : '') }}">
              @if ($errors->first('daily_offers_price_before_sale'))
                <div class="invalid-feedback">{{ $errors->first('daily_offers_price_before_sale') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="daily_offers_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('daily_offers_position') ? 'is-invalid' : '' }}" id="daily_offers_position" type="text" name="daily_offers_position"
               placeholder="{{ __('main::lang.position') }}" value="{{ old('daily_offers_position', isset($daily_offer) ? $daily_offer->daily_offers_position : 1) }}">
              @if ($errors->first('daily_offers_position'))
                <div class="invalid-feedback">{{ $errors->first('daily_offers_position') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-3 col-form-label" for="daily_offers_image">{{ __('main::lang.img') }}<span class="text-danger">  </span></label>
            <div class="col-md-9">
              @include('main::layouts.includes.imagePreview', ['name' => 'daily_offers_image', 'value' => isset($daily_offer) ? $daily_offer->daily_offers_image : null,'type'=>'daily_offers'])
              @if ($errors->first('daily_offers_image'))
                <div class="invalid-feedback">{{ $errors->first('daily_offers_image') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9 col-form-label">
              @php
                $status = old('daily_offers_status', isset($daily_offer) ? $daily_offer->daily_offers_status : 1);
              @endphp
              <input type="hidden" id="daily_offers_status_input" name="daily_offers_status" value="{{ $status }}">
              <input type="checkbox" name="daily_offers_statuss" id="daily_offers_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('daily_offers')">

              @if ($errors->first('daily_offers_status'))
                <div class="invalid-feedback">{{ $errors->first('daily_offers_status') }}</div>
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
            <p class="text-primary h6">{{ __('main::lang.daily_offerDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('main::lang.name') }}<span class="text-danger"> *</span></label>

              <div class="col-md-10">
                <input class="form-control {{ $errors->first($lang->locale .'.daily_offers_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[daily_offers_name]' }}" placeholder="{{ __('main::lang.name') }}"
                 value="{{ old($lang->locale .'.daily_offers_name', isset($daily_offer) ? $daily_offer->translate($lang->locale)->daily_offers_name : '') }}">
                @if ($errors->first($lang->locale .'.daily_offers_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.daily_offers_name') }}</div>
                @endif
              </div>
            </div>

          </div>
        </div>

      </div>
 
    @endforeach
  </div>
</div>
 
