<?php

require_once dirname( __FILE__ ) . '/fbloom-core.php';
require_once dirname( __FILE__ ) . '/fbloom-settings.php';


if(!class_exists('Fbloom_Frontend') && class_exists('Fbloom_Settings'))
{

	class Fbloom_Frontend extends Fbloom_Settings
	{
		
		/**
		* Construct the plugin object
		*/
		public function __construct() {
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));			
		}

		/**
		 * Hook into WP admin_init action hook
		 */
		public function admin_init() {
			wp_register_style( 'feedbloom_styles', plugins_url('/feedbloom/templates/css/fbloom-styles.css'));
			$this->init_settings();
		}
		
		/**
		 * Add the menu
		 */	 
		public function add_menu() {
			add_management_page(
					  'feedBloom'
					, 'feedBloom'
					, 'manage_options'
					, 'feedbloom'
					, array(&$this, 'page_main')
				);
			
			add_submenu_page(
					  null
					, 'feedbloom Edit Feed'
					, 'feedBloom Edit Feed'
					, 'manage_options'
					, 'feedbloom-edit'
					, array(&$this, 'page_edit')
				);
				
			add_submenu_page(
					  null
					, 'feedBloom Delete Feed'
					, 'feedBloom Delete Feed'
					, 'manage_options'
					, 'feedbloom-delete'
					, array(&$this, 'page_delete')
				);
				
			add_submenu_page(
					  null
					, 'feedBloom Source XML'
					, 'feedBloom Source XML'
					, 'manage_options'
					, 'feedbloom-source-xml'
					, array(&$this, 'page_source_xml')
				);
		}
		
		/**
		 * Menu Callback
		 */	
		public function page_direct($data = array(), $redirect = 'none') {
			if(!current_user_can('manage_options'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}
			
			if('none' == $redirect) {
				$page = @$_GET['page'];
			} else {
				$page = $redirect;
			}
			
			wp_enqueue_style( 'feedbloom_styles' );
			
			include(sprintf("%s/templates/header-template.php", dirname(__FILE__)));
			
			switch ($page) {
				case 'feedbloom':
					include(sprintf("%s/templates/main-template.php", dirname(__FILE__)));
					break;
				case 'feedbloom-edit':
					include(sprintf("%s/templates/edit-template.php", dirname(__FILE__)));
					break;
				case 'feedbloom-delete':
					include(sprintf("%s/templates/delete-template.php", dirname(__FILE__)));
					break;
				case 'feedbloom-source-xml':
					include(sprintf("%s/templates/source-xml-template.php", dirname(__FILE__)));
					break;
				default:
					include(sprintf("%s/templates/main-template.php", dirname(__FILE__)));
			}
		}
		
		public function page_main() {
			$scrapers = get_option('feedbloom');
			if(!is_array($scrapers)) $scrapers = array();
			$table = '';
			$rows = '';
			foreach ($scrapers as $key => $src) {
				if(!isset($src['scraper_id'])) break;
				$opt = $src['options'];
				$last_update = '';
		
				if (isset($src['last_updated']) && null != @$src['last_updated']) {
					$last_update = @date("M j, Y, g:i a", $src['last_updated']);
				} else {
					$last_update = '';
				}
				
				if ('on' == $opt['active_status']) {
					$status_val = 'fb-active.png';
				} else {
					$status_val = 'fb-inactive.png';
				}
				$status_icon = '<img class="status" src="' . $this->media . $status_val . '" />';
				
				$rows .= '<tr>';
				$rows .= '<td class="status">' . $status_icon . '</td>';
				$rows .= '<td class="name">' . $opt['scraper_name'] . '</td>';
				$rows .= '<td class="updated">' . $last_update . '</td>';
				
				$fb_source_abbr = '';
				$fb_source_abbr_close = '';
				$fb_source_URL = '<a href="" >';
				if(isset($opt['source_URL']) && '' != @$opt['source_URL']) {
					$fb_source_abbr = '<a href="' . $opt['source_URL'] . '" target="_blank"><abbr title="source: ' . url_shorten($opt['source_URL']) . '">';
					$fb_source_abbr_close = '</abbr></a>';
					$fb_source_URL = '<a href="' . $opt['source_URL'] . '" target="_blank">';
				}
				
						// $fb_source_URL .
				$rows .=
					'<td class="info">' .
						$fb_source_abbr . 
							'<img class="fbloom-list-icon" src="' . $this->media . 'tag.png" />' .
						$fb_source_abbr_close .
					'</td>';
				
				$rows .= '
					<td class="info">
						<a href="' . $this->feed_path . $src['scraper_feed_file'] . '.rss" target="_blank">
							<abbr title="view new feed">
								<img class="fbloom-list-icon" src="' . $this->media . 'fb-anchor.png" />
							</abbr>
						</a>
					</td>';
				
				$rows .= '
					<td class="info">
						<a href="tools.php?page=feedbloom-edit&sid=' . $key . '">
							<img class="fbloom-list-icon" src="' . $this->media . 'fb-pencil.png" />
						</a>
					</td>';
				
				$rows .= '</tr>';
			}
			
			$rows .= '
				<tr class="add-new">
					<td class="status">
						<a href="tools.php?page=feedbloom-edit">
							<img src="' . $this->media . 'fb-add-new.png" />
						</a>
					</td>
				</tr>';
			
			if ('' != $rows) {
				$table_header = 
					'<thead>
						<tr>
						<th class="status">Status</th>
						<th class="name">Name</th>
						<th class="updated">Last Update</th>
						<th class="info"></th>
						<th class="info"></th>
						<th class="info"></th>
						</tr>
					</thead>';
				$table = 
					'<table class="fbloom-scraper-list">
					<tbody>' . 
					$table_header . 
					$rows . '
					</tbody>
					</table>';
			}
			
			$data = array('scrapers' => $table);
			$this->page_direct($data);
		}
		
		public function page_edit() {
			if(!current_user_can('manage_options'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}
			
			$this->page_direct();
		}
		
		public function page_delete() {
			if(!current_user_can('manage_options'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}
			
			$this->page_direct();
		}
		
		public function page_source_xml() {
			if(!current_user_can('manage_options'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}
			
			$this->page_direct();
		}
		
		/**
		 * Activate the plugin
		 */
		public static function activate() {
			// Do nothing
		}

		
		/**
		 * Deactivate the plugin
		 */	 
		public static function deactivate() {
			// Do nothing
		}
		
	}

	
	
}


// Register the activation/deactivation hooks & instantiate the frontend class.
if(class_exists('Fbloom_Frontend'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Fbloom_Frontend', 'activate'));
	register_deactivation_hook(__FILE__, array('Fbloom_Frontend', 'deactivate'));
	
	// Instantiate the plugin class
	$fbloom = new Fbloom_Frontend();
	
	// Add a settings link to the plugins page
	if(isset($fbloom))
	{
		add_filter('plugin_action_links', 'feedbloom_plugin_settings_link', 10, 2);
		function feedbloom_plugin_settings_link($links, $file) {
		
			/* Insert the link at the end*/
			$links['settings'] = sprintf( '<a href="%s"> %s </a>', admin_url( 'tools.php?page=feedbloom' ), __( 'Settings', 'plugin_domain' ) );
			return $links;
		}
	}
}