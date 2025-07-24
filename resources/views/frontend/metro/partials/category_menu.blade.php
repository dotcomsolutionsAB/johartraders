<div class="aiz-category-menu bg-white rounded-0" id="category-sidebar" style="width:100%; max-height: 400px; overflow-y: auto;">
    <ul class="categories no-scrollbar mb-0 text-left d-flex flex-wrap">
        @foreach (get_level_zero_categories()->take(12) as $key => $category)
            @php
                $category_name = $category->getTranslation('name');
            @endphp
            <div class="category-nav-element p-2" data-id="{{ $category->id }}" style="flex: 1 0 25%; box-sizing: border-box;">
                <a href="{{ route('products.category', $category->slug) }}" class="text-truncate text-dark px-4 fs-14 d-block hov-column-gap-1">
                    <span class="cat-name has-transition parent-category">{{ $category_name }}</span>
                </a>
                <div class="sub-cat-menu more p-2 mt-2">
                    <!-- Preloader or child categories will be loaded here -->
                    <div class="c-preloader text-center absolute-center">
                        <i class="las la-spinner la-spin la-3x opacity-70"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>
</div>

<!-- Updated CSS -->
<style>
    /* Set a maximum height for the container and enable scrolling */
    .aiz-category-menu {
        max-height: 400px; /* Set the height of the scrollable area */
        overflow-y: auto; /* Enable vertical scroll */
    }

    /* Customize the scrollbar */
    .aiz-category-menu::-webkit-scrollbar {
        width: 6px;
    }

    .aiz-category-menu::-webkit-scrollbar-thumb {
        background-color: #ff5a00;
        border-radius: 10px;
    }

    .aiz-category-menu::-webkit-scrollbar-track {
        background-color: #ccc;
    }

    /* Flexbox settings for the categories to display in columns */
    .categories {
        display: flex;
        flex-wrap: wrap;
    }

    /* Category card layout */
    .category-nav-element {
        flex: 1 0 25%; /* Adjust to set the number of columns */
        padding: 10px;
        box-sizing: border-box;
    }

    /* Remove the border around the categories */
    .category-nav-element {
        border: none;
    }

    /* Style for parent category */
    .parent-category {
        color: #ff5a00;
        font-weight: bold;
        font-size: 16px;
    }

    /* Sub-category list */
    .sub-cat-menu ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    /* Style for child categories */
    .sub-cat-menu ul li {
        margin-bottom: 5px;
    }

    /* Alignment of child categories */
    .sub-cat-menu {
        padding-left: 20px; /* Adjust as needed to indent child categories */
    }

    .sub-cat-menu ul li a {
        color: #333;
        text-decoration: none;
        font-size: 14px;
    }

    /* Hover effect for child categories */
    .sub-cat-menu ul li a:hover {
        color: #ff5a00;
    }
</style>
