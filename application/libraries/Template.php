<?php
class Template
{
    protected $_CI;
    function __construct()
    {
        $this->_CI = &get_instance();
    }

    function display($template, $data = null)
    {
        $data['_content'] = $this->_CI->load->view($template, $data, true);
        $data['_header'] = $this->_CI->load->view('theme/header', $data, true);
        $data['_topbar'] = $this->_CI->load->view('theme/topbar', $data, true);
        $data['_sidebar'] = $this->_CI->load->view('theme/sidebar', $data, true);
        $data['_sidebar_info'] = $this->_CI->load->view('theme/sidebar-info', $data, true);
        $data['_footer'] = $this->_CI->load->view('theme/footer', $data, true);

        $this->_CI->load->view('/template.php', $data);
    }
}
