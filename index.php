<?php
/**
 * Plugin Name: Data table
 * Author: Rupom
 * Description: Plugin description
 * Version: 1.0
 */
if (!class_exists("WP_List_Table")) {
    require_once(ABSPATH . "wp-admin/includes/class-wp-list-table.php");
}
class Data_table{
    public function __construct() {
        add_action( 'admin_menu', array($this,'datatable_admin_menu') );
    }
    public function datatable_admin_menu(){
        add_menu_page('Data table', 'data table', 'manage_options', 'datatable', array($this,'display_datatable'));
    }
    public function display_datatable(){
        echo "hello";
    }
}
new Data_table();
?>