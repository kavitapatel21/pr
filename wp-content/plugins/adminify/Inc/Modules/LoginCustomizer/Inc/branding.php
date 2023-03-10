<?php
$adminify_visibility = '';
if ( empty( $this->options['jltwp_adminify_credits'] ) ) {
	$adminify_visibility = 'is-hidden';
}
?>

<div class="wp-adminify-badge <?php echo esc_attr( $position_class ) . ' ' . esc_attr( $adminify_visibility ); ?>">
	<div class="wp-adminify-badge__inner">
		<span class="wp-adminify-badge__text"><?php esc_html_e( 'Powered by', 'adminify' ); ?></span>
		<svg class="icon icon-wp-adminify" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.32 112.64">
			<defs>
				<style>
					.cls-1 {
						fill: #14142b;
					}

					.cls-2 {
						fill: #0347ff;
					}
				</style>
			</defs>
			<g id="Layer_2" data-name="Layer 2">
				<g id="Layer_2-2" data-name="Layer 2">
					<path class="cls-1" d="M161.81,37.23a22.6,22.6,0,1,0,11.3,42.16v3H184.4V59.83A22.59,22.59,0,0,0,161.81,37.23Zm11.3,22.6v0a11.31,11.31,0,1,1-11.3-11.33,11.31,11.31,0,0,1,11.3,11.33Z" />
					<path class="cls-1" d="M305.3,37.23a22.53,22.53,0,0,0-17,7.7,22.59,22.59,0,0,0-39.56,14.92V82.43H260V59.85a11.31,11.31,0,1,1,22.61,0V82.43h11.29v0H294V59.83a11.3,11.3,0,1,1,22.6,0V82.41h11.29V59.83A22.59,22.59,0,0,0,305.3,37.23Z" />
					<path class="cls-1" d="M380.88,37.23a22.6,22.6,0,0,0-22.6,22.6V82.41h11.3V59.83a11.3,11.3,0,1,1,22.6,0V82.41h11.3V59.83A22.6,22.6,0,0,0,380.88,37.23Z" />
					<path class="cls-1" d="M239.24,57.31V25.93h-11.3V40.26a22.61,22.61,0,1,0,0,39.13v3h11.3V57.31Zm-11.3,2.55a11.3,11.3,0,1,1,0-.07Z" />
					<polygon class="cls-1" points="337.42 57.66 337.42 62.36 337.42 82.41 348.71 82.41 348.71 62.36 348.71 57.66 348.71 37.29 337.42 37.29 337.42 57.66" />
					<rect class="cls-1" x="337.41" y="26" width="11.3" height="5.59" />
					<polygon class="cls-1" points="413.06 57.59 413.06 62.3 413.06 82.35 424.36 82.35 424.36 62.3 424.36 57.59 424.36 37.23 413.06 37.23 413.06 57.59" />
					<rect class="cls-1" x="413.06" y="25.94" width="11.3" height="5.59" />
					<path class="cls-1" d="M439.61,38.48v10H434v11.3h5.66V82.41h11.3V59.82h5.64V48.52h-5.64V37.23h5.64V25.93h-5.64C444.67,25.93,439.61,31.55,439.61,38.48Z" />
					<path class="cls-1" d="M511.32,37.23H500V54.17a11.3,11.3,0,1,1-22.6,0V37.23h-11.3V54.17A22.61,22.61,0,0,0,499.65,74a11.32,11.32,0,0,1-10.93,8.46,11.17,11.17,0,0,1-5.65-1.53V93a22.38,22.38,0,0,0,5.65.72,22.6,22.6,0,0,0,22.6-22.6V54.17h0Z" />
					<path class="cls-2" d="M118,72.71,83.91,13.37a26.66,26.66,0,0,0-46.23,0L3.58,72.71A26.65,26.65,0,0,0,26.7,112.64H44.56a19.19,19.19,0,0,1-9.31-27.29l24.53-42.7a19.18,19.18,0,0,1,33.27,0l24.54,42.7a19,19,0,0,1,2.56,9.19A26.31,26.31,0,0,0,118,72.71Z" />
					<path class="cls-2" d="M101.42,69a7.49,7.49,0,0,0-13,0L79.62,84.29a8.37,8.37,0,0,0,7.26,12.53H103a8.35,8.35,0,0,0,7.25-12.53Z" />
				</g>
			</g>
		</svg>

		<a class="wp-adminify-badge__link" href="https://wpadminify.com/" alt="<?php echo esc_html__( 'Get WP Adminify today', 'adminify' ); ?>" target="_blank"></a>
		<button class="wp-adminify-event-button customizer-event-overlay" data-wp-adminify-customizer-event="wp-adminify-edit-branding"></button>
	</div>
</div>
