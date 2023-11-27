@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
	  <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('main::lang.coupons') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('main::layouts.includes.messages')
		  {{--  Import Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.coupons.import') }}" id="imortDailyOffers-form" method="post" enctype="multipart/form-data">
			@csrf
              <div class="row">

                <div class="form-group col-12 col-md-6 text-center">
                  <input class="form-control" type="file" name="file" placeholder="{{ __('main::lang.chooseFile') }}"  >
                </div>

                <div class="form-group col-12 col-md-2 text-right  ">
                	<button type="buttun" id="buttun-imortDailyOffers" class="btn btn-primary btn-md"><i class="fa fa-file"></i> {{__('main::lang.import')}}</button>
                 </div>
				 <div class="form-group col-12 col-md-2 text-left ">
                	<a href="{{route('admin.coupons.export')}}"   class="btn btn-success btn-md"> {{__('main::lang.example')}}</a>
                 </div>
              </div>
              <!-- /.row-->
            </form>
          </div>
        </div>

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.coupons.index') }}" method="get" id="formDailyOffersSearch">
				<input class="form-control px-0" id="form_type" type="hidden" name="form_type" value="search">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create coupons')
	                	<a href="{{ route('admin.coupons.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
				<div class="form-group col-12 col-md-2 text-center">
					{!! Form::select('store', $stores, null, ['class' =>'form-control','placeholder'=>__('main::lang.store'),'id'=>'store']) !!}
				</div>
				<div class="form-group col-12 col-md-2 text-center">
					{!! Form::select('offer', $offers, null, ['class' =>'form-control','placeholder'=>__('main::lang.offer'),'id'=>'offer']) !!}
				</div>
                <div class="form-group col-12 col-md-2 text-center">
                  <input class="form-control" type="text" name="code" placeholder="{{ __('main::lang.coupons_code') }}" value="{{ old('code') }}">
                </div>

                <div class="form-group col-12 col-md-1 text-center">
					<select class="form-control" name="status">
						<option value="">{{ __('main::lang.selectStatus') }}</option>
						<option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('main::lang.active') }}</option>
						<option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('main::lang.stopped') }}</option>
					</select>
                </div>
				<div class="form-group col-12 col-md-1 text-center">
					<select class="form-control" name="available">
						<option value="">{{ __('main::lang.availability') }}</option>
						<option value="1" {{ old('available') === '1' ? 'selected' : '' }}>{{ __('main::lang.available') }}</option>
						<option value="0" {{ old('available') === '0' ? 'selected' : '' }}>{{ __('main::lang.not_available') }}</option>
					</select>
                </div>
				<div class="form-group col-12 col-md-1 text-center">
					<select class="form-control" name="is_special">
						<option value="">{{ __('main::lang.is_special') }}</option>
						<option value="1" {{ old('is_special') === '1' ? 'selected' : '' }}>{{ __('main::lang.special') }}</option>
						<option value="0" {{ old('is_special') === '0' ? 'selected' : '' }}>{{ __('main::lang.not_special') }}</option>
					</select>
                </div>
                <div class="form-group col-12 col-md-2">
                	<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-search"></i></button>
                	<button type="button" class="btn btn-secondary btn-md search-reset"><i class="fa fa-ban"></i></button>
					<button type="button" onclick="ExportDailyOffers();" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i></button>

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
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.coupons_code') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.position') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.locale') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.store') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.availability') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.is_special') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2"><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
		@forelse ($coupons as $coupon)
			@php
				$f = true;
			@endphp
        	@foreach ($coupon->translations->sortBy('locale') as $couponTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center ">
		          			@if ($f)
                              	<a href="{{ route('admin.coupons.show', [$coupon->coupons_id, 'activeLocale' => $couponTrans->locale]) }}">
			          			<div class="row mb-2 mb-md-0  h-100 ">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.coupons_code') }}</strong></div>
                                        <div class="col-8 col-md-12">
                                            {{ $coupon->coupons_code }}
                                        </div>
                                    </div>
                                </a>
                            @endif
		          		</div>
 
                        <div class="col-xs-12 col-md-1 text-md-center">
                            @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.position') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $coupon->coupons_position }}</div>
                                </div>
                            @endif
                        </div>
						 
		          		<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $couponTrans->locale }}</div>
		          			</div>
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
                            <a href="{{ route('admin.coupons.show', [$coupon->coupons_id, 'activeLocale' => $couponTrans->locale]) }}">
		          			<div class="row mb-2 mb-md-0 h-100">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.name') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $couponTrans->coupons_name }}</div>
		          			</div>
                            </a>
		          		</div>

						<div class="col-12 col-md-1 text-md-center">
                            <a href="{{ route('admin.stores.show', [$coupon->stores_id, 'activeLocale' => $couponTrans->locale]) }}">
		          			<div class="row mb-2 mb-md-0 h-100">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.store') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $coupon->store ? $coupon->store->translate($couponTrans->locale)->stores_name : '' }}</div>
		          			</div>
                            </a>
		          		</div>

						<div class="col-12 col-md-1 text-md-center">
                            <a href="{{ route('admin.offers.show', [$coupon->offers_id, 'activeLocale' => $couponTrans->locale]) }}">
		          			<div class="row mb-2 mb-md-0 h-100">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.offer') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $coupon->offer ? $coupon->offer->translate($couponTrans->locale)->offers_name : '' }}</div>
		          			</div>
                            </a>
		          		</div>

						<div class="col-12 col-md-1 text-md-center">
							@if ($f)
							<div class="row mb-2 mb-md-0">
								<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.availability') }}</strong></div>
								<div class="col-8 col-md-12">
									@if ($coupon->coupons_available)
										<span class="badge badge-warning">{{ __('main::lang.available') }}</span>
									@else
										<span class="badge badge-secondary">{{ __('main::lang.not_available') }}</span>
									@endif
								</div>
							</div>
							@endif
						</div>
						<div class="col-12 col-md-1 text-md-center">
							@if ($f)
							<div class="row mb-2 mb-md-0">
								<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.is_special') }}</strong></div>
								<div class="col-8 col-md-12">
									@if ($coupon->coupons_is_special)
										<span class="badge badge-warning">{{ __('main::lang.special') }}</span>
									@else
										<span class="badge badge-secondary">{{ __('main::lang.not_special') }}</span>
									@endif
								</div>
							</div>
							@endif
						</div>
		          		<div class="col-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
			          				<div class="col-8 col-md-12">
                                        @can('update coupons')
                                            <input type="checkbox" name="coupons_status" id="coupons_status_{{ $coupon->coupons_id }}"  {{ $coupon->coupons_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('coupons','{{ $coupon->coupons_id }}')">
                                        @else
                                            @if ($coupon->coupons_status)
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
		          					<form method="POST" action="{{ route('admin.coupons.destroy', $coupon->coupons_id) }}">
		          						@csrf
		          						@method('DELETE')
		          						{{-- @can('view coupons')
				          					<a href="{{ route('admin.coupons.show', [$coupon->coupons_id, 'activeLocale' => $couponTrans->locale]) }}"
				          						class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
		          						@endcan --}}
		          						@can('update coupons')
				          					<a href="{{ route('admin.coupons.edit', [$coupon->coupons_id, 'activeLocale' => $couponTrans->locale]) }}"
				          						class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
		          						@endcan
			          					@if ($f)
			          						@can('delete coupons')
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

		{{ $coupons->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
@section('script')
<script>
	$('#buttun-imortDailyOffers').click(function(){
		$(".loader").show();
        $("#overlayer").show();
		$('#imortDailyOffers-form').submit();
	})


    function ExportDailyOffers(){
        $('#form_type').val('export') ;
        $('#formDailyOffersSearch').submit();
        $('#form_type').val('search') ;
    }
</script>
@endsection
