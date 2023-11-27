@extends('general::layouts.master')

@section('main')
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.home') }}">{{ __('general::lang.home') }} </a></li>
      <li class="breadcrumb-item  active">{{ __('general::lang.settings') }}</li>
      <li class="breadcrumb-item  active">{{ __('general::lang.change_lang') }}</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
          	{{-- Search Section --}}
        <div class="card">
            <div class="card-body">
              <form class="form-horizontal" action="{{ route('admin.settings.changeLang') }}" method="get">
                <div class="row">

                  <div class="form-group col-12 col-md-4 text-center">
                        <select class="form-control" name="module">
                            <option value="">{{ __('general::lang.selectModule') }}</option>
                            <option value="" {{ old('module') == '' ? 'selected' : '' }}>Website</option>
                            <option value="general" {{ old('module') == 'general' ? 'selected' : '' }}>General</option>
                            <option value="main" {{ old('module') == 'main' ? 'selected' : '' }}>Main</option>
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
        <div class="card">
          <div class="card-header">
            <strong>{{ __('general::lang.change_lang') }}</strong>
          </div>
          <form class="form-horizontal" action="{{ route('admin.settings.saveChangeLang') }}" method="post">
            <input type="hidden" name="module" value="{{ $module }}">
          	@csrf
              <div class="card-body">
                @include('general::layouts.includes.messages')

                {{-- Tabs --}}
                <ul class="nav nav-tabs" id="langsTabs" role="tablist">
                  @foreach ($arrayLang as $key => $value)
                    <li class="nav-item">
                      <a class="nav-link {{  $loop->first ? 'active' : '' }}" id="{{ $key }}-tab" data-toggle="tab" href="#{{ $key }}"
                        role="tab" aria-controls="{{ $key }}" aria-selected="false">
                        {{  $key }}
                      </a>
                    </li>
                  @endforeach

                </ul>

                {{-- Tabs Content --}}
                <div class="tab-content " id="langsTabsContent">

                  {{-- Languages Tabs --}}
                  @foreach ($arrayLang as $key => $array)
                    <div class="tab-pane fade {{   $loop->first ? 'show active' : '' }} " id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">

                      <div class="row">
                        @foreach ($array as $title => $value)
                        <div class="col-lg-4 col-12">
                            <div class="form-group row">
                              <label class="col-md-4 col-form-label " for="{{  $key.'-'.$title }}">{{$title }}<span class="text-danger"> *</span></label>
                              <div class="col-md-8">
                                    <input type="text" id="{{  $key.'-'.$title }}" class="form-control {{ $errors->first($key.'.'.$title) ? 'is-invalid' : '' }}"   name={{ $key ."['".$title."']" }} value="{{ old($key .'.'.$title,   $value) }}"  placeholder="{{$title }}" required>
                                @if ($errors->first($key .'.'.$title))
                                  <div class="invalid-feedback">{{ $errors->first($key .'.'.$title) }}</div>
                                @endif
                              </div>
                            </div>
                        </div>
                        @endforeach

                      </div>

                    </div>
                  @endforeach
                </div>
              </div>

	          <div class="card-footer">
                {{-- @can('view settings')
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary btn-md">
                    <i class="fa fa-arrow-left"></i>
                    </a>
                @endcan --}}
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

