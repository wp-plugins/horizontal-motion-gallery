<?php

/*
Plugin Name: Horizontal motion gallery
Plugin URI: http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/
Description: Horizontal motion gallery is a flexible gallery script,The user can direct both the image scrolling direction and speed just by placing the mouse on either side of the image gallery .  
Author: Gopi.R
Version: 2.0
Author URI: http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/
Donate link: http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/
*/

function my_hmg_show() 
{
	$my_hmg_siteurl = get_option('siteurl');
	$my_hmg_pluginurl = $my_hmg_siteurl . "/wp-content/plugins/horizontal-motion-gallery/";

	$my_hmg_file = get_option('my_hmg_file');
	if($my_hmg_file == "")
	{
		$my_hmg_file = "widget.xml";
	}

	$doc = new DOMDocument();
	$doc->load( $my_hmg_pluginurl . 'gallery/'.$my_hmg_file );
	$images = $doc->getElementsByTagName( "image" );
	$vs_count = 0;
	foreach( $images as $image )
	{
	  $paths = $image->getElementsByTagName( "path" );
	  $path = $paths->item(0)->nodeValue;
	  $targets = $image->getElementsByTagName( "target" );
	  $target = $targets->item(0)->nodeValue;
	  $titles = $image->getElementsByTagName( "title" );
	  $title = $titles->item(0)->nodeValue;
	  $links = $image->getElementsByTagName( "link" );
	  $link = $links->item(0)->nodeValue;
	  
	  $my_hmg_package = $my_hmg_package . "<a href='$link' target='$target'><img src='$path' border='0' title='$title' alt='$title'></a>";
	  $vs_count++;
	}
	
	?>
    <link rel="stylesheet" type="text/css" href="<?php echo $my_hmg_pluginurl; ?>motion-gallery.css" />
	<script type="text/javascript" src="<?php echo $my_hmg_pluginurl; ?>motion-gallery.js"></script>
    <div id="hmg_motioncontainer" style="position:relative;overflow:hidden;">
      <div id="hmg_motiongallery" style="position:absolute;left:0;top:0;white-space: nowrap;"> 
      <nobr id="hmg_trueContainer">
        <?php echo $my_hmg_package; ?>
      </nobr> 
      </div>
    </div>
    <?php
}

function my_hmg_install() 
{
	add_option('my_hmg_title', "Slideshow");
	add_option('my_hmg_file', "widget.xml");
}

function my_hmg_widget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	echo get_option('my_hmg_title');
	echo $after_title;
	my_hmg_show();
	echo $after_widget;
}

function my_hmg_admin_option() 
{
	echo "<div class='wrap'>";
	echo "<h2>"; 
	echo wp_specialchars( "Horizontal motion gallery" ) ;
	echo "</h2>";
    
	$my_hmg_title = get_option('my_hmg_title');
	$my_hmg_file = get_option('my_hmg_file');
	
	if ($_POST['my_hmg_submit']) 
	{
		$my_hmg_title = stripslashes($_POST['my_hmg_title']);
		$my_hmg_file = stripslashes($_POST['my_hmg_file']);
		
		update_option('my_hmg_title', $my_hmg_title );
		update_option('my_hmg_file', $my_hmg_file );
	}
	?>
	<form name="my_hmg_form" method="post" action="">
	<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td align="left">
	<?php
	echo '<p>Title:<br><input  style="width: 350px;" maxlength="200" type="text" value="';
	echo $my_hmg_title . '" name="my_hmg_title" id="my_hmg_title" /></p>';
	
	echo '<p>File name:<br><input maxlength="200" style="width: 350px;" type="text" value="';
	echo $my_hmg_file . '" name="my_hmg_file" id="my_hmg_file" />(This XML file is only for below 1st and 2nd condition)</p>';
	
	echo '<input name="my_hmg_submit" id="my_hmg_submit" class="button-primary" value="Submit" type="submit" />';
	?>
	</td><td align="center" valign="middle"> <?php //if (function_exists (timepass)) timepass(); ?> </td></tr></table>
	</form>
    <hr />
	<h2><?php echo wp_specialchars( '1.Drag and drop the widget!' ); ?></h2>
    Go to widget menu and drag and drop the "Horizontal motion gallery" widget to your sidebar location.

    <h2><?php echo wp_specialchars( '2.Paste the below code to your desired template location!' ); ?></h2>
    <div style="padding-top:7px;padding-bottom:7px;">
    <code style="padding:7px;">
    &lt;?php if (function_exists (my_hmg_show)) my_hmg_show(); ?&gt;
    </code></div>
    
    <h2><?php echo wp_specialchars( '3.Paste the below code to your page or post!' ); ?></h2>
    <div style="padding-top:7px;padding-bottom:7px;">
    <code style="padding:7px;">
    [my_hmg=widget.xml]
    </code></div>
    widget.xml = is name of the XML file, it should be available in gallery folder.
    <h2><?php echo wp_specialchars( 'About Plugin' ); ?></h2>
    Plug-in created by <a target="_blank" href='http://www.gopiplus.com/work/'>Gopi</a>. <br> 
    <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/'>click here</a> To post suggestion or comments or feedback. <br> 
    <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/'>click here</a> To see live demo & more info. <br> 
    <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/'>click here</a> To download my other plugins. 
    </p>
	<?php
	echo "</div>";
}

function my_hmg_control()
{
	echo '<p>Horizontal motion gallery.<br> To change the setting goto Horizontal motion gallery link under SETTING tab.';
	echo ' <a href="options-general.php?page=horizontal-motion-gallery/horizontal-motion-gallery.php">';
	echo 'click here</a></p>';
	?>
	<h2><?php echo wp_specialchars( 'About Plugin' ); ?></h2>
    Plug-in created by <a target="_blank" href='http://www.gopiplus.com/work/'>Gopi</a>. <br> 
    <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/'>click here</a> To post suggestion or comments or feedback. <br> 
    <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/'>click here</a> To see live demo & more info. <br> 
    <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/'>click here</a> To download my other plugins.
	<?php
}

function my_hmg_widget_init() 
{
  	register_sidebar_widget(__('Horizontal motion gallery'), 'my_hmg_widget');   
	
	if(function_exists('register_sidebar_widget')) 	
	{
		register_sidebar_widget('Horizontal motion gallery', 'my_hmg_widget');
	}
	
	if(function_exists('register_widget_control')) 	
	{
		register_widget_control(array('Horizontal motion gallery', 'widgets'), 'my_hmg_control');
	} 
}

function my_hmg_deactivation() 
{
	delete_option('my_hmg_title');
	delete_option('my_hmg_file');
}

function my_hmg_add_to_menu() 
{
	add_options_page('Horizontal motion gallery', 'Horizontal motion gallery', 7, __FILE__, 'my_hmg_admin_option' );
}

add_action('admin_menu', 'my_hmg_add_to_menu');
add_action("plugins_loaded", "my_hmg_widget_init");
register_activation_hook(__FILE__, 'my_hmg_install');
register_deactivation_hook(__FILE__, 'my_hmg_deactivation');
add_action('init', 'my_hmg_widget_init');

add_filter('the_content','my_hmg_show_filter');

function my_hmg_show_filter($content){
	return 	preg_replace_callback('/\[my_hmg=(.*?)\]/sim','my_hmg_filter_Callback',$content);
}

function my_hmg_filter_Callback($matches) 
{
	
	$var = $matches[1];
	parse_str($var, $output);
	
	$my_hmg_file = $output['filename'];
	if($my_hmg_file==""){$my_hmg_file = "widget.xml";}
	
	$my_hmg_siteurl = get_option('siteurl');
	$my_hmg_pluginurl = $my_hmg_siteurl . "/wp-content/plugins/horizontal-motion-gallery/";

	$doc = new DOMDocument();
	$doc->load( $my_hmg_pluginurl . 'gallery/'.$my_hmg_file );
	$images = $doc->getElementsByTagName( "image" );
	$vs_count = 0;
	foreach( $images as $image )
	{
	  $paths = $image->getElementsByTagName( "path" );
	  $path = $paths->item(0)->nodeValue;
	  $targets = $image->getElementsByTagName( "target" );
	  $target = $targets->item(0)->nodeValue;
	  $titles = $image->getElementsByTagName( "title" );
	  $title = $titles->item(0)->nodeValue;
	  $links = $image->getElementsByTagName( "link" );
	  $link = $links->item(0)->nodeValue;
	  
	  $my_hmg_package = $my_hmg_package . "<a href='$link' target='$target'><img src='$path' border='0' title='$title' alt='$title'></a>";
	  $vs_count++;
	}
	
    $my_hmg_output = '<link rel="stylesheet" type="text/css" href="'.$my_hmg_pluginurl.'motion-gallery-page.css" />
	<script type="text/javascript" src="'.$my_hmg_pluginurl.'motion-gallery-page.js"></script>
    <div id="hmg_motioncontainer_a" style="position:relative;overflow:hidden;">
      <div id="hmg_motiongallery" style="position:absolute;left:0;top:0;white-space: nowrap;"> 
      <nobr id="hmg_trueContainer">'.$my_hmg_package.'</nobr> 
      </div>
    </div>';
	return $my_hmg_output;
}

?>
