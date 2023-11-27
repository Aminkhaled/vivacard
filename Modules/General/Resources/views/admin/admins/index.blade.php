@extends('general::layouts.master')

@section('main')
  <main class="main">
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.admins') }} </li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.admins') }} </li>
    </ol>
	{{-- end Breadcrumb Section --}}

    <div class="container-fluid">
      <div class="animated fadeIn">
      	@include('general::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.admins.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create admins')
	                	<a href="{{ route('admin.admins.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('general::lang.name') }}" value="{{ old('name') }}">
                </div>
                <div class="form-group col-12 col-md-3 text-center">
                  <input class="form-control" type="text" name="email" placeholder="{{ __('general::lang.email') }}" value="{{ old('email') }}">
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
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.id') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.name') }}</strong></div>
          		<div class="col-12 col-md-3 text-center"><strong>{{ __('general::lang.email') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 "><strong>{{ __('general::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
		@forelse ($admins as $admin)
	        <div class="card">
	          <div class="card-body">
	          	<div class="row">
	          		<div class="col-xs-12 col-md-1 text-md-center">
                        <a href="{{ route('admin.admins.show', $admin->admins_id) }}" >
                            <div class="row mb-2 mb-md-0 h-100">
                                <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.id') }}</strong></div>
                                <div class="col-8 col-md-12">{{ $admin->admins_id }}</div>
                            </div>
                        </a>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
                        <a href="{{ route('admin.admins.show', $admin->admins_id) }}" >
                            <div class="row mb-2 mb-md-0 h-100">
                                <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.name') }}</strong></div>
                                <div class="col-8 col-md-12">{{ $admin->name }}</div>
                            </div>
                        </a>
	          		</div>
	          		<div class="col-12 col-md-3 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.email') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $admin->email }}</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.status') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					@if ($admin->admins_status)
	          						<span class="badge badge-warning">{{ __('general::lang.active') }}</span>
	          					@else
	          						<span class="badge badge-secondary">{{ __('general::lang.stopped') }}</span>
	          					@endif
	          				</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-2 ">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.actions') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					<form method="POST" action="{{ route('admin.admins.destroy', $admin->admins_id) }}">
	          						@csrf
	          						@method('DELETE')
	          						{{-- @can('view admins')
			          					<a href="{{ route('admin.admins.show', $admin->admins_id) }}" class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
	          						@endcan --}}
	          						@can('update admins')
			          					<a href="{{ route('admin.admins.edit', $admin->admins_id) }}" class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
	          						@endcan
	          						@can('delete admins')
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
		@empty
	        <div class="card">
	          <div class="card-body text-center text-danger">
	          	{{ __('general::lang.noData') }}
	          </div>
	        </div>
		@endforelse

				{{ $admins->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
