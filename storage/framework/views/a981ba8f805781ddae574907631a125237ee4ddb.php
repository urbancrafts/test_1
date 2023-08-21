<div class="elementor-element elementor-element-2b60bc8 elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="2b60bc8" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}">
    <div class="elementor-container elementor-column-gap-no">
    <div class="elementor-row">
    <div class="elementor-element elementor-element-1b609f2 elementor-column elementor-col-100 elementor-top-column" data-id="1b609f2" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-7382dc4 elementor-widget elementor-widget-foxuries-hb-search" data-id="7382dc4" data-element_type="widget" data-widget_type="foxuries-hb-search.default">
    <div class="elementor-widget-container">
    <div class="hb-search-inline">
    <div id="hotel-booking-search-602ae19e83ede" class="hotel-booking-search">
        <fieldset class="reservation-avail-field">
            <legend>Search Location</legend>


    <form name="hb-search-form" action="<?php echo e(action('App\Http\Controllers\AjaxRequestController@post_check_availability')); ?>" class="hb-search-form-602ae19e83edb" id="check-avail-form" method="POST">
    <ul class="hb-form-table">

        <li class="hb-form-field">
           <label><input type="radio" name="search-option" id="search-option" value="Resort" checked>Resorts|<input type="radio" name="search-option" id="search-option" value="Boat">Boats| <input type="radio" name="search-option" id="search-option" value="Others">Services</label>;
        </li>
      
        <li >
            <div >
            <input type="search"  id="location" name="location" placeholder="Google location search-box"  />
                </div>
            </li>
         

    
    
    
</ul>
    
    
    
    <p class="hb-submit">
    <button type="submit" class="fa button fa-search search-btn" id="search-btn">Search</button>
    </p>
    
    
    </form>


    <div class="alert alert-warning alert-dismissible" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
        <span class="upload-error"></span>
      </div>

      <div class="alert alert-danger alert-dismissible" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
        <span class="upload-error"></span>
      </div>

      <div class="alert alert-success alert-dismissible" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        <span class="upload-success"></span>
      </div>

    <ul class="rooms tp-hotel-booking hb-catalog-column-3" id="load_search_result">

    </ul>
    
        </fieldset>
    </div> </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/pages/index-check-reservation.blade.php ENDPATH**/ ?>