@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.categories.index') }}">{{ __('main::lang.categories') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('main::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('main::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.categories.update', $category->categories_id) }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
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
