<?php

$searchlabel = apply_filters( 'maghoot_search_form_label', __( 'Search', 'magazine-hoot' ) );
$searchplaceholder = apply_filters( 'maghoot_search_form_placeholder', __( 'Type Search Term &hellip;', 'magazine-hoot' ) );
$searchsubmit = apply_filters( 'maghoot_search_form_submit', __( 'Search', 'magazine-hoot' ) );
$searchquery = get_search_query();

echo '<div class="searchbody">';

	echo '<form method="get" class="searchform" action="' . esc_url( home_url( '/' ) ) . '" >';

		echo '<label class="screen-reader-text">' . esc_html( $searchlabel ) . '</label>';
		echo '<i class="fas fa-search"></i>';
		echo '<input type="text" class="searchtext" name="s" placeholder="' . esc_attr( $searchplaceholder ) . '" value="' . esc_attr( $searchquery ) . '" />';
		echo '<input type="submit" class="submit" name="submit" value="' . esc_attr( $searchsubmit ) . '" /><span class="js-search-placeholder"></span>';

	echo '</form>';

echo '</div><!-- /searchbody -->';