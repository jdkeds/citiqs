<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_tbl_shop_vendor_times extends CI_Migration {

	public function up()
	{
        $this->load->config('custom');
        $query = 
            "
            CREATE TABLE IF NOT EXISTS tbl_shop_vendor_times (
                id          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
                vendorId    INT UNSIGNED    NOT NULL,
                day         ENUM('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun') NOT NULL,
                timeFrom    TIME            NOT NULL DEFAULT '00:00:00',
                timeTo      TIME            NOT NULL DEFAULT '23:59:59',
                PRIMARY KEY(id),
                FOREIGN KEY(vendorId) REFERENCES tbl_user(id)
            );
            ";
        $this->db->query($query);

        $days = $this->config->item('weekDays');

        foreach ($days as $day) {
            $query = "INSERT INTO `tbl_shop_vendor_times` (vendorId, day) SELECT vendorId, '{$day}' FROM tbl_shop_vendors WHERE tbl_shop_vendors.id > 0";
            $this->db->query($query);
        }
    
        

       
	}

	public function down()
	{
        $query = 'DROP TABLE tbl_shop_vendor_times;';
        $this->db->query($query);
		
	}
}




