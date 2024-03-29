
<?php
	$button = get_sub_field('button');
?>


<!-- ================================================ -->
<!-- Basic HTML structure of a button -->
<!-- ================================================ -->

<?php 
	if( !empty($button['title']) ) {
		$button_target = $button['target'] ? ' target="' . $button['target'] . '"' : '';
	}
?>
<div class="zd-button-wrapper">
	<a href="<?php esc_url( $button['url'] ) ?>" class="zd-button"<?php echo $button_target; ?>><?php echo $button['title']; ?></a>
</div>

<style>
	.zd-button-wrapper {
		(position: relative;)
	}
	.zd-button-wrapper .zd-button {
		/* Obligatory */
		display: inline-block; 
		cursor: pointer;
		outline: 0;
		-webkit-transition: all .25s ease-in-out;
		-o-transition: all .25s ease-in-out;
		transition: all .25s ease-in-out;

		/* Often Used */
		padding: Xpx Ypx;
		font-size: Xpx;
		line-height: Xpx;

		/* Optional */
		(text-align: X;)
		(letter-spacing: Xpx;)
		(font-weight: X;)
		(border-radius: Xpx;)
		(background: #XXX;)
		(color: #XXX;)
	}
</style>










<!-- ================================================ -->
<!-- In case you have 2 buttons with different colors you just add needed class to wrapper -->
<!-- ================================================ -->

<div class="zd-button-wrapper button-black">
	<a href="#" class="zd-button">Black Button Text</a>
</div>

<div class="zd-button-wrapper button-white">
	<a href="#" class="zd-button">White Button Text</a>
</div>
<style>
	.zd-button-wrapper.button-black .zd-button {
		background: #000;
		color: #fff;
	}
	.zd-button-wrapper.button-white .zd-button {
		background: #fff;
		color: #000;
	}
</style>

<!-- Instead of using button-black/button-white class could be used a class style-1/style-2. Style-1/style-2 classes are used when not only color changes but other styles too -->












<!-- ================================================ -->
<!-- Different sizes of buttons (small/medium/large) -->
<!-- ================================================ -->
<div class="zd-button-wrapper button-small">
	<a href="#" class="zd-button">Small Button Text</a>
</div>
<div class="zd-button-wrapper button-medium">
	<a href="#" class="zd-button">Mediun Button Text</a>
</div>
<div class="zd-button-wrapper button-large">
	<a href="#" class="zd-button">Large Button Text</a>
</div>

<style>
	.zd-button-wrapper.button-small .zd-button {
	    padding: 5px 10px;
	}
	.zd-button-wrapper.button-medium .zd-button {
	    padding: 10px 15px;
	}
	.zd-button-wrapper.button-large .zd-button {
	    padding: 10px 25px;
	}
</style>














<!-- ================================================ -->
<!-- Width limitations to buttons -->
<!-- ================================================ -->
<div class="zd-button-wrapper button-width-140">
	<a href="#" class="zd-button">Limited Button Text</a>
</div>

<style>
	.zd-button-wrapper.button-width-140 .zd-button {
		width: 100%;
		max-width: 140px;
	}
</style>