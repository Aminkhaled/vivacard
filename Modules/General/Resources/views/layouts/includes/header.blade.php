
@php
  $nav = $dir == 'ltr' ? 'ml-auto' : 'mr-auto';
  $dropdown = $dir == 'ltr' ? 'dropdown-menu-left' : 'dropdown-menu-right';
  $dropdown2 = $dir == 'ltr' ? 'dropdown-menu-right' : 'dropdown-menu-left';
  $dropdown3 = $dir == 'ltr' ? 'header-submenu-left' : 'header-submenu';
@endphp

<header class="app-header  navbar ">

  <div class="container-fluid row " >
        <button class="   navbar-toggler sidebar-toggler d-lg-none mr-auto "  type="button" data-toggle="sidebar-show">
          <span class="navbar-toggler-icon"></span>
        </button>
          <a class=" col-lg-1 col-md-2 col-4 navbar-brand {{$dir}}" dir="{{$dir}}" href="{{ route('admin.dashboard.home') }}">
            <img class="d-md-down-none" src="{{ asset($locale == 'ar' ? 'assets/adminPanel/img/logo-ar.png' : 'assets/adminPanel/img/logo-en.png') }}" height="25" alt="{{env('APP_NAME','test')}}">

            <img class="d-lg-none" src="{{ asset($locale == 'ar' ? 'assets/adminPanel/img/logo-ar.png' : 'assets/adminPanel/img/logo-en.png') }}" height="30" alt="env('APP_NAME','test')">
          </a>

          <div class="col-lg-9  col-md-7   row m-0 p-0 d-md-down-none">
            <ul class="nav navbar-nav d-md-down-none">

                {{-- About Company --}}
                @canany(['view infos','view contactus','view special_screens'])
                  <li class="nav-item px-3">

                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      {{ __('general::lang.aboutProject') }}
                      <i class="fa fa-arrow-circle-down"></i>
                    </a>
                    <div class="dropdown-menu {{ $dropdown }}">


                      {{-- aboutus Link --}}
                      @can('view infos')
                        <a class="dropdown-item" href="{{ route('admin.infos.show', ['about', 'activeLocale' => $locale]) }}">
                            {{ __('general::lang.aboutus') }}
                        </a>
                      @endcan

                      @canany(['view contactus','view contacts'])
                        <div class="dropdown-item dropdown">
                          <button class=" btn-empty dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('general::lang.connectWithUs') }}
                          </button>
                          <div class="dropdown-menu {{ $dropdown3 }}" aria-labelledby="dropdownMenuButton">

                            {{-- contactus Link --}}
                            @can('view contactus')
                              <a class="dropdown-item" href="{{ route('admin.contactus.index') }}">
                                {{ __('general::lang.contactus') }}
                              </a>
                            @endcan

                            {{-- contacts Link --}}
                            @can('view contacts')
                              <a class="dropdown-item" href="{{ route('admin.contacts.show', ['show', 'activeLocale' => $locale]) }}">
                                {{ __('general::lang.contacts') }}
                              </a>
                            @endcan
                          </div>
                        </div>
                      @endcanany

                      {{-- privacyPolicy Link --}}
                      @can('view infos')
                        <a class="dropdown-item" href="{{ route('admin.infos.show', ['policy', 'activeLocale' => $locale]) }}">
                          {{ __('general::lang.privacyPolicy') }}
                        </a>
                      @endcan

                      {{-- termsConditions Link --}}
                      @can('view infos')
                        <a class="dropdown-item" href="{{ route('admin.infos.show', ['terms', 'activeLocale' => $locale]) }}">
                          {{ __('general::lang.termsConditions') }}
                        </a>
                      @endcan

                      {{-- usage_policy Link --}}
                      @can('view infos')
                        <a class="dropdown-item" href="{{ route('admin.infos.show', ['usage_policy', 'activeLocale' => $locale]) }}">
                          {{ __('general::lang.usagePolicy') }}
                        </a>
                      @endcan
                      
                      {{-- specialScreens Link --}}
                      @can('view special_screens')
                        <a class="dropdown-item" href="{{ route('admin.special_screens.index') }}">
                          {{ __('general::lang.special_screens') }}
                        </a>
                      @endcan

                    </div>
                  </li>
                @endcanany

                {{-- advertisements Links --}}
                @canany(['view advertisements'])
                    <li class="nav-item px-3">
                        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ __('general::lang.advertisements') }}
                            <i class="fa fa-arrow-circle-down"></i>
                        </a>
                        <div class="dropdown-menu {{ $dropdown }}">
                            {{-- advertisements Link --}}
                            @can('view advertisements')
                            <a class="dropdown-item" href="{{ route('admin.advertisements.index') }}">
                                {{ __('general::lang.advertisements') }}
                            </a>
                            @endcan
                        </div>
                    </li>
                @endcanany

                {{-- stores Links --}}
                @canany(['view stores'])
                  <li class="nav-item px-3">
                      <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                          {{ __('main::lang.stores') }}
                          <i class="fa fa-arrow-circle-down"></i>
                      </a>

                      <div class="dropdown-menu {{ $dropdown }}">
                          {{-- stores Link --}}
                          @can('view stores')
                          <a class="dropdown-item" href="{{ route('admin.stores.index') }}">
                              {{ __('main::lang.stores') }}
                          </a>
                          @endcan
                      </div>
                  </li>
                @endcanany

                {{-- categories Links --}}
                @canany(['view categories'])
                <li class="nav-item px-3">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ __('main::lang.categories') }}
                        <i class="fa fa-arrow-circle-down"></i>
                    </a>

                    <div class="dropdown-menu {{ $dropdown }}">
                        {{-- categories Link --}}
                        @can('view categories')
                        <a class="dropdown-item" href="{{ route('admin.categories.index') }}">
                            {{ __('main::lang.categories') }}
                        </a>
                        @endcan
                    </div>
                </li>
                @endcanany

                {{-- offers Links --}}
                @canany(['view offers'])
                <li class="nav-item px-3">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ __('main::lang.offers') }}
                        <i class="fa fa-arrow-circle-down"></i>
                    </a>

                    <div class="dropdown-menu {{ $dropdown }}">
                        {{-- offers Link --}}
                        @can('view offers')
                        <a class="dropdown-item" href="{{ route('admin.offers.index') }}">
                            {{ __('main::lang.offers') }}
                        </a>
                        @endcan
                    </div>
                </li>
                @endcanany

                {{-- coupons Links --}}
                @canany(['view coupons'])
                <li class="nav-item px-3">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ __('main::lang.coupons') }}
                        <i class="fa fa-arrow-circle-down"></i>
                    </a>

                    <div class="dropdown-menu {{ $dropdown }}">
                        {{-- coupons Link --}}
                        @can('view coupons')
                        <a class="dropdown-item" href="{{ route('admin.coupons.index') }}">
                            {{ __('main::lang.coupons') }}
                        </a>
                        @endcan
                    </div>
                </li>
                @endcanany

                {{-- daily_offers Links --}}
                @canany(['view daily_offers'])
                <li class="nav-item px-3">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ __('main::lang.daily_offers') }}
                        <i class="fa fa-arrow-circle-down"></i>
                    </a>

                    <div class="dropdown-menu {{ $dropdown }}">
                        {{-- daily_offers Link --}}
                        @can('view daily_offers')
                        <a class="dropdown-item" href="{{ route('admin.daily_offers.index') }}">
                            {{ __('main::lang.daily_offers') }}
                        </a>
                        @endcan
                    </div>
                </li>
                @endcanany
                
                {{-- customers Links --}}
                @canany(['view customers'])
                    <li class="nav-item px-3">
                        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ __('main::lang.customers') }}
                            <i class="fa fa-arrow-circle-down"></i>
                        </a>

                        <div class="dropdown-menu {{ $dropdown }}">

                            {{-- customers Link --}}
                            @can('view customers')
                            <a class="dropdown-item" href="{{ route('admin.customers.index') }}">
                                {{ __('main::lang.customers') }}
                            </a>
                            @endcan

                        </div>
                    </li>
                @endcanany

                {{-- articles Links --}}
                @canany(['view articles','view articles_categories'])
                    <li class="nav-item px-3">
                        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ __('main::lang.OurArticles') }}
                            <i class="fa fa-arrow-circle-down"></i>
                        </a>

                        <div class="dropdown-menu {{ $dropdown }}">

                          {{-- articles_categories Link --}}
                          @can('view articles_categories')
                          <a class="dropdown-item" href="{{ route('admin.articles_categories.index') }}">
                              {{ __('main::lang.articles_categories') }}
                          </a>
                          @endcan

                          {{-- articles Link --}}
                          @can('view articles')
                          <a class="dropdown-item" href="{{ route('admin.articles.index') }}">
                              {{ __('main::lang.articles') }}
                          </a>
                          @endcan

                        </div>
                    </li>
                @endcanany
 
                {{-- faqs Links --}}
                @canany(['view faqs'])
                  <li class="nav-item px-3">
                      <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                          {{ __('general::lang.faqs') }}
                          <i class="fa fa-arrow-circle-down"></i>
                      </a>
                      <div class="dropdown-menu {{ $dropdown }}">
                          {{-- faqs Link --}}
                          @can('view faqs')
                          <a class="dropdown-item" href="{{ route('admin.faqs.index') }}">
                              {{ __('general::lang.faqs') }}
                          </a>
                          @endcan
                      </div>
                  </li>
                @endcanany

                {{-- Admins Links --}}
                @canany(['view admins', 'view roles'])
                  <li class="nav-item px-3">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      {{ __('general::lang.admins') }}
                      <i class="fa fa-arrow-circle-down"></i>
                    </a>

                    <div class="dropdown-menu {{ $dropdown }}">

                      {{-- Roles Link --}}
                      @can('view roles')
                        <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                          {{ __('general::lang.permissions') }}
                        </a>
                      @endcan

                      {{-- Admins Link --}}
                      @can('view admins')
                        <a class="dropdown-item" href="{{ route('admin.admins.index') }}">
                          {{ __('general::lang.admins') }}
                        </a>
                      @endcan

                    </div>
                  </li>
                @endcanany

                {{-- Settings Links --}}
                @canany(['view settings','view countries','view cities'])
                  <li class="nav-item px-3">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      {{ __('general::lang.settings') }}
                      <i class="fa fa-arrow-circle-down"></i>
                    </a>

                    <div class="dropdown-menu {{ $dropdown }}">

                      {{-- settings Link --}}
                      @can('view settings')
                        <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                          {{ __('general::lang.general_data') }}
                        </a>
                      @endcan

                      {{-- countries Link --}}
                      @can('view countries')
                      <a class="dropdown-item" href="{{ route('admin.countries.index') }}">
                          {{ __('main::lang.countries') }}
                      </a>
                      @endcan

                      {{-- cities Link --}}
                      {{-- @can('view cities')
                      <a class="dropdown-item" href="{{ route('admin.cities.index') }}">
                          {{ __('main::lang.cities') }}
                      </a>
                      @endcan --}}

                    </div>
                  </li>
                @endcanany

            </ul>
          </div>

          <div class="col-lg-2 col-md-4 col-8 row m-0 p-0  mt-2">

            <ul class="nav navbar-nav {{ $nav }}">

              <li class="nav-item dropdown  ">
                <a class="nav-link px-2" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-globe"></i>  </a>
                <div class="dropdown-menu {{ $dropdown2  }}">

                  @foreach ($langs as $lang)
                    <a class="dropdown-item" href="{{ str_replace(env('APP_URL').'/'. $locale, env('APP_URL').'/'. $lang->locale, url()->full())   }}">
                      {{ __('general::lang.'. $lang->locale) }}
                    </a>
                  @endforeach
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link px-2" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="nav-icon icon-user"></i>
                </a>
                <div class="dropdown-menu {{ $dropdown2 }}">
                  <div class="dropdown-header text-center">
                    <strong>{{ auth()->user()->name }}</strong>
                  </div>
                  <a class="dropdown-item" href="{{ route('admin.admins.show', auth()->id()) }}">
                    <i class="fa fa-user"></i> {{ __('general::lang.profile') }}</a>
                  <a class="dropdown-item" href="{{ route('admin.auth.logout') }}">
                    <i class="fa fa-lock"></i> {{ __('general::lang.logout') }}</a>
                </div>
              </li>
            </ul>
          </div>

   </div>


  {{-- URLs --}}



</header>
