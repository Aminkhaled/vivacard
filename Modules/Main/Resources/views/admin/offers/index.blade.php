@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('main::lang.offers') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}

    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('general::layouts.includes.messages')

        {{-- Search Section --}}
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.offers.index') }}" method="get">
                <div class="row">
                    <div class="form-group col-12 col-md-2 text-center">
                        @can('create offers')
                            <a href="{{ route('admin.offers.create') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i></a>
                        @endcan
                    </div>
                    <div class="form-group col-12 col-md-4 text-center">
                        <input class="form-control" type="text" name="name" placeholder="{{ __('main::lang.name') }}" value="{{ old('name') }}">
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
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.offers_name') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.img') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.coupons_count') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('main::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 "><strong>{{ __('main::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
            @forelse ($offers as $offer)
                @php
                    $f = true;
                @endphp
                @foreach ($offer->translations->sortBy('locale') as $offerTrans)
                    <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-1 text-md-center">
                                @if ($f)
                                    <a href="{{ route('admin.offers.show', [$offer->offers_id, 'activeLocale' => $offerTrans->locale]) }}">
                                        <div class="row mb-2 mb-md-0">
                                            <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.id') }}</strong></div>
                                            <div class="col-8 col-md-12">{{ $offer->offers_id }}</div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                            <div class="col-xs-12 col-md-1 text-md-center">
                                @if ($f)
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.position') }}</strong></div>
                                        <div class="col-8 col-md-12">{{ $offer->offers_position }}</div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-2 text-md-center">
                                <a href="{{ route('admin.offers.show', [$offer->offers_id, 'activeLocale' => $offerTrans->locale]) }}">
                                    <div class="row mb-2 mb-md-0">
                                        <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.offers_name') }}</strong></div>
                                        <div class="col-8 col-md-12">{{ $offerTrans->offers_name }}</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-12 col-md-2 text-md-center">
                                @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.img') }}</strong></div>
                                    <div class="col-8 col-md-12">
                                        <img src="{{ $offer->offers_image ? asset($offer->images_url($offer->offers_image, 'medium','offers')) : asset('assets/adminPanel/img/no-image.png') }}" class="img-fluid img-thumbnail" width="75px" height="75px"  />
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-2 text-md-center">
                                @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.coupons_count') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ sizeof($offer->coupons) }}</div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-2 text-md-center">
                                @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.status') }}</strong></div>
                                    <div class="col-8 col-md-12">

                                        @can('update offers')
                                            <input type="checkbox" name="offers_status" id="offers_status_{{ $offer->offers_id }}"  {{ $offer->offers_status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="sm" onChange="changeStatus('offers','{{ $offer->offers_id }}')">
                                        @else
                                            @if ($offer->offers_status == '1')
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
                                @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('main::lang.actions') }}</strong></div>
                                    <div class="col-8 col-md-12">
                                        <form method="POST" action="{{ route('admin.offers.destroy', $offer->offers_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            @can('update offers')
                                                <a href="{{ route('admin.offers.edit', [$offer->offers_id, 'activeLocale' => $offerTrans->locale]) }}"
                                                    class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('delete offers')
                                                @if(sizeof($offer->coupons) <= 0)
                                                <button type="submit" class="btn btn-danger btn-md delete-form">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                @endif
                                            @endcan
                                        </form>

                                    </div>
                                </div>
                                @endif
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

            {{ $offers->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
