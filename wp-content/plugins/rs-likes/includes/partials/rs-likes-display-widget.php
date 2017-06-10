<?php

if ( ! empty( $instance['title'] ) ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
}

if ( ! empty( $title ) ) {
	echo $before_title . $title . $after_title;
}

$options = get_option( $this->plugin_name . '-settings' );
$post_types = array();

if ( ! empty( $options['post-type'] ) ) {
	$post_types = $options['post-type'];
}

if ( ! empty( $post_types ) ) {

	$likes_args = array(
		'post_status'    => 'publish',
		'post_type'      => $post_types,
		'meta_key'       => 'rs_like_value',
		'meta_value'     => '0',
		'meta_compare'   => '>',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
		'posts_per_page' => 5
	);
	$likes_query = new WP_Query( $likes_args );

	$html = '<div class="rs-likes-inner">';
		if ( $likes_query->have_posts() ) {
			$html .= '<ul class="rs-likes-ul">';
				while ( $likes_query->have_posts() ) : $likes_query->the_post();
					$currentValue = get_post_meta( get_the_ID(), 'rs_like_value', true );
					$html .= '<li class="rs-likes-li"><a href="' . esc_url( get_post_permalink() ) . '">' . esc_html( get_the_title() ) . '</a><span> '. esc_html( $currentValue ) .'</span></li>';
				endwhile; wp_reset_postdata();
			$html .= '</ul>';
		}
	$html .= '</div>';

	echo $html;

}