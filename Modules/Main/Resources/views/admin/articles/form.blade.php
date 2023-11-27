
@php
  $activeLocale = old('activeLocale', 'general');
  $activeLocale = 'general';
@endphp

<div class="card-body">
  @include('main::layouts.includes.messages')

  {{-- Tabs --}}
  <ul class="nav nav-tabs" id="langsTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link {{ $activeLocale == 'general' ? 'active' : '' }}" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">
      {{ __('main::lang.general') }}</a>
    </li>
    @foreach ($langs as $lang)
      <li class="nav-item">
        <a class="nav-link {{ $activeLocale == $lang->locale ? 'active' : '' }}" id="{{ $lang->locale }}-tab" data-toggle="tab" href="#{{ $lang->locale }}"
          role="tab" aria-controls="{{ $lang->locale }}" aria-selected="false">
          {{ __('main::lang.'. $lang->locale) }}
        </a>
      </li>
    @endforeach
  </ul>

  {{-- Tabs Content --}}
  <div class="tab-content" id="langsTabsContent">
    <div class="tab-pane fade {{ $activeLocale == 'general' ? 'show active' : '' }}" id="general" role="tabpanel" aria-labelledby="general-tab">
      <div class="row">
        <div class="col-lg-9">

        <!-- date field  -->
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="articles_date">{{ __('main::lang.date') }}<span class="text-danger"> *</span></label>
            <div class="col-md-6">
              <input class="form-control {{ $errors->first('articles_date') ? 'is-invalid' : '' }}" id="articles_date" type="date" name="articles_date"
               placeholder="{{ __('main::lang.date') }}" value="{{ old('articles_date', isset($article) ? $article->articles_date : 1) }}">
              @if ($errors->first('articles_date'))
                <div class="invalid-feedback">{{ $errors->first('articles_date') }}</div>
              @endif
            </div>
        </div>

        <!-- {{-- categories --}} -->
        <div class="form-group row mt-3">
            <label class="col-md-2 col-form-label" for="categories">{{ __('main::lang.category') }}<span class="text-danger"> *</span></label>
            <div class="col-md-6">
              <select class="form-control select2 {{ $errors->first('articles_categories_id') ? 'is-invalid' : '' }}" id="categories" name="articles_categories_id"
               placeholder="{{ __('main::lang.category') }}">
                <option value=""></option>

                @foreach ($categories as $category)

                  <option value="{{ $category->articles_categories_id }}"
                    {{
                      old('articles_categories_id',isset($article) && $article->category ? $article->category->articles_categories_id : '') == $category->articles_categories_id  ? 'selected' : ''
                    }}
                  >
                      {{ $category->articles_categories_name }}
                  </option>
                @endforeach
              </select>
              @if ($errors->first('articles_categories_id'))
                <div class="invalid-feedback">{{ $errors->first('articles_categories_id') }}</div>
              @endif
            </div>
        </div>
 
        <!-- image field  -->
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="articles_image">{{ __('main::lang.img') }}<span class="text-danger"> *</span></label>
            <div class="col-md-6">
            @include('main::layouts.includes.imagePreview', ['name' => 'articles_image', 'value' => isset($article) ? $article->articles_image : null,'type' => 'articles'])
            @if ($errors->first('articles_image'))
                <div class="invalid-feedback">{{ $errors->first('articles_image') }}</div>
            @endif
            </div>
        </div>

        <!-- position field  -->
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="articles_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
            <div class="col-md-6">
                <input class="form-control {{ $errors->first('articles_position') ? 'is-invalid' : '' }}" id="articles_position" type="text" name="articles_position"
                placeholder="{{ __('main::lang.position') }}" value="{{ old('articles_position', isset($article) ? $article->articles_position : 10000) }}">
                @if ($errors->first('articles_position'))
                <div class="invalid-feedback">{{ $errors->first('articles_position') }}</div>
                @endif
            </div>
        </div>

        <!-- status field  -->
        <div class="form-group row">
            <label class="col-md-2 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
            <div class="col-md-6 col-form-label">

                @php
                    $status = old('articles_status', isset($article) ? $article->articles_status : 1);
                @endphp

               <input type="hidden" id="articles_status_input" name="articles_status" value="{{ $status }}">
               <input type="checkbox" name="articles_statuss" id="articles_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('articles')">

              @if ($errors->first('articles_status'))
                <div class="invalid-feedback">{{ $errors->first('articles_status') }}</div>
              @endif
            </div>
        </div>

          <!-- articles_featured field  -->
          <div class="form-group row">
            <label class="col-md-2 col-form-label">{{ __('main::lang.articles_featured') }}<span class="text-danger"> *</span></label>
            <div class="col-md-6 col-form-label">

                @php
                    $articles_featured = old('articles_featured', isset($article) ? $article->articles_featured : 0);
                @endphp

               <input type="hidden" id="articles_featured_input" name="articles_featured" value="{{ $articles_featured }}">
               <input type="checkbox" name="articles_featureds" id="articles_featured"  {{ $articles_featured ? 'checked' : '' }}  data-on=" {{__('main::lang.yes')}}" data-off=" {{__('main::lang.no')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeToggleInput('articles_featured')">
              @if ($errors->first('articles_featured'))
                <div class="invalid-feedback">{{ $errors->first('articles_featured') }}</div>
              @endif
            </div>
        </div>

        </div>
      </div>
    </div>
    {{-- Languages Tabs --}}
    @foreach ($langs as $lang)
      <div class="tab-pane fade {{ $activeLocale == $lang->locale ? 'show active' : '' }}" id="{{ $lang->locale }}" role="tabpanel" aria-labelledby="{{ $lang->locale }}-tab">

        <div class="row">

            <div class="col-lg-9">
                <p class="text-primary h6">{{ __('main::lang.articleDetails') }}</p>

                <!-- article field  -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('main::lang.title') }}<span class="text-danger"> *</span></label>

                    <div class="col-md-6">
                        <input class="form-control articles_title {{ $errors->first($lang->locale .'.articles_title') ? 'is-invalid' : '' }}" type="text"
                        name="{{ $lang->locale .'[articles_title]' }}" placeholder="{{ __('main::lang.title') }}"
                        value="{{ old($lang->locale .'.articles_title', isset($article) ? $article->translate($lang->locale)->articles_title : '') }}">
                        @if ($errors->first($lang->locale .'.articles_title'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.articles_title') }}</div>
                        @endif
                    </div>

                </div>

                <!-- article field  -->
                {{-- <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('main::lang.slug') }}<span class="text-danger"> *</span></label>

                    <div class="col-md-6">
                        <input class="form-control articles_slug {{ $errors->first($lang->locale .'.articles_slug') ? 'is-invalid' : '' }}" type="text"
                        name="{{ $lang->locale .'[articles_slug]' }}" placeholder="{{ __('main::lang.slug') }}"
                        value="{{ old($lang->locale .'.articles_slug', isset($article) ? $article->translate($lang->locale)->articles_slug : '') }}">
                        @if ($errors->first($lang->locale .'.articles_slug'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.articles_slug') }}</div>
                        @endif
                    </div>

                </div> --}}

                <!-- answer field  -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('main::lang.desc') }}<span class="text-danger"> *</span></label>
                    <div class="col-md-9">
                        <textarea id="{{ $lang->locale }}-ckeditor" class="form-control ckeditor {{ $errors->first($lang->locale .'.articles_desc') ? 'is-invalid' : '' }}"
                        name="{{ $lang->locale .'[articles_desc]' }}" rows="9" placeholder="{{ __('main::lang.desc') }}"
                        >{{ old($lang->locale .'.articles_desc', isset($article) ? $article->translate($lang->locale)->articles_desc : '') }}</textarea>
                        @if ($errors->first($lang->locale .'.articles_desc'))
                            <div class="invalid-feedback">{{ $errors->first($lang->locale .'.articles_desc') }}</div>
                        @endif
                    </div>
                </div>

                <!-- article seo title field  -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('main::lang.seo_title') }}<span class="text-danger">  </span></label>
                    <div class="col-md-6">
                        <input class="form-control character-title {{ $errors->first($lang->locale .'.articles_seo_title') ? 'is-invalid' : '' }}" type="text"
                        name="{{ $lang->locale .'[articles_seo_title]' }}" placeholder="{{ __('main::lang.seo_title') }}"
                        value="{{ old($lang->locale .'.articles_seo_title', isset($article) ? $article->translate($lang->locale)->articles_seo_title : '') }}">
                        @if ($errors->first($lang->locale .'.articles_seo_title'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.articles_seo_title') }}</div>
                        @endif
                    </div>
                    <span class="character-count"></span>
                </div>

                <!-- article seo desc field  -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('main::lang.seo_keyword') }}<span class="text-danger">  </span></label>
                    <div class="col-md-9">
                        <input class="form-control {{ $errors->first($lang->locale .'.articles_seo_keyword') ? 'is-invalid' : '' }}" type="text"
                        name="{{ $lang->locale .'[articles_seo_keyword]' }}" placeholder="{{ __('main::lang.seo_keyword') }}"
                        value="{{ old($lang->locale .'.articles_seo_keyword', isset($article) ? $article->translate($lang->locale)->articles_seo_keyword : '') }}" data-role="tagsinput">
                        @if ($errors->first($lang->locale .'.articles_seo_keyword'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.articles_seo_keyword') }}</div>
                        @endif
                    </div>

                </div>

                <!-- article seo keyword field  -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('main::lang.seo_desc') }}</label>
                    <div class="col-md-9">
                        <textarea   class=" character-desc form-control {{ $errors->first($lang->locale .'.articles_seo_desc') ? 'is-invalid' : '' }}"
                        name="{{ $lang->locale .'[articles_seo_desc]' }}"
                            id="{{ $lang->locale .'[articles_seo_desc]' }}"
                            placeholder="{{ __('main::lang.seo_desc') }}"
                            rows="3">{{ old($lang->locale .'.articles_seo_desc', isset($article) ? $article->translate($lang->locale)->articles_seo_desc : '') }}</textarea>
                        @if ($errors->first($lang->locale .'.articles_seo_desc'))
                        <div class="invalid-feedback">{{ $errors->first($lang->locale .'.articles_seo_desc') }}</div>
                        @endif
                    </div>
                    <span class="character-count"></span>
                </div>

            </div>

        </div>

      </div>
    @endforeach



  </div>
</div>
@section('style')
<link rel="stylesheet" href="{{ asset('assets/adminPanel/css/tagsinput.css') }}">

@endsection
 
@section('script')
  <script src="{{ asset('assets/adminPanel/js/tagsinput.js') }}"></script>
  <script>
        function changeToggleInput(type){
          if(document.getElementById(type).checked){
              $('#'+type+'_input').val('1')
          }else{
              $('#'+type+'_input').val('0')
          }
 
        $('.character-title').on('keydown keyup', function(e){
            var total = 70;
            var value = $(this).val();
            var remaining = total - value.length;
            // if(remaining == 0 && e.keyCode != 46 && e.keyCode != 8)  // 46 => delete, 8 => backspace
            // {
            //     e.preventDefault();
            // }
            $(this).parent('.col-md-6').siblings('.character-count').text(remaining);

        });
        $('.character-desc').on('keydown keyup', function(e){
            var total = 160;
            var value = $(this).val();
            var remaining = total - value.length;
            // if(remaining == 0 && e.keyCode != 46 && e.keyCode != 8)  // 46 => delete, 8 => backspace
            // {
            //     e.preventDefault();
            // }
            $(this).parent('.col-md-9').siblings('.character-count').text(remaining);

        });

        $(document).ready(function(){

            // Initialize File Input Plugin
            $("#articleImage").fileinput({
                'showUpload':false,
                'showCancel':false,
                'previewFileType':'any',
                theme: "fa",
                language: "{{ $dir == 'rtl' ? 'ar' : '' }}",
                required: "{{ isset($article) ? false : false }}",
                rtl: "{{ $dir == 'rtl' ? true : false }}",
                autoReplace: true,
                overwriteInitial: false,
                allowedFileTypes: ['image'],
                // maxFileCount: 5
                });

            // Delete Old Images individually
            $('.deleteArticleImage').click(function(){
                let btn =  $(this);
                let con = confirm("Are you sure?");

                if (con) {
                const filename = $(this).data('name');
                $.ajax({
                    url: "{{ route('admin.articles.deleteImage') }}",
                    method: 'POST',
                    dataType: 'json', // type of response data
                    data: {
                        filename
                    },
                    success: function (data) {   // success callback function
                        if (data.msg == 1) {
                            btn.closest('.articleImageContainer').hide("slow");
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


