@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
    <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.daily_offers.index') }}">{{ __('main::lang.daily_offers') }}</a>
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
                  <div class="col-12 col-md-10">{{ $daily_offer->daily_offers_id }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $daily_offer->translate(old('activeLocale', $locale))->daily_offers_name }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.store') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $daily_offer->store ? $daily_offer->store->stories_name  : ''}}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.daily_offers_price') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $daily_offer->daily_offers_price }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.daily_offers_price_before_sale') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $daily_offer->daily_offers_price_before_sale }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.daily_offers_url') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $daily_offer->daily_offers_url }}</div>
                </div>
              </li>

              <li class="list-group-item d-none">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.img') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <img src="{{ $daily_offer->daily_offers_image ? asset($daily_offer->images_url($daily_offer->daily_offers_image, 'medium','daily_offers')) : asset('img/no-image.png') }}"
                     alt="img" class="img-fluid img-thumbnail" />
                  </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $daily_offer->daily_offers_position }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('main::lang.status_'. $daily_offer->daily_offers_status) }}</div>
                </div>
              </li>

            </ul>
          </div>
          <div class="card-footer">
            @can('view daily_offers')
              <a href="{{ route('admin.daily_offers.index') }}" class="btn btn-md btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update daily_offers')
              <a href="{{ route('admin.daily_offers.edit', [$daily_offer->daily_offers_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-md btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
