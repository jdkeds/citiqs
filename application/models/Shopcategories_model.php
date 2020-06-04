<?php
    declare(strict_types=1);

    require_once APPPATH . 'interfaces/InterfaceCrud_model.php';
    require_once APPPATH . 'interfaces/InterfaceValidate_model.php';
    require_once APPPATH . 'abstract/AbstractSet_model.php';

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Shopcategories_model extends AbstractSet_model implements InterfaceCrud_model, InterfaceValidate_model
    {
        public $id;
        public $userId;
        public $category;
        public $active;

        private $table = 'tbl_shop_categories';

        protected function setValueType(string $property,  &$value): void
        {
            if ($property === 'id' || $property === 'userId') {
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
            if (isset($data['userId']) && isset($data['category']) && isset($data['active'])) {
                return $this->updateValidate($data);
            }
            return false;
        }

        public function updateValidate(array $data): bool
        {
            if (!count($data)) return false;
            if (isset($data['userId']) && !Validate_data_helper::validateInteger($data['userId'])) return false;
            if (isset($data['category']) && !Validate_data_helper::validateString($data['category'])) return false;
            if (isset($data['active']) && !($data['active'] === '1' || $data['active'] === '0')) return false;
            return true;
        }

        public function fetch(array $where): ?array
        {
            return $this->read(
                [
                    $this->table . '.id AS categoryId',
                    $this->table . '.category',
                    $this->table . '.active'
                ],
                $where,
                [],
                'order_by',
                [$this->table . '.category', 'ASC']
            );
        }

        public function checkIsInserted(array $data): bool
        {
            $count = $this->read(['id'], ['userId=' => $data['userId'],'category=' => $data['category']]);
            return $count ? true : false;
        }
    }
