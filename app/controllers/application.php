<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/SVGGraph/SVGGraph'.EXT);

class Application extends CI_Controller {

    public $graph = NULL;
    
    private $settings = array();
    private $values = array();
    private $colours = array();
    private $width;
    private $height;
    private $delimiter = ';';

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
        $post = $this->_set_default_settings();
        //var_dump($post);
        $values = $this->_set_default_values();
        $num = count($values);
        for ($i=0; $i<$num; $i++) {
            $series = $values[$i];
            $_labels = array();
            $_series = array();
            foreach ($series as $key => $value) {
                if ($i == 0) {
                    array_push($_labels, $key);
                }
                array_push($_series, $value);
            }
            if ($i == 0) {
                $post['labels'] = implode($this->delimiter, $_labels); 
            }
            $post['series'][$i] = implode($this->delimiter, $_series);
        }
        
        $colours = $this->_set_default_colours();
        //var_dump($colours);
        $post['colours'] = $colours;
        
        $_graph = $this->_do_graph();
        $response_content = array(
            'graph' => $_graph['graph']
        );
        $response_sidebar = array(
            'post' => $post
        );
        //var_dump($post);
        
        $this->response['extend_js'] = $_graph['graph_js'];
        $this->response['content'] = $this->load->view('graph', $response_content, true);
        $this->response['sidebar'] = $this->load->view('sidebar', $response_sidebar, true);
        $this->load->view('base.php', $this->response);
    }
    
    public function refresh_graph() {
        $settings = $this->_set_default_settings();
        $post = $this->input->post(NULL, TRUE);
        
        $num_fill_under = count($settings['fill_under']);
        
        if (!empty($post['graph_title'])) {
            $settings['graph_title'] = $post['graph_title'];
        }
        
        $keys = array_keys($post);
        foreach ($keys as $key) {
            if (array_key_exists($key, $settings)) {
                $settings[$key] = $post[$key];
            }
        }
        
        $fill_under = array();
        for ($i=0; $i < $num_fill_under; $i++) {
            if (isset($post['fill_under'][$i])) {
                $fill_under[$i] = (bool) $post['fill_under'][$i];
            } else {
                $fill_under[$i] = (bool) '0';
            }
        }
        
        $settings['fill_under'] = $fill_under;
        $settings['labels'] = $post['labels'];
        $settings['series'] = $post['series'];
        $settings['colours'] = $post['colours'];
        
        $this->_set_settings($settings);
        $this->_set_colours($post['colours']);
        $this->_set_values($post['labels'], $post['series']);
        
        $_graph = $this->_do_graph();
        
        $response_content = array(
            'graph' => $_graph['graph']
        );
        
        $response_sidebar = array(
            'post' => $this->_get_settings()
        );
        
        $this->response['extend_js'] = $_graph['graph_js'];
        $this->response['content'] = $this->load->view('graph', $response_content, true);
        $this->response['sidebar'] = $this->load->view('sidebar', $response_sidebar, true);
        $this->load->view('base.php', $this->response);
    }
    
    private function _do_graph() {
        $s = $this->_get_settings();
        $settings = (count($s) > 0) ? $s : $this->_set_default_settings();
        
        $v = $this->_get_values();
        $values = (count($v) > 0) ? $v : $this->_set_default_values();
        
        $c = $this->_get_colours();
        $colours = (count($c) > 0) ? $c : $this->_set_default_colours();
        
        $w = $this->_get_width();
        $width = isset($w) ? $w : $this->_set_default_width();
        
        $h = $this->_get_height();
        $height = isset($h) ? $h : $this->_set_default_height();
        
        $this->graph = new SVGGraph($width, $height, $settings);
		$this->graph->Values($values);
        $this->graph->Colours($colours);
        $graph = $this->graph->Fetch('MultiLineGraph');
        $graph_js = NULL; //$this->graph->FetchJavascript();
        
        return array(
            'graph' => $graph,
            'graph_js' => $graph_js
        );
    }
    
    private function _set_settings($settings=array()) {
        $this->settings = $settings;
    }
    private function _get_settings() {
        return $this->settings;
    }
    
    private function _set_values($labels='', $series=array()) {
        $values = array();
        if (count($labels)>0 && count($series)>0) {
            $keys = explode($this->delimiter, $labels);
            $num = count($keys);
            $x = 0;
            foreach ($series as $string_series) {
                $val = explode($this->delimiter, $string_series);
                $values[$x] = array();
                for ($i=0; $i<$num; $i++) {
                    $values[$x][$keys[$i]] = (!isset($val[$i]))?0:$val[$i];
                }
                $x++;
            }
        }
        $this->values = $values;
    }
    private function _get_values() {
        return $this->values;
    }
    
    private function _set_colours($colours=array()) {
        $this->colours = $colours;
    }
    private function _get_colours() {
        return $this->colours;
    }
    
    private function _set_width($width=NULL) {
        $this->width = $width;
    }
    private function _get_width() {
        return $this->width;
    }
    
    private function _set_height($height=NULL) {
        $this->height = $height;
    }
    private function _get_height() {
        return $this->height;
    }
    
    private function _set_default_settings() {
        $this->settings = array(
            'graph_title' => "Przykładowy wykres liniowy\n2013",
            'graph_title_font' => 'sans-serif',
            'graph_title_font_size' => '17px',
            'graph_title_font_weight' => '700',
            'graph_title_space' => 20,
            'graph_title_colour' => '#d00',
            'graph_title_position' => 'top',
            'legend_title' => 'Legenda',
            'legend_entries' => array('Październik', 'Listopad', 'Grudzień'),
            'legend_position' => 'top right 30 -70',
            'legend_back_colour' => '#d9edf7',
            'legend_round' => 3,
            'stroke_colour' => '#d00',
            'stroke_width' => 0,
            'back_colour' => '#ffd',
            'back_round' => 5,
            'back_stroke_width' => 1,
            'back_stroke_colour' => '#ddd',
            'label_x' => 'Imiona pracowników',
            'label_y' => 'Liczba klientów',
            'axis_colour' => '#555',
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
            'marker_size' => 4,
            'marker_type' => array('circle', 'square', 'triangle'),
            'marker_colour' => array('blue', 'red', 'yellow')
        );
        return $this->settings;
    }
    
    private function _set_default_values() {
        $this->values = array(
            array('Damian' => 30, 'Robert' => 50, 'Małgorzata' => 40, 'Jan' => 25, 'Ewa' => 45, 'Ludmiła' => 0, 'Tadeusz' => 0),
            array('Damian' => 24, 'Robert' => 60, 'Małgorzata' => 30, 'Jan' => 13, 'Ewa' => 35, 'Ludmiła' => 25, 'Tadeusz' => 0),
            array('Damian' => 20, 'Robert' => 30, 'Małgorzata' => 20, 'Jan' => 15, 'Ewa' => 25, 'Ludmiła' => 35, 'Tadeusz' => 48)
        );
        return $this->values;
    }
    
    private function _set_default_colours() {
        $this->colours = array(
            array('#f00', '#ff0'),
            array('#090', '#f90'),
            array('#00f', '#000')
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