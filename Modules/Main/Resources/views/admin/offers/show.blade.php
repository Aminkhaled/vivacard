@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.offers.index') }}">{{ __('main::lang.offers') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('main::lang.show') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ __('main::lang.show') }}
          </div>
          <div class="card-body">

            <ul class="list-group">

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.id') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $offer->offers_id }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.offers_name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $offer->translate(old('activeLocale', $locale))->offers_name }}</div>
                </div>
              </li>
 
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.img') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <img src="{{ $offer->offers_image ? asset($offer->images_url($offer->offers_image, 'medium','offers')) : asset('assets/adminPanel/img/no-image.png') }}" class="img-fluid img-thumbnail" />  
                  </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.offers_desc') }}</strong></div>
                  <div class="col-12 col-md-10">{!! $offer->translate(old('activeLocale', $locale))->offers_desc !!}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">
                    {{ __('main::lang.status_'.$offer->offers_status) }}
                   </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $offer->offers_position }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view offers')
              <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update offers')
              <a href="{{ route('admin.offers.edit', [$offer->offers_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
