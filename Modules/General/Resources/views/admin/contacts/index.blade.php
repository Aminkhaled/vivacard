@extends('general::layouts.master')

@section('main')
  <main class="main">

  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.connectWithUs') }}</li>
      <li class="breadcrumb-item  active"> {{ __('general::lang.contacts') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">

      	{{-- Operations Messages --}}
      	@include('general::layouts.includes.messages')



      	{{-- Header Section --}}
        <div class="card d-none d-md-block">
          <div class="card-header">
          	<div class="row">
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.id') }}</strong></div>
				<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.locale') }}</strong></div>
                <div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.address') }}</strong></div>
                <div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.email') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.facebook') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.twitter') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.instagram') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.snapchat') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.youtube') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.whatsapp') }}</strong></div>
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
			@forelse ($contacts as $contact)
			@php
				$f = true;
			@endphp
        	@foreach ($contact->translations->sortBy('locale') as $contactTrans)
		        <div class="card {{ $loop->parent->even ? 'even-record' : '' }}">
		          <div class="card-body">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.id') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $contact->contacts_id }}</div>
			          			</div>
		          			@endif
		          		</div>
						<div class="col-12 col-md-1 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.locale') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $contactTrans->locale }}</div>
		          			</div>
		          		</div>
						<div class="col-12 col-md-2 text-md-center">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.address') }}</strong></div>
		          				<div class="col-8 col-md-12">{{ $contactTrans->contacts_address }}</div>
		          			</div>
		          		</div>
                        <div class="col-xs-12 col-md-1 text-md-center">
                            @if ($f)
                                <div class="row mb-2 mb-md-0">
                                    <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.email') }}</strong></div>
                                    <div class="col-8 col-md-12">{{ $contact->contacts_email}}</div>
                                </div>
                            @endif
                        </div>
						<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.facebook') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $contact->contacts_facebook }}</div>
			          			</div>
		          			@endif
		          		</div>

						<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.twitter') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $contact->contacts_twitter }}</div>
			          			</div>
		          			@endif
		          		</div>

						<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.instagram') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $contact->contacts_instagram }}</div>
			          			</div>
		          			@endif
		          		</div>

						<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.snapchat') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $contact->contacts_snapchat }}</div>
			          			</div>
		          			@endif
		          		</div>

						  <div class="col-xs-12 col-md-1 text-md-center">
							@if ($f)
								<div class="row mb-2 mb-md-0">
									<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.youtube') }}</strong></div>
									<div class="col-8 col-md-12">{{ $contact->contacts_youtube }}</div>
								</div>
							@endif
						</div>
						<div class="col-xs-12 col-md-1 text-md-center">
		          			@if ($f)
			          			<div class="row mb-2 mb-md-0">
			          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.whatsapp') }}</strong></div>
			          				<div class="col-8 col-md-12">{{ $contact->contacts_whatsapp }}</div>
			          			</div>
		          			@endif
		          		</div>

		          		<div class="col-12 col-md-1">
		          			<div class="row mb-2 mb-md-0">
		          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.actions') }}</strong></div>
		          				<div class="col-8 col-md-12">
		          					{{-- <form method="POST" action="{{ route('admin.contacts.destroy', $contact->contacts_id) }}"> --}}
		          						@csrf
		          						@method('DELETE')
		          						@can('view contacts')
				          					<a href="{{ route('admin.contacts.show', [$contact->contacts_id, 'activeLocale' => $contactTrans->locale]) }}"
				          						class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
		          						@endcan
		          						@can('update contacts')
				          					<a href="{{ route('admin.contacts.edit', [$contact->contacts_id, 'activeLocale' => $contactTrans->locale]) }}"
				          						class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a>
		          						@endcan

		          					{{-- </form> --}}
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
	          	{{ __('general::lang.noData') }}
	          </div>
	        </div>
				@endforelse

				{{ $contacts->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
