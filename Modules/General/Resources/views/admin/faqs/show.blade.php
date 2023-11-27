@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item"> <a href="{{ route('admin.faqs.index') }}">{{ __('general::lang.faqs') }}</a></li>
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
                  <div class="col-12 col-md-10">{{ $faq->faqs_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $faq->faqs_position }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.faqs_question') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $faq->faqs_question }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.faqs_answer') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $faq->faqs_answer }}</div>
                </div>
              </li>
               
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('general::lang.status_'. $faq->faqs_status) }}</div>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            @can('view faqs')
              <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update faqs')
              <a href="{{ route('admin.faqs.edit', $faq->faqs_id) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
