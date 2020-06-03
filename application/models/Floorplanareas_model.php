<?php
    declare(strict_types=1);

    require_once APPPATH . 'interfaces/InterfaceCrud_model.php';
    require_once APPPATH . 'abstract/AbstractSet_model.php';

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Floorplanareas_model extends AbstractSet_model implements InterfaceCrud_model
    {
        public $id;
        public $floorplanID;
        public $area_id;
        public $occupied_color;
        public $free_color;
        public $unavailable_color;
        public $label_color;
        public $area_label;
        public $area_count;
        public $price;
        public $available;

        private $table = 'tbl_floorplan_areas';

        protected function setValueType(string $property,  &$value): void
        {
            if (
                $property === 'id'
                || $property === 'floorplanID'
                || $property === 'area_id'
                || $property === 'area_count'
            ) {
                $value = intval($value);
            }
            return;
        }

        protected function getThisTable(): string
        {
            return $this->table;
        }

        public function get_floorplan_areas($floor_plan_id)
        {
            $this->db->where('floorplanID', $floor_plan_id);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function remove_floorplan_areas ($floor_plan_id, $ids) {
            $this->db->where('floorplanID', $floor_plan_id);
            $this->db->where_in('id', $ids);
            $this->db->delete($this->table);
            var_dump($this->db->last_query());
            return $this->db->affected_rows();
        }
    }