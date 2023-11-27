@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	    <li class="breadcrumb-item  active"> {{ __('main::lang.OurArticles') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.articles.index') }}">{{ __('main::lang.articles') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('main::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('main::lang.edit') }}</strong>
          </div>
          @if(isset($article))
          <form class="form-horizontal" action="{{ route('admin.articles.update', $article->articles_id) }}" method="post" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
          	@include('main::admin.articles.form')
	          <div class="card-footer">
              @can('view articles')
  	            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-secondary">
  	              <i class="fa fa-arrow-left"></i>
                </a>
              @endcan
              <button class="btn btn-sm btn-success" type="submit">
                <i class="fa fa-save"></i>
              </button>
	          </div>
          </form>
          @endif
        </div>
      </div>
    </div>
  </main>
@endsection
