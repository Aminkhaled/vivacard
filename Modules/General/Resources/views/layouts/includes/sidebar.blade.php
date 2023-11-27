
<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard.home') }}">
            <i class="nav-icon icon-home"></i> {{ __('general::lang.home') }}
            </a>
        </li>

        {{-- About Company Links --}}
        @canany(['view infos','view contactus','view special_screens'])

            <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('general::lang.aboutProject') }}</a>
            <ul class="nav-dropdown-items">

                {{-- Infos Link --}}
                @can('view infos')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.infos.show', ['about', 'activeLocale' => $locale]) }}">
                        <i class="nav-icon fa fa-list-ul"></i> {{ __('general::lang.aboutus') }}</a>
                </li>
                @endcan

                {{-- Connect With Us Links --}}
                @canany(['view contactus','view contacts'])
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fa fa-compress"></i> {{ __('general::lang.connectWithUs') }}</a>
                    <ul class="nav-dropdown-items">

                    {{-- contactus Link --}}
                    @can('view contactus')
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.contactus.index') }}">
                            <i class="nav-icon fa fa-question-circle-o"></i> {{ __('general::lang.contactus') }}</a>
                        </li>
                    @endcan

                    {{-- contacts Link --}}
                    @can('view contacts')
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                            <i class="nav-icon fa fa-question-circle-o"></i> {{ __('general::lang.contacts') }}</a>
                        </li>
                    @endcan


                    </ul>
                </li>
                @endcanany

                {{-- privacyPolicy Link --}}
                @can('view infos')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.infos.show', ['policy', 'activeLocale' => $locale]) }}">
                    <i class="nav-icon fa fa-list-ul"></i>  {{ __('general::lang.privacyPolicy') }}</a>
                </li>
                @endcan

                {{-- termsConditions Link --}}
                @can('view infos')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.infos.show', ['terms', 'activeLocale' => $locale]) }}">
                    <i class="nav-icon fa fa-list-ol"></i> {{ __('general::lang.termsConditions') }}</a>
                </li>
                @endcan

                {{-- usage_policy Link --}}
                @can('view infos')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.infos.show', ['usage_policy', 'activeLocale' => $locale]) }}">
                    <i class="nav-icon fa fa-list-ol"></i> {{ __('general::lang.usagePolicy') }}</a>
                </li>
                @endcan
                
                {{-- specialScreens Link --}}
                @can('view special_screens')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.special_screens.index') }}">
                    <i class="nav-icon fa fa-list-ol"></i> {{ __('general::lang.special_screens') }}</a>
                </li>
                @endcan

            </ul>
            </li>
        @endcanany


        {{-- advertisements Links --}}
        @canany(['view advertisements'])
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('general::lang.advertisements') }}</a>
                <ul class="nav-dropdown-items">
                    {{-- advertisements Link --}}
                    @can('view advertisements')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.advertisements.index') }}" >
                            <i class="nav-icon fa fa-cogs"></i> {{ __('general::lang.advertisements') }}
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        {{-- stores Links --}}
        @canany(['view stores'])
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('main::lang.stores') }}</a>
            <ul class="nav-dropdown-items">
                {{-- stores Link --}}
                @can('view stores')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.stores.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.stores') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        {{-- categories Links --}}
        @canany(['view categories'])
        <li class="nav-item nav-dropdown ">
             <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('main::lang.categories') }}</a>
             <ul class="nav-dropdown-items">
                 {{-- categories Link --}}
                 @can('view categories')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.categories.index') }}" >
                         <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.categories') }}
                     </a>
                 </li>
                 @endcan
             </ul>
        </li>
        @endcanany

        {{-- offers Links --}}
        @canany(['view offers'])
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('main::lang.offers') }}</a>
            <ul class="nav-dropdown-items">
                {{-- offers Link --}}
                @can('view offers')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.offers.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.offers') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        {{-- coupons Links --}}
        @canany(['view coupons'])
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('main::lang.coupons') }}</a>
            <ul class="nav-dropdown-items">
                {{-- coupons Link --}}
                @can('view coupons')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.coupons.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.coupons') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        {{-- daily_offers Links --}}
        @canany(['view daily_offers'])
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('main::lang.daily_offers') }}</a>
            <ul class="nav-dropdown-items">
                {{-- daily_offers Link --}}
                @can('view daily_offers')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.daily_offers.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.daily_offers') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        {{-- customers Links --}}
        @canany(['view customers'])
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('main::lang.customers') }}</a>
            <ul class="nav-dropdown-items">

                {{-- customers Link --}}
                @can('view customers')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.customers.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.customers') }}
                    </a>
                </li>
                @endcan

            </ul>
        </li>
        @endcanany

        {{-- articles Links --}}
        @canany(['view articles'])
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('main::lang.OurArticles') }}</a>
            <ul class="nav-dropdown-items">

                {{-- articles_categories Link --}}
                @can('view articles_categories')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.articles_categories.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.articles_categories') }}
                    </a>
                </li>
                @endcan

                {{-- articles Link --}}
                @can('view articles')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.articles.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.articles') }}
                    </a>
                </li>
                @endcan

            </ul>
        </li>
        @endcanany

        {{-- faqs Links --}}
        @canany(['view faqs'])
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('general::lang.faqs') }}</a>
                <ul class="nav-dropdown-items">
                    {{-- faqs Link --}}
                    @can('view faqs')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.faqs.index') }}" >
                            <i class="nav-icon fa fa-cogs"></i> {{ __('general::lang.faqs') }}
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        @endcanany
        
        {{-- Admins Links --}}
        @canany(['view admins', 'view roles'])
            <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-people"></i> {{ __('general::lang.admins') }}</a>
            <ul class="nav-dropdown-items">

                @can('view admins')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admins.index') }}">
                    <i class="nav-icon icon-people"></i> {{ __('general::lang.admins') }}</a>
                </li>
                @endcan
                @can('view roles')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.roles.index') }}">
                    <i class="nav-icon fa fa-user-plus"></i> {{ __('general::lang.permissions') }}</a>
                </li>
                @endcan
            </ul>
            </li>
        @endcanany

        {{-- Website Links --}}
        @canany(['view settings','view countries','view cities' ])

            <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('general::lang.website') }}</a>
            <ul class="nav-dropdown-items">

                {{-- Settings Link --}}
                @can('view settings')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.settings.edit') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('general::lang.general_data') }}
                    </a>
                </li>
                @endcan

                {{-- countries Link --}}
                @can('view countries')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.countries.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.countries') }}
                    </a>
                </li>
                @endcan

                {{-- cities Link --}}
                {{-- @can('view cities')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.cities.index') }}" >
                        <i class="nav-icon fa fa-cogs"></i> {{ __('main::lang.cities') }}
                    </a>
                </li>
                @endcan --}}


            </ul>
            </li>
        @endcanany


      {{-- settings Link --}}
      @canany(['view settings'])
        <li class="nav-item d-none" >
            @can('view settings')
              <a class="nav-link" href="{{ route('admin.settings.index') }}" >
                <i class="nav-icon fa fa-cogs"></i> {{ __('general::lang.settings') }}
              </a>
            @endcan
        </li>
      @endcanany



    </ul>
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
