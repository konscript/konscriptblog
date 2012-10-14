<?php
/**
 * @package WordPress
 * @subpackage WPEX WordPress Framework
 * This file contains filters for customizing the dashboard columns
 */
 
//slides
add_filter("manage_edit-slides_columns", "edit_slides_columns" );
add_action("manage_posts_custom_column", "custom_slides_columns");

function edit_slides_columns($slides_columns){
        $slides_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Title",
				"slider_image" => "Featured Image",
				"date" => "Date"
        );
        return $slides_columns;
}

function custom_slides_columns($slides_column){
		global $post;
        switch ($slides_column)
        {
		case "slider_image":
				if(has_post_thumbnail()) {
				 //get atachment url
				 $img_url = wp_get_attachment_url(get_post_thumbnail_id(),'full'); //get full URL to image
				 //resize & crop the featured image
				 $featured_image = $featured_image = aq_resize( $img_url, 80, 80, true );
				echo '<img src="'. $featured_image .'" />';
				} else { echo '-'; }
		break;
		}

}

//portfolio
add_filter("manage_edit-portfolio_columns", "edit_portfolio_columns" );
add_action("manage_posts_custom_column", "custom_portfolio_columns");

function edit_portfolio_columns($portfolio_columns){
        $portfolio_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Title",
				"portfolio_category" => "Category",
                "portfolio_image" => "Featured Image",
				"date" => "Date",
        );
        return $portfolio_columns;
}

function custom_portfolio_columns($portfolio_column){
        global $post;
        switch ($portfolio_column)
        {
				case "portfolio_category":
					echo get_the_term_list( get_the_ID(), 'portfolio_cats', ' ', ' , ', ' ');
				break;
				
                case "portfolio_image":
						if(has_post_thumbnail()) {
						 //get atachment url
						 $img_url = wp_get_attachment_url(get_post_thumbnail_id(),'full'); //get full URL to image
						 //resize & crop the featured image
						 $featured_image = $featured_image = aq_resize( $img_url, 80, 80, true );
						echo '<img src="'. $featured_image .'" />';
						} else { echo '-'; }
				break;
        }

}
?>