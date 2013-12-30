<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Linegraph {
	
	var $graph;
	
	public function __construct($config = array()) {
		if (count($config) > 0) {
			require_once(APPPATH.'libraries/SVGGraph/SVGGraph'.EXT);
			
			$width = (isset($config['w'])) ? $config['w'] : 400;
			$height = (isset($config['h'])) ? $config['h'] : 200;
			$settings = (isset($config['s'])) ? $config['s'] : array();
			
			$this->graph = new SVGGraph($width, $height, $settings);
			$this->graph->Fetch('LineGraph', false);
		}
	}
	
	public function set_values($values) {
		$this->graph->Values($values);
	}
	
	public function set_colours($colours) {
		$this->graph->Colours($colours);
	}
	
	public function print_graph() {
		return $this->graph->Fetch('LineGraph', false);
	}

}