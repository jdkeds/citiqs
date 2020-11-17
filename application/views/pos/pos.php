<main style="height: 100vh;">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-12 form-inline">
				<label for='selectSpot'>Select POS spot:&nbsp;&nbsp;</label>
				<select onchange="redirectToNewLocation(this.value)" class="form-control">
					<option value="">Select</option>
					<?php foreach ($spots as $spot) { ?>
						<?php if ($spot['spotActive'] !== '1') continue; ?>
						<option
							value="pos?spotid=<?php echo $spot['spotId']; ?>"
							<?php if (intval($spot['spotId']) === $spotId) echo 'selected'; ?>
						>
							<?php echo $spot['spotName']; ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<?php if ($spotPosOrders) { ?>
				<div class="col-lg-5 col-12 form-inline">
					<label for='selectSpot'>Select holded order:&nbsp;&nbsp;</label>
					<select onchange="redirectToNewLocation(this.value)" class="form-control">
						<option value="">Select</option>
						<?php foreach ($spotPosOrders as $saveOrder) { ?>
							<option
								value="pos?spotid=<?php echo $saveOrder['spotId'] . '&' . $orderDataGetKey . '=' . $saveOrder['randomKey']; ?>"
								<?php if ($saveOrder['randomKey'] === $orderDataRandomKey) echo 'selected'; ?>
							>
								<?php echo $saveOrder['saveName']; ?>
							</option>
						<?php } ?>
					</select>
				</div>
			<?php } ?>
		</div>
	</div>
	
	<?php if (isset($mainProducts)) { ?>
		<div class='pos-template'>
			<div style="margin:0px 30px 0px 20px">
				<div class="row">
					<div class="col-lg-8">
						<div class="pos_categories" style="margin-bottom: 10px">
							<div class="pos_categories__grid">
								<?php
									foreach ($categories as $index => $category) {
										$categoryId = str_replace(['\'', '"', ' ', '*', '/'], '', $category);
									?>
										<div
											class="pos_categories__single-item <?php if (array_key_first($categories) === $index) echo 'pos_categories__single-item--active'; ?>"
											onclick="showCategory(this, '<?php echo $categoryId; ?>', 'categories')"
											data-id="<?php echo $categoryId; ?>"
										>
											<p>
												<?php echo  $category; ?>
											</p>
										</div>
									<?php
									}
								?>
							</div>
						</div>
						<!-- end categories -->
						<div class="pos-main">
							<div class="pos-main__top-bar">
								<div class="pos-main__add-item">
									<a href="<?php echo base_url() . 'orders'; ?>">
										<button class='pos-main__add-new-button'>
											<i class="fa fa-hand-o-left" aria-hidden="true"></i>
											BACK
										</button>
									</a>
								</div>
								<!-- <div class="pos-main__search">
									<input type="text" class='form-control'>
									<button class="pos-main__search__button"><i class="fas fa-search"></i></button>
								</div> -->
							</div>
							<!-- end pos top bar -->

							<div class="pos-main__grid-content">
								<?php
									foreach ($mainProducts as $category => $products) {
										$categoryId = str_replace(['\'', '"', ' ', '*', '/'], '', $category);
									?>
										<div
											class="pos-main__overflow categories"
											id="<?php echo $categoryId; ?>"
											<?php if (array_key_first($mainProducts) !== $category) echo 'style="display:none"'; ?>
										>
											<div class="pos-main__grid">
												<?php foreach ($products as $product) { ?>
													<?php $productDetails = reset($product['productDetails']); ?>
													<div
														class="pos-item"
														<?php if (!$posCheckoutOrder && !$posBuyerDetails && !$posPay && !$posSuccessLink && !$posPaymentFailedLink) { ?>
															onclick="triggerModalClick('modal_buuton_<?php echo 'single-item-details-modal' . $product['productId']; ?>_<?php echo $productDetails['productExtendedId']?>')"
                                                        <?php } else { ?>
															onclick="alertifyMessage(this)"
															data-message='You can not add product in this stage. Go back to add'
															data-message-type='error'
														<?php } ?>
													>
														<?php if ($vendor['showProductsImages'] === '1') { ?>
															<div class='pos-item__image'>
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
														<p class='pos-item__title'>
															<?php echo $productDetails['name']; ?>
															
														</p>
														<p class='pos-item__price'><?php echo $productDetails['price']; ?>&nbsp;&euro;</p>
														<p>
															<span
																id="orderQuantityValue_<?php echo $product['productId']; ?>"
																class="countOrdered priceQuantity"
																style="font-size:14px;border-radius: 100%;text-align: center;background: coral;width: 20px;display: inline-block;"
															>0</span>
														</p>
													</div>
													<!-- end single pos item-->
												<?php } ?>
											</div>
										</div>
									<?php
									}
								?>
							</div>
						</div>
						<!-- end pos main-->
						<div class="pos_categories__footer">
							<a href="javascript:void(0)" class='pos_categories__button pos_categories__button--secondary' onclick="cancelPosOrder('<?php echo $orderDataRandomKey; ?>')">Cancel Order</a>
							<?php if ( !$posCheckoutOrder && !$posBuyerDetails && !$posPay && !$posSuccessLink && !$posPaymentFailedLink ) { ?>
							<a href="javascript:void(0)" class='pos_categories__button pos_categories__button--primary' data-toggle="modal" data-target="#holdOrder"><?php echo $orderDataRandomKey ? 'Update' : 'Save'; ?>&nbsp;Order</a>
							<?php } ?>
							<a href="<?php echo base_url() . 'pos?spotid=' . $spotId; ?>" class='pos_categories__button pos_categories__button--third' onclick="cancelPosOrder()">New order</a>
						</div>
						<!-- end pos footer -->
					</div>
					<!-- start pos sidebar -->
					<?php
						if ($posCheckoutOrder) {
							include_once FCPATH . 'application/views/publicorders/checkoutOrder.php';
						} elseif ($posBuyerDetails) {
							include_once FCPATH . 'application/views/publicorders/buyerDetails.php';
						} elseif ($posPay) {
							include_once FCPATH . 'application/views/publicorders/includes/pay/payMethods.php';
						} elseif($posSuccessLink) {
							include_once FCPATH . 'application/views/paysuccesslink/success.php';
						} elseif ($posPaymentFailedLink) {
							include_once FCPATH . 'application/views/paysuccesslink/notPaid.php';
						} else {
							include_once FCPATH . 'application/views/pos/includes/posMakeOrder.php';
						}
					?>
					<!-- end pos sidebar -->
				</div>
				<!-- end row item grid -->
			</div>
		</div>
	<?php } ?>
</main>
<?php if (isset($mainProducts)) { ?>
	<?php include_once FCPATH . 'application/views/publicorders/includes/modals/makeOrderPos/productModals.php'; ?>
<?php } ?>
<?php include_once FCPATH . 'application/views/publicorders/includes/makeOrderGlobalsJs.php'; ?>

<div id="holdOrder" class="modal" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body" style="text-align:center">
				<label for="codeId" class="">Save order</label>
				<input
					type="text"
					id="posOrderName"
					class="form-control payOrderInputFields"
					<?php if (!empty($posOrderName)) { ?>
					value="<?php echo $posOrderName; ?>"
					<?php }  ?>
				/>
				<div class="virtual-keyboard-hook" data-target-id="posOrderName" data-keyboard-mapping="qwerty"><i class="fa fa-keyboard-o" aria-hidden="true"></i></div>
				<br/>
				<button
					class="btn btn-success btn-lg"
					style="border-radius:50%; margin:30px 5% 0px 0px; font-size:24px"
					onclick="holdOrder('<?php echo $spotId; ?>', 'posOrderName')"
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

<div id="confirmCancel" class="modal" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body" style="text-align:center">
				<label for="codeId" class="">This order will be removed. Are you sure?</label>
				<br/>
				<button
					class="btn btn-success btn-lg"
					style="border-radius:50%; margin:30px 5% 0px 0px; font-size:24px"
					onclick="deleteOrder('<?php echo $spotId; ?>', '<?php echo $orderDataRandomKey; ?>')"
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