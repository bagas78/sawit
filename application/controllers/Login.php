<?php
class Login extends CI_Controller{

  function __construct(){ 
    parent::__construct();
  }  
  function index(){
    $this->load->view('login');
  } 
  function auth(){ 
    $email = $this->input->post('user_email');
    $pass = md5($this->input->post('user_password'));

    $cek = $this->query_builder->login('t_user',$email,$pass);
   
        if (@$cek[0]['user_email']) {  
              $level = $cek[0]['user_level'];

              //akses level kecuali admin
              $akses = $this->query_builder->view_row("SELECT * FROM t_level WHERE level_id = '$level'");
              $this->session->set_userdata('akses',$akses);

              //tampilan
              $this->session->set_userdata('tampilan',$akses['level_tampilan']);              
          
              //ciptakan sesi
              $this->session->set_userdata('name',$cek[0]['user_nama']);
              $this->session->set_userdata('pass',$cek[0]['user_password']);

              if (@$cek[0]['user_foto']) {
                $this->session->set_userdata('foto',$cek[0]['user_foto']);
              } else {
                $this->session->set_userdata('foto','noimage.gif');
              }
              
              $this->session->set_userdata('level',$level);
              $this->session->set_userdata('id',$cek[0]['user_id']);
              $this->session->set_userdata('login','1');
              $this->session->set_userdata('kebun',$cek[0]['user_kebun']);
               
              //update stok
              //$this->stok->all();

              redirect(base_url('dashboard'));
      }
      else{
         $this->session->set_flashdata('gagal','Email / Password salah');
         redirect(base_url('login'));
      }
  }
  function logout(){
    session_destroy();
    redirect(base_url('login')); 
  }
}