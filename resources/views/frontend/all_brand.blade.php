@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="mb-4 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-lg-left text-center">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark">{{ translate('All Brands') }}</h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb justify-content-center justify-content-lg-end bg-transparent p-0">
                        <li class="breadcrumb-item has-transition opacity-60 hov-opacity-100">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            "{{ translate('All Brands') }}"
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- All Brands -->
    <section class="mb-4">
        <div class="container">
            <div class="bg-white px-3 pt-3">
                <div class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-2 gutters-16 border-top border-left">
                    @foreach ($brands as $brand)
                        <div class="col text-center border-right border-bottom z-1">
                            <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-3">
                                <div class="brand-logo-container">
                                    <img src="{{ uploaded_asset($brand->logo) }}" class="lazyload mx-auto has-transition brand-logo"
                                        alt="{{ $brand->getTranslation('name') }}">
                                </div>
                                <p class="text-center text-dark fs-14 fw-700 mt-2 brand-name">{{ $brand->getTranslation('name') }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    <style>
        /* Ensure 4 columns per row on larger screens */
        .row-cols-xxl-4 .col, 
        .row-cols-xl-4 .col, 
        .row-cols-lg-4 .col {
            flex: 0 0 25%;
            max-width: 25%;
        }
    
        .brand-logo-container {
            width: 100%;
            max-width: 200px; /* Adjusted width for a better fit */
            margin: 0 auto;
            overflow: hidden;
            position: relative;
        }
    
        .brand-logo {
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    
        /* Hover effect: scaling and shadow */
        .brand-logo-container:hover .brand-logo {
            transform: scale(1.1);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
    
        /* Proper alignment of brand name */
        .brand-name {
            margin-top: 10px;
            font-size: 16px;
            font-weight: 700;
            color: #333;
        }
    </style>
    
    
@endsection
