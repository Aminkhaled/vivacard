@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.aboutProject') }}</li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.special_screens') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('general::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.special_screens.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center"></div>
                <div class="form-group col-12 col-md-1 text-center">
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="text" name="key" placeholder="{{ __('general::lang.title') }}" value="{{ old('key') }}">
                </div>
                <div class="form-group col-12 col-md-4 text-center">
                  <input class="form-control" type="text" name="value" placeholder="{{ __('general::lang.desc') }}" value="{{ old('value') }}">
                </div>
                <div class="form-group col-12 col-md-2 text-center d-none">
				      <select class="form-control" name="status">
				        <option value="">{{ __('general::lang.selectStatus') }}</option>
				        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('general::lang.active') }}</option>
				        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('general::lang.stopped') }}</option>
				      </select>
                </div>
                <div class="form-group col-12 col-md-2 text-center">
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
          		{{-- <div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.id') }}</strong></div> --}}
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.position') }}</strong></div>
          		{{-- <div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.locale') }}</strong></div> --}}
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.name') }}</strong></div>
          		<div class="col-12 col-md-3 text-center"><strong>{{ __('general::lang.title') }}</strong></div>
          		<div class="col-12 col-md-4 text-center"><strong>{{ __('general::lang.desc') }}</strong></div>
          		<div class="col-12 col-md-2 text-center d-none"><strong>{{ __('general::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
		@forelse ($infos as $info)
			@php
				$f = true;
			@endphp

        	{{-- @foreach ($info->translations->sortBy('locale') as $infoTrans) --}}
		        <div class="card {{ $loop->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		{{-- <div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $info->infos_id }}</div>
			          			</div>
		          			@endif
		          		</div> --}}
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.position') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $info->infos_position }}</div>
			          			</div>
		          			@endif
		          		</div>
		          		{{-- <div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $info->locale }}</div>
		          			</div>
		          		</div> --}}
		          		<div class="col-12 col-md-2 text-md-center">
		          			@if ($f)
		          				<div class="row mb-2 mb-md-0">
				          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.name') }}</strong></div>
				          				<div class="col-8 col-md-12">{{ __('general::lang.'.$info->infos_key) }}</div>
		          				</div>
		          			@endif
		          		</div>
                        <div class="col-12 col-md-3 text-md-center">
                            <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.title') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $info->infos_title }}</div>
                            </div>
                        </div>
		          		<div class="col-12 col-md-4 text-md-center">
	          				<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.desc') }}</strong></div>
		          				<div class="col-8 col-md-12">{!! substr(strip_tags($info->infos_desc), 0, 40) !!}</div>
	          				</div>
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center d-none">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.status') }}</strong></div>
			          				<div class="col-8 col-md-12">
			          					@if ($info->infos_status)
			          						<span class="badge badge-warning">{{ __('general::lang.active') }}</span>
			          					@else
			          						<span class="badge badge-secondary">{{ __('general::lang.stopped') }}</span>
			          					@endif
			          				</div>
			          			</div>
		          			@endif
		          		</div>
		          		<div class="col-12 col-md-2">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
		          						@can('view special_screens')
				          					<a href="{{ route('admin.special_screens.show', [$info->infos_id]) }}"
				          						class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
		          						@endcan
		          						@can('update special_screens')
				          					<a href="{{ route('admin.special_screens.edit', [$info->infos_id]) }}"
				          						class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
		          						@endcan

		          				</div>
		          			</div>
		          		</div>
		          	</div>
		          </div>
		        </div>
		        @php
		        	$f = false;
		        @endphp
        	{{-- @endforeach --}}
		@empty
	        <div class="card">
	          <div class="card-body text-center text-danger">
	          	{{ __('general::lang.noData') }}
	          </div>
	        </div>
		@endforelse

				{{ $infos->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
