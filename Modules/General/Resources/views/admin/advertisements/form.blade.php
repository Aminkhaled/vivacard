
@php
  $activeLocale = old('activeLocale', 'general');
  $activeLocale = 'general';
@endphp
<div class="card-body">
	@include('general::layouts.includes.messages')
  <div class="row">
    <div class="col-lg-9">
        <input type="hidden" name="advertisements_type" value="website">
         {{-- Tabs --}}
        <ul class="nav nav-tabs" id="langsTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link {{ $activeLocale == 'general' ? 'active' : '' }}" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">
            {{ __('general::lang.general') }}</a>
          </li>
          @foreach ($langs as $lang)
            <li class="nav-item">
              <a class="nav-link {{ $activeLocale == $lang->locale ? 'active' : '' }}" id="{{ $lang->locale }}-tab" data-toggle="tab" href="#{{ $lang->locale }}"
                role="tab" aria-controls="{{ $lang->locale }}" aria-selected="false">
                {{ __('general::lang.'. $lang->locale) }}
              </a>
            </li>
          @endforeach
        </ul>

        {{-- Tabs Content --}}
        <div class="tab-content" id="langsTabsContent">
          <div class="tab-pane fade {{ $activeLocale == 'general' ? 'show active' : '' }}" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="row">
              <div class="col-lg-9">
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="advertisements_name">{{ __('general::lang.name') }}<span class="text-danger"> *</span></label>
                  <div class="col-md-9">
                    <input class="form-control {{ $errors->first('advertisements_name') ? 'is-invalid' : '' }}" id="advertisements_name" type="text" name="advertisements_name" placeholder="{{ __('general::lang.name') }}"
                     value="{{ old('advertisements_name', isset($advertisement) ? $advertisement->advertisements_name : '') }}">
                    @if ($errors->first('advertisements_name'))
                      <div class="invalid-feedback">{{ $errors->first('advertisements_name') }}</div>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="advertisements_view_page">{{ __('general::lang.ViewPage') }}<span class="text-danger"> *</span></label>
                  <div class="col-md-9">
                    {!! Form::select('advertisements_view_page', ['home_banner'=>__('general::lang.home_banner'),'home_offers'=>__('general::lang.home_offers'),'home_popup'=>__('general::lang.home_popup')],  old('advertisements_view_page', isset($advertisement) ? $advertisement->advertisements_view_page : 'home_banner') , ['class' => $errors->first('advertisements_view_page') ? 'is-invalid form-control' : 'form-control']) !!}
                    @if ($errors->first('advertisements_view_page'))`§
                      <div class="invalid-feedback">{{ $errors->first('advertisements_view_page') }}</div>
                    @endif 
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="advertisements_link_value">{{ __('main::lang.coupon') }}<span class="text-danger"> </span></label>
                  <div class="col-md-9">
                    <select name="advertisements_link_value" id="advertisements_link_value" class= "{{$errors->first('advertisements_link_value') ? 'form-control is-invalid' : 'form-control'}}" placeholder="{{__('main::lang.coupon')}}">
                      <option value="">{{__('main::lang.coupon')}}</option>
                      @foreach($coupons as $coupon)
                      <option value="{{$coupon->coupons_id}}" {{isset($advertisement) &&  $advertisement->advertisements_link_value == $coupon->coupons_id ? 'selected' : ''}}>{{$coupon->coupons_name. ' ( ' . $coupon->coupons_code . ' )'}}</option>
                      @endforeach
                    </select>
                  
                    @if ($errors->first('advertisements_link_value'))
                      <div class="invalid-feedback">{{ $errors->first('advertisements_link_value') }}</div>
                    @endif
                  </div>
                </div>

                 <!-- position field  -->
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="advertisements_position">{{ __('general::lang.position') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-6">
                    <input class="form-control {{ $errors->first('advertisements_position') ? 'is-invalid' : '' }}" id="advertisements_position" type="text" name="advertisements_position"
                    placeholder="{{ __('general::lang.position') }}" value="{{ old('advertisements_position', isset($advertisement) ? $advertisement->advertisements_position : 10000) }}">
                    @if ($errors->first('advertisements_position'))
                        <div class="invalid-feedback">{{ $errors->first('advertisements_position') }}</div>
                    @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ __('general::lang.status') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9 col-form-label">
                      @php
                        $status = old('advertisements_status', isset($advertisement) ? $advertisement->advertisements_status : 1);
                      @endphp
                       <input type="hidden" id="advertisements_status_input" name="advertisements_status" value="{{ $status }}">
                       <input type="checkbox" name="advertisements_statuss" id="advertisements_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('general::lang.active')}}" data-off=" {{__('general::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('advertisements')">
                      @if ($errors->first('advertisements_status'))
                        <div class="invalid-feedback">{{ $errors->first('advertisements_status') }}</div>
                      @endif
                    </div>
                  </div>


              </div>
            </div>
          </div>

            {{-- Languages Tabs --}}
            @foreach ($langs as $lang)
            <div class="tab-pane fade {{ $activeLocale == $lang->locale ? 'show active' : '' }}" id="{{ $lang->locale }}" role="tabpanel" aria-labelledby="{{ $lang->locale }}-tab">

                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="advertisements_url">{{ __('general::lang.link') }}<span class="text-danger">  </span></label>
                    <div class="col-md-9">
                      <input class="form-control {{ $errors->first($lang->locale .'.advertisements_url') ? 'is-invalid' : '' }}" id="advertisements_url" type="text" name="{{ $lang->locale .'[advertisements_url]' }}" placeholder="{{ __('general::lang.link') }}"
                       value="{{ old($lang->locale .'.advertisements_url', isset($advertisement) ? $advertisement->translate($lang->locale)->advertisements_url : '') }}">
                      @if ($errors->first($lang->locale .'.advertisements_url'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.advertisements_url') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="advertisements_web_img">{{ __('general::lang.web_img_name') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9">

                      @include('general::layouts.includes.imagePreviewLang',
                      ['name' => 'advertisements_web_img', 'value' => isset($advertisement) ? $advertisement->translate($lang->locale)->advertisements_web_img : null,'type'=>'advertisements','lang'=>$lang->locale ])

                      <div class="invalid-feedback d-block fb-700">{{ __('general::lang.imageValidate',['height'=> '450px','width'=> '1250px']) }}</div>
                      @if ($errors->first($lang->locale .'.advertisements_web_img'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.advertisements_web_img') }}</div>
                      @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="advertisements_phone_img">{{ __('general::lang.phone_img_name') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9">
                      @include('general::layouts.includes.imagePreviewLang',
                      ['name' => 'advertisements_phone_img', 'value' => isset($advertisement) ? $advertisement->translate($lang->locale)->advertisements_phone_img : null,'type'=>'advertisements','lang'=>$lang->locale])

                        <div class="invalid-feedback d-block fb-700">{{ __('general::lang.imageValidate',['height'=> '250px','width'=> '400px']) }}</div>
                        @if ($errors->first($lang->locale .'.advertisements_phone_img'))
                            <div class="invalid-feedback">{{ $errors->first($lang->locale .'.advertisements_phone_img') }}</div>
                        @endif
                    </div>
                </div>

            </div>
          @endforeach

        </div>


    </div>
  </div>
</div>

@section('script')
  <script type="text/javascript">

    $(document).ready(function(){
        // Initialize File Input Plugin
        $("#advertisementImage").fileinput({
            'showUpload':false,
            'showCancel':false,
            'previewFileType':'any',
            theme: "fa",
            language: "{{ $dir == 'rtl' ? 'ar' : '' }}",
            required: "{{ isset($advertisement) ? false : true }}",
            rtl: "{{ $dir == 'rtl' ? true : false }}",
            autoReplace: true,
            overwriteInitial: false,
            allowedFileTypes: ['image'],
            // maxFileCount: 5
        });

        // Delete Old Images individually
        $('.deleteAdvertisementImage').click(function(){
            let btn =  $(this);
            let con = confirm("Are you sure?");

            if (con) {
                const filename = $(this).data('name');
                $.ajax({
                    url: "{{ route('admin.advertisements.deleteImage') }}",
                    method: 'POST',
                    dataType: 'json', // type of response data
                    data: {
                        filename
                    },
                    success: function (data) {   // success callback function
                        if (data.msg == 1) {
                            btn.closest('.advertisementImageContainer').hide("slow");
                        } else if(data.msg == 0) {
                            alert("Something wrong happens, try again!")
                        }
                    }
                });
            }

        });
    });
  </script>

@endsection
