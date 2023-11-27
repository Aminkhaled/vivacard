@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">  <a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item"> <a href="{{ route('admin.advertisements.index') }}">{{ __('general::lang.advertisements') }}</a></li>
      <li class="breadcrumb-item  active">{{ __('general::lang.show') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ __('general::lang.show') }}
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.id') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $advertisement->advertisements_id }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.position') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $advertisement->advertisements_position }}</div>
                </div>
              </li>

              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.name') }}</strong></div>
                  <div class="col-12 col-md-10">{{ $advertisement->advertisements_name }}</div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.ViewPage') }}</strong></div>
                  <div class="col-12 col-md-10">{{__('general::lang.'.$advertisement->advertisements_view_page )}}</div>
                </div>
              </li>
              
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.web_img') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <a href="{{ $advertisement->advertisements_web_img ? asset($advertisement->images_url($advertisement->advertisements_web_img, 'original','advertisements')) : asset('assets/adminPanel/img/no-image.png') }}" target="_blank">
                        <img src="{{ $advertisement->advertisements_web_img ? asset($advertisement->images_url($advertisement->advertisements_web_img, 'medium','advertisements')) : asset('assets/adminPanel/img/no-image.png') }}"
                        alt="img" class="img-fluid img-thumbnail" />
                    </a>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.phone_img') }}</strong></div>
                  <div class="col-12 col-md-10">
                    <a href="{{ $advertisement->advertisements_phone_img ? asset($advertisement->images_url($advertisement->advertisements_phone_img, 'original','advertisements')) : asset('assets/adminPanel/img/no-image.png') }}" target="_blank">
                        <img src="{{ $advertisement->advertisements_phone_img ? asset($advertisement->images_url($advertisement->advertisements_phone_img, 'medium','advertisements')) : asset('assets/adminPanel/img/no-image.png') }}"
                        alt="img" class="img-fluid img-thumbnail" />
                    </a>

                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-12 col-md-2"><strong>{{ __('general::lang.status') }}</strong></div>
                  <div class="col-12 col-md-10">{{ __('general::lang.status_'. $advertisement->advertisements_status) }}</div>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            @can('view advertisements')
              <a href="{{ route('admin.advertisements.index') }}" class="btn btn-secondary btn-md">
                <i class="fa fa-arrow-left"></i>
              </a>
            @endcan
            @can('update advertisements')
              <a href="{{ route('admin.advertisements.edit', $advertisement->advertisements_id) }}" class="btn btn-warning btn-md">
                <i class="fa fa-edit"></i>
              </a>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
