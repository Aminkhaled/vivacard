@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.connectWithUs') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.contacts.index') }}">{{ __('general::lang.contacts') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('general::lang.show') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ __('general::lang.show') }}
          </div>
          <div class="card-body">

            {{-- Operations Messages --}}
            @include('general::layouts.includes.messages')

            <ul class="list-group">

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.id') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contact->contacts_id }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.address') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contact->translate(old('activeLocale', $locale))->contacts_address }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.mobiles') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">+{{ env('country_code',90) }}{{ $contact->contacts_mobiles }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.email') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">{{ $contact->contacts_email }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.facebook') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">{{ $contact->contacts_facebook }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.twitter') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">{{ $contact->contacts_twitter }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.instagram') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">{{ $contact->contacts_instagram }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.snapchat') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">{{ $contact->contacts_snapchat }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.youtube') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">{{ $contact->contacts_youtube }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.whatsapp') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">+{{ env('country_code',90) }}{{ $contact->contacts_whatsapp }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.desc') }}</strong></div>
                  <div class="col-12 col-md-10">{!!  $contact->translate(old('activeLocale', $locale))->contacts_text !!}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            {{-- @can('view contacts')
              <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan --}}
            @can('update contacts')
              <a href="{{ route('admin.contacts.edit', [$contact->contacts_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
