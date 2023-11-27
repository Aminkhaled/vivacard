@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.aboutProject') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.metatags.index') }}">{{ __('general::lang.metatags') }}</a>
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
                  <div class="col-12 col-md-10">{{ $metatag->metatags_id }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.page') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $metatag->metatags_page }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.title') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $metatag->translate(old('activeLocale', $locale))->metatags_title }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.description') }}</strong></div>
                  <div class="col-12 col-md-10">{!!  $metatag->translate(old('activeLocale', $locale))->metatags_desc  !!}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $metatag->metatags_position }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view metatags')
              <a href="{{ route('admin.metatags.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update metatags')
              <a href="{{ route('admin.metatags.edit', [$metatag->metatags_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
