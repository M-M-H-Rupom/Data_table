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
    function datatable_search($item){
        $name = strtolower($item['name']);
        if(strpos($name,$_REQUEST['s']) !== false){
            return true;
        }
        return false;
    }
    public function display_datatable(){
        include_once('dataset.php');
        if(isset($_REQUEST['s'])){
            $data = array_filter($data, array($this,'datatable_search'));
        }
        $table = new person_table();
        $table->set_data($data);
        $table->prepare_items();
        ?>
        <div class="wrap">
            <h2> <?php echo 'persons' ?> </h2>
            <form method="GET">
                <?php
                $table->search_box('search','search_id');
                $table->display();
                ?>
                <input type="hidden" name='page' value="<?php echo $_REQUEST['page']; ?>">
            </form>
        </div>
        <?php
    }
}
new Data_table();
?>