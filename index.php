<?php
/**
 * Plugin Name: Data table
 * Author: Rupom
 * Description: Plugin description
 * Version: 1.0
 */
require_once('person_table.php');
class Data_table{
    public function __construct() {
        add_action( 'admin_menu', array($this,'datatable_admin_menu') );
    }
    public function datatable_admin_menu(){
        add_menu_page('Data table', 'data table', 'manage_options', 'datatable', array($this,'display_datatable'));
    }
    public function display_datatable(){
        include_once('dataset.php');
        $table = new person_table();
        $table->set_data($data);
        $table->prepare_items();
        $table->search_box('search','search_id');
        $table->display();
    }
}
new Data_table();
?>