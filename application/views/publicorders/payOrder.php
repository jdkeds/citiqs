<?php
    $tableRows = '';
    $totalOrder = 0;
    $total = 0;
    $quantiy = 0;

    if ($vendor['preferredView'] === $oldMakeOrderView) {
        foreach($ordered as $productExtendedId => $data) {
            if (!isset($data['mainProduct'])) {
                $mainExtendedId = $productExtendedId;
            } else {
                $data = $data['mainProduct'][$mainExtendedId ];
            }
            $quantiy = $quantiy + intval($data['quantity'][0]);
            $totalOrder = $totalOrder + floatval($data['amount'][0]);
    
            $tableRows .= '<tr>';
            $tableRows .=   '<td>' . $data['quantity'][0] . ' x ' .  $data['name'][0] . '</td>';
            $tableRows .=   '<td>' . number_format($data['amount'][0], 2, '.', ',') . ' &euro;</td>';
            $tableRows .= '</tr>';
        }
    } elseif ($vendor['preferredView'] === $newMakeOrderView) {
        
        foreach($ordered as $data) {
            $data = reset($data);            
            $quantiy = $quantiy + intval($data['quantity']);
            $totalOrder = $totalOrder + floatval($data['amount']);
    
            $tableRows .= '<tr>';
            $tableRows .=   '<td>' . $data['quantity'] . ' x ' .  $data['name'] . '</td>';
            $tableRows .=   '<td>' . number_format($data['amount'], 2, '.', ',') . ' &euro;</td>';
            $tableRows .= '</tr>';

            if (!empty($data['addons'])) {
                foreach ($data['addons'] as $addon) {
                    $quantiy = $quantiy + intval($addon['quantity']);
                    $totalOrder = $totalOrder + floatval($addon['amount']);
            
                    $tableRows .= '<tr>';
                    $tableRows .=   '<td>' . $addon['quantity'] . ' x ' .  $addon['name'] . '</td>';
                    $tableRows .=   '<td>' . number_format($addon['amount'], 2, '.', ',') . ' &euro;</td>';
                    $tableRows .= '</tr>';
                }
            }
        }
    } 

    $serviceFee = $totalOrder * $vendor['serviceFeePercent'] / 100 + $vendor['minimumOrderFee'];
    if ($serviceFee > $vendor['serviceFeeAmount']) $serviceFee = $vendor['serviceFeeAmount'];
    $total = $totalOrder + $serviceFee;
    $totalWithTip = $total + $waiterTip;

    $targetBlank = $iframe ? 'target="_blank"' : '';
?>
<div id="wrapper">
    <div id="content">
        <div class="container" id="shopping-cart">
            <div class="container" id="page-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div id="area-container">
                            <div class="page-container">
                                <div class="heading pay-header">
                                    <div class="amount"><?php echo number_format($total, 2, ',', '.'); ?> EUR</div>
                                    <div class="info">
                                        <b>bestelling</b>
                                    </div>
                                </div>
                                <div class="bar bar2">
                                    <div class="language">
                                        <a href="#">
                                            <span class="selectedLanguage">NL</span>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </a>
                                        <div class="menu hidden">
                                            <ul>
                                                <li class="selected">NL</li>
                                                <!-- <li>EN</li>
                                                <li>FR</li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-details" style="background-color: white">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th data-trans="" data-trn-key="Productnaam">Productnaam
                                            </th>
                                            <th data-trans="" data-trn-key="Totaal">Totaal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $tableRows; ?>
                                            <tr>
                                                <td style="text-align:left">
                                                    <p>Bestellingen</p>
                                                    <p>Service</p>
                                                    <p>TOTAAL</p>
                                                    <?php if ($waiterTip) { ?>
                                                    <p>Waiter tip</p>
                                                    <p>TOTAL WITH TIP</p>
                                                    <?php } ?>                                                    
                                                    <p class="voucher" style="display:none">Voucher amount</p>
                                                    <p class="voucher" style="display:none">Pay with other method</p>
                                                </td>
                                                <td>
                                                    <p><?php echo number_format($totalOrder, 2, ',', '.'); ?> &euro;</p>
                                                    <p><?php echo number_format($serviceFee, 2, ',', '.'); ?> &euro;</p>
                                                    <p><?php echo number_format($total, 2, ',', '.'); ?> &euro;</p>
                                                    <?php if ($waiterTip) { ?>
                                                        <p><?php echo number_format($waiterTip, 2, ',', '.'); ?> &euro;</p>
                                                        <p><?php echo number_format($totalWithTip, 2, ',', '.'); ?> &euro;</p>
                                                    <?php } ?>
                                                    <p class="voucher" style="display:none"><span id="voucherAmount"></span> &euro;</p>
                                                    <p class="voucher" style="display:none"><span id="leftAmount"></span> &euro;</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bar">
                                    <div class="bar-title">
                                        <span data-trans="" data-trn-key="Kies een betaalmethode">
                                            Kies een betaalmethode
                                        </span>
                                    </div>
                                    <span class="bar-title-original hidden">
                                        <span data-trans="" data-trn-key="Kies een betaalmethode">Kies een betaalmethode</span>
                                    </span>
                                </div>
                                <div class="content-container clearfix" id="paymentMethodsContainer">
                                    <div class="payment-container methods">
                                        <?php if ($vendor['ideal'] === '1') { ?>
                                            <a href="javascript:void(0)" onclick="toogleElements('idealBanks', 'paymentMethodsContainer', 'hidden')" class="paymentMethod method-card" >
                                                <img src="https://tiqs.com/shop/assets/imgs/extra/ideal.png" alt="iDEAL">
                                                <span>iDEAL</span>
                                            </a>
                                        <?php } ?>
                                        <?php if ($vendor['creditCard'] === '1') { ?>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $creditCardPaymentType; ?>/0" class="paymentMethod method-card addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/creditcard.png" alt="Creditcard">
                                                <span>Creditcard</span>
                                            </a>
                                        <?php } ?>
										<?php if ($vendor['payconiq'] === '1') { ?>
											<a href="<?php echo base_url(); ?>insertorder/<?php echo $payconiqPaymentType; ?>/0" class="paymentMethod method-card addTargetBlank" <?php echo $targetBlank; ?>>
												<img src="https://tiqs.com/qrzvafood/assets/imgs/extra/payconiq.png" alt="Payconiq">
												<span>Payconiq</span>
											</a>
										<?php } ?>
                                        <?php if ($vendor['bancontact'] === '1') { ?>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $bancontactPaymentType; ?>/0" class="paymentMethod method-card addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/bancontact.png" alt="bancontact">
                                                <span>Bancontact</span>
                                            </a>
                                        <?php } ?>
                                        <?php if ($vendor['giro'] === '1') { ?>
                                            <a href="javascript:void(0)" onclick="toogleElements('giroBanks', 'paymentMethodsContainer', 'hidden')" class="paymentMethod method-card" >
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/giropay(1).png" alt="bancontact">
                                                <span data-trans="" data-trn-key="Bancontact">Giropay</span>
                                            </a>
                                        <?php } ?>
                                        <?php if ($localType === intval($spot['spotTypeId'])) { ?>
                                            <?php if ($vendor['prePaid'] === '1') { ?>
                                                <!-- <a href="<?php #echo base_url() . 'cashPayment/' . $this->config->item('orderNotPaid') . '/' . $this->config->item('prePaid'); ?>" class="paymentMethod method-card" > -->
                                                <p class="paymentMethod method-card" data-toggle="modal" data-target="#prePaid">
                                                    <img src="<?php echo base_url() . 'assets/images/waiter.png'; ?>" alt="Pay at waiter" />
                                                    <?php if ($vendor['vendorId'] == THGROUP) { ?>
                                                        <span>Collect at the bar</span>
                                                    <?php } else { ?>
                                                        <span>Pay at waiter</span>
                                                    <?php } ?>
                                                </p>
                                            <?php } ?>
                                            <?php if ($vendor['postPaid'] === '1') { ?>
                                                <!-- <a href="<?php #echo base_url() . 'cashPayment/' . $this->config->item('orderPaid') . '/' . $this->config->item('postPaid'); ?>" class="paymentMethod method-card" > -->
                                                <p class="paymentMethod method-card" data-toggle="modal" data-target="#postPaid">
                                                    <img src="<?php echo base_url() . 'assets/images/waiter.png'; ?>" alt="Pay at waiter" />
                                                    
                                                    <?php if ($vendor['vendorId'] == THGROUP) { ?>
                                                        <span>Collect at the bar</span>
                                                    <?php } else { ?>
                                                        <span>Pay at waiter</span>
                                                    <?php } ?>
                                                </p>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($vendor['pinMachine'] === '1') { ?>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $pinMachinePaymentType; ?>/TH-9268-3020" class="paymentMethod method-card addTargetBlank" <?php echo $targetBlank; ?>>
                                            <img src="<?php echo base_url() . 'assets/home/images/pinmachine.png'; ?>" alt="pin machine">
                                                <span>Pin machine</span>
                                            </a>
                                        <?php } ?>
                                        <?php if ($vendor['vaucher'] === '1') { ?>
                                            <p data-toggle="modal" data-target="#voucher" class="paymentMethod method-card" >
                                                <img src="<?php echo base_url() . 'assets/home/images/voucher.png'; ?>" alt="voucher" >
                                                <span>Voucher</span>
                                            </p>
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>

                                <?php if ($vendor['ideal'] === '1') { ?>
                                    <div class="method method-ideal hidden"  id="idealBanks">
                                        <div class="title hidden"><span data-trans="" data-trn-key="Kies een bank">Kies een bank</span>
                                        </div>                                        
                                        <div class="payment-container">
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/1" class="bank paymentMethod abn_amro addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO">
                                                <span>ABN AMRO</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/8" class="bank paymentMethod asn_bank addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/asn_bank.png" alt="ASN Bank">
                                                <span>ASN Bank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/5080" class="bank paymentMethod bunq addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra//bunq.png" alt="Bunq">
                                                <span>Bunq</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/5082" class="bank paymentMethod handelsbanken addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/handelsbanken.png" alt="Handelsbanken">
                                                <span>Handelsbanken</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/4" class="bank paymentMethod ing addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/ing.png" alt="ING">
                                                <span>ING</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/12" class="bank paymentMethod knab addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/knab(1).png" alt="Knab">
                                                <span>Knab</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/5081" class="bank paymentMethod moneyou addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/moneyou.png" alt="Moneyou">
                                                <span>Moneyou</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/2" class="bank paymentMethod rabobank addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/rabobank.png" alt="Rabobank">
                                                <span>Rabobank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/9" class="bank paymentMethod regiobank addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/regiobank.png" alt="RegioBank">
                                                <span>RegioBank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/5" class="bank paymentMethod sns_bank addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/sns_bank.png" alt="SNS Bank">
                                                <span>SNS Bank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/10" class="bank paymentMethod triodos_bank addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/triodos_bank.png" alt="Triodos Bank">
                                                <span>Triodos Bank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $idealPaymentType; ?>/11" class="bank paymentMethod van_lanschot addTargetBlank" <?php echo $targetBlank; ?>>
                                                <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/van_lanschot.png" alt="van Lanschot">
                                                <span>van Lanschot</span>
                                            </a>
                                            <div class="clearfix"></div>
                                            <a
                                                href="javascript:void(0)"                                                
                                                onclick="toogleElements('paymentMethodsContainer', 'idealBanks', 'hidden')"
                                                >
                                                Back to payment methods
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($vendor['giro'] === '1') { ?>
                                    <div class="method method-ideal hidden"  id="giroBanks">
                                        <div class="title hidden"><span data-trans="" data-trn-key="Kies een bank">Kies een bank</span>
                                        </div>
                                        <div class="payment-container">
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $giroPaymentType; ?>/0" class="bank paymentMethod addTargetBlank" <?php echo $targetBlank; ?>>
                                                <!-- <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO"> -->
                                                <span>Sparkasse</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $giroPaymentType; ?>/0" class="bank paymentMethod addTargetBlank" <?php echo $targetBlank; ?>>
                                                <!-- <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO"> -->
                                                <span>Volksbanken Raiffeisenbanken</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $giroPaymentType; ?>/0" class="bank paymentMethod addTargetBlank" <?php echo $targetBlank; ?>>
                                                <!-- <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO"> -->
                                                <span>Postbank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $giroPaymentType; ?>/0" class="bank paymentMethod addTargetBlank" <?php echo $targetBlank; ?>>
                                                <!-- <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO"> -->
                                                <span>Comdirect</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $giroPaymentType; ?>/0" class="bank paymentMethod addTargetBlank" <?php echo $targetBlank; ?>>
                                                <!-- <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO"> -->
                                                <span>BB Bank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $giroPaymentType; ?>/0" class="bank paymentMethod addTargetBlank" <?php echo $targetBlank; ?>>
                                                <!-- <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO"> -->
                                                <span>MLP Bank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $giroPaymentType; ?>/0" class="bank paymentMethod addTargetBlank" <?php echo $targetBlank; ?>>
                                                <!-- <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO"> -->
                                                <span>PSD Bank</span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>insertorder/<?php echo $giroPaymentType; ?>/0" class="bank paymentMethod addTargetBlank" <?php echo $targetBlank; ?>>
                                                <!-- <img src="https://tiqs.com/qrzvafood/assets/imgs/extra/abn_amro.png" alt="ABN AMRO"> -->
                                                <span>Deutsche Kreditbank AG</span>
                                            </a>
                                            <div class="clearfix"></div>
                                            <a
                                                href="javascript:void(0)"
                                                onclick="toogleElements('paymentMethodsContainer', 'giroBanks', 'hidden')"
                                                >
                                                Back to payment methods
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- modals -->
                                <?php if ($localType === intval($spot['spotTypeId'])) { ?>
                                    <?php if ($vendor['prePaid'] === '1') { ?>
                                        <!-- Modal -->
                                        <div id="prePaid" class="modal" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <button
                                                            class="btn btn-success btn-lg"
                                                            style="border-radius:50%; margin-right:5%; font-size:24px"
                                                            onclick="redirect('<?php echo base_url() . 'cashPayment/' . $this->config->item('orderNotPaid') . '/' . $this->config->item('prePaid'); ?>')"
                                                            >
                                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                        </button>
                                                        <button
                                                            class="btn btn-danger btn-lg"
                                                            style="border-radius:50%; margin-left:5%; font-size:24px"
                                                            data-dismiss="modal"
                                                            >
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($vendor['postPaid'] === '1') { ?>
                                        <!-- Modal -->
                                        <div id="postPaid" class="modal" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <button
                                                            class="btn btn-success btn-lg"
                                                            style="border-radius:50%; margin-right:5%; font-size:24px"
                                                            onclick="redirect('<?php echo base_url() . 'cashPayment/' . $this->config->item('orderPaid') . '/' . $this->config->item('postPaid'); ?>')"
                                                            >
                                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                        </button>
                                                        <button
                                                            class="btn btn-danger btn-lg"
                                                            style="border-radius:50%; margin-left:5%; font-size:24px"
                                                            data-dismiss="modal"
                                                            >
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($vendor['vaucher'] === '1') { ?>
                                    <!-- Modal -->
                                    <div id="voucher" class="modal" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <label for="codeId">Insert code from voucher</label>
                                                    <input
                                                        type="text"
                                                        id="codeId"
                                                        class="form-control"
                                                        data-total="<?php echo round($totalOrder, 2); ?>"
                                                        data-total-amount="<?php echo round($total, 2); ?>"
                                                        data-waiter-tip="<?php echo round($waiterTip, 2); ?>"
                                                    />
                                                    <br/>
                                                    <button
                                                        class="btn btn-success btn-lg"
                                                        style="border-radius:50%; margin:30px 5% 0px 0px; font-size:24px"
                                                        onclick="voucherPay('codeId')"
                                                    >
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                    </button>
                                                    <button
                                                        class="btn btn-danger btn-lg closeModal"
                                                        style="border-radius:50%; margin:30px 5% 0px 0px; font-size:24px"
                                                        data-dismiss="modal"
                                                    >
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="footer" style="text-align:left">
                                    <a href="<?php echo base_url() . $redirect; ?>" class="btn-cancel">
                                        <i class="fa fa-arrow-left"></i>
                                        <span data-trans="" data-trn-key="Annuleren">Annuleren</span>
                                    </a>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function inIframe () {
        try {
            return window.self !== window.top;
        } catch (e) {
            return false;
        }
    }
    function addTargetBlank() {
        let a = document.getElementsByClassName('addTargetBlank');
        let aLength = a.length;
        let i;
        for (i = 0; i < aLength; i++) {
            a[i].target = "_blank";

        }
    }
    if (inIframe()) {
        addTargetBlank();
    }
</script>