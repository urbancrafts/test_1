<div class="elementor-element elementor-element-d3e3bb7 elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="d3e3bb7" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-row">
			<div class="elementor-element elementor-element-a49567c elementor-column elementor-col-100 elementor-top-column" data-id="a49567c" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-db2f4fa animated-fast elementor-view-default elementor-invisible elementor-widget elementor-widget-icon" data-id="db2f4fa" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="icon.default">
			<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-decor"></i> </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-d64a55d animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="d64a55d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>Discover</span></div>
			</div>
			</div>
			<div class="elementor-element elementor-element-c242158 animated-fast elementor-invisible elementor-widget elementor-widget-heading" data-id="c242158" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Rooms & Suites</h2> </div>
			</div>
			<div class="elementor-element elementor-element-8d0aac8 animated-fast elementor-invisible elementor-widget elementor-widget-wp-widget-hb_widget_carousel" data-id="8d0aac8" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="wp-widget-hb_widget_carousel.default">
			<div class="elementor-widget-container">
			<div id="hotel_booking_slider_602ae19e94c88" data-items="4" data-nav="true" data-pagination="false" data-id="#hotel_booking_slider_602ae19e94c88" class="hb_room_carousel_container hb_room_carousel_widget_container tp-hotel-booking">
			<div class="navigation">
			<span class="foxuries-icon-long-arrow-left prev"></span> <a class="text-link" href="#">See All Lodges</a>
			<span class="foxuries-icon-long-arrow-right next"></span> </div>
			<div class="hb_room_carousel">

			<ul class="rooms tp-hotel-booking hb-catalog-column-3">
           <?php if(count($rooms) > 0): ?>
           <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
		   <?php if($room->img_1 != "" ): ?>

		   <li id="room-56" class="hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view">
			<div class="summary entry-summary">
			<div class="media">
			<a href="<?php echo e(url('resorts/resort/'.$room->shelter_id.'/'.$room->id)); ?>">
			<img src="<?php echo e($room->img_1); ?>" width="500" height="575" alt="" /> </a>
			</div>
			<div class="room-caption">
			<div class="title">
			<h4>
			<a href="<?php echo e(url('resorts/resort/'.$room->shelter_id.'/'.$room->id)); ?>"><?php echo e($room->room_no); ?></a>
			</h4>
			</div>
			<div class="room-meta">

	<?php $__currentLoopData = $resorts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resort): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    <?php if($resort->id == $room->shelter_id): ?>
		<span class="room-type"><i class="foxuries-icon-home-solid"></i>
		<a href="<?php echo e(url('resorts/resort/'.$room->shelter_id)); ?>"><?php echo e($resort->name); ?></a>	
	</span>	
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	

</div>
			<div class="price">
			<span class="title-price">Price from</span>
			<span class="price_value price_min"><?php echo e($room->curr); ?><?php echo e($room->amount); ?></span>
			<span class="unit"><?php echo e($room->duration); ?></span>
			</div>
			
			<a href="<?php echo e(url('resorts/resort/'.$room->shelter_id.'/'.$room->id)); ?>" class="room-button"><i class="foxuries-icon-long-arrow-right"></i><span>See detail</span></a> </div>
			</div>
			</li>

			<?php endif; ?>
		   
		   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			   
		   <?php else: ?>
		   <li><h3>No room data created yet</h3></li>
			   
		   <?php endif; ?>
			</ul>

			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div><?php /**PATH C:\Users\SONY\Desktop\beach_comber\resources\views/pages/index-room-show.blade.php ENDPATH**/ ?>