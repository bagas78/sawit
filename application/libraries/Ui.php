<?php 

class Ui {
  protected $url;

  function __construct(){
        $this->url = &get_instance();
    }

    function view($url) {

      //tampilan
      $tampilan = $this->url->session->userdata('tampilan');
      switch ($tampilan) {
        case $tampilan == 'desktop':
          $ui = $url;
          break;
        
        case $tampilan == 'tablet':
          $ui = $url.'_mobile';
          break;
      }

      return $ui;
    }
}