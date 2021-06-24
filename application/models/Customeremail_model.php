<?php
    declare(strict_types=1);

    require_once APPPATH . 'interfaces/InterfaceCrud_model.php';
    require_once APPPATH . 'interfaces/InterfaceValidate_model.php';
    require_once APPPATH . 'abstract/AbstractSet_model.php';

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Customeremail_model extends AbstractSet_model implements InterfaceCrud_model, InterfaceValidate_model
    {

        public $id;
        public $vendorId;
        public $email;
        public $active;

        private $table = 'tbl_customer_emails';

        protected function setValueType(string $property,  &$value): void
        {
            $this->load->helper('validate_data_helper');
            if (!Validate_data_helper::validateNumber($value)) return;

            if ($property === 'id' || $property === 'vendorId') {
                $value = intval($value);
            }

            return;
        }

        protected function getThisTable(): string
        {
            return $this->table;
        }

        public function insertValidate(array $data): bool
        {
            if (isset($data['vendorId']) && isset($data['email'])) {
                return $this->updateValidate($data);
            }
            return false;
        }

        public function updateValidate(array $data): bool
        {
            if (!count($data)) return false;
            if (isset($data['vendorId']) && !Validate_data_helper::validateInteger($data['vendorId'])) return false;
            if (isset($data['email']) && !Validate_data_helper::validateEmail($data['email'])) return false;            
            if (isset($data['active']) && !($data['active'] === '1' || $data['active'] === '0')) return false;
            return true;
        }

        public function insertEmails(array $data): bool
        {
            $keys = '';
            $allValues = [];

            foreach($data as $insert) {
                if (!$this->insertValidate($insert)) continue;
                if (empty($keys)) $keys = array_keys($insert);

                $values = array_values($insert);
                $escapeValues = array_map(function($value) {
                    return $this->db->escape($value);
                }, $values);
                array_push($allValues, '(' . implode(',', $escapeValues) . ')');;
            }

            if (!$keys || empty($allValues)) return false;

            $query =  '';
            $query  = 'INSERT INTO ' . $this->getThisTable() . ' ';
            $query .= '(' . implode(',' , $keys) . ')  ';
            $query .= 'VALUES ';
            $query .= implode(',', $allValues) ;
            $query .= ' ON DUPLICATE KEY UPDATE email = VALUES(email);';


            return $this->db->query($query);
        }

    }
