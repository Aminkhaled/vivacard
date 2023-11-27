@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('main::lang.OurArticles') }}</li>
	  <li class="breadcrumb-item  active">{{ __('main::lang.articles') }}</li>
    </ol>

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('general::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.articles.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create articles')
	                	<a href="{{ route('admin.articles.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="text" name="title" placeholder="{{ __('main::lang.title') }}" value="{{ old('title') }}">
                </div>
				<div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="date" name="date" placeholder="{{ __('main::lang.date') }}" value="{{ old('date') }}">
                </div>
                <div class="form-group col-12 col-md-2 text-center">
					<select class="form-control" name="status">
						<option value="">{{ __('main::lang.selectStatus') }}</option>
						<option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('main::lang.active') }}</option>
						<option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('main::lang.stopped') }}</option>
					</select>
                </div>
				<div class="form-group col-12 col-md-2 text-center">
					<select class="form-control" name="articles_featured">
						<option value="">{{ __('main::lang.articles_featured') }}</option>
						<option value="1" {{ old('articles_featured') === '1' ? 'selected' : '' }}>{{ __('main::lang.yes') }}</option>
						<option value="0" {{ old('articles_featured') === '0' ? 'selected' : '' }}>{{ __('main::lang.no') }}</option>
					</select>
                </div>
               
                <div class="form-group col-12 col-md-2  ">
                	<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                	<button type="button" class="btn btn-secondary btn-sm search-reset"><i class="fa fa-ban"></i></button>
                </div>
              </div>
              <div class="card row">
				<div class="card-header col-12"><h4 class="fb-700"> {{__('main::lang.articlesCount')}}  : 	  {{$count_articles}} </h4></div>
			  </div>
              <!-- /.row-->
            </form>
          </div>
        </div>

      	{{-- Header Section --}}
        <div class="card d-none d-md-block">
          <div class="card-header">
          	<div class="row">
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.id') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.locale') }}</strong></div>
				<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.position') }}</strong></div>
				<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.date') }}</strong></div>
				<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.category') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.title') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.image') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.articles_featured') }}</strong></div>
          		<div class="col-12 col-md-2 "><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
		@forelse ($articles as $article)
			@php
				$f = true;
			@endphp
        	@foreach ($article->translations->sortBy('locale') as $articleTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">

					  	<!-- for id -->
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $article->articles_id }}</div>
			          			</div>
		          			@endif
		          		</div>

					  	<!-- for locale -->
						<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $articleTrans->locale }}</div>
		          			</div>
		          		</div>
                        <!-- for position -->
                        <div class="col-12 col-md-1 text-md-center">
                            @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.position') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $article->articles_position }}</div>
                                </div>
                            @endif
                        </div>
						<!-- for date -->
						<div class="col-12 col-md-1 text-md-center">
							@if ($f)
								<div class="row mb-2 mb-md-0">
									<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.date') }}</strong></div>
									<div class="col-8 col-md-12">{{ $article->articles_date }}</div>
								</div>
							@endif
		          		</div>

						  <!-- for category -->
						<div class="col-12 col-md-1 text-md-center">
							@if ($f)
								<div class="row mb-2 mb-md-0">
									<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.category') }}</strong></div>
									<div class="col-8 col-md-12">{{ $article->category ? $article->category->articles_categories_name : '' }}</div>
								</div>
							@endif
						</div>

						<!-- for title -->
						<div class="col-12 col-md-2 text-md-center">
							<div class="row mb-2 mb-md-0">
								<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.title') }}</strong></div>
								<div class="col-8 col-md-12">{{ $articleTrans->articles_title }}</div>
							</div>
		          		</div>

						<!-- for image -->
						<div class="col-12 col-md-1 text-md-center">
							@if ($f)
								<div class="row mb-2 mb-md-0">
									<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.image') }}</strong></div>
									<div class="col-8 col-md-12">
										<img src="{{ $article->articles_image ? asset($article->images_url($article->articles_image, 'thumbnail','articles')) : asset('img/no-image.png') }}" alt="" width="50px"  >
									</div>
								</div>
							@endif
		          		</div>

		          		<!-- for status -->
						<div class="col-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
			          				<div class="col-8 col-md-12">
                                        @can('update articles')
                                            <input type="checkbox" name="articles_status" id="articles_status_{{ $article->articles_id }}"  {{ $article->articles_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('articles','{{ $article->articles_id }}')">
                                        @else
                                            @if ($article->articles_status)
                                                <span class="badge badge-warning">{{ __('main::lang.active') }}</span>
                                            @else
                                                <span class="badge badge-secondary">{{ __('main::lang.stopped') }}</span>
                                            @endif
                                        @endcan
			          				</div>
			          			</div>
		          			@endif
		          		</div>
                        <div class="col-12 col-md-1 text-md-center">
                            @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.articles_featured') }}</strong></div>
                                    <div class="col-8 col-md-12">
                                      @can('update articles')
                                          <input type="checkbox" class="articles_featured_input" name="articles_featured" id="articles_featured{{ $article->articles_id }}"  {{ $article->articles_featured ? 'checked' : '' }}  data-on=" {{__('main::lang.yes')}}" data-off=" {{__('main::lang.no')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('articles_featured','{{ $article->articles_id }}')">
                                      @else
                                          @if ($article->articles_featured)
                                              <span class="badge badge-warning">{{ __('main::lang.yes') }}</span>
                                          @else
                                              <span class="badge badge-secondary">{{ __('main::lang.no') }}</span>
                                          @endif
                                      @endcan
                                    </div>
                                </div>
                            @endif
                        </div>
						<!-- for actions -->
		          		<div class="col-12 col-md-2">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
		          					<form method="POST" action="{{ route('admin.articles.destroy', $article->articles_id) }}">
		          						@csrf
		          						@method('DELETE')
		          						@can('view articles')
				          					<a href="{{ route('admin.articles.show', [$article->articles_id, 'activeLocale' => $articleTrans->locale]) }}"
				          						class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
		          						@endcan
		          						@can('update articles')
				          					<a href="{{ route('admin.articles.edit', [$article->articles_id, 'activeLocale' => $articleTrans->locale]) }}"
				          						class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
		          						@endcan
			          					@if ($f)
			          						@can('delete articles')
			          							<button type="submit" class="btn btn-danger btn-sm delete-form">
			          								<i class="fa fa-trash"></i>
			          							</button>
			          						@endcan
			          					@endif
                                        
		          					</form>
		          				</div>
		          			</div>
		          		</div>

		          	</div>
		          </div>
		        </div>
		        @php
		        	$f = false;
		        @endphp
        	@endforeach
				@empty
	        <div class="card">
	          <div class="card-body text-center text-danger">
	          	{{ __('main::lang.noData') }}
	          </div>
	        </div>
		@endforelse

		{{ $articles->appends(request()->except('page'))->links() }}

      </div>
    </div>
  </main>
@endsection

@section('script')
<script>
	$('#buttun-imortBrands').click(function(){
		$(".loader").show();
        $("#overlayer").show();
		$('#imortBrands-form').submit();
	})
</script>
@endsection


