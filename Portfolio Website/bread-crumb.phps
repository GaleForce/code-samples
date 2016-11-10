<?php
/*
 *@class BreadCrumbs
 *
 *@use Used to create breadcrumb links based off the uri request.
 *
 *@param $base_uri (string) URI of root breadcrumb
 *@param $base_title (string optional) title to use for base URI
 */

CLASS BreadCrumbs {

	public $crumbs_arr = array();
	
	public function __construct($root, $root_title = 'Home')
	{
		$this->root = rtrim($root, '/');
		$this->root_title = $root_title;
		$this->set_home_dir();
		unset ($this->crumbs_arr);
		$this->make_crumbs();
	}
	
	public function set_home_dir()
	{
		$this->home_dir = preg_replace('/.*?[^\/](\/[^\/].*)/', '$1', $this->root);
	}
	
	public function format_crumb_text($text = '')
	{
		$text = preg_replace('/\//', '', $text);
		return ucwords(strtolower(preg_replace('/-/', ' ', $text)));
	}

	public function make_crumbs() {
		$req = $_SERVER['PHP_SELF'];
		$req = preg_replace('/'.preg_quote($this->home_dir, '/').'/', '', $req);
		$c_arr = array();
		$args = array(
				'class' => 'breadcrumb'
			);
		
		$num_loops = 0;
		if (preg_match('/\//', $req)) {
			while ('/' != $req && $num_loops < 10) {
				$num_loops++;
				$text = preg_replace('/.+\/([^\/]+)\/?/', '$1', $req);
				if ($_SERVER['PHP_SELF'] == $this->home_dir.$req) {
					if ('index.php' !== $text) {
						$text = preg_replace('/(.*)\..*/', '$1', $text);
					} else {
						$text = '';
					}
				}
				if ('' != $text) {
					$c_arr[] = $this->get_html_link_code(
													$this->format_crumb_text($text),
													$this->root.$req,
													$args);
				}
				$req = preg_replace('/(.*\/)[^\s]+\/?/', '$1', $req);
			}
		}
		$c_arr[] = $this->get_html_link_code($this->root_title, $this->root, $args);
		$this->crumbs_arr = array_reverse($c_arr);
		// var_dump($this->crumbs_arr);
	}
	
	public function get_crumbs($as_list = FALSE, $args = array())
	{
		$default = array(
					'delim'		 => ' > ',
					'list_id' 	 => '',
					'list_class' => '',
					'item_class' => '',
				);
		$args = array_intersect_key($args, $default) + array_diff_key($default, $args);
		extract($args);
		unset ($args);
		if(TRUE === $as_list) {
			$ul    = "<ul id=\"{$list_id}\" class=\"{$list_class}\">";
			$ulc   = '</ul>';
			$li    = "<li class=\"{$item_class}\">";
			$lic   = '</li>';
			$delim = '';
		} else {
			$ul  = '';
			$ulc = '';
			$li  = '';
			$lic = '';
		}
		
		echo $ul;
		$ct = count($this->crumbs_arr);
		foreach ($this->crumbs_arr as $k => $v) {
			echo $li,$v,$lic;
			if ($ct != $k + 1) {
				echo $delim;
			}
		}
		echo $ulc;
	}
	
	public function get_html_link_code($content = 'link', $url = '', $args = array())
	{
		$default = array(
					'id' 	 => '',
					'class'  => '',
					'target' => '',
					'rel' 	 => '',
					'type' 	 => ''
				);
		$args = array_intersect_key($args, $default) + array_diff_key($default, $args);
		
		$atts = 'href="'.$url.'"';
		
		foreach ($args as $k => $v) {
			if ('' != $v) { $atts .= " {$k}=\"{$v}\""; }
		}
		
		return "<a {$atts}>{$content}</a>";
	}
}