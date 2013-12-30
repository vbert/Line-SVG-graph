<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/SVGGraph/SVGGraph'.EXT);

class Application extends CI_Controller {

    public $graph = NULL;
    
    private $settings = array();
    private $values = array();
    private $colours = array();
    private $width;
    private $height;

    public function __construct() {
        parent::__construct();
        
        $this->response = array();
        $this->response['page_title'] = $this->config->item('app_name');
        $this->response['page_description'] = $this->config->item('app_description');
        $this->response['page_author'] = $this->config->item('app_author');
        $this->response['extend_js'] = '';
        $this->response['content'] = '';
        $this->response['sidebar'] = '';
    }
    
    public function index() {
        $_graph = $this->_do_graph();
        
        $response_content = array(
            'graph' => $_graph['graph']
        );
        
        $response_sidebar = array();
        
        $this->response['extend_js'] = $_graph['graph_js'];
        $this->response['content'] = $this->load->view('graph', $response_content, true);
        $this->response['sidebar'] = $this->load->view('sidebar', $response_sidebar, true);
        $this->load->view('base.php', $this->response);
    }
    
    private function _do_graph() {
        $settings = (count($this->settings) > 0) ? $this->settings : $this->_set_default_settings();
        $values = (count($this->values) > 0) ? $this->values : $this->_set_default_values();
        $colours = (count($this->colours) > 0) ? $this->colours : $this->_set_default_colours();
        $width = isset($this->width) ? $this->width : $this->_set_default_width();
        $height = isset($this->height) ? $this->height : $this->_set_default_height();
        
        $this->graph = new SVGGraph($width, $height, $settings);
		$this->graph->Values($values);
        $this->graph->Colours($colours);
        $graph = $this->graph->Fetch('MultiLineGraph', false);
        $graph_js = $this->graph->FetchJavascript();
        
        return array(
            'graph' => $graph,
            'graph_js' => $graph_js
        );
    }
    
    private function _set_default_settings() {
        $this->settings = array(
            'graph_title' => "Przykładowy wykres liniowy\nGrudzień 2013",
            'graph_title_font' => 'sans-serif',
            'graph_title_font_size' => '17px',
            'graph_title_font_weight' => '700',
            'graph_title_space' => 20,
            'graph_title_colour' => '#d00',
            'graph_title_position' => 'top',
            'back_colour' => '#eee',
            'stroke_colour' => '#000',
            'back_stroke_width' => 0,
            'back_stroke_colour' => '#eee',
            'label_x' => 'Imiona pracowników',
            'label_y' => 'Liczba klientów',
            'axis_colour' => '#333',
            'axis_overlap' => 2,
            'axis_font' => 'Arial',
            'axis_font_size' => 10,
            'grid_colour' => '#666',
            'label_colour' => '#000',
            'pad_right' => 20,
            'pad_left' => 20,
            'link_base' => '/',
            'link_target' => '_top',
            'fill_under' => array(true, true, true),
            'marker_size' => 3,
            'marker_type' => array('circle', 'square', 'triangle'),
            'marker_colour' => array('blue', 'red', 'yellow')
        );
        return $this->settings;
    }
    
    private function _set_default_values() {
        $this->values = array(
            array('Damian' => 30, 'Robert' => 50, 'Małgorzata' => 40, 'Jan' => 25, 'Ewa' => 45),
            array('Damian' => 24, 'Robert' => 60, 'Małgorzata' => 30, 'Jan' => 13, 'Ewa' => 35, 'Ludmiła' => 25, 'Tadeusz' => 48),
            array('Damian' => 20, 'Robert' => 30, 'Małgorzata' => 20, 'Jan' => 15, 'Ewa' => 25, 'Ludmiła' => 35)
        );
        return $this->values;
    }
    
    private function _set_default_colours() {
        $this->colours = array(
            array('red', 'yellow'),
            array('green', 'orange'),
            array('blue', 'gray')
        );
        return $this->colours;
    }
    
    private function _set_default_width() {
        $this->width = 600;
        return $this->width;
    }
    
    private function _set_default_height() {
        $this->height = 400;
        return $this->height;
    }
}

/* End of file application.php */
/* Location: ./app/controllers/application.php */