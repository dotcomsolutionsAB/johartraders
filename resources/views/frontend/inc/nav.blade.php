    <!-- Top Bar Banner -->
    @php
        $topbar_banner = get_setting('topbar_banner');
        $topbar_banner_medium = get_setting('topbar_banner_medium');
        $topbar_banner_small = get_setting('topbar_banner_small');
        $topbar_banner_asset = uploaded_asset($topbar_banner);
    @endphp
    @if ($topbar_banner != null)
        <div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner"
            data-value="removed">
            <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset h-40px h-lg-60px">
                <!-- For Large device -->
                <img src="{{ $topbar_banner_asset }}" class="d-none d-xl-block img-fit h-100" alt="{{ translate('topbar_banner') }}">
                <!-- For Medium device -->
                <img src="{{ $topbar_banner_medium != null ? uploaded_asset($topbar_banner_medium) : $topbar_banner_asset }}"
                    class="d-none d-md-block d-xl-none img-fit h-100" alt="{{ translate('topbar_banner') }}"> 
                <!-- For Small device -->
                <img src="{{ $topbar_banner_small != null ? uploaded_asset($topbar_banner_small) : $topbar_banner_asset }}"
                    class="d-md-none img-fit h-100" alt="{{ translate('topbar_banner') }}">
            </a>
            <button class="btn text-white h-100 absolute-top-right set-session" data-key="top-banner"
                data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
                <i class="la la-close la-2x"></i>
            </button>
        </div>
    @endif

    <!-- Top Bar -->
    <div class="top-navbar bg-white z-1035 h-35px h-sm-auto">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col">
                    <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                        @if (get_setting('show_language_switcher') == 'on')
                            {{-- <li class="list-inline-item dropdown mr-4" id="lang-change">
                                
                                <a href="javascript:void(0)" class="dropdown-toggle text-secondary fs-12 py-2"
                                    data-toggle="dropdown" data-display="static">
                                    <span class="">{{ $system_language->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    @foreach (get_all_active_language() as $key => $language)
                                        <li>
                                            <a href="javascript:void(0)" data-flag="{{ $language->code }}"
                                                class="dropdown-item @if ($system_language->code == $language->code) active @endif">
                                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                                    class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                                <span class="language">{{ $language->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li> --}}
                        @endif

                        <!-- Currency Switcher -->
                        @if (get_setting('show_currency_switcher') == 'on')
                            {{-- <li class="list-inline-item dropdown ml-auto ml-lg-0 mr-0" id="currency-change">
                                @php
                                    $system_currency = get_system_currency();
                                @endphp

                                <a href="javascript:void(0)" class="dropdown-toggle text-secondary fs-12 py-2"
                                    data-toggle="dropdown" data-display="static">
                                    {{ $system_currency->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                    @foreach (get_all_active_currency() as $key => $currency)
                                        <li>
                                            <a class="dropdown-item @if ($system_currency->code == $currency->code) active @endif"
                                                href="javascript:void(0)"
                                                data-currency="{{ $currency->code }}">{{ $currency->name }}
                                                ({{ $currency->symbol }})</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li> --}}
                        @endif
                    </ul>
                </div>
                <div class="col-6 text-right d-none d-lg-block">
                    <ul class="list-inline mb-0 h-100 d-flex justify-content-end align-items-center">
                        @if (get_setting('vendor_system_activation') == 1)
                            <!-- Become a Seller -->
                            {{-- <li class="list-inline-item mr-0 pl-0 py-2">
                                <a href="{{ route('shops.create') }}"
                                    class="text-secondary fs-12 pr-3 d-inline-block border-width-2 border-right">{{ translate('Become a Seller !') }}</a>
                            </li>
                            <!-- Seller Login -->
                            <li class="list-inline-item mr-0 pl-0 py-2">
                                <a href="{{ route('seller.login') }}"
                                    class="text-secondary fs-12 pl-3 d-inline-block">{{ translate('Login to Seller') }}</a>
                            </li> --}}
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <header class="@if (get_setting('header_stikcy') == 'on')  @endif z-1020 bg-white" >
        <!-- Search Bar -->
        <!-- Header Logo and Top Bar Area -->
        <div class="position-relative logo-bar-area border-bottom z-1025" style="background: #ff5a00 ;">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Sidebar Button for Mobile (Left side for mobile view) -->
                <button type="button" class="btn d-lg-none mr-3 p-0 active" data-toggle="class-toggle"
                    data-target=".aiz-top-menu-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <rect width="16" height="2" transform="translate(0 7)" fill="#919199" />
                        <rect width="16" height="2" fill="#919199" />
                        <rect width="16" height="2" transform="translate(0 14)" fill="#919199" />
                    </svg>
                </button>

                <!-- Helpline Number (Right aligned on desktop) -->
                <div class="helpline d-none d-lg-block">
                    <a href="tel:+919831050825" style="color:#fff; text-decoration: none;">
                        <span>{{ translate('Helpline: +91') }}</span>
                        <span style="color:#fff;">9831050825</span>
                    </a>
                </div>
                
                <!-- Search Field (Mobile: Right aligned | Desktop: Next to helpline number) -->
                {{-- <div class="front-header-search d-flex align-items-center bg-white mx-xl-5" style="padding: 5px;">
                    <div class="search-input" style="width: 250px;">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <input type="text" class="border border-soft-light form-control fs-14 hov-animate-outline"
                                    id="search" name="keyword" placeholder="{{ translate('I am shopping for...') }}"
                                    autocomplete="off" @isset($query) value="{{ $query }}" @endisset>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                    <path d="M9.847,17.839a7.993,7.993,0,1,1,7.993-7.993A8,8,0,0,1,9.847,17.839Zm0-14.387a6.394,6.394,0,1,0,6.394,6.394A6.4,6.4,0,0,0,9.847,3.453Z"
                                        transform="translate(-1.854 -1.854)" fill="#b5b5bf" />
                                    <path d="M24.4,25.2a.8.8,0,0,1-.565-.234l-6.15-6.15a.8.8,0,0,1,1.13-1.13l6.15,6.15A.8.8,0,0,1,24.4,25.2Z"
                                        transform="translate(-5.2 -5.2)" fill="#b5b5bf" />
                                </svg>
                            </div>
                        </form>
                        <!-- Search Suggestion Box -->
                        <div class="typed-search-box document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                            style="min-height: 200px;">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16"></div>
                            <div id="search-content" class="text-left" style="background: white; z-index: 999;"></div>
                        </div>
                    </div>
                </div> --}}
                <!-- Search field -->
                <div class="front-header-search d-flex align-items-center bg-white mx-xl-5" >
                    <div class="" style="width: 250px; margin-right: 0; background: #ff5a00 ;"> <!-- Adjust width and align to the right -->
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="search-input-box">
                                    <input type="text"
                                        class="border border-soft-light form-control fs-14 hov-animate-outline"
                                        id="search" name="keyword"
                                        @isset($query)
                                        value="{{ $query }}"
                                    @endisset
                                        placeholder="{{ translate('I am shopping for...') }}" autocomplete="off">
                
                                    <svg id="Group_723" data-name="Group 723" xmlns="http://www.w3.org/2000/svg"
                                        width="20.001" height="20" viewBox="0 0 20.001 20">
                                        <path id="Path_3090" data-name="Path 3090"
                                            d="M9.847,17.839a7.993,7.993,0,1,1,7.993-7.993A8,8,0,0,1,9.847,17.839Zm0-14.387a6.394,6.394,0,1,0,6.394,6.394A6.4,6.4,0,0,0,9.847,3.453Z"
                                            transform="translate(-1.854 -1.854)" fill="#b5b5bf" />
                                        <path id="Path_3091" data-name="Path 3091"
                                            d="M24.4,25.2a.8.8,0,0,1-.565-.234l-6.15-6.15a.8.8,0,0,1,1.13-1.13l6.15,6.15A.8.8,0,0,1,24.4,25.2Z"
                                            transform="translate(-5.2 -5.2)" fill="#b5b5bf" />
                                    </svg>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px;">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">
                
                            </div>
                            <div id="search-content" class="text-left" style="background: white; z-index:999;">
                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Icon for Mobile (Right aligned) -->
                <div class="d-lg-none ml-auto mr-0">
                    <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle"
                        data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Add this CSS for responsiveness and proper alignment -->
        <style>
            /* General styling */
            .logo-bar-area {
                /* padding: 10px 0; */
            }

            .helpline {
                font-size: 16px;
                color: #131010;
            }

            /* Desktop view */
            @media (min-width: 992px) {
                .container {
                    justify-content: flex-end; /* Align everything to the right on desktop */
                }

                .front-header-search {
                    margin-left: 20px; /* Margin between helpline and search bar on desktop */
                }
            }

            /* Mobile view adjustments */
            @media (max-width: 768px) {
                .logo-bar-area {
                    padding: 10px 15px;
                }

                .helpline {
                    display: none; /* Hide helpline number on mobile */
                }

                .search-input {
                    width: 100%; /* Full width search on mobile */
                }

                .d-lg-none {
                    margin-right: 10px;
                }
            }
        </style>

        <!-- Header Logo -->
        <div class="logo-bar-area border-bottom border-md-none z-1025" style="display: flex; justify-content: center; padding-left: 15vw;">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="col-auto pl-0 pr-3 d-flex align-items-center justify-content-center logo-container">
                        <a class="d-block py-20px mr-3 ml-0" href="{{ route('home') }}">
                            @php
                                $header_logo = get_setting('header_logo');
                            @endphp
                            @if ($header_logo != null)
                                <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-auto img-fluid logo-img">
                            @else
                                <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-auto img-fluid logo-img">
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add this CSS -->
        <style>
            /* Default for larger screens (laptop, desktop) */
            .logo-container {
                width: 60vw;
            }
            .logo-img {
                max-width: 100%;
                height: auto;
            }

            /* For mobile view */
            @media (max-width: 768px) {
                .logo-bar-area {
                    padding-left: 0; /* Remove extra padding */
                }
                .logo-container {
                    width: 100%; /* Ensure container takes full width */
                    justify-content: center; /* Keep it centered */
                }
                .logo-img {
                    max-width: 80%; /* Allow the image to shrink on mobile */
                }
            }
        </style>
        <!-- Menu Bar -->
        <div class="d-none d-lg-block position-relative bg-primary h-65px">
            <div class="container-fluid">
                <div class="d-flex h-100 justify-content-between align-items-center">
                    <!-- Category Menu Button (Visible on all screens) -->
                    <div class="d-none d-lg-block d-xl-block all-category has-transition bg-black-10" id="category-menu-bar">
                        <div class="px-3 h-100 d-flex align-items-center justify-content-between" style="padding: 12px; width:230px; cursor: pointer;">
                            <span class="fw-700 fs-16 text-white mr-3">{{ translate('Categories') }}</span>
                            <a href="{{ route('categories.all') }}" class="text-reset">
                                {{-- <span class="d-none d-lg-inline-block text-white hov-opacity-80">see all</span> --}}
                            </a>
                            <i class="las la-angle-down text-white has-transition" id="category-menu-bar-icon" style="font-size: 1.2rem;"></i>
                        </div>
                    </div>
            
                    <!-- Header Menus -->
                    @php
                        $nav_txt_color = ((get_setting('header_nav_menu_text') == 'light') ||  (get_setting('header_nav_menu_text') == null)) ? 'text-white' : 'text-dark';
                    @endphp
                    <div class="w-100 d-flex justify-content-center align-items-center overflow-auto">
                        <ul class="list-inline mb-0 pl-0 d-flex flex-wrap hor-swipe c-scrollbar-light" style="align-items: center;">
                            @if (get_setting('header_menu_labels') != null)
                                @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                                    <li class="list-inline-item mr-0 animate-underline-white" style="padding: 8px 0;">
                                        <a href="{{ json_decode(get_setting('header_menu_links'), true)[$key] }}"
                                            class="fs-13 px-3 py-2 d-inline-block fw-700 {{ $nav_txt_color }} header_menu_links hov-bg-black-10
                                            @if (url()->current() == json_decode(get_setting('header_menu_links'), true)[$key]) active @endif" style="padding: 8px 0;">
                                            {{ translate($value) }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            @if (get_setting('helpline_number'))
                                <!-- Helpline -->
                                <li class="list-inline-item ml-3">
                                    <a href="tel:{{ get_setting('helpline_number') }}"
                                        class="fs-13 px-4 py-3 d-inline-block fw-700 {{ $nav_txt_color }} header_menu_links bg-black-10" style="font-weight: 900;">
                                        <span class="text-white">{{ translate('Helpline') }}</span>
                                        <span class="text-white">{{ get_setting('helpline_number') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
            
                    <!-- Cart (Visible on all screen sizes) -->
                    <div class="d-none d-lg-block d-xl-block align-self-stretch ml-3 has-transition bg-black-10" data-hover="dropdown">
                        <div class="nav-cart-box dropdown h-100" id="cart_items" style="width: max-content;">
                            @include('frontend.'.get_setting('homepage_select').'.partials.cart')
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Categoty Menus -->
            <div class="hover-category-menu position-absolute w-100 top-100 left-0 right-0 z-3 d-none"
                id="click-category-menu">
                <div class="container">
                    <div class="d-flex position-relative">
                        <div class="position-static">
                            @include('frontend.'.get_setting("homepage_select").'.partials.category_menu')
                            {{-- @include('frontend.'.'all_category') --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Top Menu Sidebar -->
    <div class="aiz-top-menu-sidebar collapse-sidebar-wrap sidebar-xl sidebar-left d-lg-none z-1035">
        <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle"
            data-target=".aiz-top-menu-sidebar" data-same=".hide-top-menu-bar"></div>
        <div class="collapse-sidebar c-scrollbar-light text-left">
            <button type="button" class="btn btn-sm p-4 hide-top-menu-bar" data-toggle="class-toggle"
                data-target=".aiz-top-menu-sidebar">
                <i class="las la-times la-2x text-primary"></i>
            </button>
            {{-- @auth
                <span class="d-flex align-items-center nav-user-info pl-4">
                    <!-- Image -->
                    <span class="size-40px rounded-circle overflow-hidden border border-transparent nav-user-img">
                        @if ($user->avatar_original != null)
                            <img src="{{ $user_avatar }}" class="img-fit h-100" alt="{{ translate('avatar') }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image" alt="{{ translate('avatar') }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                        @endif
                    </span>
                    <!-- Name -->
                    <h4 class="h5 fs-14 fw-700 text-dark ml-2 mb-0">{{ $user->name }}</h4>
                </span>
            @else
                <!--Login & Registration -->
                <span class="d-flex align-items-center nav-user-info pl-4">
                    <!-- Image -->
                    <span
                        class="size-40px rounded-circle overflow-hidden border d-flex align-items-center justify-content-center nav-user-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19.902" height="20.012"
                            viewBox="0 0 19.902 20.012">
                            <path id="fe2df171891038b33e9624c27e96e367"
                                d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1.006,1.006,0,1,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1,10,10,0,0,0-6.25-8.19ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"
                                transform="translate(-2.064 -1.995)" fill="#91919b" />
                        </svg>
                    </span>
                    <a href="{{ route('user.login') }}"
                        class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block border-right border-soft-light border-width-2 pr-2 ml-3">{{ translate('Login') }}</a>
                    <a href="{{ route('user.registration') }}"
                        class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block py-2 pl-2">{{ translate('Registration') }}</a>
                </span>
            @endauth --}}
            <hr>
            <ul class="mb-0 pl-3 pb-3 h-100">
                @if (get_setting('header_menu_labels') != null)
                    @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                        <li class="mr-0">
                            <a href="{{ json_decode(get_setting('header_menu_links'), true)[$key] }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                            @if (url()->current() == json_decode(get_setting('header_menu_links'), true)[$key]) active @endif">
                                {{ translate($value) }}
                            </a>
                        </li>
                    @endforeach
                @endif
                @auth
                    @if (isAdmin())
                        <hr>
                        <li class="mr-0">
                            <a href="{{ route('admin.dashboard') }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links">
                                {{ translate('My Account') }}
                            </a>
                        </li>
                    @else
                        <hr>
                        <li class="mr-0">
                            <a href="{{ route('dashboard') }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                {{ areActiveRoutes(['dashboard'], ' active') }}">
                                {{ translate('My Account') }}
                            </a>
                        </li>
                    @endif
                    @if (isCustomer())
                        <li class="mr-0">
                            <a href="{{ route('all-notifications') }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                {{ areActiveRoutes(['all-notifications'], ' active') }}">
                                {{ translate('Notifications') }}
                            </a>
                        </li>
                        <li class="mr-0">
                            <a href="{{ route('wishlists.index') }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                {{ areActiveRoutes(['wishlists.index'], ' active') }}">
                                {{ translate('Wishlist') }}
                            </a>
                        </li>
                        <li class="mr-0">
                            <a href="{{ route('compare') }}"
                                class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-dark header_menu_links
                                {{ areActiveRoutes(['compare'], ' active') }}">
                                {{ translate('Compare') }}
                            </a>
                        </li>
                    @endif
                    <hr>
                    <li class="mr-0">
                        <a href="{{ route('logout') }}"
                            class="fs-13 px-3 py-3 w-100 d-inline-block fw-700 text-primary header_menu_links">
                            {{ translate('Logout') }}
                        </a>
                    </li>
                @endauth
            </ul>
            <br>
            <br>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script type="text/javascript">
            function show_order_details(order_id) {
                $('#order-details-modal-body').html(null);

                if (!$('#modal-size').hasClass('modal-lg')) {
                    $('#modal-size').addClass('modal-lg');
                }

                $.post('{{ route('orders.details') }}', {
                    _token: AIZ.data.csrf,
                    order_id: order_id
                }, function(data) {
                    $('#order-details-modal-body').html(data);
                    $('#order_details').modal();
                    $('.c-preloader').hide();
                    AIZ.plugins.bootstrapSelect('refresh');
                });
            }
        </script>
    @endsection
