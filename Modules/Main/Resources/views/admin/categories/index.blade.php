@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
	  <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('main::lang.categories') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('main::layouts.includes.messages')
		  {{--  Import Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.categories.import') }}" id="imortCategories-form" method="post" enctype="multipart/form-data">
			@csrf
              <div class="row">

                <div class="form-group col-12 col-md-6 text-center">
                  <input class="form-control" type="file" name="file" placeholder="{{ __('main::lang.chooseFile') }}"  >
                </div>

                <div class="form-group col-12 col-md-2 text-right  ">
                	<button type="buttun" id="buttun-imortCategories" class="btn btn-primary btn-md"><i class="fa fa-file"></i> {{__('main::lang.import')}}</button>
                 </div>
				 <div class="form-group col-12 col-md-2 text-left ">
                	<a href="{{route('admin.categories.export')}}"   class="btn btn-success btn-md"> {{__('main::lang.example')}}</a>
                 </div>
              </div>
              <!-- /.row-->
            </form>
          </div>
        </div>

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.categories.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create categories')
	                	<a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
                <div class="form-group col-12 col-md-3 text-center">
					<input class="form-control" type="text" name="categories_code" placeholder="{{ __('main::lang.categories_code') }}" value="{{ old('categories_code') }}">
                </div>
				<div class="form-group col-12 col-md-2 text-center">
					<select class="form-control selectCategory select2 p-0"
							id="categories" name="parent" placeholder="{{ __('main::lang.category') }}">
						<option value=""></option>
						@foreach ($categoryForSelect as $category)
						@if(!$category->isLeaf())
							<option value="{{ $category->categories_id }}" {{ old('parent') == $category->categories_id ? 'selected' : '' }}>
								{{ $category->categories_name }}
							</option>
						@endif
						@endforeach
					</select>
				</div>
                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('main::lang.name') }}" value="{{ old('name') }}">
                </div>

                <div class="form-group col-12 col-md-2 text-center">
					<select class="form-control" name="status">
						<option value="">{{ __('main::lang.selectStatus') }}</option>
						<option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('main::lang.active') }}</option>
						<option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('main::lang.stopped') }}</option>
					</select>
                </div>
                <div class="form-group col-12 col-md-2">
                	<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-search"></i></button>
                	<button type="button" class="btn btn-secondary btn-md search-reset"><i class="fa fa-ban"></i></button>
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
          		<div class="col-12 col-md-1 text-center d-none"><strong>{{ __('main::lang.id') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.categories_code') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.position') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.category') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.locale') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2"><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
				@forelse ($categories as $category)
					@php
						$f = true;
					@endphp
        	@foreach ($category->translations->sortBy('locale') as $categoryTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center d-none">
		          			@if ($f)
                              <a href="{{ route('admin.categories.show', [$category->categories_id, 'activeLocale' => $categoryTrans->locale]) }}">
			          			<div class="row mb-2 mb-md-0  h-100 ">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.id') }}</strong></div>
                                        <div class="col-8 col-md-12">
                                            {{ $category->categories_id }}
                                        </div>
                                    </div>
                                </a>
                            @endif
		          		</div>

		          		<div class="col-xs-12 col-md-2 text-md-center">
		          			@if ($f)
                                <a href="{{ route('admin.categories.show', [$category->categories_id, 'activeLocale' => $categoryTrans->locale]) }}">
                                    <div class="row mb-2 mb-md-0 h-100">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.categories_code') }}</strong></div>
                                        <div class="col-8 col-md-12"> {{ $category->categories_code }}</div>
                                    </div>
                                </a>
		          			@endif
		          		</div>
                        <div class="col-xs-12 col-md-1 text-md-center">
                            @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.position') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $category->categories_position }}</div>
                                </div>
                            @endif
                        </div>
						<div class="col-12 col-md-2 text-md-center">
                                @if($f)
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.category') }}</strong></div>
                                        <div class="col-8 col-md-12">
                                            @if($category->isRoot())
                                                <i class="fa fa-circle"></i>
                                            @else
                                                @php
                                                    $parents = $category->getAncestors()->pluck('categories_name')->toArray();
                                                @endphp
                                                @foreach ($parents as $parent)
                                                    @if($loop->last)
                                                        {{ $parent }}
                                                    @else
                                                        {{ $parent }} =>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
		          		<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $categoryTrans->locale }}</div>
		          			</div>
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
                            <a href="{{ route('admin.categories.show', [$category->categories_id, 'activeLocale' => $categoryTrans->locale]) }}">
		          			<div class="row mb-2 mb-md-0 h-100">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.name') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $categoryTrans->categories_name }}</div>
		          			</div>
                            </a>
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
			          				<div class="col-8 col-md-12">
                                        @can('update categories')
                                            <input type="checkbox" name="categories_status" id="categories_status_{{ $category->categories_id }}"  {{ $category->categories_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('categories','{{ $category->categories_id }}')">
                                        @else
                                            @if ($category->categories_status)
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
		          					<form method="POST" action="{{ route('admin.categories.destroy', $category->categories_id) }}">
		          						@csrf
		          						@method('DELETE')
		          						{{-- @can('view categories')
				          					<a href="{{ route('admin.categories.show', [$category->categories_id, 'activeLocale' => $categoryTrans->locale]) }}"
				          						class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
		          						@endcan --}}
		          						@can('update categories')
				          					<a href="{{ route('admin.categories.edit', [$category->categories_id, 'activeLocale' => $categoryTrans->locale]) }}"
				          						class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
		          						@endcan
			          					@if ($f)
			          						@can('delete categories')
			          							<button type="submit" class="btn btn-danger btn-md delete-form">
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

				{{ $categories->appends(request()->except('page'))->links() }}
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
