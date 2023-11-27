@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active">{{ __('general::lang.settings') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.countries.index') }}">{{ __('main::lang.countries') }}</a>
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
                  <div class="col-12 col-md-10">{{ $country->countries_id }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.title') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $country->translate(old('activeLocale', $locale))->countries_name }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">
                    {{ __('main::lang.status_'.$country->countries_status) }}
                   </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $country->countries_position }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view countries')
              <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update countries')
              {{-- <a href="{{ route('admin.countries.edit', [$country->countries_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a> --}}
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
