<?php
    declare(strict_types=1);

    require_once APPPATH . 'interfaces/InterfaceCrud_model.php';
    require_once APPPATH . 'interfaces/InterfaceValidate_model.php';
    require_once APPPATH . 'abstract/AbstractSet_model.php';

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Shopproduct_model extends AbstractSet_model implements InterfaceCrud_model, InterfaceValidate_model
    {
        public $id;
        public $categoryId;
        public $stock;
        public $recommendedQuantity;
        public $active;
        public $showImage;
        public $dateTimeFrom;
        public $dateTimeTo;
        public $productTypeId;
        private $table = 'tbl_shop_products';

        protected function setValueType(string $property,  &$value): void
        {
            if (
                $property === 'id'
                || $property === 'categoryId'
                || $property === 'stock'
                || $property === 'recommendedQuantity'
                || $property === 'productTypeId'
            ) {
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
            if (
                isset($data['categoryId']) 
                && isset($data['productTypeId']) 
                // && isset($data['recommendedQuantity']) 
                && isset($data['active'])
            ) {
                return $this->updateValidate($data);
            }
            return false;
        }

        public function updateValidate(array $data): bool
        {
            if (!count($data)) return false;
            if (isset($data['categoryId']) && !Validate_data_helper::validateInteger($data['categoryId'])) return false;
            if (isset($data['stock']) && !Validate_data_helper::validateInteger($data['stock'])) return false;
            if (isset($data['recommendedQuantity']) && !Validate_data_helper::validateInteger($data['recommendedQuantity'])) return false;
            if (isset($data['active']) && !($data['active'] === '1' || $data['active'] === '0')) return false;
            if (isset($data['showImage']) && !($data['showImage'] === '1' || $data['showImage'] === '0')) return false;
            if (isset($data['dateTimeFrom']) && !Validate_data_helper::validateDate($data['dateTimeFrom'])) return false;
            if (isset($data['dateTimeTo']) && !Validate_data_helper::validateDate($data['dateTimeTo'])) return false;
            if (isset($data['productTypeId']) && !Validate_data_helper::validateInteger($data['productTypeId'])) return false;
            return true;
        }

        public function getUserProducts(int $userId): ?array
        {
            return
                $this->read(
                    [
                        $this->table. '.id AS productId',
                    ],
                    ['tbl_shop_categories.userId=' => $userId],
                    [
                        ['tbl_shop_categories', $this->table.'.categoryId = tbl_shop_categories.id', 'LEFT'],
                    ]
                );
        }
    }
