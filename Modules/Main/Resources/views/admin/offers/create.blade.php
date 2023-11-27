@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.offers.index') }}">{{ __('main::lang.offers') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('main::lang.create') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('main::lang.create') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.offers.store') }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@include('main::admin.offers.form')
	          <div class="card-footer">
                @can('view offers')
                    <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary btn-md">
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
