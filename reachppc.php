<?php

/*
Plugin Name: ReachPPC Link Unit Plugin
Version: 1.0
Plugin URI: http://www.reachppc.com/
Author: Magic at ReachJunction Media Limited
Author URI: http://www.reachppc.com/
Plugin Description: Use this plugin to quickly and easily insert ReachPPC Link Unit to your posts.
*/

/*
    This program is free software; you can redistribute it
    under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

function wp_reachppc_process($content)
{
	// 356AA0
	$pub_id = get_option('wp_reachppc_id');
	$bg     = get_option('wp_reachppc_bgcolor');
	$link   = get_option('wp_reachppc_linkcolor');
	$border = get_option('wp_reachppc_bordercolor');
	if(get_option('wp_reachppc_pos') == 'top')
	{
		$content = '<script type="text/javascript">
									ppc_pub_id = "'.$pub_id.'";
									ppc_bgcolor = "'.$bg.'";
									ppc_bordercolor = "'.$border.'";
									ppc_linkcolor = "'.$link.'";
									ppc_width = "728";
									ppc_height = "15";
									ppc_font = "Arial";
									</script>
									<script type="text/javascript" src="http://ad.reachppc.com/reachadsLink.js"></script>' . $content;
	}
	else
	{
		$content .= '<script type="text/javascript">
								ppc_pub_id = "'.$pub_id.'";
								ppc_bgcolor = "'.$bg.'";
								ppc_bordercolor = "'.$border.'";
								ppc_linkcolor = "'.$link.'";
								ppc_width = "728";
								ppc_height = "15";
								ppc_font = "Arial";
								</script>
								<script type="text/javascript" src="http://ad.reachppc.com/reachadsLink.js"></script>';
	}
	
  return $content;
}

// Displays Simple Ad Campaign Options menu
function ad_reachppc_option_page() {
    if (function_exists('add_options_page')) {
        add_options_page('ReachPPC Link Unit', 'ReachPPC Link Unit', 8, __FILE__, 'ad_insertion_options_page');
    }
}

function ad_insertion_options_page() {

    if (isset($_POST['info_update']))
    {
        echo '<div id="message" class="updated fade"><p><strong>';

        $tmpCode1 = htmlentities(stripslashes($_POST['wp_reachppc_id']) , ENT_COMPAT);
        update_option('wp_reachppc_id', $tmpCode1);
        
        $tmpCode1 = htmlentities(stripslashes($_POST['wp_reachppc_bgcolor']) , ENT_COMPAT);
        update_option('wp_reachppc_bgcolor', $tmpCode1);
        
        $tmpCode1 = htmlentities(stripslashes($_POST['wp_reachppc_linkcolor']) , ENT_COMPAT);
        update_option('wp_reachppc_linkcolor', $tmpCode1);
        
        $tmpCode1 = htmlentities(stripslashes($_POST['wp_reachppc_bordercolor']) , ENT_COMPAT);
        update_option('wp_reachppc_bordercolor', $tmpCode1);
        
        $tmpCode1 = htmlentities(stripslashes($_POST['wp_reachppc_pos']) , ENT_COMPAT);
        update_option('wp_reachppc_pos', $tmpCode1);

        echo 'Options Updated!';
        echo '</strong></p></div>';
    }

    ?>

    <div class=wrap>

    <h2>ReachPPC Link Unit Options </h2>
</div>
    <p>For information and updates, please visit:<br />
    <a href="http://www.reachppc.com/">http://www.reachppc.com/</a></p>

    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
    <input type="hidden" name="info_update" id="info_update" value="true" />

    <fieldset class="options">
    <legend><strong>Usage</strong></legend>
    <p>Use this plugin to quickly and easily insert ReachPPC Link Unit to your posts.</p>
  	<p>First, sigup at <a href="http://my.reachppc.com/signup.php" target="_blank">ReachPPC</a>.</p>
  	<p>Once you got approve, you will get your unique ID.</p>
    <p>So now you can monetize from your blog. You'll get paid by Paypal, check or WireTransfer.</p>
    </fieldset>
    <p>Please enter your account ID that you signup at ReachPPC.</p>
    <table>    	
    	<tr><td>Your ReachPPC ID: </td><td><input type="text" name="wp_reachppc_id" value=<?php echo get_option('wp_reachppc_id'); ?>></input></td></tr>
    	<tr><td>Background Color(RGB): </td><td><input type="text" name="wp_reachppc_bgcolor" value=<?php if(get_option('wp_reachppc_bgcolor')){ echo get_option('wp_reachppc_bgcolor');}else{ echo 'FFFFFF';} ?>></input></td></tr>
    	<tr><td>Link Color(RGB): </td><td><input type="text" name="wp_reachppc_linkcolor" value=<?php if(get_option('wp_reachppc_linkcolor')){ echo get_option('wp_reachppc_linkcolor');}else{ echo '356AA0';} ?>></input></td></tr>
    	<tr><td>Border Color(RGB): </td><td><input type="text" name="wp_reachppc_bordercolor" value=<?php if(get_option('wp_reachppc_bordercolor')){ echo get_option('wp_reachppc_bordercolor');}else{ echo 'FFFFFF';} ?>></input></td></tr>
    		<tr><td>Position: </td><td><input type="radio" name="wp_reachppc_pos" value="top" <?php if(get_option('wp_reachppc_pos') == 'top' ){ echo 'checked="checked"';}?>>Top</input><input type="radio" name="wp_reachppc_pos" value="bottom" <?php if(get_option('wp_reachppc_pos') == 'bottom' ){ echo 'checked="checked"';}?>>Bottom</input></td></tr>
		</table>
    <div class="submit">
        <input type="submit" name="info_update" value="<?php _e('Save'); ?> &raquo;" />
    </div>

    </form>
    </div>

<?php
}

add_filter('the_content', 'wp_reachppc_process');

add_action('admin_menu', 'ad_reachppc_option_page');

?>
