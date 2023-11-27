@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active">{{ __('general::lang.settings') }}</li>
	  <li class="breadcrumb-item  active"> {{ __('main::lang.cities') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('general::layouts.includes.messages')

        {{-- Search Section --}}
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.cities.index') }}" method="get">
                <div class="row">
                    <div class="form-group col-12 col-md-2 text-center">
                        {{-- @can('create cities')
                            <a href="{{ route('admin.cities.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                        @endcan --}}
                    </div>
                    <div class="form-group col-12 col-md-3 text-center">
                        <input class="form-control" type="text" name="title" placeholder="{{ __('main::lang.title') }}" value="{{ old('title') }}">
                    </div>
                    <div class="form-group col-12 col-md-3 text-center">
                        {!! Form::select('country', $countries, old('country'), ['class' => 'form-control','placeholder'=>__('main::lang.country')]) !!}
                    </div>
                    <div class="form-group col-12 col-md-2 text-center">
                        <select class="form-control" name="status">
                            <option value="">{{ __('general::lang.selectStatus') }}</option>
                            <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('general::lang.active') }}</option>
                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('general::lang.stopped') }}</option>
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
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.id') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.position') }}</strong></div>
          		<div class="col-12 col-md-3 text-center"><strong>{{ __('main::lang.title') }}</strong></div>
          		<div class="col-12 col-md-3 text-center"><strong>{{ __('main::lang.country') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 "><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
            @forelse ($cities as $city)
            @php
                $f = true;
            @endphp
        	@foreach ($city->translations->sortBy('locale') as $cityTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
                              <a href="{{ route('admin.cities.show', [$city->cities_id]) }}">
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $city->cities_id }}</div>
			          			</div>
                              </a>
		          			@endif
		          		</div>
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.position') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $city->cities_position }}</div>
			          			</div>
		          			@endif
		          		</div>

                        <div class="col-12 col-md-3 text-md-center">
                            <a href="{{ route('admin.cities.show', [$city->cities_id]) }}">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.title') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $cityTrans->cities_name }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-md-3 text-md-center">
                            <a href="{{ route('admin.countries.show', [$city->countries_id]) }}">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.country') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $city->country ? $city->country->countries_name : '' }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-md-2 text-md-center">
                            <div class="row mb-2 mb-md-0">
                                <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
                                <div class="col-8 col-md-12">

                                    @can('update cities')
                                        <input type="checkbox" name="cities_status" id="cities_status_{{ $city->cities_id }}"  {{ $city->cities_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('cities','{{ $city->cities_id }}')">
                                    @else
                                        @if ($city->cities_status == '1')
                                            <span class="badge badge-warning">{{ __('main::lang.active') }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ __('main::lang.stopped') }}</span>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                        </div>
		          		<div class="col-12 col-md-2">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
                                    {{-- <form method="POST" action="{{ route('admin.cities.destroy', $city->cities_id) }}"> --}}
                                        @csrf
                                        @method('DELETE')
                                        @can('view cities')
                                            <a href="{{ route('admin.cities.show', [$city->cities_id, 'activeLocale' => $cityTrans->locale]) }}"
                                                class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
                                        @endcan
                                        {{-- @can('update cities')
                                            <a href="{{ route('admin.cities.edit', [$city->cities_id, 'activeLocale' => $cityTrans->locale]) }}"
                                                class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete cities')
                                            <button type="submit" class="btn btn-danger btn-md delete-form">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </form> --}}

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

				{{ $cities->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
