<?php

/*
Plugin Name: Horizontal motion gallery
Plugin URI: http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/
Description: Horizontal motion gallery is a flexible gallery script,The user can direct both the image scrolling direction and speed just by placing the mouse on either side of the image gallery.  
Author: Gopi.R
Version: 7.0
Author URI: http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/
Donate link: http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function my_hmg_show( $dir = "dir1" ) 
{
	$arr = array();
	$arr["dir"] = $dir;
	echo my_hmg_shortcode($arr);
}

function my_hmg_install() 
{
	add_option('my_hmg_dir1', "wp-content/plugins/horizontal-motion-gallery/gallery1/");
	add_option('my_hmg_dir2', "wp-content/plugins/horizontal-motion-gallery/gallery1/");
	add_option('my_hmg_dir3', "wp-content/plugins/horizontal-motion-gallery/gallery1/");
	add_option('my_hmg_dir4', "wp-content/plugins/horizontal-motion-gallery/gallery1/");
	add_option('my_hmg_dir5', "wp-content/plugins/horizontal-motion-gallery/gallery1/");
}

function my_hmg_widget($args) 
{
	$arr = array();
	$arr["dir"] = get_option('my_hmg_dir1');
	echo my_hmg_shortcode($arr);
}

function my_hmg_admin_option() 
{
	echo "<div class='wrap'>";
	echo "<h2>Horizontal motion gallery</h2>"; 
    
	$my_hmg_dir1 = get_option('my_hmg_dir1');
	$my_hmg_dir2 = get_option('my_hmg_dir2');
	$my_hmg_dir3 = get_option('my_hmg_dir3');
	$my_hmg_dir4 = get_option('my_hmg_dir4');
	$my_hmg_dir5 = get_option('my_hmg_dir5');
	
	if (@$_POST['my_hmg_submit']) 
	{
		$my_hmg_dir1 = stripslashes($_POST['my_hmg_dir1']);
		$my_hmg_dir2 = stripslashes($_POST['my_hmg_dir2']);
		$my_hmg_dir3 = stripslashes($_POST['my_hmg_dir3']);
		$my_hmg_dir4 = stripslashes($_POST['my_hmg_dir4']);
		$my_hmg_dir5 = stripslashes($_POST['my_hmg_dir5']);
		
		update_option('my_hmg_dir1', $my_hmg_dir1 );
		update_option('my_hmg_dir2', $my_hmg_dir2 );
		update_option('my_hmg_dir3', $my_hmg_dir3 );
		update_option('my_hmg_dir4', $my_hmg_dir4 );
		update_option('my_hmg_dir5', $my_hmg_dir5 );
	}

	echo '<form name="my_hmg_form" method="post" action="">';
	echo '<p>Directory 1:<br><input  style="width: 650px;" type="text" value="';
	echo $my_hmg_dir1 . '" name="my_hmg_dir1" id="my_hmg_dir1" /></p>';
	echo '<p>Directory 2:<br><input style="width: 650px;" type="text" value="';
	echo $my_hmg_dir2 . '" name="my_hmg_dir2" id="my_hmg_dir2" /></p>';
	echo '<p>Directory 3:<br><input style="width: 650px;" type="text" value="';
	echo $my_hmg_dir3 . '" name="my_hmg_dir3" id="my_hmg_dir3" /></p>';
	echo '<p>Directory 4:<br><input style="width: 650px;" type="text" value="';
	echo $my_hmg_dir4 . '" name="my_hmg_dir4" id="my_hmg_dir4" /></p>';
	echo '<p>Directory 5:<br><input style="width: 650px;" type="text" value="';
	echo $my_hmg_dir5 . '" name="my_hmg_dir5" id="my_hmg_dir5" /></p>';
	echo '<input name="my_hmg_submit" id="my_hmg_submit" class="button-primary" value="Submit" type="submit" />';
	echo '</form>';
	?>
	<br>
	<h2>Plugin configuration</h2>
	<ol>
		<li>Drag and drop the widget</li>
		<li>Add the gallery in the posts and pages</li>
		<li>Add directly in the theme</li>
	</ol>
	Note: Check official website for more information <a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/horizontal-motion-gallery/">click here</a>.<br>
	<?php
	echo "</div>";
}

function my_hmg_deactivation() 
{
	// No action required.
}

function my_hmg_add_to_menu() 
{
	add_options_page('Horizontal motion gallery', 'Horizontal motion gallery', 'manage_options', __FILE__, 'my_hmg_admin_option' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'my_hmg_add_to_menu');
}

function my_hmg_control() 
{
	echo "Horizontal motion gallery";
}

function my_hmg_init()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget('Motion Gallery', 'Motion Gallery', 'my_hmg_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control('Motion Gallery', array('Motion Gallery', 'widgets'), 'my_hmg_control');
	} 
}

add_action("plugins_loaded", "my_hmg_init");
register_activation_hook(__FILE__, 'my_hmg_install');
register_deactivation_hook(__FILE__, 'my_hmg_deactivation');
add_shortcode( 'motion-gallery', 'my_hmg_shortcode' );

function my_hmg_shortcode( $atts ) 
{
	$my_hmg_package = "";
	$$my_hmg_output = "";
	global $my_hmg_scriptinserted;
	
	// [motion-gallery dir="dir1"]
	if ( ! is_array( $atts ) )
	{
		return '';
	}
	$dir =  strtoupper($atts['dir']);
	
	switch ($dir)
	{
		case "DIR1":
			$dir_location = get_option('my_hmg_dir1');
			break;
		case "DIR2":
			$dir_location = get_option('my_hmg_dir2');
			break;
		case "DIR3":
			$dir_location = get_option('my_hmg_dir3');
			break;
		case "DIR4":
			$dir_location = get_option('my_hmg_dir4');
			break;
		case "DIR5":
			$dir_location = get_option('my_hmg_dir5');
			break;
		default:
			$dir_location = "wp-content/plugins/horizontal-motion-gallery/gallery1/";
	}

	$siteurl = get_option('siteurl') . "/";
	$my_hmg_pluginurl = $siteurl . "/wp-content/plugins/horizontal-motion-gallery/";
	if(is_dir($dir_location))
	{
		$f_dirHandle = opendir($dir_location);
		$path = "";
		$vs_count = 0;
		while ($f_file = readdir($f_dirHandle)) 
		{
			$f_file_nocase = $f_file;
			$f_file = strtoupper($f_file);
			if(!is_dir($f_file) && (strpos($f_file, '.JPG')>0 or strpos($f_file, '.GIF')>0 or strpos($f_file, '.PNG')>0)) 
			{
				$path = $siteurl . $dir_location . $f_file_nocase;
				$my_hmg_package = $my_hmg_package . "<a href='#'><img src='$path' border='0' title='' alt=''></a>";
				$vs_count++;
			}
		}
		closedir($f_dirHandle);
		
		if (!isset($ScriptInserted) || $ScriptInserted !== true)
		{
			$ScriptInserted = true;
			$my_hmg_output = $my_hmg_output . '<link rel="stylesheet" type="text/css" href="'.$my_hmg_pluginurl.'motion-gallery-page.css" />';
			$my_hmg_output = $my_hmg_output . '<script type="text/javascript" src="'.$my_hmg_pluginurl.'motion-gallery-page.js"></script>';
		}
		
		$my_hmg_output = $my_hmg_output . '<div id="hmg_motioncontainer_a" style="position:relative;overflow:hidden;">';
			$my_hmg_output = $my_hmg_output . '<div id="hmg_motiongallery" style="position:absolute;left:0;top:0;white-space: nowrap;"> ';
				$my_hmg_output = $my_hmg_output . '<nobr id="hmg_trueContainer">'.$my_hmg_package.'</nobr>';
			$my_hmg_output = $my_hmg_output . '</div>';
		$my_hmg_output = $my_hmg_output . '</div>';
	}
	else
	{
		$my_hmg_output = "Directory not exists (". $dir_location.")";
	}
	
	return $my_hmg_output;
}
?>