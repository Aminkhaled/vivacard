@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active">{{ __('general::lang.settings') }}</li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.settings.index') }}">{{ __('general::lang.general_data') }}</a>
      </li>
      <li class="breadcrumb-item  active">{{ __('general::lang.edit') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="card">
          <div class="card-header">
            <strong>{{ __('general::lang.edit') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
          	@csrf

              <div class="card-body">
                @include('general::layouts.includes.messages')

                <div class="row">
                  <div class="col-lg-9">

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="website_lang">{{ __('general::lang.website_lang') }}</label>
                      <div class="col-md-3">

                        <select name="website_lang" id="website_lang" class="form-control w-50">

                          <option value="ar" {{ getSettingByKey('website_lang') == 'ar' ? 'selected' : ''  }}>
                            {{ __('general::lang.ar') }}
                          </option>

                          <option value="en" {{ getSettingByKey('website_lang') == 'en' ? 'selected' : ''  }}>
                            {{ __('general::lang.en') }}
                          </option>

                        </select>

                      </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-md-3 col-form-label">{{ __('general::lang.website_status') }}</label>
                      <div class="col-md-3 col-form-label">
                        @php
                          $status = getSettingByKey('website_status');
                        @endphp

                        <div class="form-check form-check-inline mr-1">
                          <input
                            class="form-check-input" id="active" type="radio"
                            value="1" name="website_status" {{ $status == '1' ? 'checked' : '' }}>
                          <label class="form-check-label" for="active">{{ __('general::lang.active') }}</label>
                        </div>

                        <div class="form-check form-check-inline mr-1">
                          <input class="form-check-input" id="stopped" type="radio" value="0" name="website_status" {{ $status == 0 ? 'checked' : '' }}>
                          <label class="form-check-label" for="stopped">{{ __('general::lang.stopped') }}</label>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>



	          <div class="card-footer">
              @can('view settings')
                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary btn-md">
                  <i class="fa fa-arrow-left"></i>
                </a>
              @endcan
              <button class="btn btn-success btn-md" type="submit">
                <i class="fa fa-save"></i>
              </button>
	          </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection
@section('style')
<style>
.select2-container {
    width: 25% !important;
}
.select2-container .select2-selection--single {
    height:  100% !important;
}
}
</style>
@endsection
