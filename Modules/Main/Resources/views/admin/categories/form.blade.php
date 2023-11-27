
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

          <div class="form-group row ">
              <label class="col-md-3 col-form-label" for="categories_image">{{ __('main::lang.img') }}<span class="text-danger">  </span></label>
              <div class="col-md-9">
                @include('main::layouts.includes.imagePreview', ['name' => 'categories_image', 'value' => isset($category) ? $category->categories_image : null,'type'=>'categories'])
                @if ($errors->first('categories_image'))
                  <div class="invalid-feedback">{{ $errors->first('categories_image') }}</div>
                @endif
              </div>
          </div>
          @if(isset($category) && $category->categories_image)
          <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.delete_image') }}<span class="text-danger">
                     </span></label>
              <div class="col-md-9 col-form-label">
                  <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" id="delete_image" type="checkbox" value="1"name="delete_image"  >
                   </div>

              </div>
          </div>
          @endif
          <div class="form-group my-4 row">
            <label class="col-md-3 col-form-label" for="categories">{{ __('main::lang.topCategory') }}</label>
            <div class="col-md-9">
              <select class="form-control select2 {{ $errors->first('categories') ? 'is-invalid' : '' }}" id="categories" name="categories_parent_id" placeholder="{{ __('main::lang.topCategory') }}">
                    <option value="">{{ __('main::lang.topCategory') }}</option>
                    @foreach ($categories as $selectCategory)
                        @if($selectCategory->isRoot())
                            <option value="{{ $selectCategory->categories_id }}"
                                {{ isset($category) && $category->categories_parent_id == $selectCategory->categories_id ? 'selected' : '' }}
                            >
                              {{ $selectCategory->categories_name }}
                            </option>
                        @else
                            @php
                                $parents = $selectCategory->getAncestors()->pluck('categories_name')->toArray();
                            @endphp
                            <option value="{{ $selectCategory->categories_id }}"
                                {{ isset($category) && $category->categories_parent_id == $selectCategory->categories_id ? 'selected' : '' }}
                            >
                                {{-- @foreach ($parents as $parent)
                                    {{ $parent }} =>
                                @endforeach
                              {{ $selectCategory->categories_name }} --}}
                              @foreach(getCategoryParentChilds($selectCategory) as $parent)
                                @if($loop->last)
                                {{ $parent }}
                                @else
                                {{ $parent }} =>
                                @endif
                              @endforeach
                            </option>

                        @endif
                    @endforeach
              </select>
              @if ($errors->first('categories_parent_id'))
                <div class="invalid-feedback">{{ $errors->first('categories_parent_id') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="categories_code">{{ __('main::lang.categories_code') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('categories_code') ? 'is-invalid' : '' }}" id="categories_code" type="text" name="categories_code"
               placeholder="{{ __('main::lang.categories_code') }}" value="{{ old('categories_code', isset($category) ? $category->categories_code : '') }}">
              @if ($errors->first('categories_code'))
                <div class="invalid-feedback">{{ $errors->first('categories_code') }}</div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="categories_position">{{ __('main::lang.position') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9">
              <input class="form-control {{ $errors->first('categories_position') ? 'is-invalid' : '' }}" id="categories_position" type="text" name="categories_position"
               placeholder="{{ __('main::lang.position') }}" value="{{ old('categories_position', isset($category) ? $category->categories_position : 1) }}">
              @if ($errors->first('categories_position'))
                <div class="invalid-feedback">{{ $errors->first('categories_position') }}</div>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
            <div class="col-md-9 col-form-label">
              @php
                $status = old('categories_status', isset($category) ? $category->categories_status : 1);
              @endphp
              <input type="hidden" id="categories_status_input" name="categories_status" value="{{ $status }}">
              <input type="checkbox" name="categories_statuss" id="categories_status"  {{ $status ? 'checked' : '' }}  data-on=" {{__('main::lang.active')}}" data-off=" {{__('main::lang.stopped')}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="80px" onChange="changeStatusInput('categories')">

              @if ($errors->first('categories_status'))
                <div class="invalid-feedback">{{ $errors->first('categories_status') }}</div>
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
            <p class="text-primary h6">{{ __('main::lang.categoryDetails') }}</p>
            <div class="form-group row">
              <label class="col-md-2 col-form-label">{{ __('main::lang.name') }}<span class="text-danger"> *</span></label>

              <div class="col-md-10">
                <input class="form-control {{ $errors->first($lang->locale .'.categories_name') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[categories_name]' }}" placeholder="{{ __('main::lang.name') }}"
                 value="{{ old($lang->locale .'.categories_name', isset($category) ? $category->translate($lang->locale)->categories_name : '') }}">
                @if ($errors->first($lang->locale .'.categories_name'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_name') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('main::lang.seo_title') }}<span class="text-danger">  </span></label>
                <div class="col-md-10">
                    <input class="form-control {{ $errors->first($lang->locale .'.categories_seo_title') ? 'is-invalid' : '' }}" type="text"
                     name="{{ $lang->locale .'[categories_seo_title]' }}" placeholder="{{ __('main::lang.seo_title') }}"
                     value="{{ old($lang->locale .'.categories_seo_title', isset($category) ? $category->translate($lang->locale)->categories_seo_title : '') }}">
                    @if ($errors->first($lang->locale .'.categories_seo_title'))
                      <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_seo_title') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('main::lang.seo_keyword') }}<span class="text-danger">  </span></label>

                <div class="col-md-10">
                    <input class="form-control {{ $errors->first($lang->locale .'.categories_seo_keyword') ? 'is-invalid' : '' }}" type="text"
                    name="{{ $lang->locale .'[categories_seo_keyword]' }}" placeholder="{{ __('main::lang.seo_keyword') }}"
                    value="{{ old($lang->locale .'.categories_seo_keyword', isset($category) ? $category->translate($lang->locale)->categories_seo_keyword : '') }}" data-role="tagsinput">
                    @if ($errors->first($lang->locale .'.categories_seo_keyword'))
                    <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_seo_keyword') }}</div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ __('main::lang.seo_desc') }}</label>
                <div class="col-md-10">
                    <textarea   class="  form-control {{ $errors->first($lang->locale .'.categories_seo_desc') ? 'is-invalid' : '' }}"
                      name="{{ $lang->locale .'[categories_seo_desc]' }}"
                        id="{{ $lang->locale .'[categories_seo_desc]' }}"
                        placeholder="{{ __('main::lang.seo_desc') }}"
                        rows="3">{{ old($lang->locale .'.categories_seo_desc', isset($category) ? $category->translate($lang->locale)->categories_seo_desc : '') }}</textarea>
                    @if ($errors->first($lang->locale .'.categories_seo_desc'))
                      <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_seo_desc') }}</div>
                    @endif
                </div>
            </div>
          </div>

        </div>

      <div class="row comparisonItems {{ isset($allow) && $allow == 1 ? '' : 'd-none' }}"  >

          <div class="col-lg-9">
            <p class="text-primary h6">{{ __('main::lang.comparisonItems') }}  </p>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.item1') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.categories_comparison_item1') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[categories_comparison_item1]' }}" placeholder="{{ __('main::lang.item1') }}"
                 value="{{ old($lang->locale .'.categories_comparison_item1', isset($category->CategoryComparison) ? $category->CategoryComparison->translate($lang->locale)->categories_comparison_item1 : '') }}">
                @if ($errors->first($lang->locale .'.categories_comparison_item1'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_comparison_item1') }}</div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.item2') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.categories_comparison_item2') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[categories_comparison_item2]' }}" placeholder="{{ __('main::lang.item2') }}"
                 value="{{ old($lang->locale .'.categories_comparison_item2', isset($category->CategoryComparison) ? $category->CategoryComparison->translate($lang->locale)->categories_comparison_item2 : '') }}">
                @if ($errors->first($lang->locale .'.categories_comparison_item2'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_comparison_item2') }}</div>
                @endif
              </div>
            </div>


            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.item3') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.categories_comparison_item3') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[categories_comparison_item3]' }}" placeholder="{{ __('main::lang.item3') }}"
                 value="{{ old($lang->locale .'.categories_comparison_item3', isset($category->CategoryComparison) ? $category->CategoryComparison->translate($lang->locale)->categories_comparison_item3 : '') }}">
                @if ($errors->first($lang->locale .'.categories_comparison_item3'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_comparison_item3') }}</div>
                @endif
              </div>
            </div>


            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.item4') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.categories_comparison_item4') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[categories_comparison_item4]' }}" placeholder="{{ __('main::lang.item4') }}"
                 value="{{ old($lang->locale .'.categories_comparison_item4', isset($category->CategoryComparison) ? $category->CategoryComparison->translate($lang->locale)->categories_comparison_item4 : '') }}">
                @if ($errors->first($lang->locale .'.categories_comparison_item4'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_comparison_item4') }}</div>
                @endif
              </div>
            </div>


            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.item5') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.categories_comparison_item5') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[categories_comparison_item5]' }}" placeholder="{{ __('main::lang.item5') }}"
                 value="{{ old($lang->locale .'.categories_comparison_item5', isset($category->CategoryComparison) ? $category->CategoryComparison->translate($lang->locale)->categories_comparison_item5 : '') }}">
                @if ($errors->first($lang->locale .'.categories_comparison_item5'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_comparison_item5') }}</div>
                @endif
              </div>
            </div>


            <div class="form-group row">
              <label class="col-md-3 col-form-label">{{ __('main::lang.item6') }}<span class="text-danger"> *</span></label>

              <div class="col-md-9">
                <input class="form-control {{ $errors->first($lang->locale .'.categories_comparison_item6') ? 'is-invalid' : '' }}" type="text"
                 name="{{ $lang->locale .'[categories_comparison_item6]' }}" placeholder="{{ __('main::lang.item6') }}"
                 value="{{ old($lang->locale .'.categories_comparison_item6', isset($category->CategoryComparison) ? $category->CategoryComparison->translate($lang->locale)->categories_comparison_item6 : '') }}">
                @if ($errors->first($lang->locale .'.categories_comparison_item6'))
                  <div class="invalid-feedback">{{ $errors->first($lang->locale .'.categories_comparison_item6') }}</div>
                @endif
              </div>
            </div>


          </div>

        </div>

      </div>
    @endforeach
  </div>
</div>
@section('style')
<link rel="stylesheet" href="{{ asset('front/css/tagsinput.css') }}">
@endsection
@section('script')
  <script src="{{ asset('front/js/tagsinput.js') }}"></script>
  <script>
    function checkIfCategoryIsLeaf(categories_id){
      @foreach ($categories as $categ)
        if(categories_id == "{{$categ->categories_id}}"){
          @if($categ->categories_allow_comparison == 1)
            alert('{{__("main::lang.comparisonDateWillDeleted")}}')
          @endif
          @if($categ->isLeaf())
            return true ;
          @else
            @foreach($allLeavesIds as $leaf)
                if(categories_id == "{{ $leaf->categories_parent_id }}"){
                    return true ;
                }
            @endforeach
            return false ;
          @endif
        }
      @endforeach
    }
    function checkIfCategoryIsRoot(categories_id){
      @foreach ($categories as $categ)
        if(categories_id == "{{$categ->categories_id}}"){
          @if($categ->isRoot())
            return true ;
          @else
            return false ;
          @endif
        }
      @endforeach
    }
    function checkParentCategory(categories_id){
      if(categories_id){
        if(checkIfCategoryIsLeaf(categories_id)){

            $('#categories_allow_comparison').removeClass('d-none')
            // $('.badge_div').removeClass('d-none');

            @if(isset($category) && $category->categories_allow_comparison == '1')
                $('.comparisonItems').removeClass('d-none');
            @else
                $("input[name='categories_allow_comparison'][value='0']").prop('checked', true);
                $('.comparisonItems').addClass('d-none');
            @endif
        }else{
            $('#categories_allow_comparison').addClass('d-none')
            $("input[name='categories_allow_comparison'][value='0']").prop('checked', true);
            $('.comparisonItems').addClass('d-none');
            // $('.badge_div').addClass('d-none');

        }
        $('#categories_allow_ratings').addClass('d-none')
        $("input[name='categories_allow_ratings'][value='0']").prop('checked', true);
      }else{
        $('#categories_allow_comparison').addClass('d-none')
        $('#categories_allow_ratings').removeClass('d-none')
        // $("input[name='categories_allow_comparison'][value='0']").prop('checked', true);
        //   $('.comparisonItems').addClass('d-none');
      }
    }
    categories_id =  $("#categories").val();
    checkParentCategory(categories_id)

    $("#categories").change(function (){
        categories_id =  $("#categories").val();
        checkParentCategory(categories_id)
    });

    @if(isset($category))
      @if($category->isLeaf())
            $('#categories_allow_comparison').removeClass('d-none')
            // $('.badge_div').removeClass('d-none');
            @if(isset($category) && $category->categories_allow_comparison == '1')
                $('.comparisonItems').removeClass('d-none');
            @else
                $('.comparisonItems').addClass('d-none');
            @endif
      @else
        $('#categories_allow_comparison').addClass('d-none')
        $("input[name='categories_allow_comparison'][value='0']").prop('checked', true);
        $('.comparisonItems').addClass('d-none');
        // $('.badge_div').addClass('d-none');
      @endif

      @if($category->isRoot())
        $('#categories_allow_ratings').removeClass('d-none')
      @else
        $('#categories_allow_ratings').addClass('d-none')
        $("input[name='categories_allow_ratings'][value='0']").prop('checked', true);
      @endif
    @endif

    $("#allowed").change(function (){
        allowed =  $("#allowed").val();
        if(allowed == 1){
          $('.comparisonItems').removeClass('d-none');
        }else{
          $('.comparisonItems').addClass('d-none');
        }
      });
    $("#notAllowed").change(function (){
     allowed =  $("#notAllowed").val();
        if(allowed == 1){
          $('.comparisonItems').removeClass('d-none');
        }else{
          $('.comparisonItems').addClass('d-none');
        }
    });

    function changeToggleInput(type){
        if(document.getElementById(type).checked){
            $('#'+type+'_input').val('1')
        }else{
            $('#'+type+'_input').val('0')
        }
    }
  </script>
@endsection
