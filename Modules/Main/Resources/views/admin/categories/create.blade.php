@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.categories.index') }}">{{ __('main::lang.categories') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('main::lang.create') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('main::lang.create') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@include('main::admin.categories.form')
 
	          <div class="card-footer">
              @can('view categories')
                <a href="{{ route('admin.categories.index') }}" class="btn btn-md btn-secondary">
                  <i class="fa fa-arrow-left"></i>
                </a>
              @endcan
              <button class="btn btn-md btn-success" type="submit">
                <i class="fa fa-save"></i>
              </button>
	          </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection
