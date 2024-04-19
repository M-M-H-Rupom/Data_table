<?php
if (!class_exists("WP_List_Table")) {
    require_once(ABSPATH . "wp-admin/includes/class-wp-list-table.php");
}
class person_table extends WP_List_Table{
    // function __construct($args = array()){
    //     parent::__construct($args);
    // }
    function set_data($data){
        $this->items = $data;
    }
    function get_columns(){
        return [
            'cb'=> '<input type="checkbox">',
            'name' => "Name",
            'gmail' => "Gmail",
            'address'=> "Address",
        ];
    }
    function column_cb($item){
        return "<input type='checkbox' value='{$item['id']}'>";
    }
    function column_name($item){
        return "<strong>{$item['name']}<strong>";
    }
    function column_address($item){
        return "<em>{$item['address']}<em>";
    }
    function column_default($item, $column_name){
        return $item[$column_name];
    }
    function prepare_items(){
        $this->_column_headers = array($this->get_columns());
    }
}
?>