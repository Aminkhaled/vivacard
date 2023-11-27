@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item"> <a href="{{ route('admin.advertisements.index') }}">{{ __('general::lang.advertisements') }}</a></li>
      <li class="breadcrumb-item  active">{{ __('general::lang.create') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('general::lang.create') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.advertisements.store') }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@include('general::admin.advertisements.form')
	          <div class="card-footer">
              @can('view advertisements')
                <a href="{{ route('admin.advertisements.index') }}" class="btn btn-secondary btn-md">
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
