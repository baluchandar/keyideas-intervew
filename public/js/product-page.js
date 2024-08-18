    $(document).ready(function() {
        $('.filter-button').on('click', function() {
        var $currentDropdown = $(this).parent();

        $('.filter-dropdown').not($currentDropdown).removeClass('active');
        $('.filter-dropdown .arrow').html('&#9660;'); 

        $currentDropdown.toggleClass('active');
        
        if ($currentDropdown.hasClass('active')) {
            $(this).find('.arrow').html('&#9650;'); 
        } else {
            $(this).find('.arrow').html('&#9660;'); 
        }
    });

    $('.close-btn').on('click', function() {
        var $dropdown = $(this).closest('.filter-dropdown');
        $dropdown.removeClass('active');
        $dropdown.find('.arrow').html('&#9660;'); 
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.filter-dropdown').length) {
            $('.filter-dropdown').removeClass('active');
            $('.arrow').html('&#9660;'); 
        }
    });

    $('.sort-options .dropdown-menu a').on('click', function() {
            var selectedText = $(this).text();
            filters.sortBy = $(this).attr('value');
            filterProducts();
            $(this).closest('.dropdown').find('.sort-btn').text(selectedText);
    });

    //price range 
    $("#slider-range").slider({
        range: true, 
        min: 0,
        max: 200000,
        step: 1,
        values: [0,200000],
        slide: function( event, ui ) {
            $( "#min-price").val("$"+numberWithCommas(ui.values[ 0 ]));
            suffix = '';
            if (ui.values[ 1 ] == $( "#max-price").data('max') ){
            suffix = ' +';
            }
            $( "#max-price").val("$"+numberWithCommas(ui.values[ 1 ] + suffix));   
            
            if(ui.values[ 0 ] > 0) {
                filters.priceFrom = ui.values[ 0 ];
            }else {
                delete filters.priceFrom;
            }
            
            if(ui.values[ 1 ] < 200000) {
                filters.priceTo = ui.values[ 1 ];
            }else {
                delete filters.priceTo;
            }
        },
        change:function(e,ui) {
            filterProducts();
        }
    })
    $("#min-price, #max-price").change(function() {
        var minValue = parseInt($("#min-price").val().replace(/[$,]/g, ""), 10); // remove comma and doller sign from input
        var maxValue = parseInt($("#max-price").val().replace(/[$,]/g, ""), 10);
            $("#slider-range").slider("values", 0, minValue);
            $("#slider-range").slider("values", 1, maxValue);
            if(0 < minValue) {
                filters.priceFrom = minValue;
            }else{
                delete filters.priceFrom;
            }
            if(200000 > maxValue) {
                filters.priceTo = maxValue;
            }else{
                delete filters.priceTo;
            }
            filterProducts();
    });

$(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && is_loading == false) {
            if(lastPage < currentPage){
                return;
            }
            loadProducts();
        }
    });

    $('.gender-input-filter').change(function(){
        if(typeof(filters.gender) != 'undefined') {
            delete filters.gender;
        }
        var selectedGender = [];
        $('.gender-input-filter:checked').each(function() {
          selectedGender.push($(this).val());
        })
        if(selectedGender.length > 0) {
            filters.gender = selectedGender.toString();
        }
        filterProducts();
    })
    $('.category-input-filter').change(function(){
        if(typeof(filters.category) != 'undefined') {
            delete filters.category;
        }
        var selectedCategory = [];
        $('.category-input-filter:checked').each(function() {
          selectedCategory.push($(this).val());
        })
        if(selectedCategory.length > 0) {
            filters.category = selectedCategory.toString();
        }
        filterProducts();
    })

    $('.head-desc .show-more').click(function(){
        $(this).remove();
        $('.head-desc').removeClass('view-less');
    })
    });//End documentreadyFun
function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}
function productItemHtml(productInfo) {
    return `<div class="product-block col-md-3">
    <div class="product-item">
    <a href="`+assetPath+productInfo.prod_Live_URL+`">
                <div class="image-wrapper">
                    <span class="bookmart-icon"><img src="`+assetPath+`images/heart-svgrepo-com.svg" /></span>
                    <img src="`+assetPath+productInfo.attr_whitegold_platinum_round_default_img+`" class="img "/>
                </div>
                <div class="item-name">`+productInfo.prod_name+`</div>
                <div class="item-price-block">
                    <span class="selling-price">$`+numberWithCommas(productInfo.attr_14k_regular)+`</span>
                </div>
                <div class="item-rating">
                    <span class="text-primary">★</span>
                    <span class="text-primary">★</span>
                    <span class="text-primary">★</span>
                    <span class="text-secondary">★</span> 15 Reviews
                </div>
                </a>
            </div>
        </div>`; 
}
function generateFilterLabels() {
    var filterLabels = '';
    var priceLabelLoaded = false;
    $.each(filters, function (key, filter) {
        // if(key == 'priceFrom') {
        var filterOptions = ['gender','category'];
        if($.inArray(key,filterOptions) != -1) {
            $.each(filter.split(","), function(index, value) {
                filterLabels += generateFiltLabel(key,value);
            })
        }else if(key == 'priceFrom' || key == 'priceTo' && (priceLabelLoaded == false)) {
            $('.price-label-filter-res').remove();
            filterLabels += generateFiltLabel(key,filter);
            priceLabelLoaded = true;
        }
        $('#filter-result-labels-sec').html(filterLabels);

    });
}
function removeFilter(key,filter) {
    filter = decodeURI(filter);
    if(key == 'priceFrom' || key == 'priceTo') {
         $('#min-price').val('$0')   
         $('#max-price').val('$200000')
         $("#slider-range").slider("values", 0, 0);
         $("#slider-range").slider("values", 1, 200000);
         $('.price-label-filter-res').remove();
         delete filters.priceFrom   
         delete filters.priceTo   
    }else{
    var filterVal = [];
        $.each(filters[key].split(","), function(index, value) { 
            if(value != filter){
                filterVal.push(value);
            }else{
                    $("."+key+"-input-filter[value='"+filter+"']").prop("checked", false);
                }
            if(filterVal.length > 0) {
                filters[key] = filterVal.join(',');  
            }else{
                delete filters[key];
            }
        })
    }
    filterProducts();
}
function generateFiltLabel(key,value) {
    if(key == 'priceFrom' || key == 'priceTo') {
        var priceFromLabl = key == 'priceFrom' ? value : (typeof(filters.priceFrom)!= 'undefined' ? filters.priceFrom : 0 )
        var priceToLabl = key == 'priceTo' ? value : (typeof(filters.priceTo)!= 'undefined' ? filters.priceTo : 200000 )
        return `<label class="filter-res-label price-label-filter-res" >$`+numberWithCommas(priceFromLabl)+` - $`+numberWithCommas(priceToLabl)+` <span onclick=removeFilter("`+key+`",`+value+`) aria-hidden="true">&times;</span></label>`;
    }else{
        return `<label id="label-`+key+`-`+value+`" class="filter-res-label">`+value+` <span onclick=removeFilter("`+key+`","`+encodeURI(value)+`") aria-hidden="true">&times;</span></label>`;
    }
}
function filterProducts(){
    currentPage = 1;
    loadProducts();
    generateFilterLabels();
}