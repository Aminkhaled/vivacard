@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('main::lang.OurArticles') }}</li>
	  <li class="breadcrumb-item  active">{{ __('main::lang.articles_categories') }}</li>
    </ol>

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('main::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.articles_categories.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create articles')
	                	<a href="{{ route('admin.articles_categories.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
                <div class="form-group col-12 col-md-1 text-center">
                </div>
                <div class="form-group col-12 col-md-6 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('main::lang.name') }}" value="{{ old('name') }}">
                </div>
                <div class="form-group col-12 col-md-2 text-center">
						      <select class="form-control" name="status">
						        <option value="">{{ __('main::lang.selectStatus') }}</option>
						        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('main::lang.active') }}</option>
						        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('main::lang.stopped') }}</option>
						      </select>
                </div>
                <div class="form-group col-12 col-md-2  ">
                	<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                	<button type="button" class="btn btn-secondary btn-sm search-reset"><i class="fa fa-ban"></i></button>
                </div>
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
          		<div class="col-12 col-md-3 text-center"><strong>{{ __('main::lang.name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.articles') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2  "><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
				@forelse ($articles_categories as $articles_category)
					@php
						$f = true;
					@endphp
        	@foreach ($articles_category->translations->sortBy('locale') as $articles_categoryTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $articles_category->articles_categories_id }}</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $articles_categoryTrans->locale }}</div>
		          			</div>
		          		</div>

                        <div class="col-xs-12 col-md-1 text-md-center">
                            @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.position') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $articles_category->articles_categories_position }}</div>
                                </div>
                            @endif
                        </div>

		          		<div class="col-12 col-md-3 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.name') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $articles_categoryTrans->articles_categories_name }}</div>
		          			</div>
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
		          			@if($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.articles') }}</strong></div>
			          				<div class="col-8 col-md-12">
			          					@can('view articles')
				          					<a href="{{ route('admin.articles.index', ['articles_category' => $articles_category->articles_categories_id]) }}"
				          						class="btn btn-info btn-sm">
				          							{{ __('main::lang.articles') }}
				          						</a>
		          						@endcan
			          				</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
			          				<div class="col-8 col-md-12">
                                        @can('update articles_categories')
                                            <input type="checkbox" name="articles_categories_status" id="articles_categories_status_{{ $articles_category->articles_categories_id }}"  {{ $articles_category->articles_categories_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('articles_categories','{{ $articles_category->articles_categories_id }}')">
                                        @else
                                            @if ($articles_category->articles_categories_status)
                                                <span class="badge badge-warning">{{ __('main::lang.active') }}</span>
                                            @else
                                                <span class="badge badge-secondary">{{ __('main::lang.stopped') }}</span>
                                            @endif
                                        @endcan

			          				</div>
			          			</div>
		          			@endif
		          		</div>
		          		<div class="col-12 col-md-2">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
		          					<form method="POST" action="{{ route('admin.articles_categories.destroy', $articles_category->articles_categories_id) }}">
		          						@csrf
		          						@method('DELETE')
		          						@can('view articles')
				          					<a href="{{ route('admin.articles_categories.show', [$articles_category->articles_categories_id, 'activeLocale' => $articles_categoryTrans->locale]) }}"
				          						class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
		          						@endcan
		          						@can('update articles')
				          					<a href="{{ route('admin.articles_categories.edit', [$articles_category->articles_categories_id, 'activeLocale' => $articles_categoryTrans->locale]) }}"
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

				{{ $articles_categories->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
@section('script')
<script>
	$('#buttun-imortCategories').click(function(){
		$(".loader").show();
        $("#overlayer").show();
		$('#imortCategories-form').submit();
	})
</script>
@endsection
