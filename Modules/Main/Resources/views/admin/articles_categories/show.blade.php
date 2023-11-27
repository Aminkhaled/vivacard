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
                  <div class="col-12 col-md-10">{{ $category->articles_categories_id }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $category->articles_categories_position }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $category->translate(old('activeLocale', $locale))->articles_categories_name }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('main::lang.status_'. $category->articles_categories_status) }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view articles')
              <a href="{{ route('admin.articles_categories.index') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update articles')
              <a href="{{ route('admin.articles_categories.edit', [$category->articles_categories_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-sm btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
