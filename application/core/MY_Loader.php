<?php
class MY_Loader extends CI_Loader {    
	public function template_adm($template_name, $vars = array(), $return = FALSE)
    {
        //panggil beberapa view ke dalam sebuah function.
        if($return):
        $content  = $this->view('aulakoronka/head', $vars, $return);
		$content  = $this->view('aulakoronka/header', $vars, $return);
		$content  = $this->view('aulakoronka/sidebar', $vars, $return);
        $content .= $this->view('aulakoronka/'.$template_name, $vars, $return);
        $content .= $this->view('aulakoronka/footer', $vars, $return);
		$content .= $this->view('aulakoronka/foot', $vars, $return);

        return $content;
    else:
        $this->view('aulakoronka/head', $vars);
		$this->view('aulakoronka/header', $vars);
		$this->view('aulakoronka/sidebar', $vars);
        $this->view('aulakoronka/'.$template_name, $vars);
        $this->view('aulakoronka/footer', $vars);
		$this->view('aulakoronka/foot', $vars);
    endif;
    }
}

