
@php
  $activeLocale = old('activeLocale', 'general');
  $activeLocale = 'general';
@endphp

<div class="card-body">
  @include('general::layouts.includes.messages')

  {{-- Tabs --}}
  <ul class="nav nav-tabs" id="langsTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link {{ $activeLocale == 'general' ? 'active' : '' }}" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">
      {{ __('general::lang.general') }}</a>
    </li>
    @foreach ($langs as $lang)
      <li class="nav-item">
        <a class="nav-link {{ $activeLocale == $lang->locale ? 'active' : '' }}" id="{{ $lang->locale }}-tab" data-toggle="tab" href="#{{ $lang->locale }}"
          role="tab" aria-controls="{{ $lang->locale }}" aria-selected="false">
          {{ __('general::lang.'. $lang->locale) }}
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
            <label class="col-md-3 col-form-label" for="metatags_email">{{ __('general::lang.page') }}</label>
            <div class="col-md-9">
              {{ isset($metatag) ? $metatag->metatags_page : '' }}
              <input  type="hidden" name="metatags_page" value="{{ old('metatags_page', isset($metatag) ? $metatag->metatags_page : 'home') }}">
            </div>
          </div>


          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="metatags_position">{{ __('general::lang.position') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('metatags_position') ? 'is-invalid' : '' }}" id="metatags_position" type="text" name="metatags_position"
               placeholder="{{ __('general::lang.position') }}" value="{{ old('metatags_position', isset($metatag) ? $metatag->metatags_position : 1) }}">
              @if ($errors->first('metatags_position'))
                <div class="invalid-feedback">{{ $errors->first('metatags_position') }}</div>
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
            <p class="text-primary h6">{{ __('general::lang.metatagDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('general::lang.title') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.metatags_title') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[metatags_title]' }}" placeholder="{{ __('general::lang.title') }}"
                 value="{{ old($lang->locale .'.metatags_title', isset($metatag) && $metatag->translate($lang->locale) ? $metatag->translate($lang->locale)->metatags_title : '') }}">
                @if ($errors->first($lang->locale .'.metatags_title'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.metatags_title') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('general::lang.description') }}<span class="text-danger"> *</span></label>
              <div class="col-md-9">
                <textarea class="form-control {{ $errors->first($lang->locale .'.metatags_desc') ? 'is-invalid' : '' }}"
                 name="{{ $lang->locale .'[metatags_desc]' }}" rows="9" placeholder="{{ __('general::lang.description') }}"
                 >{{ old($lang->locale .'.metatags_desc', isset($metatag) && $metatag->translate($lang->locale) ? $metatag->translate($lang->locale)->metatags_desc : '') }}</textarea>
                @if ($errors->first($lang->locale .'.metatags_desc'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.metatags_desc') }}</div>
                @endif
              </div>
            </div>
          </div>

        </div>



      </div>
    @endforeach


  </div>
</div>
