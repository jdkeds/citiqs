<?php if ($this->view === 'found') { ?>
<link rel="stylesheet" type="text/css"  href="<?php echo $this->baseUrl; ?>assets/home/styles/timeline-page.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl;; ?>assets/home/styles/hotel-page.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/found.css" />
<?php } elseif ($this->view === 'map') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/map.css" />
<?php } elseif ($this->view === 'login') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/login.css" />
<?php } elseif ($this->view === 'labels') { ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/flatpickr.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/labels.css">
<?php } elseif ($this->view === 'upload') { ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/upload.css">
<?php } elseif ($this->view === 'foundclaim') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/hotel-page.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/timeline-page.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/foundclaim.css">
<?php } elseif ($this->view === 'registerbusiness') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/hotel-page.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/timeline-page.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/registerbusiness.css">
<?php } elseif ($this->view === 'check') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/check.css">
<?php } elseif ($this->view === 'profile') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/profile.css">
<link rel="stylesheet" type="text/css"  href="<?php echo $this->baseUrl; ?>assets/home/styles/timeline-page.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl;; ?>assets/home/styles/hotel-page.css">
<?php } elseif ($this->view === 'employeenew') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/grid.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/employeenew.css">
<?php } elseif ($this->view === 'appointmentNewView') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/grid.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/appointmentNewView.css">
<?php } elseif ($this->view === 'claimcheckout' || strpos($this->view, 'claimcheckout') !== false) { ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/timeline-page.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/claimcheckout.css">
<?php } elseif ($this->view === 'contactform') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/contact-page.css" />
<?php } elseif ($this->view === 'userCalimedlisting') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/flatpickr.css">
<?php } elseif ($this->view === 'send') { ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<?php } elseif ($this->view === 'sendbags') { ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<?php } elseif ($this->view === 'nolabels') { ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/styles/hotel-page.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/styles/timeline-page.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/styles/nolabaels.css">
<?php } elseif ($this->view === 'publicorders/makeOrder') { ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/styles/makeOrder.css">
<!-- swipe slider -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/slickCss/slick.css">    
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/slickCss/slick-theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/slickCss/custom.css">
<?php } elseif ($this->view === 'warehouse/orders') { ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/styles/orderList.css">
<?php } elseif ($this->view === 'warehouse/warehouse') { ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<?php } elseif ($this->view === 'warehouse/products') { ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.min.css">
<?php } ?>
