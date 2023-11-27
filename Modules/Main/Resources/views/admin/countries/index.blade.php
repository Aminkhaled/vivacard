@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active">{{ __('general::lang.settings') }}</li>
	  <li class="breadcrumb-item  active"> {{ __('main::lang.countries') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('general::layouts.includes.messages')

        {{-- Search Section --}}
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.countries.index') }}" method="get">
                <div class="row">
                    <div class="form-group col-12 col-md-2 text-center">
                        @can('create countries')
                            <a href="{{ route('admin.countries.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                        @endcan
                    </div>
                    <div class="form-group col-12 col-md-4 text-center">
                        <input class="form-control" type="text" name="title" placeholder="{{ __('main::lang.title') }}" value="{{ old('title') }}">
                    </div>
                    <div class="form-group col-12 col-md-3 text-center">
                        <select class="form-control" name="status">
                        <option value="">{{ __('general::lang.selectStatus') }}</option>
                        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('general::lang.active') }}</option>
                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('general::lang.stopped') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-3">
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
          		<div class="col-12 col-md-4 text-center"><strong>{{ __('main::lang.title') }}</strong></div>
          		<div class="col-12 col-md-3 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-3 "><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
            @forelse ($countries as $country)
            @php
                $f = true;
            @endphp
        	@foreach ($country->translations->sortBy('locale') as $countryTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
                              <a href="{{ route('admin.countries.show', [$country->countries_id, 'activeLocale' => $countryTrans->locale]) }}">
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $country->countries_id }}</div>
			          			</div>
                              </a>
		          			@endif
		          		</div>
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.position') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $country->countries_position }}</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-4 text-md-center">
                            <a href="{{ route('admin.countries.show', [$country->countries_id, 'activeLocale' => $countryTrans->locale]) }}">
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.title') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $countryTrans->countries_name }}</div>
                                </div>
                            </a>
		          		</div>

                        <div class="col-12 col-md-3 text-md-center">
                            <div class="row mb-2 mb-md-0">
                                <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
                                <div class="col-8 col-md-12">

                                    @can('update countries')
                                        <input type="checkbox" name="countries_status" id="countries_status_{{ $country->countries_id }}"  {{ $country->countries_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('countries','{{ $country->countries_id }}')">
                                    @else
                                        @if ($country->countries_status == '1')
                                            <span class="badge badge-warning">{{ __('main::lang.active') }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ __('main::lang.stopped') }}</span>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                        </div>
		          		<div class="col-12 col-md-3">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
                                    <form method="POST" action="{{ route('admin.countries.destroy', $country->countries_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        @can('view countries')
                                            <a href="{{ route('admin.countries.show', [$country->countries_id, 'activeLocale' => $countryTrans->locale]) }}"
                                                class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
                                        @endcan
                                        @can('update countries')
                                            <a href="{{ route('admin.countries.edit', [$country->countries_id, 'activeLocale' => $countryTrans->locale]) }}"
                                                class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete countries')
                                            <button type="submit" class="btn btn-danger btn-md delete-form">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
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

				{{ $countries->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
