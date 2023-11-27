@extends('general::layouts.master')

@section('main')
  <main class="main">
  	{{-- Breadcrumb Section --}}
    <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
	  <li class="breadcrumb-item  active"> {{ __('general::lang.connectWithUs') }}</li>
	  <li class="breadcrumb-item  active"> {{ __('general::lang.contactus') }}</li>
    </ol>
	{{-- end Breadcrumb Section --}}
    <div class="container-fluid">
      <div class="animated fadeIn">
      	@include('general::layouts.includes.messages')

      	{{-- Search Section --}}
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.contactus.index') }}" method="get" id="formContactUsSearch">
                <input class="form-control px-0" id="form_type" type="hidden" name="form_type" value="search">
              <div class="row">
                <div class="form-group col-12 col-md-1 text-center"></div>
                <div class="form-group col-12 col-md-4 text-center">
                  <input class="form-control" type="text" name="name" placeholder="{{ __('general::lang.name') }}" value="{{ old('name') }}">
                </div>

 				<div class="form-group col-12 col-md-3 text-center">
                    <select class="form-control" name="status">
                        <option value="">{{ __('general::lang.selectStatus') }}</option>
                        <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{ __('general::lang.done') }}</option>
                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{ __('general::lang.new') }}</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                    {{-- <select class="form-control" name="type">
                        <option value="">{{ __('general::lang.selectType') }}</option>
                        <option value="customer" {{ old('type') == 'customer' ? 'selected' : '' }}>{{ __('services::lang.customer') }}</option>
                        <option value="provider" {{ old('type') == 'provider' ? 'selected' : '' }}>{{ __('services::lang.provider') }}</option>
                    </select> --}}
                </div>
                <div class="form-group col-12 col-md-2 text-center">
                	<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-search"></i></button>
                	<button type="button" class="btn btn-secondary btn-md search-reset"><i class="fa fa-ban"></i></button>
                    <button type="button" onclick="ExportContactUs();" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i></button>

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
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.phone') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.email') }}</strong></div>
          		{{-- <div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.type') }}</strong></div> --}}
          		<div class="col-12 col-md-1 text-center"><strong>{{ __('general::lang.status') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.date') }}</strong></div>
          		<div class="col-12 col-md-2 text-center"><strong>{{ __('general::lang.actions') }}</strong></div>
          	</div>
          </div>
        </div>

      	{{-- Data Section --}}
				@forelse ($contactus as $contact)
	        <div class="card">
	          <div class="card-body">
	          	<div class="row">
	          		<div class="col-xs-12 col-md-1 text-md-center">
                        <a href="{{ route('admin.contactus.show', $contact->contact_us_id) }}">
	          			<div class="row mb-2 mb-md-0 h-100">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.id') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $contact->contact_us_id }}</div>
	          			</div>
                        </a>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
                        @if($contact->customer)
                        <a href="{{ route('admin.customers.show', $contact->customers_id) }}">
                        @else
                        {{-- <a href="{{ route('admin.contactus.show', $contact->contact_us_id) }}"> --}}
                        @endif
	          			<div class="row mb-2 mb-md-0 h-100">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.name') }}</strong></div>
	          				<div class="col-8 col-md-12">

	          						{{ $contact->contact_us_name }}
                                </div>
                            </div>
                        @if($contact->customer )
                        </a>
                        @endif
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.phone') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $contact->contact_us_phone }}</div>
	          			</div>
	          		</div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.email') }}</strong></div>
	          				<div class="col-8 col-md-12">{{ $contact->contact_us_email }}</div>
	          			</div>
	          		</div>
	          		{{-- <div class="col-12 col-md-1 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.type') }}</strong></div>
	          				<div class="col-8 col-md-12">
                                {{$contact->contact_us_type ?  __('services::lang.'.$contact->contact_us_type) : ''}}
	          				</div>
	          			</div>
	          		</div> --}}
					<div class="col-12 col-md-1 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.status') }}</strong></div>
	          				<div class="col-8 col-md-12">

	          					@if ($contact->contact_us_status == 0)
                                    @can('update contactus')
									<a href="{{ route('admin.contactus.edit', $contact->contact_us_id) }}" class="btn btn-success btn-md">
                                    @endcan
                                        <span class="p-2 ">{{ __('general::lang.new') }}</span>
                                    @can('update contactus')
                                    </a>
                                    @endcan
	          					@else
	          						<span class="p-2 badge badge-secondary">{{ __('general::lang.done') }}</span>
	          					@endif

	          				</div>
	          			</div>
	          		</div>
                    <div class="col-12 col-md-2 text-md-center">
                        <div class="row mb-2 mb-md-0">
                            <div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.date') }}</strong></div>
                            <div class="col-8 col-md-12">{{ Carbon\Carbon::parse($contact->contact_us_created_at)->timezone(env('timezone','Africa/Cairo'))->format('Y-m-d h:m:s a') }}</div>
                        </div>
                    </div>
	          		<div class="col-12 col-md-2 text-md-center">
	          			<div class="row mb-2 mb-md-0">
	          				<div class="col-4 d-block d-md-none"><strong>{{ __('general::lang.actions') }}</strong></div>
	          				<div class="col-8 col-md-12">
	          					<form method="POST" action="{{ route('admin.contactus.destroy', $contact->contact_us_id) }}">
		          						@csrf
		          						@method('DELETE')

	          						{{-- @can('view contactus')
			          					<a href="{{ route('admin.contactus.show', $contact->contact_us_id) }}" class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
	          						@endcan --}}
	          						@can('delete contactus')
	          							<button type="submit" class="btn btn-danger btn-md delete-form">
	          								<i class="fa fa-trash"></i>
	          							</button>
	          						@endcan

                                    <a href="https://web.whatsapp.com/send?phone={{ env('country_code','90') }}{{ $contact->contact_us_phone }}&text={{ __('general::lang.whatsappDefaultMsg') }}"
                                        data-action="share/whatsapp/share" target="_blank"
                                        class="btn btn-success font-weight-bold btn-md">
                                        <i class="fa fa-whatsapp"></i>   <span class=" " style="font-size:10px">{{ __('general::lang.whatsapp') }}</span>
                                    </a>
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

				{{ $contactus->appends(request()->except('page'))->links() }}
      </div>
    </div>
  </main>
@endsection
@section('script')
<script>
	$('#form_type').val('search') ;

	function ExportContactUs(){
		$('#form_type').val('export') ;
 		$('#formContactUsSearch').submit();
		$('#form_type').val('search') ;

	}


</script>
@endsection
