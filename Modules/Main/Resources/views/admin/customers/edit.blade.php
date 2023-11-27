@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('main::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.customers.index') }}">{{ __('main::lang.customers')  }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('main::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('main::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.customers.update', $customer->customers_id) }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
          	@include('main::admin.customers.form')
	          <div class="card-footer">
              @can('view customers')
  	            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary btn-md">
  	              <i class="fa fa-arrow-left"></i>
                </a>
              @endcan
              <button class="btn btn-success btn-md" type="submit">
                <i class="fa fa-save"></i>
              </button>
	          </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection
