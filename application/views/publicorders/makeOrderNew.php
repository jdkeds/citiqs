<div class="container shop-container">
    <div class="row">
        <?php if (!empty($mainProducts)) { ?>
            <?php
            if ($vendor['logo']) { ?>
                <div style="text-align:center">
                    <img src=<?php echo base_url() . 'assets/images/vendorLogos/' . $vendor['logo']; ?> alt="" width="300" height="auto" />
                </div>
            <?php }?>
            <?php
                $categories = array_keys($mainProducts);
                $categoryList = '<ul class="list-group categoryNav">';
                $count = 0;
                foreach ($categories as $categoryName) {
                    $count++;
                    $categoryList .= '<li class="list-group-item">';
                    $categoryList .=    '<a href="#" data-index="' . $count . '">' . $categoryName . '</a>';
                    $categoryList .= '</li>';
                }
                $categoryList .= '</ul>';
            ?>
            <div>
                <div class="col-12 col-md-8" id="categoryContainer">
                    <div class="items-slider">
                        <div class="shop__items">
                            <div class="shop__item-list-heading" id="categoryNav">
                                <h2>MENU</h2>
                                <?php echo $categoryList; ?>
                            </div>
                            <!-- end item list -->
                        </div>
                        <?php foreach ($mainProducts as $category => $products) { ?>
                            <div class="shop__items">
                                <div class="shop__item-list-heading" id='<?php echo $category; ?>'>
                                    <h2><?php echo $category; ?></h2>
                                </div>
                                <div class="shop__item-list">
                                    <?php
                                        foreach ($products as $product) {
                                            $productDetails = reset($product['productDetails']); ?>
                                            <div class="shop__single-item" data-toggle="modal" data-target="#single-item-details-modal<?php echo $product['productId']; ?>">
                                                <?php if ($vendor['showProductsImages'] === '1') { ?>
                                                    <div class="shop__single-item__image">                                                        
                                                        <img
                                                            <?php if ($product['productImage'] && file_exists($uploadProductImageFolder . $product['productImage'])) { ?>
                                                                src="<?php echo base_url() . 'assets/images/productImages/' . $product['productImage']; ?>"
                                                            <?php } else { ?>
                                                                src="<?php echo base_url() . 'assets/images/defaultProductsImages/' . $vendor['defaultProductsImage']; ?>"
                                                            <?php } ?>
                                                            alt="<?php echo $productDetails['name']; ?>"
                                                        />
                                                    </div>
                                                <?php } ?>
                                                <div class="shop__single-item__info">
                                                    <strong class='shop__single-item__info--title'><?php echo $productDetails['name']; ?></strong>
                                                    <p class='shop__single-item__info--description'><?php echo $productDetails['shortDescription']; ?></p>
                                                    <?php
                                                        if ($vendor['showAllergies'] === '1')  {
                                                            $product['allergies'] = unserialize($product['allergies']);
                                                            if (!empty($product['allergies']['productAllergies'])) {
                                                                $productAllergies = $product['allergies']['productAllergies'];
                                                                $baseUrl = base_url();
                                                                echo '<div>';
                                                                foreach ($productAllergies as $allergy) {
                                                                    ?>
                                                                        <img
                                                                            src="<?php echo $baseUrl . 'assets/images/allergies/' . str_replace(' ', '_', $allergy); ?>"
                                                                            alt="<?php echo $allergy; ?>"
                                                                            height='24px'
                                                                            width='24px'
                                                                            style="display:inline; margin:0px 2px 3px 0px"
                                                                        />
                                                                    <?php
                                                                }
                                                                echo '</div>';
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                                <div class="shop__single-item__price">
                                                    <span><?php echo $productDetails['price']; ?></span>
                                                </div>
                                                <div class="shop__single-item__add-to-cart">
                                                    <span>+</span>
                                                </div>
                                            </div>
                                            <!-- end single item -->
                                            <?php
                                        }
                                    ?>
                                </div>
                                <!-- end item list -->
                            </div>
                        <?php } ?>
                        <?php if (isset($termsAndConditions) && $termsAndConditions) { ?>
                            <div class="shop__items">
                                <div class="shop__item-list-heading">
                                    <h2>TERMS AND CONDITIONS</h2>
                                </div>
                                <div class="shop__item-list">
                                    <p style="padding-left:10px">
                                        <?php echo $termsAndConditions; ?>
                                    </p>
                                </div>
                                <!-- end item list -->
                            </div>
                        <?php } ?>
                    </div>
                    <!-- end slider -->
                </div>
                <!-- end left side -->
                <div class="col-12 col-md-4">
                    <div class="shopping-cart" id='shopping-cart'>
                        <h3>Items</h3>
                        <div class="shopping-cart__list" id='shopping-cart__list'>
                            <?php echo $shoppingList; ?>
                        </div>
                        <!-- end shoping cart list -->
                        <div class="shopping-cart__total">
                                <p>Total:</p>
                                <p>&euro;&nbsp;<span class="shopping-cart__total-price totalPrice">0</span></p>
                            </div>
                        <button class='checkout-button button-main button-primary' onclick="checkout()">checkout</button>
                    </div>
                </div>
            </div>
            <!-- end right side -->
        <?php } else { ?>
            No available products
        <?php } ?>
    </div>
</div>
<!-- end shop container -->

<?php
    if (!empty($mainProducts)) {
        ?>
            <!-- bottom bar for smaller screens -->
            <div class='bottom-bar'>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center text-left-md">
                            <div class="bottom-bar__summary">
                                <?php if ($vendor['requireReservation'] === '1' ) { ?>
                                    <a href="<?php echo base_url(); ?>check424/<?php echo $vendor['vendorId']; ?>" style="margin:0px 20px 0px 10px">
                                        <i style="font-size: 40px;color: white" class="fa fa-home"></i>
                                    </a>
                                <?php } ?>
                                <p>TOTAL: <span class='bottom-bar__total-price'>&euro;&nbsp;<span class="totalPrice">0</span></span> </p>
                                <button class='button-main button-secondary' onclick="focusCheckOutModal('modal__checkout__list')">Order List</button>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 text-center text-right-md">
                            <button class='button-main button-secondary bottom-bar__checkout' onclick="checkout()">CHECKOUT</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end bottom bar -->

            <!-- Modal checkout -->
            <div class="modal modal__checkout" id="checkout-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-header__content">
                                <div class='modal-header__details'>
                                    <h4 class="modal-header__title">Order List:</h4>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="modal__checkout__list" id='modal__checkout__list' style="margin: 0px 10px; overflow-y: scroll !important;">
                                    <?php echo $checkoutList; ?>
                                </div>
                                <div class="modal-footer">
                                    <p>TOTAL:
                                        <span class="bottom-bar__total-price"></span>
                                    </p>
                                    <button class='button-main button-primary' onclick="checkout()">
                                        CHECKOUT &euro;&nbsp;<span class="totalPrice">0</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal checkout -->
        <?php 
        $counter = 0;
        foreach ($mainProducts as $category => $products) {

            foreach ($products as $product) {
                $productDetails = reset($product['productDetails']);
                $counter++;
                $remarkProductId = ($product['addRemark'] === '1') ? 'remark_' . $counter . '_' . $product['productId'] : '0';
                ?>
                    <!-- start modal single item details -->
                    <div
                        class="modal modal__item"
                        id="single-item-details-modal<?php echo $product['productId']; ?>"
                        role="dialog"
                        >
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-header__content">
                                    <div class='modal-header__details'>
                                        <h4 class="modal-header__title"><?php echo $productDetails['name']; ?></h4>
                                        <h4 class='modal-price'>&euro; <?php echo $productDetails['price']; ?></h4>
                                    </div>
                                    <h6 class="modal-header__description"><?php echo $productDetails['shortDescription']; ?></h6>
                                    <p class='modal__category'>Category: <a href='#'><?php echo $product['category']; ?></a></p>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal__content" id="product_<?php echo $product['productId']; ?>" style="position:relative; top:20px">

                                    <div class="modal__adittional">
                                        <?php if ($product['onlyOne'] === '0') { ?>
                                            <h6>Quantity</h6>
                                            <div class="form-check modal__additional__checkbox  col-lg-7 col-sm-12" style="margin-bottom:3px">
                                                <label class="form-check-label">
                                                    <?php echo $productDetails['name']; ?>
                                                </label>
                                            </div>
                                            <div
                                                class="modal-footer__quantity col-lg-4 col-sm-12"
                                                style="margin-bottom:3px"
                                                >
                                                <span
                                                    class='modal-footer__buttons modal-footer__quantity--plus'
                                                    style="margin-right:5px;"
                                                    data-type="minus"
                                                    onclick="changeProductQuayntity(this, 'addonQuantity')"
                                                    >
                                                    -
                                                </span>
                                        <?php } ?>
                                        <input
                                            type="number"
                                            min="1"
                                            step="1"
                                            value="1"
                                            data-name="<?php echo $productDetails['name']; ?>"
                                            data-add-product-price="<?php echo $productDetails['price']; ?>"
                                            data-category="<?php echo $product['category']; ?>"
                                            data-product-extended-id="<?php echo $productDetails['productExtendedId']; ?>"
                                            data-product-id="<?php echo $product['productId']; ?>"
                                            data-only-one="<?php echo $product['onlyOne']; ?>"
                                            data-remark-id="<?php echo $remarkProductId ?>"
                                            <?php if ($product['onlyOne'] === '0') { ?>
                                                class="form-control checkProduct"
                                                style="display:inline-block"
                                            <?php } elseif ($product['onlyOne'] === '1') { ?>
                                                readonly
                                                hidden
                                            <?php } ?>
                                        />
                                        <?php if ($product['onlyOne'] === '0') { ?>
                                                    <span
                                                        class='modal-footer__buttons modal-footer__quantity--minus'
                                                        style="margin-left:5px;"
                                                        data-type="plus"
                                                        onclick="changeProductQuayntity(this, 'addonQuantity')"
                                                        >
                                                        +
                                                    </span>
                                                </div>
                                        <?php } ?>
                                        <?php
                                            if ($vendor['showAllergies'] === '1')  {
                                                $product['allergies'] = unserialize($product['allergies']);
                                                if (!empty($product['allergies']['productAllergies'])) {
                                                    $productAllergies = $product['allergies']['productAllergies'];
                                                    $baseUrl = base_url();
                                                    echo '<div style="margin: 5px 0px;" class="col-lg-12 col-sm-12">';
                                                    foreach ($productAllergies as $allergy) {
                                                        ?>
                                                            <img
                                                                src="<?php echo $baseUrl . 'assets/images/allergies/' . str_replace(' ', '_', $allergy); ?>.png"
                                                                alt="<?php echo $allergy; ?>"
                                                                height='24px'
                                                                width='24px'
                                                                style="display:inline; margin:0px 2px 3px 0px"
                                                            />
                                                        <?php
                                                    }
                                                    echo '</div>';
                                                }
                                            }
                                        ?>
                                        <?php if ($product['addRemark'] === '1') { ?>
                                            <h6 class="remark">Remark</h6>
                                            <div class="form-check modal__additional__checkbox  col-lg-12 col-sm-12" style="margin-bottom:3px">
                                                <textarea
                                                    class="form-control"
                                                    rows="1"
                                                    maxlength="200"
                                                    data-product-remark-id="<?php echo $remarkProductId; ?>"
                                                ></textarea>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if ($product['addons']) { ?>
                                        <div class="modal__adittional" style="position:relative; top: 15px;">
                                            <h6>Additional</h6>
                                            <div class="modal__adittional__list"  style="position:relative; top: 15px;">
                                                <?php
                                                    $productAddons = $product['addons'];
                                                    $countAddons = 0;
                                                    foreach ($productAddons as $productAddon) {
                                                        $countAddons++;
                                                        $addonId = $productAddon[0][0];
                                                        $addonAllowedQuantity = $productAddon[0][1];
                                                        $addon = $addons[$addonId][0];
                                                        $remarkAddonId = $addon['addRemark'] === '1' ? $remarkProductId . '_' . $countAddons : '0';                                                        
                                                        ?>
                                                        <div class="form-check modal__additional__checkbox  col-lg-7 col-sm-12" style="margin-bottom:3px">
                                                            <label class="form-check-label">
                                                                <input
                                                                    type="checkbox"
                                                                    class="form-check-input checkAddons"
                                                                    onchange="toggleElement(this)"
                                                                />
                                                                <?php echo $addon['name']; ?>
                                                                &euro; <?php echo $addon['price']; ?>
                                                                (min per unit 1 / max  per unit <?php echo $addonAllowedQuantity; ?>)
                                                            </label>
                                                            <?php
                                                                if ($vendor['showAllergies'] === '1')  {
                                                                    $addon['allergies'] = unserialize($addon['allergies']);
                                                                    if (!empty($addon['allergies']['productAllergies'])) {
                                                                        $addonAllergies = $addon['allergies']['productAllergies'];
                                                                        $baseUrl = base_url();
                                                                        echo '<div>';
                                                                        foreach ($addonAllergies as $allergy) {
                                                                            ?>
                                                                                <img
                                                                                    src="<?php echo $baseUrl . 'assets/images/allergies/' . str_replace(' ', '_', $allergy); ?>.png"
                                                                                    alt="<?php echo $allergy; ?>"
                                                                                    height='24px'
                                                                                    width='24px'
                                                                                    style="display:inline; margin:0px 2px 3px 0px"
                                                                                />
                                                                            <?php
                                                                        }
                                                                        echo '</div>';
                                                                    }
                                                                }
                                                            ?>
  
                                                        </div>
                                                        <div
                                                            class="modal-footer__quantity col-lg-4 col-sm-12"
                                                            style="visibility: hidden; margin-bottom:3px"
                                                            >
                                                            <span
                                                                class='modal-footer__buttons modal-footer__quantity--plus'
                                                                style="margin-right:5px;"
                                                                data-type="minus"
                                                                onclick="changeAddonQuayntity(this)"
                                                            >
                                                                -
                                                            </span>
                                                            <input
                                                                type="number"
                                                                min="1"
                                                                max="<?php echo $addonAllowedQuantity; ?>"
                                                                data-addon-price="<?php echo $addon['price']; ?>"
                                                                data-addon-name="<?php echo $addon['name']; ?>"
                                                                data-category="<?php echo $addon['category']; ?>"
                                                                data-product-extended-id="<?php echo $productDetails['productExtendedId']; ?>"
                                                                data-addon-extended-id="<?php echo $addon['productExtendedId']; ?>"
                                                                data-initial-min-quantity="1"
                                                                data-initial-max-quantity="<?php echo $addonAllowedQuantity; ?>"
                                                                data-min = "1"
                                                                data-max="<?php echo $addonAllowedQuantity; ?>"
                                                                data-remark-id="<?php echo $remarkAddonId ?>"
                                                                step="1"
                                                                value="1"
                                                                class="form-control addonQuantity"
                                                                disabled
                                                                style="display:inline-block"
                                                            />
                                                            <span
                                                                class='modal-footer__buttons modal-footer__quantity--minus'
                                                                style="margin-left:5px;"
                                                                data-type="plus"
                                                                onclick="changeAddonQuayntity(this)"
                                                                >
                                                                +
                                                            </span>
                                                        </div>
                                                        <?php if ($addon['addRemark'] === '1') { ?>
                                                            <div class="form-check modal__additional__checkbox  col-lg-12 col-sm-12" style="margin-bottom:3px">
                                                                <h6 style="margin-top:0px;">Remark</h6>
                                                                <div class="col-lg-12 col-sm-12" style="margin-bottom:3px">
                                                                    <textarea
                                                                        class="form-control"
                                                                        rows="1"
                                                                        maxlength="200"
                                                                        data-addon-remark-id="<?php echo $remarkAddonId ?>"
                                                                    ></textarea>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php
                                                    }
                                                ?>
                                            </div>

                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="button-main button-primary"
                                    data-dismiss="modal"
                                    data-product-id="<?php echo $product['productId']; ?>"
                                    data-product-name="<?php echo $productDetails['name']; ?>"
                                    data-product-price="<?php echo $productDetails['price']; ?>"
                                    onclick="cloneProductAndAddons(this)"
                                    >Continue</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- end modal single item details -->
                <?php
            }
        }
    }
?>
