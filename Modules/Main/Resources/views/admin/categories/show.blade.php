@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
    <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.categories.index') }}">{{ __('main::lang.categories') }}</a>
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
                  <div class="col-12 col-md-10">{{ $category->categories_id }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $category->translate(old('activeLocale', $locale))->categories_name }}</div>
                </div>
              </li>

              <li class="list-group-item d-none">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.img') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <img src="{{ $category->categories_image ? asset($category->images_url($category->categories_image, 'medium','categories')) : asset('img/no-image.png') }}"
                     alt="img" class="img-fluid img-thumbnail" />
                  </div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $category->categories_position }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('main::lang.status_'. $category->categories_status) }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                <div class="col-12 col-md-2"><strong>{{ __('main::lang.seo_title') }}</strong></div>
                <div class="col-12 col-md-10">{{ $category->translate(old('activeLocale', $locale))->categories_seo_title}}</div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                <div class="col-12 col-md-2"><strong>{{ __('main::lang.seo_keyword') }}</strong></div>
                <div class="col-12 col-md-10">{{ $category->translate(old('activeLocale', $locale))->categories_seo_keyword}}</div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="row">
                <div class="col-12 col-md-2"><strong>{{ __('main::lang.seo_desc') }}</strong></div>
                <div class="col-12 col-md-10">{!! $category->translate(old('activeLocale', $locale))->categories_seo_desc !!}</div>
                </div>
            </li>

            </ul>
          </div>
          <div class="card-footer">
            @can('view categories')
              <a href="{{ route('admin.categories.index') }}" class="btn btn-md btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update categories')
              <a href="{{ route('admin.categories.edit', [$category->categories_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-md btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
