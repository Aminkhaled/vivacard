@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
    <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.coupons.index') }}">{{ __('main::lang.coupons') }}</a>
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
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.coupons_code') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $coupon->coupons_code }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $coupon->translate(old('activeLocale', $locale))->coupons_name }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.store') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $coupon->store ? $coupon->store->stores_name  : ''}} </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.offer') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $coupon->offer ? $coupon->offer->offers_name  : ''}}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.categories') }}</strong></div>
                  <div class="col-12 col-md-10">
                    @foreach($coupon->categories as $category)
                    <span class="badge badge-info"> {{$category->categories_name}} </span>
                    @endforeach
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.countries') }}</strong></div>
                  <div class="col-12 col-md-10">
                    @foreach($coupon->countries as $country)
                    <span class="badge badge-info"> {{$country->countries_name}} </span>
                    @endforeach
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.coupons_click_counts') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $coupon->coupons_click_counts }}</div>
                </div>
              </li>

              <li class="list-group-item d-none">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.img') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <img src="{{ $coupon->coupons_image ? asset($coupon->images_url($coupon->coupons_image, 'medium','coupons')) : asset('img/no-image.png') }}"
                     alt="img" class="img-fluid img-thumbnail" />
                  </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $coupon->coupons_position }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">
                    @if ($coupon->coupons_status)
                      <span class="badge badge-warning">{{ __('main::lang.active') }}</span>
                    @else
                      <span class="badge badge-secondary">{{ __('main::lang.stopped') }}</span>
                    @endif
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.availability') }}</strong></div>
                  <div class="col-12 col-md-10">
                    @if ($coupon->coupons_available)
                      <span class="badge badge-warning">{{ __('main::lang.available') }}</span>
                    @else
                      <span class="badge badge-secondary">{{ __('main::lang.not_available') }}</span>
                    @endif
                  </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.is_special') }}</strong></div>
                  <div class="col-12 col-md-10">
                    @if ($coupon->coupons_is_special)
                      <span class="badge badge-warning">{{ __('main::lang.special') }}</span>
                    @else
                      <span class="badge badge-secondary">{{ __('main::lang.not_special') }}</span>
                    @endif  
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            @can('view coupons')
              <a href="{{ route('admin.coupons.index') }}" class="btn btn-md btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update coupons')
              <a href="{{ route('admin.coupons.edit', [$coupon->coupons_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-md btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
