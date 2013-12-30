<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/SVGGraph/SVGGraph'.EXT);

class Application extends CI_Controller {

    public $graph = NULL;

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

        $settings = array(
            'back_colour'       => '#eee',      'stroke_colour'      => '#000',
            'back_stroke_width' => 0,           'back_stroke_colour' => '#eee',
            'axis_colour'       => '#333',      'axis_overlap'       => 2,
            'axis_font'         => 'Arial',     'axis_font_size'     => 10,
            'grid_colour'       => '#666',      'label_colour'       => '#000',
            'pad_right'         => 20,          'pad_left'           => 20,
            'link_base'         => '/',         'link_target'        => '_top',
            'fill_under'        => array(true, false),
            'marker_size'       => 3,
            'marker_type'       => array('circle', 'square', 'triangle'),
            'marker_colour'     => array('blue', 'red', 'yellow')
        );
        $values = array(
            array('Dough' => 30, 'Ray' => 50, 'Me' => 40, 'So' => 25, 'Far' => 45, 'Lard' => 35),
            array('Dough' => 20, 'Ray' => 30, 'Me' => 20, 'So' => 15, 'Far' => 25, 'Lard' => 35, 'Tea' => 45),
            array('Dough' => 24, 'Ray' => 60, 'Me' => 30, 'So' => 13, 'Far' => 35, 'Lard' => 55, 'Tea' => 48)
        );
        $colours = array(
            array('red', 'yellow'),
            array('blue', 'white'),
            array('green', 'orange')
        );
        
        $this->graph = new SVGGraph(600, 400, $settings);
		$this->graph->Values($values);
        $this->graph->Colours($colours);
        
        $response_content = array(
            'graph' => $this->graph->Fetch('MultiLineGraph', false)
        );
        $this->response['extend_js'] = $this->graph->FetchJavascript();
        $this->response['content'] = $this->load->view('graph', $response_content, true);
        $this->response['sidebar'] = $this->load->view('sidebar', array(), true);
        $this->load->view('base.php', $this->response);
    }

}

/* End of file application.php */
/* Location: ./app/controllers/application.php */