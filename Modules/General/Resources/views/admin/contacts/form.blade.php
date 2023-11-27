
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
        <div class="col-lg-4">

          <div class="form-group row" >
            <label class="col-md-3 col-form-label" for="contacts_mobiles">{{ __('general::lang.mobiles') }}<span class="text-danger"> </span></label>
            <div class="col-md-9">
                <div class="input-group ltr" dir="ltr">
                    <input class="form-control {{ $errors->first('contacts_mobiles') ? 'is-invalid' : '' }}" dir="ltr" id="contacts_mobiles" type="text" name="contacts_mobiles" placeholder="{{ __('general::lang.mobiles') }}" value="{{ old('contacts_mobiles', isset($contact) ? $contact->contacts_mobiles : 1) }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text" dir="ltr">+{{ env('country_code',90) }}</span>
                    </div>
                </div>
              @if ($errors->first('contacts_mobiles'))
                <div class="invalid-feedback">{{ $errors->first('contacts_mobiles') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="contacts_email">{{ __('general::lang.email') }}<span class="text-danger"> </span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('contacts_email') ? 'is-invalid' : '' }}" dir="ltr" id="contacts_email" type="email" name="contacts_email"
               placeholder="{{ __('general::lang.email') }}" value="{{ old('contacts_email', isset($contact) ? $contact->contacts_email : 1) }}">
              @if ($errors->first('contacts_email'))
                <div class="invalid-feedback">{{ $errors->first('contacts_email') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="contacts_facebook">{{ __('general::lang.facebook') }}<span class="text-danger"> </span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('contacts_facebook') ? 'is-invalid' : '' }}" dir="ltr" id="contacts_facebook" type="text" name="contacts_facebook"
               placeholder="{{ __('general::lang.facebook') }}" value="{{ old('contacts_facebook', isset($contact) ? $contact->contacts_facebook : 1) }}">
              @if ($errors->first('contacts_facebook'))
                <div class="invalid-feedback">{{ $errors->first('contacts_facebook') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="contacts_twitter">{{ __('general::lang.twitter') }}<span class="text-danger"> </span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('contacts_twitter') ? 'is-invalid' : '' }}" dir="ltr" id="contacts_twitter" type="text" name="contacts_twitter"
               placeholder="{{ __('general::lang.twitter') }}" value="{{ old('contacts_twitter', isset($contact) ? $contact->contacts_twitter : 1) }}">
              @if ($errors->first('contacts_twitter'))
                <div class="invalid-feedback">{{ $errors->first('contacts_twitter') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="contacts_instagram">{{ __('general::lang.instagram') }}<span class="text-danger"> </span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('contacts_instagram') ? 'is-invalid' : '' }}" dir="ltr" id="contacts_instagram" type="text" name="contacts_instagram"
               placeholder="{{ __('general::lang.instagram') }}" value="{{ old('contacts_instagram', isset($contact) ? $contact->contacts_instagram : 1) }}">
              @if ($errors->first('contacts_instagram'))
                <div class="invalid-feedback">{{ $errors->first('contacts_instagram') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="contacts_snapchat">{{ __('general::lang.snapchat') }}<span class="text-danger"> </span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('contacts_snapchat') ? 'is-invalid' : '' }}" dir="ltr" id="contacts_snapchat" type="text" name="contacts_snapchat"
               placeholder="{{ __('general::lang.snapchat') }}" value="{{ old('contacts_snapchat', isset($contact) ? $contact->contacts_snapchat : 1) }}">
              @if ($errors->first('contacts_snapchat'))
                <div class="invalid-feedback">{{ $errors->first('contacts_snapchat') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="contacts_youtube">{{ __('general::lang.youtube') }}<span class="text-danger"> </span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('contacts_youtube') ? 'is-invalid' : '' }}" dir="ltr" id="contacts_youtube" type="text" name="contacts_youtube"
               placeholder="{{ __('general::lang.youtube') }}" value="{{ old('contacts_youtube', isset($contact) ? $contact->contacts_youtube : 1) }}">
              @if ($errors->first('contacts_youtube'))
                <div class="invalid-feedback">{{ $errors->first('contacts_youtube') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="contacts_whatsapp">{{ __('general::lang.whatsapp') }}<span class="text-danger"> </span></label>
            <div class="col-md-9">
                <div class="input-group mb-3">
                    <input class="form-control {{ $errors->first('contacts_whatsapp') ? 'is-invalid' : '' }}" dir="ltr" id="contacts_whatsapp" type="text" name="contacts_whatsapp" placeholder="{{ __('general::lang.whatsapp') }}" value="{{ old('contacts_whatsapp', isset($contact) ? $contact->contacts_whatsapp : 1) }}">
                    <div class="input-group-prepend">
                      <span class="input-group-text" dir="ltr">+{{ env('country_code',90) }}</span>
                    </div>
                </div>

              @if ($errors->first('contacts_whatsapp'))
                <div class="invalid-feedback">{{ $errors->first('contacts_whatsapp') }}</div>
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
            <p class="text-primary h6">{{ __('general::lang.address') }}</p>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('general::lang.address') }}<span class="text-danger">  </span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.contacts_address') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[contacts_address]' }}" placeholder="{{ __('general::lang.address') }}"
                 value="{{ old($lang->locale .'.contacts_address', isset($contact) && $contact->translate($lang->locale) ? $contact->translate($lang->locale)->contacts_address : '') }}">
                @if ($errors->first($lang->locale .'.contacts_address'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.contacts_address') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('general::lang.desc') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <textarea id="{{ $lang->locale }}-ckeditor" class="form-control ckeditor {{ $errors->first($lang->locale .'.contacts_text') ? 'is-invalid' : '' }}"
                  name="{{ $lang->locale .'[contacts_text]' }}" rows="9" placeholder="{{ __('general::lang.desc') }}"
                  >{{ old($lang->locale .'.contacts_text', isset($contact) && $contact->translate($lang->locale) ? $contact->translate($lang->locale)->contacts_text : '') }}</textarea>
                @if ($errors->first($lang->locale .'.contacts_text'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.contacts_text') }}</div>
                @endif
              </div>


            </div>

          </div>
        </div>




      </div>
    @endforeach
  </div>
</div>
