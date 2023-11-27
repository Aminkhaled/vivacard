@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	    <li class="breadcrumb-item  active"> {{ __('main::lang.OurArticles') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.articles_categories.index') }}">{{ __('main::lang.articles_categories') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('main::lang.create') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('main::lang.create') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.articles_categories.store') }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@include('main::admin.articles_categories.form')

	          <div class="card-footer">
              @can('view articles_categories')
                <a href="{{ route('admin.articles_categories.index') }}" class="btn btn-sm btn-secondary">
                  <i class="fa fa-arrow-left"></i>
                </a>
              @endcan
              <button class="btn btn-sm btn-success" type="submit">
                <i class="fa fa-save"></i>
              </button>
	          </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection
