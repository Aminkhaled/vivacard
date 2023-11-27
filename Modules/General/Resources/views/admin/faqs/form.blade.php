
@php
  $activeLocale = old('activeLocale', 'general');
  $activeLocale = 'general';
@endphp
<div class="card-body">
	@include('general::layouts.includes.messages')
  <div class="row">
    <div class="col-lg-9">
        <input type="hidden" name="faqs_type" value="website">
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
         
                 <!-- position field  -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="faqs_position">{{ __('general::lang.position') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-6">
                    <input class="form-control {{ $errors->first('faqs_position') ? 'is-invalid' : '' }}" id="faqs_position" type="text" name="faqs_position"
                    placeholder="{{ __('general::lang.position') }}" value="{{ old('faqs_position', isset($faq) ? $faq->faqs_position : 10000) }}">
                    @if ($errors->first('faqs_position'))
                        <div class="invalid-feedback">{{ $errors->first('faqs_position') }}</div>
                    @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ __('general::lang.status') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9 col-form-label">
                      @php
                        $status = old('faqs_status', isset($faq) ? $faq->faqs_status : 1);
                      @endphp
                       <input type="hidden" id="faqs_status_input" name="faqs_status" value="{{ $status }}">
                       <input type="checkbox" name="faqs_statuss" id="faqs_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('general::lang.active')}}" data-off=" {{__('general::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('faqs')">
                      @if ($errors->first('faqs_status'))
                        <div class="invalid-feedback">{{ $errors->first('faqs_status') }}</div>
                      @endif
                    </div>
                  </div>


              </div>
            </div>
          </div>

            {{-- Languages Tabs --}}
            @foreach ($langs as $lang)
            <div class="tab-pane fade {{ $activeLocale == $lang->locale ? 'show active' : '' }}" id="{{ $lang->locale }}" role="tabpanel" aria-labelledby="{{ $lang->locale }}-tab">

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="faqs_question">{{ __('general::lang.faqs_question') }}<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                      <input class="form-control {{ $errors->first($lang->locale .'.faqs_question') ? 'is-invalid' : '' }}" id="faqs_question" type="text" name="{{ $lang->locale .'[faqs_question]' }}" placeholder="{{ __('general::lang.faqs_question') }}"
                       value="{{ old($lang->locale .'.faqs_question', isset($faq) ? $faq->translate($lang->locale)->faqs_question : '') }}">
                      @if ($errors->first($lang->locale .'.faqs_question'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.faqs_question') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 col-form-label">{{ __('general::lang.faqs_answer') }}<span class="text-danger"> *</span></label>
                  <div class="col-md-10">
                    <textarea id="{{ $lang->locale }}-ckeditor" class="form-control ckeditor {{ $errors->first($lang->locale .'.faqs_answer') ? 'is-invalid' : '' }}"
                     name="{{ $lang->locale .'[faqs_answer]' }}" rows="9" placeholder="{{ __('general::lang.faqs_answer') }}"
                     >{{ old($lang->locale .'.faqs_answer', isset($faq) && $faq->translate($lang->locale) ? $faq->translate($lang->locale)->faqs_answer : '') }}</textarea>
                    @if ($errors->first($lang->locale .'.faqs_answer'))
                      <div class="invalid-feedback">{{ $errors->first($lang->locale .'.faqs_answer') }}</div>
                    @endif
                  </div>
                </div>

            </div>
          @endforeach

        </div>


    </div>
  </div>
</div>
 