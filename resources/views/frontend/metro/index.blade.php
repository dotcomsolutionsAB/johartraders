    @extends('frontend.layouts.app')

    @section('content')
    <style>
        #section_featured .slick-slider .slick-list{
            background: #fff;
        }
        #section_featured .slick-slider .slick-list .slick-slide {
            margin-bottom: -5px;
        }
        @media (max-width: 575px){
            #section_featured .slick-slider .slick-list .slick-slide {
                margin-bottom: -4px;
            }
        }
    </style>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        h3 {
            font-family: 'Neuropol', sans-serif; /* Ensure Neuropol is set as the primary font */
            font-size: 33px;
            line-height: 36px;
            color: #1f1f1f;
            padding-bottom: 25px;
            text-transform: uppercase;
            text-align: left;
            width: fit-content;
        }

        /* Style for the span inside h3 */
        h3 span {
            color: #ff5a00;
        }

        .sec {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            gap: 20px;
        }

        .content, .img {
            width: 100%;
            max-width: 1200px;
            animation: slideUp 1s ease-in-out;
        }

        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            
        }

        .content h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .content p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: justify;
        }

        .content button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            align-self: center;
            transition: background-color 0.3s ease;
            font-family: 'neuropol';
        }

        .content button:hover {
            background-color: #0056b3;
        }

        .img img {
            width: 100%;
            height: auto;
            max-width: 600px;
            border-radius: 10px;
        }

        button.custom-btn {
            color: #fff !important; /* Ensuring the text color is white */
            background-color: #ff5a00 !important; /* Background color set to your desired orange */
            border: solid 1px #ff5a00 !important;
            font-size: 16px !important;
            padding: 10px 40px !important;
            border-radius: 0px !important;
            text-transform: uppercase !important;
            font-weight: bold !important;
            text-align: left !important; /* Align the button text to the left */
            display: inline-block !important;
        }

        button.custom-btn:hover {
            color: #fff !important; /* Make sure the text remains white on hover */
            background-color: #000 !important; /* Change background color to black on hover */
            border-color: #000 !important; /* Also change border color to black on hover */
        }

        @media (min-width: 768px) {
            .sec {
                flex-direction: row;
            }

            .content, .img {
                width: 50%;
            }
        }

        /* Animation */
        @keyframes slideUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .btn-catalog:hover {
                background-color: #000; /* Black background on hover */
                border-color: #000; /* Black border on hover */
        }
    </style>
    <style>
        .brand_scroll {
            width: 100%;
            background: #fff;
            padding: 35px 0;
        }

        #scroller .innerScrollArea {
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 100px;
        }
        
        #scroller li {
            padding: 0;
            margin: 0;
            list-style-type: none;
            position: absolute;

            }
        #scroller ul {
            padding: 0;
            margin: 0;
            display: flex;
            position: relative;
            transition: all 0.5s ease;
        }

        .brand_img {
            width: 230px;
            height: 100px;
            text-align: center;
            line-height: 100px;
            margin: 0px 10px;
        }

        .brand_img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .clr {
            clear: both;
        }

    </style>
    
    <link href="{{ static_asset('assets/css/file_css.css') }}" rel="stylesheet">

    @php $lang = get_system_language()->code;  @endphp

    <!-- Sliders -->
    <div class="home-banner-area mb-3">
        <div class="p-0">
            <!-- Sliders -->
            <div class="home-slider slider-full">
                @if (get_setting('home_slider_images', null, $lang) != null)
                    <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-autoplay="true" data-infinite="true">
                        @php
                            $decoded_slider_images = json_decode(get_setting('home_slider_images', null, $lang), true);
                            $sliders = get_slider_images($decoded_slider_images);
                            $home_slider_links = get_setting('home_slider_links', null, $lang);
                        @endphp
                        @foreach ($sliders as $key => $slider)
                            <div class="carousel-box">
                                <a href="{{ isset(json_decode($home_slider_links, true)[$key]) ? json_decode($home_slider_links, true)[$key] : '' }}">
                                    <!-- Image -->
                                    <div class="d-block mw-100 img-fit overflow-hidden h-180px h-md-320px h-lg-460px h-xl-553px overflow-hidden">
                                        <img class="img-fit h-100 m-auto has-transition ls-is-cached lazyloaded"
                                        src="{{ $slider ? my_asset($slider->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        alt="{{ env('APP_NAME') }} promo"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Flash Deal -->
    @php
        $flash_deal = get_featured_flash_deal();
        $flash_deal_bg = get_setting('flash_deal_bg_color');
        $flash_deal_bg_full_width = (get_setting('flash_deal_bg_full_width') == 1) ? true : false;
        $flash_deal_banner_menu_text = ((get_setting('flash_deal_banner_menu_text') == 'dark') ||  (get_setting('flash_deal_banner_menu_text') == null)) ? 'text-dark' : 'text-white';
        
    @endphp
    @if ($flash_deal != null)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3" style="background: {{ ($flash_deal_bg_full_width && $flash_deal_bg != null) ? $flash_deal_bg : '' }};" id="flash_deal">
            <div class="container">
                <!-- Top Section sm to lg -->
                <div class="d-flex d-lg-none flex-wrap mb-2 mb-md-3 @if ($flash_deal_bg_full_width && $flash_deal_bg != null) pt-2 pt-md-3 @endif align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <span class="d-inline-block {{ ($flash_deal_bg_full_width && $flash_deal_bg != null) ? $flash_deal_banner_menu_text : 'text-dark'}}">{{ translate('Flash Sale') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 16 24"
                            class="ml-3">
                            <path id="Path_28795" data-name="Path 28795"
                                d="M30.953,13.695a.474.474,0,0,0-.424-.25h-4.9l3.917-7.81a.423.423,0,0,0-.028-.428.477.477,0,0,0-.4-.207H21.588a.473.473,0,0,0-.429.263L15.041,18.151a.423.423,0,0,0,.034.423.478.478,0,0,0,.4.2h4.593l-2.229,9.683a.438.438,0,0,0,.259.5.489.489,0,0,0,.571-.127L30.9,14.164a.425.425,0,0,0,.054-.469Z"
                                transform="translate(-15 -5)" fill="#fcc201" />
                        </svg>
                    </h3>
                    <!-- Links -->
                    <div>
                        <div class="text-dark d-flex align-items-center mb-0">
                            <a href="{{ route('flash-deals') }}"
                                class="fs-10 fs-md-12 fw-700 has-transition @if ((get_setting('flash_deal_banner_menu_text') == 'light') && $flash_deal_bg_full_width && $flash_deal_bg != null) text-white opacity-60 hov-opacity-100 animate-underline-white @else text-reset opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary @endif mr-3">{{ translate('View All Flash Sale') }}</a>
                            <span class=" border-left border-soft-light border-width-2 pl-3">
                                <a href="{{ route('flash-deal-details', $flash_deal->slug) }}"
                                    class="fs-10 fs-md-12 fw-700 has-transition @if ((get_setting('flash_deal_banner_menu_text') == 'light') && $flash_deal_bg_full_width && $flash_deal_bg != null) == 'light') text-white opacity-60 hov-opacity-100 animate-underline-white @else text-reset opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary @endif">{{ translate('View All Products from This Flash Sale') }}</a>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Countdown for small device -->
                <div class="bg-white mb-3 d-md-none">
                    <div class="aiz-count-down-circle" end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                </div>

                <div class="row no-gutters align-items-center" style="background: {{ $flash_deal_bg }};">
                    <!-- Flash Deals Baner & Countdown -->
                    <div class="col-xxl-4 col-lg-5 col-6 h-200px h-md-400px h-lg-475px">
                        <div class="h-100 w-100 w-xl-auto"
                            style="background-image: url('{{ uploaded_asset($flash_deal->banner) }}'); background-size: cover; background-position: center center;">
                            <div class="py-5 px-md-3 px-xl-5 d-none d-md-block">
                                <div class="bg-white">
                                    <div class="aiz-count-down-circle"
                                        end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-8 col-lg-7 col-6">
                        <div class="pl-3 pr-lg-3 pl-xl-2rem pr-xl-2rem">
                            <!-- Top Section from lg device -->
                            <div class="d-none d-lg-flex flex-wrap mb-2 mb-md-3 align-items-baseline justify-content-between">
                                <!-- Title -->
                                <h3 class="fs-16 fs-md-20 fw-700 mb-2">
                                    <span class="d-inline-block {{ $flash_deal_banner_menu_text }}">{{ translate('Flash Sale') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 16 24"
                                        class="ml-3">
                                        <path id="Path_28795" data-name="Path 28795"
                                            d="M30.953,13.695a.474.474,0,0,0-.424-.25h-4.9l3.917-7.81a.423.423,0,0,0-.028-.428.477.477,0,0,0-.4-.207H21.588a.473.473,0,0,0-.429.263L15.041,18.151a.423.423,0,0,0,.034.423.478.478,0,0,0,.4.2h4.593l-2.229,9.683a.438.438,0,0,0,.259.5.489.489,0,0,0,.571-.127L30.9,14.164a.425.425,0,0,0,.054-.469Z"
                                            transform="translate(-15 -5)" fill="#fcc201" />
                                    </svg>
                                </h3>
                                <!-- Links -->
                                <div>
                                    <div class="text-dark d-flex align-items-center mb-0">
                                        <a href="{{ route('flash-deals') }}"
                                            class="fs-10 fs-md-12 fw-700 has-transition {{ $flash_deal_banner_menu_text }} @if (get_setting('flash_deal_banner_menu_text') == 'light') text-white opacity-60 hov-opacity-100 animate-underline-white @else text-reset opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary @endif mr-3">
                                            {{ translate('View All Flash Sale') }}
                                        </a>
                                        <span class=" border-left border-soft-light border-width-2 pl-3">
                                            <a href="{{ route('flash-deal-details', $flash_deal->slug) }}"
                                                class="fs-10 fs-md-12 fw-700 has-transition {{ $flash_deal_banner_menu_text }} @if (get_setting('flash_deal_banner_menu_text') == 'light') text-white opacity-60 hov-opacity-100 animate-underline-white @else text-reset opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary @endif">{{ translate('View All Products from This Flash Sale') }}</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Flash Deals Products -->
                            @php
                                $flash_deal_products = get_flash_deal_products($flash_deal->id);
                            @endphp
                            <div class="aiz-carousel border-top @if (count($flash_deal_products) > 8) border-right @endif arrow-inactive-none arrow-x-0"
                                data-rows="2" data-items="5" data-xxl-items="5" data-xl-items="3.5" data-lg-items="3" data-md-items="2"
                                data-sm-items="2.5" data-xs-items="1.7" data-arrows="true" data-dots="false">
                                @foreach ($flash_deal_products as $key => $flash_deal_product)
                                    <div class="carousel-box bg-white border-left border-bottom">
                                        @if ($flash_deal_product->product != null && $flash_deal_product->product->published != 0)
                                            @php
                                                $product_url = route('product', $flash_deal_product->product->slug);
                                                if ($flash_deal_product->product->auction_product == 1) {
                                                    $product_url = route('auction-product', $flash_deal_product->product->slug);
                                                }
                                            @endphp
                                            <div
                                                class="h-100px h-md-200px h-lg-auto flash-deal-item position-relative text-center has-transition hov-shadow-out z-1">
                                                <a href="{{ $product_url }}"
                                                    class="d-block py-md-2 overflow-hidden hov-scale-img"
                                                    title="{{ $flash_deal_product->product->getTranslation('name') }}">
                                                    <!-- Image -->
                                                    <img src="{{ get_image($flash_deal_product->product->thumbnail) }}"
                                                        class="lazyload h-60px h-md-100px h-lg-120px mw-100 mx-auto has-transition"
                                                        alt="{{ $flash_deal_product->product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    <!-- Price -->
                                                    <div
                                                        class="fs-10 fs-md-14 mt-md-2 text-center h-md-48px has-transition overflow-hidden pt-md-4 flash-deal-price lh-1-5">
                                                        <span
                                                            class="d-block text-primary fw-700">{{ home_discounted_base_price($flash_deal_product->product) }}</span>
                                                        @if (home_base_price($flash_deal_product->product) != home_discounted_base_price($flash_deal_product->product))
                                                            <del
                                                                class="d-block fw-400 text-secondary">{{ home_base_price($flash_deal_product->product) }}</del>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Today's deal -->
    @php
        $todays_deal_section_bg = get_setting('todays_deal_section_bg_color');
    @endphp
    <div id="todays_deal" class="mb-2rem mt-2 mt-md-3" @if(get_setting('todays_deal_section_bg') == 1) style="background: {{ $todays_deal_section_bg }};" @endif>

    </div>

    <!-- Featured Categories -->
    @if (count($featured_categories) > 0)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <div class="bg-white">
                    <!-- Top Section -->
                    <div class="d-flex mt-2 mt-md-3 mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Featured Categories') }}</span>
                        </h3>
                    </div>
                </div>
                <!-- Categories -->
                <div class="bg-white px-sm-3">
                    <div class="aiz-carousel sm-gutters-17" data-items="4" data-xxl-items="4" data-xl-items="3.5"
                        data-lg-items="3" data-md-items="2" data-sm-items="2" data-xs-items="1" data-arrows="true"
                        data-dots="false" data-autoplay="false" data-infinite="true">
                        @foreach ($featured_categories as $key => $category)
                            @php
                                $category_name = $category->getTranslation('name');
                            @endphp
                            <div class="carousel-box position-relative p-0 has-transition border-right border-top border-bottom @if ($key == 0) border-left @endif">
                                <div class="h-200px h-sm-250px h-md-340px">
                                    <div class="h-100 w-100 w-xl-auto position-relative hov-scale-img overflow-hidden">
                                        <div class="position-absolute h-100 w-100 overflow-hidden">
                                            <img src="{{ isset($category->coverImage->file_name) ? my_asset($category->coverImage->file_name) : static_asset('') }}"
                                                alt="{{ $category_name }}"
                                                class="img-fit h-100 has-transition"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </div>
                                        <div class="pb-4 px-4 absolute-bottom-left has-transition h-50 w-100 d-flex flex-column align-items-center justify-content-end"
                                            style="background: linear-gradient(to top, rgba(0,0,0,0.5) 50%,rgba(0,0,0,0) 100%) !important;">
                                            <div class="w-100">
                                                <a class="fs-16 fw-700 text-white animate-underline-white home-category-name d-flex align-items-center hov-column-gap-1"
                                                    href="{{ route('products.category', $category->slug) }}"
                                                    style="width: max-content;">
                                                    {{ $category_name }}&nbsp;
                                                    <i class="las la-angle-right"></i>
                                                </a>
                                                <div class="d-flex flex-wrap h-50px overflow-hidden mt-2">
                                                    @foreach ($category->childrenCategories->take(6) as $key => $child_category)
                                                    <a href="{{ route('products.category', $child_category->slug) }}" class="fs-13 fw-300 text-soft-light hov-text-white pr-3 pt-1">
                                                        {{ $child_category->getTranslation('name') }}
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Banner section 1 -->
    @php $homeBanner1Images = get_setting('home_banner1_images', null, $lang);   @endphp
    @if ($homeBanner1Images != null)
        <div class="pb-2 pb-md-3 pt-2 pt-md-3" style="background: #f5f5fa;">
            <div class="container mb-2 mb-md-3">
                @php
                    $banner_1_imags = json_decode($homeBanner1Images);
                    $data_md = count($banner_1_imags) >= 2 ? 2 : 1;
                    $home_banner1_links = get_setting('home_banner1_links', null, $lang);
                @endphp
                <div class="w-100">
                    <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                        data-items="{{ count($banner_1_imags) }}" data-xxl-items="{{ count($banner_1_imags) }}"
                        data-xl-items="{{ count($banner_1_imags) }}" data-lg-items="{{ $data_md }}"
                        data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                        data-dots="false">
                        @foreach ($banner_1_imags as $key => $value)
                            <div class="carousel-box overflow-hidden hov-scale-img">
                                <a href="{{ isset(json_decode($home_banner1_links, true)[$key]) ? json_decode($home_banner1_links, true)[$key] : '' }}"
                                    class="d-block text-reset overflow-hidden">
                                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                        data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                        class="img-fluid lazyload w-100 has-transition"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Featured Products -->
    <div id="section_featured" class="pt-2 pt-md-3" style="background: #f5f5fa;">

    </div>

    <!-- Banner Section 2 -->
    @php $homeBanner2Images = get_setting('home_banner2_images', null, $lang);   @endphp
    @if ($homeBanner2Images != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_2_imags = json_decode($homeBanner2Images);
                    $data_md = count($banner_2_imags) >= 2 ? 2 : 1;
                    $home_banner2_links = get_setting('home_banner2_links', null, $lang);
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_2_imags) }}" data-xxl-items="{{ count($banner_2_imags) }}"
                    data-xl-items="{{ count($banner_2_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_2_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ isset(json_decode($home_banner2_links, true)[$key]) ? json_decode($home_banner2_links, true)[$key] : '' }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- First Section -->
    <div class="row" style="margin: 40px; ">
        <!-- Left Column: Text Content -->
        <div class="col-sm-12 col-md-6">
            <div class="body_block1_left wow fadeInUp" data-wow-delay="0.2s" style="animation-delay: 0.2s;">
                <h3 style="font-size: 36px; line-height: 1.2; color: #333; margin-bottom: 20px; text-transform: uppercase; font-weight: bold;">
                    About J<span style="color: #ff5a00;">o</span>har traders
                </h3>
                <p style="font-family: 'Verdana', sans-serif; font-size: 16px; line-height: 1.8; color: #666; margin-bottom: 20px; text-align: justify;">
                    We have been into Food Processing Machineries and Commercial Kitchen Equipments Business since 2010. We are Supplier, Traders, Wholesalers & Manufacturer for all kinds of Food-related Machineries. We are located at 24 Netaji Subhas Road Ground Floor, Room 8A, Kolkata-700001, Near Canning street PNB bank 4 point Crossing at the heart of City’s Business hub, very near to Kolkata’s Railway station HOWRAH.
                </p>
                <p style="font-family: 'Verdana', sans-serif; font-size: 16px; line-height: 1.8; color: #666; margin-bottom: 20px; text-align: justify;">
                    We offer an array of products which comprise Bakery Machineries, Fast Food Machineries, Meat Processing Machineries, Commercial Pulverizers, Wet Grinder Machines & Commercial Kitchen Equipments. We customize Kitchen Equipments as per our client needs. Our range of products is of high quality as they are sourced from authorized manufacturers. We specialize in working directly with manufacturers to create sustainable partnerships. In an endeavour to serve in a better and superior way, we make sure that the products and services offered by us meet the satisfaction of the customers. We are a customer-centric firm, delivering a product that is easily maintained and installed, easy to clean, proficient, and competent. Whenever a customer visits our showroom we give them proper guidance before purchasing any products so that it suits their needs.
                </p>
                <a href="http://johartraders.in/about" role="button" 
                style="color: #fff; background-color: #ff5a00; border: solid 1px #ff5a00; font-family: 'neuropol'; font-size: 16px; padding: 10px 30px; text-transform: uppercase; font-weight: bold; text-align: center; display: inline-block; transition: background-color 0.3s ease; text-decoration: none; ">
                    Read More
                </a>
            </div>
        </div>

        <!-- Right Column: Image -->
        <div class="col-sm-12 col-md-6" style=" justify-content: center; display: flex; align-items: center;">
            <div class="body_block1_right wow fadeInUp" data-wow-delay="0.4s" style="animation-delay: 0.4s; ">
                <div class="body_block1_right_pic" style="align-items: center;">
                    <img src="https://johartraders.in/public/uploads/all/nV19yjpxGhVpdbZ8vaF20VkHr6hLfJwsfrF5414w.jpg" alt="About Johar Traders" 
                        style="width: 100%; height: auto; max-width: 500px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom: 50px; padding: 40px; position: relative; background-image: url('https://johartraders.in/public/uploads/all/vueHOFUz5fCufjauDJ54TPRZm46UWmQedlnLgeJq.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <!-- Overlay with Orange Color -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(246, 89, 4, 0.926); z-index: 1;"></div>

        <!-- Left Column: Text Content -->
        <div class="col-sm-12 col-md-6" style="position: relative; z-index: 2; padding: 40px; color: #fff; padding: 20px;">
            <div class="body_block2_left wow fadeInUp" data-wow-delay="0.2s" style="animation-delay: 0.2s; padding: 20px">
                <h3 style="font-size: 36px; line-height: 1.2; color: #fff; margin-bottom: 20px; text-transform: uppercase; font-weight: bold;">
                    Our Product <span style="color: #000;">Range</span>
                </h3>
                <p style="font-family: 'Verdana', sans-serif; font-size: 16px; line-height: 1.8; color: #fff; margin-bottom: 20px; text-align: justify;">
                    By offering a wide range of Food Processing Machineries to our clients, we have been able to achieve a distinctive position in the market. At our firm, we believe in building customer relationships, and through our good services, we are one of the recognized firms engaged in trading and wholesaling of machineries. Our infrastructure is capable enough of delivering bulk orders on time and at a valuable competitive price.
                </p>
                <p style="font-family: 'Verdana', sans-serif; font-size: 16px; line-height: 1.8; color: #fff; margin-bottom: 20px; text-align: justify;">
                    <strong style="color: #000;">Mr. Yakub Johar</strong> has been actively motivating the team and guiding us since we started. He has been in the Machinery business since 1987 and has vast experience in this field. Our customer-centric ethics and policies are the driving force behind achieving a name as a reputed firm. We always aim at delivering products that meet the requirements and needs of the customers. We will be coming up with a few more showrooms in the near future, with one recently to be opened at NH-6 Dhulagarh Highway.
                </p>
                <a href="https://johartraders.in/uploads/pdf/JOHAR Catalog-1 ( 2020-21).pdf" role="button" 
                style="color: #fff; background-color: #000; border: solid 1px #000; font-size: 16px; font-family: 'neuropol'; padding: 10px 30px; text-transform: uppercase; font-weight: bold; text-align: center; display: inline-block; transition: background-color 0.3s ease; text-decoration: none;" target="_blank">
                    Our PDF Catalog
                </a>
            </div>
        </div>

        <!-- Right Column: Image -->
        <div class="col-sm-12 col-md-6" style="position: relative; z-index: 2; align-items: center; display: flex; justify-content:center;">
            <div class="body_block2_right wow fadeInUp" data-wow-delay="0.4s" style="animation-delay: 0.4s;">
                <div class="body_block2_right_pic" style="padding: 20px;">
                    <img src="https://johartraders.in/public/uploads/all/JOj1yJG0z76E1LCRoZ7QNmmKQFIe3DmCfn9JboXp.jpg" alt="Product Range" 
                        style="width: 100%; height: auto; max-width: 500px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                </div>
            </div>
        </div>
    </div>

    <section class="body_block3" style="overflow: hidden; border-top: solid 3px #ff5a00; padding: 80px 0px;">
        <div class="container">
            <div class="pro_box1 wow fadeInUp" data-wow-delay="0.2s" style="animation-delay: 0.2s; visibility: visible;     position: relative; border: solid 1px #dddddd; margin-bottom: 50px;">
                <div class="pro_box1_pic" style="height: inherit; font-size: 0; text-align: center; max-width: 100%;    position: relative; overflow: inherit">
                    <a href="https://johartraders.in/product/poultry-machines">
                        <img src="https://old.johartraders.in/uploads/product_category/IXSB95WZTN-20190102-082659.jpg" alt="" class="btn-block btn-h">
                    </a>
                </div>
            </div>
            <div class="pro_box1 wow fadeInUp" data-wow-delay="0.2s" style="animation-delay: 0.2s; visibility: visible;     position: relative; border: solid 1px #dddddd; margin-bottom: 50px;">
                <div class="pro_box1_pic" style="height: inherit; font-size: 0; text-align: center; max-width: 100%;    position: relative; overflow: inherit">
                    <a href="https://johartraders.in/product/ice-cream-cafe-machines">
                        <img src="https://old.johartraders.in/uploads/product_category/LOQAPI4A36-20190115-012724.jpg" alt="" class="btn-block btn-h">
                    </a>
                </div>
            </div>
            <div class="pro_box1 wow fadeInUp" data-wow-delay="0.2s" style="animation-delay: 0.2s; visibility: visible;     position: relative; border: solid 1px #dddddd; margin-bottom: 50px;">
                <div class="pro_box1_pic" style="height: inherit; font-size: 0; text-align: center; max-width: 100%;    position: relative; overflow: inherit">
                    <a href="https://johartraders.in/product/wet-grinder-machines">
                    <img src="https://old.johartraders.in/uploads/product_category/A8QD3N8Q3J-20190102-083050.jpg" alt="" class="btn-block btn-h">
                </a>
                </div>
            </div>
            <div class="pro_box1 wow fadeInUp" data-wow-delay="0.2s" style="animation-delay: 0.2s; visibility: visible;     position: relative; border: solid 1px #dddddd; margin-bottom: 50px;">
                <div class="pro_box1_pic" style="height: inherit; font-size: 0; text-align: center; max-width: 100%;    position: relative; overflow: inherit">
                    <a href="https://johartraders.in/product/namkeen-machines">
                    <img src="https://old.johartraders.in/uploads/product_category/RJ9H11J4OS-20190115-012746.jpg" alt="" class="btn-block btn-h">
                </a>
                </div>

            </div>
            <div class="pro_box1 wow fadeInUp" data-wow-delay="0.2s" style="animation-delay: 0.2s; visibility: visible;     position: relative; border: solid 1px #dddddd; margin-bottom: 50px;">
                <div class="pro_box1_pic" style="height: inherit; font-size: 0; text-align: center; max-width: 100%;    position: relative; overflow: inherit">
                    <a href="https://johartraders.in/product/noodles-sewai-machines">
                    <img src="https://old.johartraders.in/uploads/product_category/HF2DQKVUPA-20190102-084009.jpg" alt="" class="btn-block btn-h">
                </a>
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-all_por" href="https://new.johartraders.in/product/poultry-machines" role="button" style="color: #ff5a00; background-color: #fff; font-size: 18px; padding: 10px 40px; border-radius: 0px; text-transform: uppercase; border: solid 2px #ff5a00 !important; font-weight: bold;">
                    View all products
                </a>
            </div>
        </div>
    </section>


    <section class="body_block4" style="padding: 0;">
        <div class="">
            <div class="row no-gutters">
                <!-- Left Side: Quote Section with Full Background Image -->
                <div class="col-sm-12 col-md-6" style="background-image: url('https://johartraders.in/public/uploads/all/rGBwd6pGFVSPL3ReabVPWCMSA0o1uP9NYsQ1YofO.jpg'); background-size: cover; background-position: center; min-height: 500px; display: flex; align-items: center; justify-content: center;">
                    <div class="quote_sec text-center" style="color: white;">
                        <div class="quote_cont wow fadeInUp" style="visibility: visible; animation-delay: 0.2s;  top: 50% !important; left: 50% !important;">
                            <h3 style="font-size: 36px; line-height: 1.2; color: #fff; margin-bottom: 20px; text-transform: uppercase; font-weight: bold; font-size: 48px; line-height: 60px; color: #fff; font-style: italic; margin-bottom: 30px;">
                                We Send You The <br><span style="color:black;">Price</span> Immediately
                            </h3>
                            <a class="btn btn-primary btn-quote" href="https://new.johartraders.in/enquiry_form" role="button" style="padding: 10px 30px; text-transform: uppercase; font-weight: bold; color: #fff; background-color: #dd4e00; font-size: 18px; padding: 12px 40px; border-radius: 5px; text-transform: uppercase; border: solid 2px #fff !important; font-weight: bold;">
                                Get Instant Quote
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Inquiry Form Section with Full Background Image -->
                <div class="col-sm-12 col-md-6" style="background-image: url('https://johartraders.in/public/uploads/all/55zARJLrvOcAbCqd0ooe5hoqDnDQCS8BHKUWMmog.jpg'); background-size: cover; background-position: center; min-height: 500px; display: flex; align-items: center;">
                    <div class="inquiry_sec sky-form" style="padding: 30px; width: 100%;">
                        <div class="inquiry_cont wow fadeInUp" style="visibility: visible; animation-delay: 0.2s;">
                            <h3 style="font-size: 36px; line-height: 1.2; color: #ff5a00; margin-bottom: 20px; text-transform: uppercase; font-weight: bold;">Quick Inquiry</h3>
                            <form action="" method="post" name="contactform" id="contactform">
                                <div class="form-groupcus">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mb-3">
                                            <label class="input" for="c_fname">
                                                <input type="text" placeholder="First Name" class="form-control required" name="c_fname" id="c_fname">
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-3">
                                            <label class="input" for="c_lname">
                                                <input type="text" placeholder="Last Name" class="form-control required" name="c_lname" id="c_lname">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-groupcus">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mb-3">
                                            <label class="input" for="c_email">
                                                <input type="email" placeholder="Email Id" class="form-control required" name="c_email" id="c_email">
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-3">
                                            <label class="input" for="c_phone">
                                                <input type="text" placeholder="Phone Number" class="form-control required" name="c_phone" id="c_phone">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-groupcus">
                                    <div class="row">
                                        <div class="col-sm-12 mb-3">
                                            <label class="textarea">
                                                <textarea rows="3" placeholder="Message" class="form-control required" name="c_msg" id="c_msg"></textarea>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-groupcus">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input class="btn btn-primary btn-about" type="submit" value="Submit" name="contact_submit" id="contact_submit" style="padding: 10px 30px; text-transform: uppercase; font-weight: bold;">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section class="body_block5" style=" border-top: solid 3px #ff5a00;
        overflow: hidden">
        <div class="brand_scroll">
            <div class="scroller_img" id="scroller" style="width: 100%; height: 100px;">
                <div class="innerScrollArea">
                    <ul>
                        <li style="left: 0px; ">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/AKASA CATALOG 2020.pdf" target="_blank">
                                <img src="https://old.johartraders.in/uploads/client/3QOMSJZRT9-20190102-081923.jpg" alt="">
                            </a>
                            </div>
                        </li>
                        <li style="left: 250px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/SEVANA (2).pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/6E3Z8QKL4X-20190102-081938.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 500px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/KALSI NEW CATALOG.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/PFGNPUGUP7-20190102-081958.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 750px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/natraj .pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/MFUYLAMGH5-20190102-082018.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 1000px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/#" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/22NSEWQS4Q-20190102-082027.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 1250px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/#" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/SJ9EYULMB7-20190102-082036.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 1500px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/SACO PRO CATALOG.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/J2ZWI24UUY-20190119-033833.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 1750px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/Panasonic catalogue 18-19.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/ZETSXFLMBP-20190116-050736.png" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 2000px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/rotimation.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/VJ9MC6DM11-20190116-050742.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 2250px;">

                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/LK3D1MT2FJ-20190119-032359.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 2500px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/AKASA CATALOG 2020.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/3QOMSJZRT9-20190102-081923.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 2750px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/SEVANA (2).pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/6E3Z8QKL4X-20190102-081938.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 3000px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/KALSI NEW CATALOG.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/PFGNPUGUP7-20190102-081958.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 3250px;">
                            <div class="brand_img"><a href="https://johartraders.in/uploads/client/natraj .pdf" target="_blank">
                                <img src="https://old.johartraders.in/uploads/client/MFUYLAMGH5-20190102-082018.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 3500px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/#" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/22NSEWQS4Q-20190102-082027.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 3750px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/#" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/SJ9EYULMB7-20190102-082036.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 4000px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/SACO PRO CATALOG.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/J2ZWI24UUY-20190119-033833.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 4250px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/Panasonic catalogue 18-19.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/ZETSXFLMBP-20190116-050736.png" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 4500px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/rotimation.pdf" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/VJ9MC6DM11-20190116-050742.jpg" alt="">
                                </a>
                            </div>
                        </li>
                        <li style="left: 4750px;">
                            <div class="brand_img">
                                <a href="https://johartraders.in/uploads/client/" target="_blank">
                                    <img src="https://old.johartraders.in/uploads/client/LK3D1MT2FJ-20190119-032359.jpg" alt="">
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </div>
    </section>
    

    <!-- Best Selling  -->
    {{-- <div id="section_best_selling">

    </div> --}}

    <!-- New Products -->
    {{-- <div id="section_newest">

    </div> --}}

    <script>
        const scroller = document.querySelector('#scroller ul');
        let scrollAmount = 0;
    
        function scrollBrands() {
            scrollAmount += 1;
            scroller.style.transform = `translateX(-${scrollAmount}px)`;
    
            // Reset the scroll position if all logos are out of view
            if (scrollAmount >= scroller.scrollWidth / 2) {
                scrollAmount = 0;
            }
    
            requestAnimationFrame(scrollBrands);
        }
    
        // Start the scrolling effect
        scrollBrands();
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
    
    <!-- Banner Section 3 -->
    @php $homeBanner3Images = get_setting('home_banner3_images', null, $lang);   @endphp
    @if ($homeBanner3Images != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_3_imags = json_decode($homeBanner3Images);
                    $data_md = count($banner_3_imags) >= 2 ? 2 : 1;
                    $home_banner3_links = get_setting('home_banner3_links', null, $lang);
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_3_imags) }}" data-xxl-items="{{ count($banner_3_imags) }}"
                    data-xl-items="{{ count($banner_3_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_3_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ isset(json_decode($home_banner3_links, true)[$key]) ? json_decode($home_banner3_links, true)[$key] : '' }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Auction Product -->
    @if (addon_is_activated('auction'))
        <div id="auction_products">

        </div>
    @endif

    <!-- Cupon -->
    @if (get_setting('coupon_system') == 1)
        <div class=" mt-2 mt-md-3"
            style="background-color: {{ get_setting('cupon_background_color', '#292933') }}">
            <div class="container">
                <div class="position-relative py-5">
                    <div class="text-center text-xl-left position-relative z-5">
                        <div class="d-lg-flex">
                            <div class="mb-3 mb-lg-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="109.602" height="93.34" viewBox="0 0 109.602 93.34">
                                    <defs>
                                        <clipPath id="clip-pathcup">
                                            <path id="Union_10" data-name="Union 10" d="M12263,13778v-15h64v-41h12v56Z"
                                                transform="translate(-11966 -8442.865)" fill="none" stroke="#fff"
                                                stroke-width="2" />
                                        </clipPath>
                                    </defs>
                                    <g id="Group_24326" data-name="Group 24326"
                                        transform="translate(-274.201 -5254.611)">
                                        <g id="Mask_Group_23" data-name="Mask Group 23"
                                            transform="translate(-3652.459 1785.452) rotate(-45)"
                                            clip-path="url(#clip-pathcup)">
                                            <g id="Group_24322" data-name="Group 24322"
                                                transform="translate(207 18.136)">
                                                <g id="Subtraction_167" data-name="Subtraction 167"
                                                    transform="translate(-12177 -8458)" fill="none">
                                                    <path
                                                        d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"
                                                        stroke="none" />
                                                    <path
                                                        d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"
                                                        stroke="none" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                        <g id="Group_24321" data-name="Group 24321"
                                            transform="translate(-3514.477 1653.317) rotate(-45)">
                                            <g id="Subtraction_167-2" data-name="Subtraction 167"
                                                transform="translate(-12177 -8458)" fill="none">
                                                <path
                                                    d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"
                                                    stroke="none" />
                                                <path
                                                    d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"
                                                    stroke="none" fill="#fff" />
                                            </g>
                                            <g id="Group_24325" data-name="Group 24325">
                                                <rect id="Rectangle_18578" data-name="Rectangle 18578" width="8"
                                                    height="2" transform="translate(120 5287)" fill="#fff" />
                                                <rect id="Rectangle_18579" data-name="Rectangle 18579" width="8"
                                                    height="2" transform="translate(132 5287)" fill="#fff" />
                                                <rect id="Rectangle_18581" data-name="Rectangle 18581" width="8"
                                                    height="2" transform="translate(144 5287)" fill="#fff" />
                                                <rect id="Rectangle_18580" data-name="Rectangle 18580" width="8"
                                                    height="2" transform="translate(108 5287)" fill="#fff" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="ml-lg-3">
                                <h5 class="fs-36 fw-400 text-white mb-3">{{ translate(get_setting('cupon_title')) }}</h5>
                                <h5 class="fs-20 fw-400 text-gray">{{ translate(get_setting('cupon_subtitle')) }}</h5>
                                <div class="mt-5 pt-5">
                                    <a href="{{ route('coupons.all') }}"
                                        class="btn text-white hov-bg-white hov-text-dark border border-width-2 fs-16 px-5"
                                        style="border-radius: 28px;background: rgba(255, 255, 255, 0.2);box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.16);">{{ translate('View All Coupons') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute right-0 bottom-0 h-100">
                        <img class="h-100" src="{{ uploaded_asset(get_setting('coupon_background_image', null, $lang)) }}"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/coupon.svg') }}';"
                            alt="{{ env('APP_NAME') }} promo">
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Category wise Products -->
    <div id="section_home_categories" style="background: #f5f5fa;">

    </div>

    <!-- Classified Product -->
    @if (get_setting('classified_product') == 1)
        @php
            $classified_products = get_home_page_classified_products(6);
        @endphp
        @if (count($classified_products) > 0)
            <section class="mb-2 mb-md-3 mt-3 mt-md-5">
                <div class="container">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Classified Ads') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('customer.products') }}">{{ translate('View All Products') }}</a>
                        </div>
                    </div>
                    <!-- Banner -->
                    @php
                        $classifiedBannerImage = get_setting('classified_banner_image', null, $lang);
                        $classifiedBannerImageSmall = get_setting('classified_banner_image_small', null, $lang);
                    @endphp
                    @if ($classifiedBannerImage != null || $classifiedBannerImageSmall != null)
                        <div class="mb-3 overflow-hidden hov-scale-img d-none d-md-block">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset($classifiedBannerImage) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                        <div class="mb-3 overflow-hidden hov-scale-img d-md-none">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ $classifiedBannerImageSmall != null ? uploaded_asset($classifiedBannerImageSmall) : uploaded_asset($classifiedBannerImage) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                    @endif
                    <!-- Products Section -->
                    <div class="bg-white pt-3">
                        <div class="row no-gutters border-top border-left">
                            @foreach ($classified_products as $key => $classified_product)
                                <div
                                    class="col-xl-4 col-md-6 border-right border-bottom has-transition hov-shadow-out z-1">
                                    <div class="aiz-card-box p-2 has-transition bg-white">
                                        <div class="row hov-scale-img">
                                            <div class="col-4 col-md-5 mb-3 mb-md-0">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                    class="d-block overflow-hidden h-auto h-md-150px text-center">
                                                    <img class="img-fluid lazyload mx-auto has-transition"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ isset($classified_product->thumbnail->file_name) ? my_asset($classified_product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <h3
                                                    class="fw-400 fs-14 text-dark text-truncate-2 lh-1-4 mb-3 h-35px d-none d-sm-block">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                        class="d-block text-reset hov-text-primary">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                                <div class="fs-14 mb-3">
                                                    <span
                                                        class="text-secondary">{{ $classified_product->user ? $classified_product->user->name : '' }}</span><br>
                                                    <span
                                                        class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                @if ($classified_product->conditon == 'new')
                                                    <span
                                                        class="badge badge-inline badge-soft-info fs-13 fw-700 px-3 py-2 text-info"
                                                        style="border-radius: 20px;">{{ translate('New') }}</span>
                                                @elseif($classified_product->conditon == 'used')
                                                    <span
                                                        class="badge badge-inline badge-soft-secondary-base fs-13 fw-700 px-3 py-2 text-danger"
                                                        style="border-radius: 20px;">{{ translate('Used') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!-- Top Sellers -->
    @if (get_setting('vendor_system_activation') == 1)
        @php
            $best_selers = get_best_sellers(5);
        @endphp
        @if (count($best_selers) > 0)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <!-- Top Section -->
                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <span class="pb-3">{{ translate('Top Sellers') }}</span>
                    </h3>
                    <!-- Links -->
                    <div class="d-flex">
                        <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                            href="{{ route('sellers') }}">{{ translate('View All Sellers') }}</a>
                    </div>
                </div>
                <!-- Sellers Section -->
                <div class="aiz-carousel arrow-x-0 arrow-inactive-none" data-items="5" data-xxl-items="5"
                    data-xl-items="4" data-lg-items="3.4" data-md-items="2.5" data-sm-items="2" data-xs-items="1.4"
                    data-arrows="true" data-dots="false">
                    @foreach ($best_selers as $key => $seller)
                        @if ($seller->user != null)
                            <div
                                class="carousel-box h-100 position-relative text-center border-right border-top border-bottom @if ($key == 0) border-left @endif has-transition hov-animate-outline">
                                <div class="position-relative px-3" style="padding-top: 2rem; padding-bottom:2rem;">
                                    <!-- Shop logo & Verification Status -->
                                    <div class="mx-auto size-100px size-md-120px">
                                        <a href="{{ route('shop.visit', $seller->slug) }}"
                                            class="d-flex mx-auto justify-content-center align-item-center size-100px size-md-120px border overflow-hidden hov-scale-img"
                                            tabindex="0"
                                            style="border: 1px solid #e5e5e5; border-radius: 50%; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.06);">
                                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                                data-src="{{ uploaded_asset($seller->logo) }}" alt="{{ $seller->name }}"
                                                class="img-fit lazyload has-transition"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                        </a>
                                    </div>
                                    <!-- Shop name -->
                                    <!-- <h2 class="fs-14 fw-700 text-dark text-truncate-2 h-40px mt-3 mt-md-4 mb-0 mb-md-3">
                                        <a href="{{ route('shop.visit', $seller->slug) }}"
                                            class="text-reset hov-text-primary" tabindex="0">{{ $seller->name }}</a>
                                    </h2> -->
                                    <!-- Shop Rating -->
                                    <div class="rating rating-mr-1 text-dark mb-3">
                                        {{ renderStarRating($seller->rating) }}
                                        <span class="opacity-60 fs-14">({{ $seller->num_of_reviews }}
                                            {{ translate('Reviews') }})</span>
                                    </div>
                                    <!-- Visit Button -->
                                    <a href="{{ route('shop.visit', $seller->slug) }}" class="btn-visit">
                                        <span class="circle" aria-hidden="true">
                                            <span class="icon arrow"></span>
                                        </span>
                                        <span class="button-text">{{ translate('Visit Store') }}</span>
                                    </a>
                                    @if ($seller->verification_status == 1)
                                        <span class="absolute-top-right mr-2rem">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31.999" height="48.001" viewBox="0 0 31.999 48.001">
                                                <g id="Group_25062" data-name="Group 25062" transform="translate(-532 -1033.999)">
                                                <path id="Union_3" data-name="Union 3" d="M1937,12304h16v14Zm-16,0h16l-16,14Zm0,0v-34h32v34Z" transform="translate(-1389 -11236)" fill="#85b567"/>
                                                <path id="Union_5" data-name="Union 5" d="M1921,12280a10,10,0,1,1,10,10A10,10,0,0,1,1921,12280Zm1,0a9,9,0,1,0,9-9A9.011,9.011,0,0,0,1922,12280Zm1,0a8,8,0,1,1,8,8A8.009,8.009,0,0,1,1923,12280Zm4.26-1.033a.891.891,0,0,0-.262.636.877.877,0,0,0,.262.632l2.551,2.551a.9.9,0,0,0,.635.266.894.894,0,0,0,.639-.266l4.247-4.244a.9.9,0,0,0-.639-1.542.893.893,0,0,0-.635.266l-3.612,3.608-1.912-1.906a.89.89,0,0,0-1.274,0Z" transform="translate(-1383 -11226)" fill="#fff"/>
                                                </g>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    @endif

    <!-- Top Brands -->
    @if (get_setting('top_brands') != null)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <!-- Top Section -->
                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">{{ translate('Top Brands') }}</h3>
                    <!-- Links -->
                    <div class="d-flex">
                        <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                            href="{{ route('brands.all') }}">{{ translate('View All Brands') }}</a>
                    </div>
                </div>
                <!-- Brands Section -->
                <div class="bg-white px-3">
                    <div
                        class="row row-cols-xxl-6 row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-3 gutters-16 border-top border-left">
                        @php
                            $top_brands = json_decode(get_setting('top_brands'));
                            $brands = get_brands($top_brands);
                        @endphp
                        @foreach ($brands as $brand)
                            <div
                                class="col text-center border-right border-bottom hov-scale-img has-transition hov-shadow-out z-1">
                                <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-sm-3">
                                    <img src="{{ isset($brand->brandLogo->file_name) ? my_asset($brand->brandLogo->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        class="lazyload h-md-100px mx-auto has-transition p-2 p-sm-4 mw-100"
                                        alt="{{ $brand->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    <p class="text-center text-dark fs-12 fs-md-14 fw-700 mt-2">
                                        {{ $brand->getTranslation('name') }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

