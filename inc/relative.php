<?php
	
	add_action( 'template_redirect', 'digitate_relative_urls' );

	function digitate_relative_urls() {
	    // Don't do anything if:
	    // - In feed
	    // - In sitemap by WordPress SEO plugin
	    if ( is_feed() || get_query_var( 'sitemap' ) )
	        return;
	
	    $filters = array(
	        'post_link',       // Normal post link
		    'post_type_link',  // Custom post type link
		    'page_link',       // Page link
		    'attachment_link', // Attachment link
		    'get_shortlink',   // Shortlink
		
		    'post_type_archive_link',    // Post type archive link
		    'get_pagenum_link',          // Paginated link
		    'get_comments_pagenum_link', // Paginated comment link
		
		    'term_link',   // Term link, including category, tag
		    'search_link', // Search link
		
		    'day_link',   // Date archive link
		    'month_link',
		    'year_link',
	    );
	    
	    foreach ( $filters as $filter )
	    
	    {
	        add_filter( $filter, 'wp_make_link_relative' );
	    }
	}
	
	function internal_link_to_relative(  $url, $post, $leavename ) {

		if ( $post->post_type == 'post' ) {
			$url = wp_make_link_relative($url);
		}
		return $url;
		}
	add_filter( 'post_link', 'internal_link_to_relative', 10, 3 );

	
	function fix_links($input) {
	    return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
	}
	
?>