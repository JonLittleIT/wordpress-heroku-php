<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
if( function_exists( 'woohoo_get_all_images_size' ) )
{
	function woohoo_get_all_images_size()
	{
		?>
		<select>
			<option value="">- Select Image Size -</option>
			<?php
			$woohoo_giis = get_intermediate_image_sizes();
			foreach( $woohoo_giis as $key => $value ):
				echo '<option value="'.$key.'">'.$value.'</option>';
			endforeach;
			?>
		</select>
		<?php
	}
}
