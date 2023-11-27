
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


            <!-- position field  -->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="articles_categories_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
            <div class="col-md-6">
              <input class="form-control {{ $errors->first('articles_categories_position') ? 'is-invalid' : '' }}" id="articles_categories_position" type="text" name="articles_categories_position"
               placeholder="{{ __('main::lang.position') }}" value="{{ old('articles_categories_position', isset($category) ? $category->articles_categories_position : 1) }}">
              @if ($errors->first('articles_categories_position'))
                <div class="invalid-feedback">{{ $errors->first('articles_categories_position') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9 col-form-label">
                @php
                    $status = old('articles_categories_status', isset($category) ? $category->articles_categories_status : 1);
                @endphp
                <input type="hidden" id="articles_categories_status_input" name="articles_categories_status" value="{{ $status }}">
                <input type="checkbox" name="articles_categories_statuss" id="articles_categories_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('articles_categories')">
                {{-- <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="active" type="radio" value="1" name="articles_categories_status" {{ $status == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ __('main::lang.active') }}</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="stopped" type="radio" value="0" name="articles_categories_status" {{ $status == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="stopped">{{ __('main::lang.stopped') }}</label>
                </div> --}}
                @if ($errors->first('articles_categories_status'))
                    <div class="invalid-feedback">{{ $errors->first('articles_categories_status') }}</div>
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
            <p class="text-primary h6">{{ __('main::lang.articlesCategoryDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.name') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.articles_categories_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[articles_categories_name]' }}" placeholder="{{ __('main::lang.name') }}"
                 value="{{ old($lang->locale .'.articles_categories_name', isset($category) ? $category->translate($lang->locale)->articles_categories_name : '') }}">
                @if ($errors->first($lang->locale .'.articles_categories_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.articles_categories_name') }}</div>
                @endif
              </div>
            </div>


          </div>

        </div>

      </div>
    @endforeach
  </div>
</div>
