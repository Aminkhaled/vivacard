@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.aboutProject') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.special_screens.index') }}">{{ __('general::lang.special_screens') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('general::lang.show') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">

        {{-- Operations Messages --}}
        @include('general::layouts.includes.messages')


        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ __('general::lang.show') }}
          </div>
          <div class="card-body">

            <ul class="list-group">


                <li class="list-group-item">
                    <div class="row">
                        <div class="col-12 col-md-2"><strong>{{ __('general::lang.title') }}</strong></div>
                        <div class="col-12 col-md-10">{!!  $info->translate(old('activeLocale', $locale))->infos_title  !!}</div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                    <div class="col-12 col-md-2"><strong>{{ __('general::lang.desc') }}</strong></div>
                    <div class="col-12 col-md-10">{!!  $info->translate(old('activeLocale', $locale))->infos_desc  !!}</div>
                    </div>
                </li>


                <li class="list-group-item d-none">
                    <div class="row">
                    <div class="col-12 col-md-2"><strong>{{ __('general::lang.status') }}</strong></div>
                    <div class="col-12 col-md-10">{{ __('general::lang.status_'. $info->infos_status) }}</div>
                    </div>
                </li>

            </ul>
          </div>
          <div class="card-footer">
            @can('view special_screens')
              <a href="{{ route('admin.special_screens.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update special_screens')
              <a href="{{ route('admin.special_screens.edit', [$info->infos_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>

        </div>
      </div>
    </div>
  </main>

@endsection
