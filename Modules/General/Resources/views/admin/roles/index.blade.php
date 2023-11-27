@extends('general::layouts.master')

@section('main')
  <main class="main">
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.admins') }}</li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.permissions') }}</li>
    </ol>
    {{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">
      	@include('general::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.roles.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-2 text-center">
                  @can('create roles')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                  @endcan
                  @hasrole('super_admin')
                    <a href="{{ route('admin.permissions.update') }}" class="btn btn-warning btn-md">
                      <i class="fa fa-edit"></i>{{ __('general::lang.updatePermissions') }}</a>
                  @endhasrole
                </div>
                <div class="form-group col-12 col-md-8 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('general::lang.name') }}" value="{{ old('name') }}">
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
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.id') }}</strong></div>
          		<div class="col-12 col-md-9 text-center"><strong>{{ __('general::lang.name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
				@forelse ($roles as $role)


	        <div class="card">
	          <div class="card-body">
	          	<div class="row">
	          		<div class="col-xs-12 col-md-1 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.id') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $role->id }}</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-9 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.name') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $role->name }}</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.actions') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					<form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}">
                        @csrf
                        @method('DELETE')
                        @can('view roles')
                          <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('update roles')
  		          					<a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('delete roles')
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

				{{ $roles->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
