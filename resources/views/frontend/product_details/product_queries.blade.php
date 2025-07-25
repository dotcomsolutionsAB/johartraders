@if(get_setting('product_query_activation') == 1)
    {{-- <div class="bg-white border mt-4 mb-4" id="product_query">
        <div class="p-3 p-sm-4">
            <h3 class="fs-16 fw-700 mb-0">
                <span>{{ translate(' Product Queries ') }} ({{ count($detailedProduct->product_queries) }})</span>
            </h3>
        </div>

        <!-- Login & Register -->
        @guest
            <p class="fs-14 fw-400 mb-0 px-3 px-sm-4 mt-3"><a
                    href="{{ route('user.login') }}">{{ translate('Login') }}</a> {{ translate('or') }} <a class="mr-1"
                    href="{{ route('user.registration') }}">{{ translate('Register ') }}</a>{{ translate(' to submit your questions to seller') }}
            </p>
        @endguest

        <!-- Query Submit -->
        @auth
            <div class="query form px-3 px-sm-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('product-queries.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product" value="{{ $detailedProduct->id }}">
                    <div class="form-group">
                        <textarea class="form-control rounded-0" rows="3" cols="40" name="question"
                            placeholder="{{ translate('Write your question here...') }}" style="resize: none;"></textarea>
                        
                    </div>
                    <button type="submit" class="btn btn-sm w-150px btn-primary rounded-0">{{ translate('Submit') }}</button>
                </form>
            </div>

            <!-- Own Queries -->
            @php
                $own_product_queries = $detailedProduct->product_queries->where('customer_id', Auth::id());
            @endphp
            @if ($own_product_queries->count() > 0)
            
                <div class="question-area my-4 mb-0 px-3 px-sm-4">

                    <div class="py-3">
                        <h3 class="fs-16 fw-700 mb-0">
                            <span class="mr-4">{{ translate('My Questions') }}</span>
                        </h3>
                    </div>
                    @foreach ($own_product_queries as $product_query)
                        <div class="produc-queries mb-4">
                            <div class="query d-flex my-2">
                                <span class="mt-1"><svg xmlns="http://www.w3.org/2000/svg" width="24.994"
                                        height="24.981" viewBox="0 0 24.994 24.981">
                                        <g id="Group_23909" data-name="Group 23909"
                                            transform="translate(18392.496 11044.037)">
                                            <path id="Subtraction_90" data-name="Subtraction 90"
                                                d="M1830.569-117.742a.4.4,0,0,1-.158-.035.423.423,0,0,1-.252-.446c0-.84,0-1.692,0-2.516v-2.2a5.481,5.481,0,0,1-2.391-.745,5.331,5.331,0,0,1-2.749-4.711c-.034-2.365-.018-4.769,0-7.094l0-.649a5.539,5.539,0,0,1,4.694-5.513,5.842,5.842,0,0,1,.921-.065q3.865,0,7.73,0l5.035,0a5.539,5.539,0,0,1,5.591,5.57c.01,2.577.01,5.166,0,7.693a5.54,5.54,0,0,1-4.842,5.506,6.5,6.5,0,0,1-.823.046l-3.225,0c-1.454,0-2.753,0-3.97,0a.555.555,0,0,0-.435.182c-1.205,1.214-2.435,2.445-3.623,3.636l-.062.062-1.005,1.007-.037.037-.069.069A.464.464,0,0,1,1830.569-117.742Zm7.37-11.235h0l1.914,1.521.817-.754-1.621-1.273a3.517,3.517,0,0,0,1.172-1.487,5.633,5.633,0,0,0,.418-2.267v-.58a5.629,5.629,0,0,0-.448-2.323,3.443,3.443,0,0,0-1.282-1.525,3.538,3.538,0,0,0-1.93-.53,3.473,3.473,0,0,0-1.905.534,3.482,3.482,0,0,0-1.288,1.537,5.582,5.582,0,0,0-.454,2.314v.654a5.405,5.405,0,0,0,.471,2.261,3.492,3.492,0,0,0,1.287,1.5,3.492,3.492,0,0,0,1.9.527,3.911,3.911,0,0,0,.947-.112Zm-.948-.9a2.122,2.122,0,0,1-1.812-.9,4.125,4.125,0,0,1-.652-2.457v-.667a4.008,4.008,0,0,1,.671-2.4,2.118,2.118,0,0,1,1.78-.863,2.138,2.138,0,0,1,1.824.869,4.145,4.145,0,0,1,.639,2.473v.673a4.07,4.07,0,0,1-.655,2.423A2.125,2.125,0,0,1,1836.991-129.881Z"
                                                transform="translate(-20217 -10901.814)" fill="#e62e04"
                                                stroke="rgba(0,0,0,0)" stroke-miterlimit="10"
                                                stroke-width="1" />
                                        </g>
                                    </svg></span>

                                <div class="ml-3">
                                    <div class="fs-14">{{ strip_tags($product_query->question) }}</div>
                                    <span class="text-secondary">{{ $product_query->user->name }} </span>
                                </div>
                            </div>
                            <div class="answer d-flex my-2">
                                <span class="mt-1"> <svg xmlns="http://www.w3.org/2000/svg" width="24.99"
                                        height="24.98" viewBox="0 0 24.99 24.98">
                                        <g id="Group_23908" data-name="Group 23908"
                                            transform="translate(17952.169 11072.5)">
                                            <path id="Subtraction_89" data-name="Subtraction 89"
                                                d="M2162.9-146.2a.4.4,0,0,1-.159-.035.423.423,0,0,1-.251-.446q0-.979,0-1.958V-151.4a5.478,5.478,0,0,1-2.39-.744,5.335,5.335,0,0,1-2.75-4.712c-.034-2.355-.018-4.75,0-7.065l0-.678a5.54,5.54,0,0,1,4.7-5.513,5.639,5.639,0,0,1,.92-.064c2.527,0,5.029,0,7.437,0l5.329,0a5.538,5.538,0,0,1,5.591,5.57c.01,2.708.01,5.224,0,7.692a5.539,5.539,0,0,1-4.843,5.506,6,6,0,0,1-.822.046l-3.234,0c-1.358,0-2.691,0-3.96,0a.556.556,0,0,0-.436.182c-1.173,1.182-2.357,2.367-3.5,3.514l-1.189,1.192-.047.048-.058.059A.462.462,0,0,1,2162.9-146.2Zm5.115-12.835h3.559l.812,2.223h1.149l-3.25-8.494h-.98l-3.244,8.494h1.155l.8-2.222Zm3.226-.915h-2.888l1.441-3.974,1.447,3.972Z"
                                                transform="translate(-20109 -10901.815)" fill="#f7941d"
                                                stroke="rgba(0,0,0,0)" stroke-miterlimit="10"
                                                stroke-width="1" />
                                        </g>
                                    </svg></span>

                                <div class="ml-3">
                                    <div class="fs-14">
                                        {{ strip_tags($product_query->reply ? $product_query->reply : translate('Seller did not respond yet')) }}
                                    </div>
                                    <span class=" text-secondary">
                                        {{ $product_query->product->user->name }} </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            
            @endif
        @endauth
                
        <!-- Others Queries -->
        <div class="queries-area my-4 mb-0 px-3 px-sm-4">
            @include('frontend.'.get_setting('homepage_select').'.partials.product_query_pagination')
        </div>
    </div> --}}
@endif