@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.aboutProject') }}</li>
       <li class="breadcrumb-item">
        <a href="{{ route('admin.infos.show', [$info->infos_key, 'activeLocale' => $locale]) }}">
          @if($info->infos_key == 'about')
            {{ __('general::lang.aboutus') }}
          @elseif($info->infos_key == 'policy')
            {{ __('general::lang.privacyPolicy') }}
          @elseif($info->infos_key == 'terms')
            {{ __('general::lang.termsConditions') }}
          @elseif($info->infos_key == 'usage_policy')
            {{ __('general::lang.usagePolicy') }}
          @else
            {{ __('general::lang.infos') }}
          @endif
        </a>
      </li>
      <li class="breadcrumb-item  active">{{ __('general::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('general::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.infos.update', $info->infos_id) }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
          	@include('general::admin.infos.form')
	          <div class="card-footer">
              {{-- @can('view infos')
  	            <a href="{{ route('admin.infos.index') }}" class="btn btn-secondary btn-md">
  	              <i class="fa fa-arrow-left"></i>
                </a>
              @endcan --}}
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
