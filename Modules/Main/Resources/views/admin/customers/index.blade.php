@extends('general::layouts.master')

@section('main')
  <main class="main">
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('main::lang.home') }} </a> </li>
      <li class="breadcrumb-item  active"> {{ __('main::lang.customers') }} </li>
     </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">
      	@include('main::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.customers.index') }}" method="get">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">

                </div>
                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('main::lang.customers_name') }}" value="{{ old('name') }}">
                </div>

                <div class="form-group col-12 col-md-2 text-center">
                    <div class="input-group "  dir="rtl" >
                      <input class="form-control" type="text" dir="ltr" name="phone" placeholder="{{ __('main::lang.customers_phone') }}" value="{{ old('phone') }}">
                      <div class="input-group-prepend">
                        <span class="input-group-text" dir="ltr">+{{ env('country_code',90) }}</span>
                      </div>
                    </div>
                </div>

                <div class="form-group col-12 col-md-3 text-center">
                    <input class="form-control" type="text" dir="ltr" name="email" placeholder="{{ __('main::lang.email') }}" value="{{ old('email') }}">
                </div>

                <div class="form-group col-12 col-md-2 text-center">
                    <select class="form-control" name="status">
                        <option value="">{{ __('main::lang.selectStatus') }}</option>
                        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('main::lang.active') }}</option>
                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('main::lang.stopped') }}</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-2 ">
                	<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-search"></i></button>
                	<button type="button" class="btn btn-secondary btn-md search-reset"><i class="fa fa-ban"></i></button>
                </div>
              </div>
              <!-- /.row-->
            </form>
          </div>
        </div>

      </div>
      	{{-- Header Section --}}
        <div class="card d-none d-md-block">
          <div class="card-header">
          	<div class="row">
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.id') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.customers_name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.customers_phone') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.email') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.created_at') }}</strong></div>
          		<div class="col-12 col-md-1 "><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
		@forelse ($customers as $customer)
	        <div class="card">
	          <div class="card-body">
	          	<div class="row">
	          		<div class="col-xs-12 col-md-1 text-md-center">
                        <a href="{{ route('admin.customers.show', $customer->customers_id) }}" >
                            <div class="row mb-2 mb-md-0 h-100">
                                <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.id') }}</strong></div>
                                <div class="col-8 col-md-12">{{ $customer->customers_id }}</div>
                            </div>
                        </a>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
                  <a href="{{ route('admin.customers.show', $customer->customers_id) }}" >
                      <div class="row mb-2 mb-md-0 h-100">
                          <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.customers_name') }}</strong></div>
                          <div class="col-8 col-md-12">{{ $customer->customers_name }}</div>
                      </div>
                  </a>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.customers_phone') }}</strong></div>
	          				<div class="col-8 col-md-12" dir="ltr">{{ $customer->customers_country_code }}{{ $customer->customers_phone }}</div>
	          			</div>
	          		</div>

	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.email') }}</strong></div>
	          				<div class="col-8 col-md-12" dir="ltr">{{ $customer->customers_email }}</div>
	          			</div>
					      </div>

	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
	          				<div class="col-8 col-md-12">

                        <input type="checkbox" name="customers_status" id="customers_status_{{ $customer->customers_id }}"  {{ $customer->customers_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('{{ $customer->customers_id }}')">

	          				</div>
	          			</div>
	          		</div>
                <div class="col-12 col-md-2 text-md-center">
                    <div class="row mb-2 mb-md-0">
                        <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.created_at') }}</strong></div>
                        <div class="col-8 col-md-12">{{ $customer->customers_created_at->format('Y-m-d') }}</div>
                    </div>
                </div>
               
	          		<div class="col-12 col-md-1  ">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.actions') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					<form method="POST" action="{{ route('admin.customers.destroy', $customer->customers_id) }}">
	          						@csrf
	          						@method('DELETE')
	          						{{-- @can('view customers')
			          					<a href="{{ route('admin.customers.show', $customer->customers_id) }}" class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
	          						@endcan --}}
	          						@can('update customers')
			          					<a href="{{ route('admin.customers.edit', $customer->customers_id) }}" class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
	          						@endcan
	          						@can('delete customers')

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
	          	{{ __('main::lang.noData') }}
	          </div>
	        </div>
		@endforelse

				{{ $customers->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
        function changeStatus(id){
            console.log(document.getElementById('customers_status_'+id).checked);
            if(document.getElementById('customers_status_'+id).checked){
                status = '1';
            }else{
                status = '0';
            }
            $.ajax({
                type: "GET",
                url: "<?php echo url('/')?>/{{$locale}}/admin/customers/changeStatus/"+id+"/"+status,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'device_token': "{{ isset($device_token) ? $device_token : '' }}",
                },
                success: function(data) {
                    $('#generalModalCenter').find('.modal-title').html(data.msg)
                    // $('#generalModalCenter').find('.modal-body').html(data.msg)
                    $('#generalModalCenter').modal('show')
                }
            })

        }
    </script>
@endsection
