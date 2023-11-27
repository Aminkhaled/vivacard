@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('main::lang.home') }} </a></li>>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.customers.index') }}">{{ __('main::lang.customers')  }}</a>
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
                  <div class="col-12 col-md-10">{{ $customer->customers_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.customers_name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $customer->customers_name }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.email') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $customer->customers_email }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.customers_phone') }}</strong></div>
                  <div class="col-12 col-md-10" dir="ltr">{{ $customer->customers_country_code }}{{ $customer->customers_phone }}</div>
                </div>
              </li>

              {{-- <li class="list-group-item  ">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.customers_birthdate') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $customer->customers_birthdate }}</div>
                </div>
              </li> --}}


              {{-- <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.gender') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $customer->customers_gender ? __('main::lang.'. $customer->customers_gender) : '' }}</div>
                </div>
              </li> --}}


              {{-- <li class="list-group-item  ">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.country') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $customer->country ? $customer->country->countries_name : '' }}</div>
                </div>
              </li> --}}

              {{-- <li class="list-group-item  ">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.city') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $customer->city ? $customer->city->cities_name : '' }}</div>
                </div>
              </li> --}}

              <li class="list-group-item  ">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.created_at') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $customer->customers_created_at }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('main::lang.status_'. $customer->customers_status) }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view customers')
              <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update customers')
              <a href="{{ route('admin.customers.edit', $customer->customers_id) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
