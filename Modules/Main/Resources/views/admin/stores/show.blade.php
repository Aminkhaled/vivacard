@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.stores.index') }}">{{ __('main::lang.stores') }}</a>
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
                  <div class="col-12 col-md-10">{{ $store->stores_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.stores_code') }}</strong></div>
                  <div class="col-12 col-md-10">{{$store->stores_code}}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.stores_name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $store->translate(old('activeLocale', $locale))->stores_name }}</div>
                </div>
              </li>
              
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.stores_logo') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <img src="{{ $store->stores_logo ? asset($store->images_url($store->stores_logo, 'medium','stores')) : asset('assets/adminPanel/img/no-image.png') }}" class="img-fluid img-thumbnail"  />  
                  </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.stores_link') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <a href="{{ $store->stores_link }}" target="_blank">{{ $store->stores_link }}</a>
                  </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.stores_desc') }}</strong></div>
                  <div class="col-12 col-md-10">{!! $store->translate(old('activeLocale', $locale))->stores_desc !!}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">
                    {{ __('main::lang.status_'.$store->stores_status) }}
                   </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $store->stores_position }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view stores')
              <a href="{{ route('admin.stores.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update stores')
              <a href="{{ route('admin.stores.edit', [$store->stores_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
