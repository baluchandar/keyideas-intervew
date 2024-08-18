<!DOCTYPE html>
<html lang="en">
<head>
  <title>Wedding cards Catalog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 m-auto">
            <div class="header-block">
                <h1>Shop Wedding Bands And Wedding rings</h1>
                <div class="head-desc view-less">
                    <span>Our collection of men's and women's wedding bands features the finest platinum, gold, and contemporary metals. Each stunning band is crafted to the highest standards with handcrafted details, fine diamonds, or colorful gemstones.</span>
                    <span class="show-more">Show More</span>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-blocks pt-3">
    
        <div class="filter-dropdown">
            <div class="filter-button">
                Gender <span class="arrow">&#9660;</span>
            </div>
            <div class="filter-dropdown-menu">
                <strong>Gender</strong> <div class="close-btn">&times;</div>
                <div class="form-group row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label><input type="checkbox" value="Mens" class="gender-input-filter"> Mens</label>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label><input type="checkbox" value="Womens" class="gender-input-filter"> Womens</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter 2: Diamond Type -->
        <div class="filter-dropdown">
            <div class="filter-button">
                Style <span class="arrow">&#9660;</span>
            </div>
            <div class="filter-dropdown-menu category-filter-menu">
                <strong>Style</strong> <div class="close-btn">&times;</div>
                <div class="form-group row">
                    @if($categories)
                        @foreach($categories as $category)
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label><input type="checkbox" class="category-input-filter" value="{{ $category->name}}"> {{$category->name}}</label>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="filter-dropdown">
            <div class="filter-button disabled">
                Diamond Type <span class="arrow">&#9660;</span>
            </div>
            <div class="filter-dropdown-menu">
                <div class="close-btn">&times;</div>
                <div class="form-group">
                </div>
            </div>
        </div>
        <div class="filter-dropdown">
            <div class="filter-button disabled">
                Gemstones <span class="arrow">&#9660;</span>
            </div>
            <div class="filter-dropdown-menu">
                <div class="close-btn">&times;</div>
                <div class="form-group">
                </div>
            </div>
        </div>
        <div class="filter-dropdown">
            <div class="filter-button disabled">
                Metal <span class="arrow">&#9660;</span>
            </div>
            <div class="filter-dropdown-menu">
                <div class="close-btn">&times;</div>
                <div class="form-group">
                </div>
            </div>
        </div>

        <div class="filter-dropdown">
            <div class="filter-button">
                Price <span class="arrow">&#9660;</span>
            </div>
            <div class="price-filter filter-dropdown-menu">
                <strong>Price</strong> <div class="close-btn">&times;</div>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <div>
                            <label for="min-price" class="small text-muted">Min Price</label>
                            <input type="text" id="min-price" value="$0">
                        </div>
                        <div>
                            <label for="max-price" class="small text-muted">Max Price</label>
                            <input type="text" id="max-price" value="$200000">
                        </div>
                    </div>
                    <div class="range-slider mt-4">
                    <div class="range-selector">
                        <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div id="filter-result-labels-sec">

    </div>
    

    <div class="sort-options">
        <div class="row">
            <div class="col-md-8">
                <span>Sort By</span>
                <div class="dropdown d-inline">
                    <button class="btn sort-btn dropdown-toggle" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Best Sellers
                    </button>
                    <div class="dropdown-menu sort-filter-input" aria-labelledby="sortDropdown">
                        <a class="dropdown-item" value="top">Best Sellers</a>
                        <a class="dropdown-item" value="low-high">Low to High</a>
                        <a class="dropdown-item" value="high-low">High to Low</a>
                    </div>
                </div>
                
                <span class="ml-3">Shipping Date By</span>
                <div class="dropdown d-inline">
                    <button class="btn sort-btn dropdown-toggle disabled" type="button" id="shippingDateDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Any Date
                    </button>
                    <div class="dropdown-menu" aria-labelledby="shippingDateDropdown">
                        <a class="dropdown-item" href="#">Any Date</a>
                        <a class="dropdown-item" href="#">Within 1 Day</a>
                        <a class="dropdown-item" href="#">Within 1 Week</a>
                        <a class="dropdown-item" href="#">Within 1 Month</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <span class="results-count"><span id="total-product-count"></span> Results</span>
            </div>
        </div>
    </div>
    <hr />

    <div class="product-list-container row m-0" id="item-products-container">
       
    </div>
</div>

  <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
  <script>
      var currentPage = 1,lastPage=1,totalProducts = 0,is_loading = true;
      var filters = {};
      var assetPath = '{{ asset("/") }}';
      loadProducts();
      
      var currentRequest = null;
      function loadProducts()
      {
        filters.page = currentPage;
        var queryString = new URLSearchParams(filters).toString();
        var pageUrl =`{{ url('/get-products') }}?`+queryString;
          is_loading = true;
          currentRequest  = $.ajax({
            url:pageUrl,
            type:'get',
            dataType:'json',
            beforeSend : function()    {           
                if(currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success:function(res) {
                if(res.status == 'success') {
                    lastPage = res.last_page;
                    totalProducts = res.total;
                    $('#total-product-count').html(numberWithCommas(totalProducts));
                    if(res.total <= 0) {
                        $('#item-products-container').html("<h2 class='no-products-label'>No products found with the given filters.");
                        is_loading = false;
                        return false;
                    }
                    var productHtml = '';
                    $.each(res.data, function(index, product) {
                        productHtml += productItemHtml(product);
                    });
                    if(currentPage == 1) {
                        $('#item-products-container').html(productHtml);
                    }else{
                        $('#item-products-container').append(productHtml);
                    }
                    currentPage++;
                    is_loading = false;
                }else{
                    alert("Sorry something went wrong");
                    return;
                }
            }
        })
        
    }
</script>
<script src="{{ asset('js/product-page.js') }}"></script>
</body>
</html>



