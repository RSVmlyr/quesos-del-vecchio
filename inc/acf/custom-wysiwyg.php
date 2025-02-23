<?php

add_filter( 'acf/fields/wysiwyg/toolbars', function ( $toolbars ) {
	// Register a basic toolbar with a single row of options
	$toolbars['Color bar'][1] = [ 'bold' ];

	return $toolbars;
});  
