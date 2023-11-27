@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.connectWithUs') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.contactus.index') }}">{{ __('general::lang.contactus') }}</a>
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
            <ul class="list-group">
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.id') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_name }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.phone') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_phone }}</div>
                </div>
              </li>
               <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.email') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_email }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.date') }}</strong></div>
                  <div class="col-12 col-md-10">{{ Carbon\Carbon::parse($contactus->contact_us_created_at)->timezone(env('timezone','Africa/Cairo')) }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.message') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $contactus->contact_us_message }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.type') }}</strong></div>
                  <div class="col-12 col-md-10">
                    {{$contactus->contact_us_type ?  __('services::lang.'.$contactus->contact_us_type) : ''}}
                  </div>
                </div>
              </li>
              @if($contactus->order)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('services::lang.orders_id') }}</strong></div>
                  <div class="col-12 col-md-10">
                    {{$contactus->order->orders_id}}
                  </div>
                </div>
              </li>
              @endif
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">
                      @if ($contactus->contact_us_status == '0')
                        <span class="p-2 badge badge-warning">{{ __('general::lang.new') }}</span>
                      @else
                        <span class="p-2 badge badge-secondary">{{ __('general::lang.done') }}</span>
                      @endif
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            @can('view contactus')
              <a href="{{ route('admin.contactus.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
