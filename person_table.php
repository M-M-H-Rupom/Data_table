<?php
if (!class_exists("WP_List_Table")) {
    require_once(ABSPATH . "wp-admin/includes/class-wp-list-table.php");
}
class person_table extends WP_List_Table{
    // function __construct($args = array()){
    //     parent::__construct($args);
    // }
    private $_items;
    function set_data($data){
        $this->_items = $data;
    }
    function get_columns(){
        return [
            'cb'=> '<input type="checkbox">',
            'name' => "Name",
            'gmail' => "Gmail",
            'address'=> "Address",
            'gender' => 'Gender'
        ];
    }
    function extra_tablenav($which){
        $selected_male = '';
        $selected_female = '';
            if(($_REQUEST['filter_s'] == 'male')){
                $selected_male = 'selected';
            }elseif($_REQUEST['filter_s'] == 'female'){
              $selected_female = 'selected';  
            }
        
        if('top' == $which):
        ?>
        <div class="actions">
            <select name="filter_s" id="filter_s">
                <option value="all">All</option>
                <option value="male" <?php echo $selected_male ?> >Male</option>
                <option value="female" <?php echo $selected_female ?> >feMale</option>
            </select>
            <?php
            submit_button('filter', 'primary','submit',false);
            ?>
        </div>
        <?php
        endif;
    }
    function get_sortable_columns(){
        return [
            'name' => ['name',true],
            'gmail' => ['gmail',true],
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
    function prepare_items(){
        $paged = $_REQUEST['paged']?? 1;
        $this->_column_headers = array($this->get_columns(),array(),$this->get_sortable_columns());
        $data_chunks = array_chunk($this->_items,2);
        $this->items = $data_chunks[$paged -1];
        $this->set_pagination_args([
            'total_items' => count($this->_items),
            'per_page' => 2,
            'total_pages' => ceil(count($this->_items) / 2)
        ]);
    }
    function column_default($item, $column_name){
        return $item[$column_name];
    }
}
?>