<?php
    declare(strict_types=1);

    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Utility_helper
    {
        public static function shuffleString(int $range): string
        {
            $set = '3456789abcdefghjkmnpqrstvwxyABCDEFGHJKMNPQRSTVWXY';
            return substr(str_shuffle($set), 0, $range);
        }

        public static function shuffleStringSmallCaps(int $range): string
        {
            $set = '3456789abcdefghjkmnpqrstvwxy';
            return substr(str_shuffle($set), 0, $range);
        }

        public static function shuffleBigStringRandom(int $range): string
        {
            $set = '123456789abcdefghjkmnpqrstvwxy3456789abcdefghjkmnpqrstvwxyABCDEFGHJKMNPQRSTVWXY3456789abcdefghjkmnpqrstvstvwxy3456789abcdefghwxy123456789abcdefghjkmnpqrstvwxyABCDEFGHJKMNPQRSTVWXY';
            return substr(str_shuffle($set), 0, $range);
        }

        public static function changeClaimCheckoutView(string $businessTypeId): string
        {
            switch ($businessTypeId) {
                case '1':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'airbnb';
                    break;
                case '2':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'amusementPark';
                    break;
                case '3':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'aviation';
                    break;
                case '4':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'businessToBusiness';
                    break;
                case '5':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'bar';
                    break;
                case '6':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'camping';
                    break;
                case '7':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'carRental';
                    break;
                case '8':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'club';
                    break;
                case '9':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'event';
                    break;
                case '10':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'eventHall';
                    break;
                case '11':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'festival';
                    break;
                case '12':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'hotel';
                    break;
                case '13':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'mall';
                    break;
                case '14':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'movieTheater';
                    break;
                case '15':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'municipality';
                    break;
                case '16':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'museum';
                    break;
                case '17':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'publicTransport';
                    break;
                case '18':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'restaurant';
                    break;
                case '19':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'school';
                    break;
                case '20':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'sport';
                    break;
                case '21':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'storeAndMarket';
                    break;
                case '22':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'theater';
                    break;
                case '23':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'tourOperator';
                    break;
                case '24':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'transport';
                    break;
                case '25':
                    $view = 'claimcheckout' . DIRECTORY_SEPARATOR . 'university';
                    break;
                default:
                    $view = 'claimcheckout';
                    break;
            }
            return $view;            
        }

        public static function getDhlShipmentDate(): string
        {
            $date = date('Y-m-d', strtotime('+3 days'));
            $timestamp = strtotime($date);
            $weekday= date("l", $timestamp );
            if ($weekday === "Saturday") {
                return date('Y-m-d', strtotime($date . " + 2 days"));
            } elseif ($weekday === "Sunday") {  
                return date('Y-m-d', strtotime($date . " + 1 day"));
            }
            return $date;      
        }

        public static function getMondayIwWeekendDay(string $date): string
        {
            $timestamp = strtotime($date);
            $weekday= date("l", $timestamp );
            if ($weekday === "Saturday") {
                return date('Y-m-d h:i:s', strtotime($date . " + 2 days"));
            } elseif ($weekday === "Sunday") {  
                return date('Y-m-d h:i:s', strtotime($date . " + 1 day"));
            }
            return $date;      
        }

        public static function resetArrayByKeyMultiple(array $arrays, string $key): array
        {
            if (empty($arrays)) return [];
            $reset = [];
            foreach($arrays as $array) {
                if (!isset($reset[$array[$key]])) {
                    $reset[$array[$key]] = [];
                }
                array_push($reset[$array[$key]], $array);
            }
            return $reset;
        }

        /**
         * compareTwoDates
         * 
         * Checks is first date less or equal to second date. Returns true if it is, else false.
         *
         * @param string $firtsDate
         * @param string $secondDate
         * @param boolean $equal
         * @return boolean
         */
        public static function compareTwoDates(string $firtsDate, string $secondDate, bool $equal = true): bool
        {
            $firtsDate = strtotime($firtsDate);
            $secondDate = strtotime($secondDate);

            if ($equal) {
                return ($firtsDate <= $secondDate);
            }
            return ($firtsDate < $secondDate);
            
        }

        public static function getSessionValue(string $key)
        {
            if (isset($_SESSION[$key])) {
                $return = $_SESSION[$key];
                unset($_SESSION[$key]);
                return $return;
            }
            return null;
            
        }

        // Return empty string if invalid UTF8 string
        public static function check_invalid_utf8($string)
        {
            $string = (string) $string;
            if (0 === strlen( $string )) return '';
            // Check for support for utf8 in the installed PCRE library once and store the result in a static
            static $utf8_pcre = null;
            if (!isset( $utf8_pcre )) $utf8_pcre = @preg_match('/^./u', 'a');
            // We can't demand utf8 in the PCRE installation, so just return the string in those cases
            if (!$utf8_pcre) return $string;
            // preg_match fails when it encounters invalid UTF8 in $string
            if (1 === @preg_match('/^./us', $string)) return $string;
            return '';
        }

        public static function logMessage(string $file, string $message): int
        {
            $message = date('Y-m-d H:i:s') . ' => ' . $message . PHP_EOL;
            return file_put_contents($file, $message, FILE_APPEND);
        }

        public static function getPaginationLinks(int $count, int $perPage, $url) {
            if (!$count) return '';

            $config['base_url'] = base_url() . $url;
            $config['total_rows'] = $count;
            $config['per_page'] = $perPage;
            $config['enable_query_strings'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'offset';

            $CI =& get_instance();
            $CI->load->library('pagination');
            $CI->pagination->initialize($config);

            return $CI->pagination->create_links();
        }

        public static function array_sort_by_column(&$arr, $col, $dir = SORT_ASC)
        {
            $sort_col = array();
            foreach ($arr as $key=> $row) {
                $sort_col[$key] = $row[$col];
            }
            array_multisort($sort_col, $dir, $arr);
        }

        public static function convertDayToDate(array $arrays, string $key): array
        {
            if (empty($arrays)) return [];
            $reset = [];
            $today = date('D');
            $now = now();
            $time = date('H:i:s', $now);
            foreach($arrays as $array) {
                if ($array['day'] === $today && $array['timeTo'] <= $time) {
                    $date = date('Y-m-d', strtotime('+7days', strtotime(date('Y-m-d H:i:s'))));
                } else {
                    $date = date('Y-m-d', strtotime($array[$key], strtotime(date('Y-m-d H:i:s'))));
                }

                if (!isset($reset[$date])) {
                    $reset[$date] = [];
                }
                array_push($reset[$date], $array);
            }
            ksort($reset);
            return $reset;
        }

        public static function returnMakeNewOrderElements(?array $ordered, array $vendor, array $mainProducts, array $rawAddons): array
        {
            // $shoppingList = '';
            $checkoutList = '';
            if  (!is_null($ordered)) {
                $count = 0;
                foreach ($ordered as $product) {
                    $count++;
                    $price = 0;
                    $productExtendedId = array_keys($product)[0];
                    $product = reset($product);
                    $randomId = 'product_' . $product['productId'] . '_' . $count;
                    $remarkProductId = (isset($product['remark'])) ? 'remark_' . $count . '_' . $product['productId'] : '0';
                    $onlyOne = ($product['onlyOne'] === '1') ? true : false;

                    $checkoutList .= '<div id="' . $randomId . '" class="orderedProducts ' . $product['productId'] . '" ';
                    // if ($count === 1) {
                    //     $checkoutList .= 'style="padding-left:0px;"';
                    // } else {
                    //     $checkoutList .= 'style="padding-left:0px; position:relative; top:40px"';
                    // }
                    
                    $checkoutList .= '>';
                    $checkoutList .=    '<div class="alert alert-dismissible" style="padding-left: 0px; margin-bottom: 10px;">';
                    $checkoutList .=        '<a href="#" onclick="removeOrdered(\'' . $randomId . '\')" class="close removeOrdered_' . $product['productId'] . '" data-dismiss="alert" aria-label="close">×</a>';
                    $checkoutList .=        '<h4>' . $product['name'] . ' (€' . $product['price'] . ')</h4>';
                    $checkoutList .=    '</div>';
                    $checkoutList .=    '<div class="modal__content">';
                    $checkoutList .=        '<div class="modal__adittional">';
                    if (!$onlyOne) {
                        $checkoutList .=        '<h6>Quantity</h6>';
                        $checkoutList .=        '<div class="form-check modal__additional__checkbox  col-lg-7 col-sm-12" style="margin-bottom:3px">';
                        $checkoutList .=            '<label class="form-check-label">' . $product['name'] . '</label>';
                        $checkoutList .=        '</div>';
                        $checkoutList .=        '<div class="modal-footer__quantity col-lg-4 col-sm-12" style="margin-bottom:3px">';
                        $checkoutList .=            '<span 
                                                        class="modal-footer__buttons modal-footer__quantity--plus" 
                                                        style="margin-right:5px;" 
                                                        data-type="minus"
                                                        onclick="changeProductQuayntity(this, \'addonQuantity\')">';
                        $checkoutList .=            ' -';
                        $checkoutList .=            '</span>';
                    }

                    $checkoutList .=                '<input
                                                        type="number"
                                                        min="0"
                                                        step="1"
                                                        value="' . $product['quantity'] . '"
                                                        data-name="' . $product['name'] . '"
                                                        data-add-product-price="' . $product['price'] . '"
                                                        data-only-one="' . $product['onlyOne'] . '"
                                                        data-category="' . $product['category'] . '"
                                                        data-product-extended-id="' . $productExtendedId . '"
                                                        data-product-id="' . $product['productId'] . '" 
                                                        data-remark-id="' . $remarkProductId . '"                                                        
                                                        data-order-quantity-value="orderQuantityValue_' .  $product['productId'] . '"
                                                        data-ordered="orderQuantityValue_' .  $product['productId'] . '" ';
                    
                    if (!empty($product['categorySlide'])) {
                        $checkoutList .=                'data-category-slide="' . $product['categorySlide'] . '" ';
                    }
                                                        

                    if (!$onlyOne) {                                    
                        $checkoutList .=                'class="form-control checkProduct" style="display:inline-block"';
                    } else {
                        $checkoutList .=                'readonly hidden';
                    }
                    $checkoutList .=                '/>';

                    if (!$onlyOne) {
                        $checkoutList .=            '<span
                                                        class="modal-footer__buttons modal-footer__quantity--minus"
                                                        style="margin-left:5px;"
                                                        data-type="plus"
                                                        onclick="changeProductQuayntity(this, \'addonQuantity\')"
                                                    >';
                        $checkoutList .=            ' +';
                        $checkoutList .=            '</span>';
                        $checkoutList .=        '</div>';

                    }
                    
                    if ($vendor['showAllergies'] === '1')  {
                        $productesInCategory = $mainProducts[$product['category']];
                        #var_dump($productesInCategory);
                        foreach ($productesInCategory as $categoryProduct) {
                            if ($categoryProduct['productId'] === $product['productId']) {
                                $categoryProduct['allergies'] = !empty($categoryProduct['allergies']) ? unserialize($categoryProduct['allergies']) : [];
                                if (!empty($categoryProduct['allergies']['productAllergies'])) {
                                    $productAllergies = $categoryProduct['allergies']['productAllergies'];
                                    $baseUrl = base_url();
                                    $checkoutList .= '<div style="margin: 5px 0px;" class="col-lg-12 col-sm-12">';
                                    foreach ($productAllergies as $allergy) {
                                        $checkoutList .=    '<img
                                                                src="'. $baseUrl . 'assets/images/allergies/' . str_replace(' ', '_', $allergy) . '.png"
                                                                alt="' . $allergy . '"
                                                                height="24px"
                                                                width="24px"
                                                                style="display:inline; margin:0px 2px 3px 0px"
                                                            />';
                                    }
                                    $checkoutList .= '</div>';
                                }
                                break;
                            }
                        }
                    }
                
                    if ($remarkProductId !== '0') {

                        $checkoutList .=        '<h6>Remark</h6>';
                        $checkoutList .=            '<div class="form-check modal__additional__checkbox  col-lg-12 col-sm-12" style="margin-bottom:3px">';
                        $checkoutList .=                '<textarea
                                                            class="form-control"
                                                            rows="1"
                                                            maxlength="200"
                                                            data-product-remark-id="' . $remarkProductId . '"
                                                        >' . $product['remark'] . '</textarea>
                                                    </div>';

                    }

                    $checkoutList .=        '</div>';

                    if (isset($product['addons'])) {
                        $checkoutList .=        '<div class="modal__adittional">';
                        $checkoutList .=            '<h6 style="margin-top:10px">Additional</h6>';
                        $checkoutList .=            '<div class="modal__adittional__list">';

                        $countAddons = 0;
                        foreach ($product['addons'] as $addonExtendedId => $addon) {
                            $step = floatval($addon['step']);
                            $countAddons++;
                            $remarkAddonId = isset($addon['remark']) ? $remarkProductId . '_' . $countAddons : '0';

                            $checkoutList .=            '<div class="form-check modal__additional__checkbox  col-lg-7 col-sm-12" style="margin-bottom:3px">';
                            $checkoutList .=                '<label class="form-check-label">';
                            $checkoutList .=                    '<input type="checkbox" class="form-check-input checkAddons" onchange="toggleElement(this)" checked>&nbsp;';
                            $checkoutList .=                    $addon['name'] . ' € ' . $addon['price'] . ' (min per unit ' . $addon['initialMinQuantity'] . ' / max  per unit ' . $addon['initialMaxQuantity'] . ')';
                            $checkoutList .=                '</label>';

                            if ($vendor['showAllergies'] === '1')  {
                                $addon['allergies'] = unserialize($rawAddons[$addonExtendedId][0]['allergies']);
                                if (!empty($addon['allergies']['productAllergies'])) {
                                    $addonAllergies = $addon['allergies']['productAllergies'];
                                    $baseUrl = base_url();
                                    $checkoutList .= '<div>';
                                    foreach ($addonAllergies as $allergy) {
                             
                                        $checkoutList .= '<img
                                                            src="' . $baseUrl . 'assets/images/allergies/' . str_replace(' ', '_', $allergy) . '.png"
                                                            alt="' . $allergy  . '"
                                                            height="24px"
                                                            width="24px"
                                                            style="display:inline; margin:0px 2px 3px 0px"
                                                        />';
                                    }
                                    $checkoutList .= '</div>';
                                }
                            }
                            $checkoutList .=            '</div>';
                            $checkoutList .=            '<div class="modal-footer__quantity col-lg-4 col-sm-12" style="visibility: visible; margin-bottom: 3px;">';
                            $checkoutList .=                '<span 
                                                                class="modal-footer__buttons modal-footer__quantity--plus"
                                                                style="margin-right:5px;"
                                                                data-type="minus"
                                                                onclick="changeAddonQuayntity(this)"
                                                            >';
                            $checkoutList .=                    ' -';
                            $checkoutList .=                '</span>';
                            $checkoutList .=                '<input
                                                                readonly
                                                                type="number"
                                                                min="' . $addon['minQuantity'] . '"
                                                                max="' . $addon['maxQuantity'] . '"
                                                                data-addon-price="' . $addon['price'] . '"
                                                                data-addon-name="' . $addon['name'] . '"
                                                                data-category="' . $addon['category'] . '"
                                                                data-product-extended-id="' . $productExtendedId . '"
                                                                data-addon-extended-id="' . $addonExtendedId . '"
                                                                data-min="' . $addon['minQuantity'] . '"
                                                                data-max="' . $addon['maxQuantity'] . '"
                                                                data-initial-min-quantity="' . $addon['initialMinQuantity'] . '"
                                                                data-initial-max-quantity="' . $addon['initialMaxQuantity'] . '"
                                                                data-remark-id="' .  $remarkAddonId . '"
                                                                step="' . $addon['step'] . '"
                                                                value="' . $addon['quantity'] . '"
                                                                class="form-control addonQuantity"  
                                                                style="display:inline-block"
                                                            />';
                            $checkoutList .=                '<span
                                                                class="modal-footer__buttons modal-footer__quantity--minus"
                                                                style="margin-left:5px;"
                                                                data-type="plus"
                                                                onclick="changeAddonQuayntity(this)"
                                                            >';
                            $checkoutList .=                    ' +';
                            $checkoutList .=                '</span>';
                            $checkoutList .=            '</div>';

                            if ($remarkAddonId !== '0') {
                                $checkoutList .=        '
                                                        <div class="form-check modal__additional__checkbox  col-lg-12 col-sm-12" style="margin-bottom:3px">
                                                            <h6>Remark</h6>
                                                            <div class="col-lg-12 col-sm-12" style="margin-bottom:3px">
                                                                <textarea
                                                                    class="form-control"
                                                                    rows="1"
                                                                    maxlength="200"
                                                                    data-addon-remark-id="' . $remarkAddonId . '"
                                                                >' . $addon['remark'] . '</textarea>
                                                            </div>
                                                        </div>
                                                        '; 
                            }
                        }
                        $checkoutList .=            '</div>';
                        $checkoutList .=        '</div>';                      
                    }

                    $checkoutList .=    '</div>';
                    $checkoutList .= '</div>'; 
        
                    $price += floatval($product['amount']);
                    $addonsArray = [];
                    if (isset($product['addons'])) {
                        foreach($product['addons'] as $addon) {
                            $price += floatval($addon['amount']);
                            $addonString = $addon['name']  . '(' . $addon['price'] . ')';
                            array_push($addonsArray, $addonString);
                        }
                    }
                    // $shoppingList .= '<div class="shopping-cart__single-item ' . $randomId . '" data-ordered-id="' . $randomId . '">';
                    // $shoppingList .=     '<div class="shopping-cart__single-item__details">';
                    // $shoppingList .=         '<p style="text-align:left">';
                    // $shoppingList .=             '<span class="shopping-cart__single-item__quantity">' . $product['quantity'] . '</span>';
                    // $shoppingList .=             ' x ';
                    // $shoppingList .=             '<span class="shopping-cart__single-item__name">' . $product['name'] . '</span>';
                    // $shoppingList .=         '</p>';
                    // $shoppingList .=         '<p style="text-align:left" class="shopping-cart__single-item__additional">' . implode(', ', $addonsArray) . '</p>';
                    // $shoppingList .=         '<p>&euro; <span class="shopping-cart__single-item__price">' . number_format($price, 2, '.', ',').'</span></p>';
                    // $shoppingList .=     '</div>';
                    // $shoppingList .=     '<div class="shopping-cart__single-item__remove" onclick="focusOnOrderItem(\'modal__checkout__list\', \'' . $randomId . '\')">';
                    // $shoppingList .=         '<i class="fa fa-info-circle" aria-hidden="true"></i>';
                    // $shoppingList .=     '</div>';
                    // $shoppingList .= '</div>';
                }
            }

            return [
                // 'shoppingList' => $shoppingList,
                'checkoutList' => $checkoutList
            ];
        }

        public static function arrayToCsv(array $csv, string $fileRelaitvePath): void
        {
            $csvFile = FCPATH . $fileRelaitvePath;
            $csvFile = fopen($csvFile, 'w');
            $firstLine = null;

            foreach ($csv as $data) {

                if (is_null($firstLine)) {
                    $firstLine = array_keys($data);
                    fputcsv($csvFile, $firstLine, ';');
                }

                $dataToScv = array_values($data);
                fputcsv($csvFile, $dataToScv, ';');
            }

            fclose($csvFile);
            $fileLocation = base_url() . $fileRelaitvePath;
            redirect($fileLocation);

            return;
        }

        public static function sanitizePost(): array
        {
            $CI =& get_instance();
            $post = [];
            foreach ($_POST as $key => $value) {
                $post[$key] = $CI->input->post($key, true);
            };
            return $post;
        }

        public static function getDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
        {

            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;            
            return ($miles * 1.609344);
        }

        public static function sanitizeGet(): array
        {
            $CI =& get_instance();
            $get = [];
            foreach ($_GET as $key => $value) {
                $get[$key] = $CI->input->get($key, true);
            };
            return $get;
        }

        public static function getAndUnsetValue(array &$array, string $key)
        {
            $value = $array[$key];
            unset($array[$key]);
            return $value;
        }
    }
