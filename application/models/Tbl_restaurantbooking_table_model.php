<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Tbl_restaurantbooking_table_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tbl_restaurantbooking_table by id
     */
    function get_tbl_restaurantbooking_table($id)
    {
        return $this->db->get_where('tbl_restaurantbooking_tables',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all tbl_restaurantbooking_tables
     */
    function get_all_tbl_restaurantbooking_tables()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('tbl_restaurantbooking_tables')->result_array();
    }
        
    /*
     * function to add new tbl_restaurantbooking_table
     */
    function add_tbl_restaurantbooking_table($params)
    {
        $this->db->insert('tbl_restaurantbooking_tables',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tbl_restaurantbooking_table
     */
    function update_tbl_restaurantbooking_table($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('tbl_restaurantbooking_tables',$params);
    }
    
    /*
     * function to delete tbl_restaurantbooking_table
     */
    function delete_tbl_restaurantbooking_table($id)
    {
        return $this->db->delete('tbl_restaurantbooking_tables',array('id'=>$id));
    }
}
