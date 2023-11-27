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
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.id') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $article->articles_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $article->articles_position }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.category') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $article->category ? $article->category->articles_categories_name : ''}}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.date') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $article->articles_date }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.title') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $article->translate(old('activeLocale', $locale))->articles_title}}</div>
                </div>
              </li>
 
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.desc') }}</strong></div>
                  <div class="col-12 col-md-10">{!! $article->translate(old('activeLocale', $locale))->articles_desc !!}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.seo_title') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $article->translate(old('activeLocale', $locale))->articles_seo_title}}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{  __('main::lang.seo_desc') }}</strong></div>
                  <div class="col-12 col-md-10">{{$article->translate(old('activeLocale', $locale))->articles_seo_desc  }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{__('main::lang.seo_keyword') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $article->translate(old('activeLocale', $locale))->articles_seo_keyword}}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.image') }}</strong></div>
                  <div class="col-12 col-md-3">
                    <a href="{{ $article->articles_image ? asset('uploads/articles/original/'. $article->articles_image) : asset('img/no-image.png') }}" target="_blank">
                        <img src="{{ $article->articles_image ? asset('uploads/articles/medium/'. $article->articles_image) : asset('img/no-image.png') }}"   class="mt-2 img-fluid img-thumbnail">
                    </a>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.articles_featured') }}</strong></div>
                  <div class="col-12 col-md-10">{{$article->articles_featured ?  __('main::lang.yes') : __('main::lang.no') }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.articles_views') }}</strong></div>
                  <div class="col-12 col-md-10">{{$article->articles_views  }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-lg-1 col-md-2"><strong>{{ __('main::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('main::lang.status_'. $article->articles_status) }}</div>
                </div>
              </li>


            </ul>
          </div>
          <div class="card-footer">
            @can('view articles')
              <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update articles')
              <a href="{{ route('admin.articles.edit', [$article->articles_id, 'activeLocale' => old('activeLocale', $locale)]) }}" class="btn btn-sm btn-warning">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
