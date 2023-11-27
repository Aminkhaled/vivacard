@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      @can('view admins')
      <li class="breadcrumb-item">
        <a href="{{ route('admin.admins.index') }}">{{ __('general::lang.admins') }}</a>
      </li>
      @endcan
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
                  <div class="col-12 col-md-10">{{ $admin->admins_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $admin->name }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.email') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $admin->email }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $admin->admins_position }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('general::lang.status_'. $admin->admins_status) }}</div>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            @can('view admins')
              <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
               <a href="{{ route('admin.admins.edit', $admin->admins_id) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
           </div>
        </div>
      </div>
    </div>
  </main>
@endsection
