@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
	  <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('main::lang.daily_offers') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('main::layouts.includes.messages')
		  {{--  Import Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.daily_offers.import') }}" id="imortDailyOffers-form" method="post" enctype="multipart/form-data">
			@csrf
              <div class="row">

                <div class="form-group col-12 col-md-6 text-center">
                  <input class="form-control" type="file" name="file" placeholder="{{ __('main::lang.chooseFile') }}"  >
                </div>

                <div class="form-group col-12 col-md-2 text-right  ">
                	<button type="buttun" id="buttun-imortDailyOffers" class="btn btn-primary btn-md"><i class="fa fa-file"></i> {{__('main::lang.import')}}</button>
                 </div>
				 <div class="form-group col-12 col-md-2 text-left ">
                	<a href="{{route('admin.daily_offers.export')}}"   class="btn btn-success btn-md"> {{__('main::lang.example')}}</a>
                 </div>
              </div>
              <!-- /.row-->
            </form>
          </div>
        </div>

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.daily_offers.index') }}" method="get" id="formDailyOffersSearch">
				<input class="form-control px-0" id="form_type" type="hidden" name="form_type" value="search">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center">
                	@can('create daily_offers')
	                	<a href="{{ route('admin.daily_offers.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                	@endcan
                </div>
				<div class="form-group col-12 col-md-3 text-center">
					{!! Form::select('store', $stores, null, ['class' =>'form-control','placeholder'=>__('main::lang.store'),'id'=>'store']) !!}
				</div>
                <div class="form-group col-12 col-md-3 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('main::lang.name') }}" value="{{ old('name') }}">
                </div>

                <div class="form-group col-12 col-md-3 text-center">
					<select class="form-control" name="status">
						<option value="">{{ __('main::lang.selectStatus') }}</option>
						<option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('main::lang.active') }}</option>
						<option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('main::lang.stopped') }}</option>
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
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.daily_offers_code') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.position') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.locale') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.store') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.daily_offers_price') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.daily_offers_price_before_sale') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2"><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
		@forelse ($daily_offers as $daily_offer)
			@php
				$f = true;
			@endphp
        	@foreach ($daily_offer->translations->sortBy('locale') as $daily_offerTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center ">
		          			@if ($f)
                              	<a href="{{ route('admin.daily_offers.show', [$daily_offer->daily_offers_id, 'activeLocale' => $daily_offerTrans->locale]) }}">
			          			<div class="row mb-2 mb-md-0  h-100 ">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.daily_offers_code') }}</strong></div>
                                        <div class="col-8 col-md-12">
                                            {{ $daily_offer->daily_offers_code }}
                                        </div>
                                    </div>
                                </a>
                            @endif
		          		</div>
 
                        <div class="col-xs-12 col-md-1 text-md-center">
                            @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.position') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $daily_offer->daily_offers_position }}</div>
                                </div>
                            @endif
                        </div>
						 
		          		<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $daily_offerTrans->locale }}</div>
		          			</div>
		          		</div>

		          		<div class="col-12 col-md-2 text-md-center">
                            <a href="{{ route('admin.daily_offers.show', [$daily_offer->daily_offers_id, 'activeLocale' => $daily_offerTrans->locale]) }}">
		          			<div class="row mb-2 mb-md-0 h-100">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.name') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $daily_offerTrans->daily_offers_name }}</div>
		          			</div>
                            </a>
		          		</div>

						<div class="col-12 col-md-2 text-md-center">
                            <a href="{{ route('admin.stores.show', [$daily_offer->stores_id, 'activeLocale' => $daily_offerTrans->locale]) }}">
		          			<div class="row mb-2 mb-md-0 h-100">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.store') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $daily_offer->store ? $daily_offer->store->translate($daily_offerTrans->locale)->stores_name : '' }}</div>
		          			</div>
                            </a>
		          		</div>

						<div class="col-12 col-md-1 text-md-center">
							@if ($f)
							<div class="row mb-2 mb-md-0">
								<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.daily_offers_price') }}</strong></div>
								<div class="col-8 col-md-12">{{ $daily_offer->daily_offers_price }}</div>
							</div>
							@endif
						</div>
						<div class="col-12 col-md-1 text-md-center">
							@if ($f)
							<div class="row mb-2 mb-md-0">
								<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.daily_offers_price_before_sale') }}</strong></div>
								<div class="col-8 col-md-12">{{ $daily_offer->daily_offers_price_before_sale }}</div>
							</div>
							@endif
						</div>
		          		<div class="col-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
			          				<div class="col-8 col-md-12">
                                        @can('update daily_offers')
                                            <input type="checkbox" name="daily_offers_status" id="daily_offers_status_{{ $daily_offer->daily_offers_id }}"  {{ $daily_offer->daily_offers_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('daily_offers','{{ $daily_offer->daily_offers_id }}')">
                                        @else
                                            @if ($daily_offer->daily_offers_status)
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
		          					<form method="POST" action="{{ route('admin.daily_offers.destroy', $daily_offer->daily_offers_id) }}">
		          						@csrf
		          						@method('DELETE')
		          						{{-- @can('view daily_offers')
				          					<a href="{{ route('admin.daily_offers.show', [$daily_offer->daily_offers_id, 'activeLocale' => $daily_offerTrans->locale]) }}"
				          						class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
		          						@endcan --}}
		          						@can('update daily_offers')
				          					<a href="{{ route('admin.daily_offers.edit', [$daily_offer->daily_offers_id, 'activeLocale' => $daily_offerTrans->locale]) }}"
				          						class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
		          						@endcan
			          					@if ($f)
			          						@can('delete daily_offers')
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

		{{ $daily_offers->appends(request()->except('page'))->links() }}
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
