<?php
/* BOXED PAGE BACKGROUN */
?>
html body{
	background-image: url(<?php echo esc_attr($page_bg_image)?>);
	background-attachment: fixed;
    padding: 100px 0;
    background-size: cover;
}
html .layout.layout-page-boxed {
	box-shadow: 0 0 40px 5px rgba(0,0,0,0.8);
}