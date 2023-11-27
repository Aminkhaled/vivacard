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
      <li class="breadcrumb-item  active">{{ __('general::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('general::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.special_screens.update', $info->infos_id) }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
          	@include('general::admin.special_screens.form')
	          <div class="card-footer">
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
