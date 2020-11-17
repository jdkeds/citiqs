<div 
    <?php if ($pos) { ?>
        class='col-lg-4'
    <?php } else { ?>
        class='checkout-message' style='margin-top: 100px; margin-bottom: 100px;'
    <?php } ?>
>
	<img src="http://localhost:8080/alfred/alfred/assets/images/defaultProductsImages/coca-cola.png" alt="">
	<h2>CONFIRMATION</h2>
	<div class="checkout-message__content">
		<h3><?php if (!$pos) echo 'Your'; ?>&nbsp;Order was</h3>
        <p class='order-status order-status--true'>successful</p>
        <?php if (isset($order)) { ?>
            <div class='checkout-message__details'>
                <h3>spot: table<span class='checkout-message__spot'></span>&nbsp;<?php echo $order['spotName']; ?></h3>
                <h3>order n<sup>o</sup>: <span class='checkout-message__order'><?php echo $order['orderId']; ?></span></h3>
                <?php
                    $amount = floatval($order['orderAmount']) + floatval($order['serviceFee']);
                ?>
                <h3>amount: <span class='checkout-message__amount'><?php echo number_format($amount, 2, '.', ''); ?></span></h3>
                <?php if (floatval($order['waiterTip'])) { ?>
                    <h3>tip: <span class='checkout-message__amount'><?php echo number_format($order['waiterTip'], 2, '.', ''); ?></span></h3>
                <?php } ?>
            </div>
        <?php } ?>
		<h3 class='order-status order-status--true'>Please be patiente we are now working on that</h3>
	</div>
	<div class="checkout-btns">
        <?php if (isset($order)) { ?>
            <?php if (isset($pos) && $pos === '1') { ?>
                <a
                    href="<?php echo base_url() . 'pos?spotid=' . $order['spotId']; ?>"
                    style="background-color: #948b6f"
                    class="button"
                >
                    Back<i class="fa fa-arrow-left"></i>
                </a>
            <?php } else { ?>
                <a
                    href="<?php echo base_url() . 'make_order?vendorid=' . $order['vendorId'] . '&spotid=' . $order['spotId']; ?>"
                    style="background-color: #948b6f"
                    class="button">
                    Order again<i class="fa fa-arrow-right"></i>
                </a>
            <?php } ?>
        <?php } else { ?>
            <a href="<?php echo base_url() . 'places'; ?>" style="background-color: #948b6f" class="button">
                Back<i class="fa fa-arrow-right"></i>
            </a>
        <?php } ?>
	</div>
</div>
