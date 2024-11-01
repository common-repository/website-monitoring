<?php
/*
Plugin Name: Super Monitoring
Plugin URI: https://www.supermonitoring.com/p/wordpress-plugin
Description: Monitor your blog's uptime with www.supermonitoring.com services - and have all the charts and tables displayed in your WordPress panel. 
Author: SITEIMPULSE
Author URI: https://www.siteimpulse.com/
Text Domain: website-monitoring
Domain Path: /languages
Version: 2.97
*/

if ( !defined( 'WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( !defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( !defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( !defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

    load_plugin_textdomain( 'website-monitoring', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	function adminMenu()
	{
	    	$data = get_option("monitoringst");
		
		$api = __('https://www.supermonitoring.com/API/','website-monitoring');

		add_options_page( "Super Monitoring", "Super Monitoring", 8, __FILE__, "settingsPage" );

		if ( $data["token"] != '' ) {

	        add_menu_page('Super Monitoring', 'Super Monitoring', 10, 'msmenu',"msservicesPage", 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1OTUiIGhlaWdodD0iODQyIiB2aWV3Qm94PSIwIDAgNTk1LjMgODQxLjkiIGNsYXNzPSJ1bmRlZmluZWQiPjxzdHlsZT4uYXtmaWxsOiNGRkY7fTwvc3R5bGU+PHBhdGggZD0iTTUzMy42IDI1MS43Yy0xOS4xLTIyLjItNjIuMS0zMC45LTEwNi41LTM2LjggLTQ0LjQtNS45LTcxLjgtOC4zLTEyOS43LTguMyAtNTcuOCAwLTg1LjIgMi40LTEyOS43IDguMyAtNDQuNCA1LjktODcuNSAxNC42LTEwNi41IDM2LjggLTE4LjcgMjEuOC0zNy40IDg5LjUtMzYuNSAxNDYuN2wwLjggMjEuOGMyLjUgNTEuNiA5LjEgMTAxLjIgMTkuNCAxMjkuMiAxMS41IDMxLjIgMzEuMiA1Mi4xIDYxLjMgNjEuMiA0MS44IDEyLjcgODguOSAxOCAxMTEuNSAyMC40IDIyLjUgMi40IDU2LjMgNS4yIDc5LjcgNS4yIDIzLjQgMCA1Ny4xLTIuOCA3OS43LTUuMiAyMi41LTIuNCA2OS43LTcuNyAxMTEuNS0yMC40IDMwLjEtOS4xIDQ5LjktMjkuOSA2MS4zLTYxLjIgMTAuNC0yOC40IDE3LjEtNzkuMSAxOS41LTEzMS43bDAuNy0yMS44QzU3MC40IDMzOS4zIDU1MiAyNzMuMiA1MzMuNiAyNTEuN3pNMjk4LjEgNTY2LjljLTE2LjUgMC0yOS45LTEzLjQtMjkuOS0yOS45czEzLjQtMjkuOCAyOS45LTI5LjhjMTYuNSAwIDI5LjkgMTMuNCAyOS45IDI5LjhTMzE0LjYgNTY2LjkgMjk4LjEgNTY2Ljl6TTMwOS43IDQ3OWgtMjIuNWMtMC40LTcuMy0xOC41LTEzMy4yLTE4LjUtMTc2LjYgMC04LjIgMy4zLTE1LjcgOC43LTIxLjEgNS40LTUuNCAxMi45LTguNyAyMS4xLTguNyA4LjIgMCAxNS43IDMuMyAyMS4xIDguOCA1LjQgNS40IDguNyAxMi45IDguNyAyMS4xQzMyOC4zIDM0NS42IDMwOS41IDQ3Mi44IDMwOS43IDQ3OXoiIGNsYXNzPSJhIi8+PC9zdmc+' );
	        add_submenu_page( 'msmenu', 'Super Monitoring', __('Your Checks','website-monitoring'), 'administrator', 'msmenu', "msservicesPage" );
	        add_submenu_page( 'msmenu', 'Super Monitoring', __('Your Account','website-monitoring'), 'administrator', 'msmenu1', "mssettingPage" );
		add_submenu_page( 'msmenu', 'Super Monitoring', __('Your Contacts','website-monitoring'), 'administrator', 'msmenu2', "mscontactsPage" );

        }

	}

	function activate()
	{
		$data = array( "token" => "");
		if( !get_option("monitoringst") ) {
			add_option( "monitoringst", $data );
		} else {
			update_option( "monitoringst", $data );
		}
	}

	function deactivate() {
		delete_option( "monitoringst" );
	}

	function mscontactsPage () {
		
		$data = get_option("monitoringst");
		
		echo "<iframe id=\"frame\" width=\"100%\" frameborder=\"0\" src=\"https://" . __('www.supermonitoring.com','website-monitoring') . "/index.php?wp_token=$data[token]&s=contacts\"></iframe>";
        ?>
		<script type="text/javascript">
		function resizeIframe() {
		    var height = document.documentElement.clientHeight;
		    height -= document.getElementById('frame').offsetTop;

		    // not sure how to get this dynamically
		    height -= 20; /* whatever you set your body bottom margin/padding to be */

		    document.getElementById('frame').style.height = height +"px";

		};
		document.getElementById('frame').onload = resizeIframe;
		window.onresize = resizeIframe;
		</script>
        <?
	}

	function msservicesPage () {
		
		$data = get_option("monitoringst");
		
		echo "<iframe id=\"frame\" width=\"100%\" frameborder=\"0\" src=\"https://" . __('www.supermonitoring.com','website-monitoring') . "/index.php?wp_token=$data[token]\"></iframe>";
        ?>
		<script type="text/javascript">
		function resizeIframe() {
		    var height = document.documentElement.clientHeight;
		    height -= document.getElementById('frame').offsetTop;

		    // not sure how to get this dynamically
		    height -= 20; /* whatever you set your body bottom margin/padding to be */

		    document.getElementById('frame').style.height = height +"px";

		};
		document.getElementById('frame').onload = resizeIframe;
		window.onresize = resizeIframe;
		</script>
        <?	}
	
	function mssettingPage () {

		$data = get_option("monitoringst");

		echo "<iframe id=\"frame\" width=\"100%\" frameborder=\"0\" src=\"https://" . __('www.supermonitoring.com','website-monitoring') . "/index.php?wp_token=$data[token]&s=settings\"></iframe>";
        ?>
		<script type="text/javascript">
		function resizeIframe() {
		    var height = document.documentElement.clientHeight;
		    height -= document.getElementById('frame').offsetTop;

		    // not sure how to get this dynamically
		    height -= 20; /* whatever you set your body bottom margin/padding to be */

		    document.getElementById('frame').style.height = height +"px";

		};
		document.getElementById('frame').onload = resizeIframe;
		window.onresize = resizeIframe;
		</script>
        <?
	}

    function getApiResponse ( $token )
    {
	$api = __('https://www.supermonitoring.com/API/','website-monitoring');

        $curl = curl_init();
        curl_setopt ( $curl, CURLOPT_URL,$api );
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ( $curl, CURLOPT_POST, true );
        $string = 'f=wp_token&token=' . $token;
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $string);
        $result = curl_exec ( $curl );
        curl_close ( $curl );

	return $result;


    }

	function settingsPage()
	{

		$data = get_option("monitoringst");
		
		if (isset($_POST["monitoringst-submit"]))
		{

			$isCorrect = getApiResponse ( $_POST["monitoringst-token"] );
			if ( $isCorrect == '0' ) {
			        echo "<div id='ws-warning' class='error'><p>" . __('Invalid token. You can obtain your token in your Account Settings at <a href=\"https://www.supermonitoring.com/\" target=\"_blank\">www.supermonitoring.com</a>.','website-monitoring') . "</p></div>";
			} else {

				list ( $return, $link ) = explode ( '|', $isCorrect );
				echo "<div id='ws-warning' class='updated fade'><p>" . __('Changes have been saved.','website-monitoring') . "</p></div>";
					    $data["token"] = attribute_escape( $_POST["monitoringst-token"] );
					    if ( isset( $_POST["monitoringst-language"] ) ) {
						    $data["language"] = attribute_escape( $_POST["monitoringst-language"] );
					    }
					    if ( isset( $_POST["monitoringst-version"] ) ) {
						    $data["version"] = attribute_escape( $_POST["monitoringst-version"] );
					    }
					    $data["link"] = $link;
					    update_option( "monitoringst", $data );					    

			}

		} else {
			$data = get_option( "monitoringst" );

		}


	?>
	<div class="wrap">
		<h2><?php _e( 'Super Monitoring - plugin settings', 'website-monitoring' ); ?></h2>
		<p><?php _e( 'If you already have a subscription at www.supermonitoring.com, enter your token to integrate the service with WordPress panel.', 'website-monitoring' ); ?></p>
		<form method="post">

		<table class="form-table">
		<tbody>
		<tr valign="top">
		<th scope="row"><label for="monitoringst-token"><?php echo _e( 'Authorization token:', 'website-monitoring' ); ?></label></th>
		<td><input type="text" name="monitoringst-token" class="regular-text code" value="<?php echo $data["token"]; ?>" />
		<p class="description"><?php _e( 'You can find the token in your Account Settings at <a href="https://www.supermonitoring.com/" target="_blank">www.supermonitoring.com</a>.', 'website-monitoring' ); ?></p></td>
		</tr>
		</tbody></table>

		<p class="submit"><input type="submit" value="<?php _e( 'Save changes', 'website-monitoring' ); ?>" class="button button-primary" name="monitoringst-submit"></p>
		
		</form>

		<div style="float: left; background-color: white; padding: 10px; margin-right: 15px; border: 1px solid rgb(221, 221, 221);max-width: 700px;">
		<?php _e( 'If you don`t have an account at www.supermonitoring.com yet, <a href="https://www.supermonitoring.com/landing/page1/?utm_source=WordPress&utm_medium=text&utm_campaign=plugin" target="_blank"><strong>sign up here</strong></a> for a 14-day free trial.', 'website-monitoring' ); ?>
		</div>

	<?php

	}

	function preparation_message () {		$data = get_option("monitoringst");
		if ( $data['token'] == '' )
		echo "<div id='ws-warning' class='updated fade'><p>" . __('<strong>Super Monitoring</strong> plugin is almost ready. You only need to','website-monitoring') . " <a href=\"" . admin_url() . "options-general.php?page=website-monitoring%2Fsupermonitoring.php\">" . __('configure it','website-monitoring') . "</a>.</p></div>";
		
	}

add_action( "admin_menu", "adminMenu" );
add_action('admin_notices', 'preparation_message');
register_activation_hook( __FILE__, "activate" );
register_deactivation_hook( __FILE__, "deactivate" );

?>