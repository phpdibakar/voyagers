<style>
@import url(<?php echo  plugins_url() . '/'. $this_plugin_dir .'/assets/slider/jquery.bxslider.css'; ?>);
</style>
<ul class="bxslider">
	<?php if(count($sliders)): ?>
		<?php foreach($sliders as $slider): ?>
			<li>
				<?php 
					$image = (isset($slider->img) && !empty($slider->img)) ? 'uploads/'. $slider->img : 'img/icon-no-image.png';
					echo HtmlHelper::resizeWithPHPThumb(
						plugins_url() . '/'. $this_plugin_dir .'/assets/phpThumb', 
						plugins_url() . '/'. $this_plugin_dir .'/assets/' . $image,  
						800, 
						600,
						$slider->name,
						$slider->title,
						1
					);
				?>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>

<!-- jQuery library (served from Google) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="<?php echo  plugins_url() . '/'. $this_plugin_dir .'/assets/slider/jquery.bxslider.min.js'; ?>"></script>
<script>
$(document).ready(function(){
  $('.bxslider').bxSlider({
	captions: true,
	mode: 'fade'
  });
});
</script>