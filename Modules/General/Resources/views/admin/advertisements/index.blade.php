@extends('general::layouts.master')

@section('main')
  <main class="main">
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
		<li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
       	<li class="breadcrumb-item  active"> {{ __('general::lang.advertisements') }} </li>
    </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">
      	@include('general::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.advertisements.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create advertisements')
	                	<a href="{{ route('admin.advertisements.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
                <div class="form-group col-12 col-md-4 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('general::lang.name') }}" value="{{ old('name') }}">
                </div>
                {{-- <div class="form-group col-12 col-md-3 text-center">
                </div> --}}
                <div class="form-group col-12 col-md-2 text-center">
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
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.id') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.position') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.web_img') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.phone_img') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.ViewPage') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 "><strong>{{ __('general::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
		@forelse ($advertisements as $advertisement)
	        <div class="card">
	          <div class="card-body">
	          	<div class="row">
	          		<div class="col-xs-12 col-md-1 text-md-center">
                        <a href="{{ route('admin.advertisements.show', $advertisement->advertisements_id) }}">
                            <div class="row mb-2 mb-md-0 h-100">
                                <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.id') }}</strong></div>
                                <div class="col-8 col-md-12">{{ $advertisement->advertisements_id }}</div>
                            </div>
                        </a>
	          		</div>
                      <div class="col-12 col-md-1 text-md-center">
                        <div class="row mb-2 mb-md-0 h-100">
                            <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.position') }}</strong></div>
                            <div class="col-8 col-md-12">{{ $advertisement->advertisements_position }}</div>
                        </div>
	          		</div>

	          		<div class="col-12 col-md-1 text-md-center">
                        <a href="{{ route('admin.advertisements.show', $advertisement->advertisements_id) }}">
                            <div class="row mb-2 mb-md-0 h-100">
                                <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.name') }}</strong></div>
                                <div class="col-8 col-md-12">{{ $advertisement->advertisements_name }}</div>
                            </div>
                        </a>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.web_img') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					<img src="{{ $advertisement->advertisements_web_img ? asset($advertisement->images_url($advertisement->advertisements_web_img, 'thumbnail','advertisements')) : asset('assets/adminPanel/img/no-image.png') }}"
                     				 class="img-fluid img-thumbnail" width="100px" height="100px" />
	          				</div>
	          			</div>
	          		</div>

                    <div class="col-12 col-md-2 text-md-center">
                        <div class="row mb-2 mb-md-0">
                            <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.phone_img') }}</strong></div>
                            <div class="col-8 col-md-12">
                                <img src="{{ $advertisement->advertisements_phone_img ? asset($advertisement->images_url($advertisement->advertisements_phone_img, 'thumbnail','advertisements')) : asset('assets/adminPanel/img/no-image.png') }}"
                                    class="img-fluid img-thumbnail" width="100px" height="100px" />
                            </div>
                        </div>
                    </div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.ViewPage') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ __('general::lang.'.$advertisement->advertisements_view_page )}}</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-1 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.status') }}</strong></div>
	          				<div class="col-8 col-md-12">
                                @can('update advertisements')
                                    <input type="checkbox" name="advertisements_status" id="advertisements_status_{{ $advertisement->advertisements_id }}"  {{ $advertisement->advertisements_status ? 'checked' : '' }}  data-on=" {{__('general::lang.active')}}" data-off=" {{__('general::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('advertisements','{{ $advertisement->advertisements_id }}')">
                                @else
                                    @if ($advertisement->advertisements_status)
                                        <span class="badge badge-warning">{{ __('general::lang.active') }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ __('general::lang.stopped') }}</span>
                                    @endif
                                @endcan

	          				</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-2 ">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.actions') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					<form method="POST" action="{{ route('admin.advertisements.destroy', $advertisement->advertisements_id) }}">
	          						@csrf
	          						@method('DELETE')
	          						@can('update advertisements')
			          					<a href="{{ route('admin.advertisements.edit', $advertisement->advertisements_id) }}" class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
	          						@endcan
	          						@can('delete advertisements')
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

		{{ $advertisements->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
