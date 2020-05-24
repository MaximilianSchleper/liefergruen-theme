
<?php
function child_theme_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));

}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );?>
## add short description to produkt katalog

add_action( 'woocommerce_after_shop_loop_item_title', 'wc_add_short_description' );

function wc_add_short_description() {
	global $product;
	?>
        <div itemprop="description">
            <?php echo apply_filters( 'woocommerce_short_description', $product->post-> post_excerpt ) ?>
        </div>
	<?php
}

## today var for advanced export 
// replace {tomorrow} and {today}  with actual values comparison operators
// tweak formats for your needs!
add_filter('woe_settings_validate_defaults', function ($settings) {
	$settings = json_encode($settings); // to string
	$tomorrow = date("d.m.y" , strtotime("+1 day",  current_time( 'timestamp' ) ));
	$settings = str_replace( '{tomorrow}', $tomorrow, $settings);
	$today = date("d.m.y" , current_time( 'timestamp' ) );
	$settings = str_replace( '{today}', $today, $settings);
	$settings = json_decode($settings, true); // to array
	return $settings;
} );