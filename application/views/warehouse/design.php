<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<main class="container" style="margin-top:20px">

    
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#design">Design</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#iframeSettings">Iframe</a>
            </li>
        </ul>
        <div class="tab-content">

            <div id="design" class="container tab-pane active" style="background-color:#fff">
                <div class="row">
                    <h3 class="col-lg-12" style="margin:15px 0px">Set buyer view style</h3>
                    <div class="col-lg-6">            
                        <form method="post" id="<?php echo $id; ?>" onsubmit="return saveDesign(this)">
                            <?php 
                                include_once FCPATH . 'application/views/warehouse/includes/design/selectTypeView.php';
                                include_once FCPATH . 'application/views/warehouse/includes/design/closed.php';
                                include_once FCPATH . 'application/views/warehouse/includes/design/selectSpotView.php';
                                include_once FCPATH . 'application/views/warehouse/includes/design/makeOrderNewView.php';
                                include_once FCPATH . 'application/views/warehouse/includes/design/checkoutOrderView.php';
                                include_once FCPATH . 'application/views/warehouse/includes/design/buyerDetailsView.php';
                                include_once FCPATH . 'application/views/warehouse/includes/design/payOrderView.php';
                            ?>
                            <input type="submit" class="btn btn-primary" value="submit" />
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div style="margin:auto; width:80%;">
                            <iframe id="iframe" src="<?php echo $iframeSrc; ?>" width="420px" height="650px" style="position:fixed"></iframe>
                        </div>
                    </div>
                </div>
            </div>        
            <div id="iframeSettings" class="container tab-pane" style="background-color:#fff">            
                <?php include_once FCPATH . 'application/views/warehouse/includes/design/iframeSettings.php'; ?>
            </div>
        </div>
        
    
</main>
<script>
    var designGlobals = (function() {
        let globals = {
            'id' : "<?php echo $id; ?>",
            'iframe'  : '<?php echo $iframeSrc; ?>',
            'iframeId' : 'iframe',
            'showClass' : 'showFieldsets',
            'hideClass' : 'hideFieldsets',
            'selectTypeView' : 'selectTypeView',
            'closed' : 'closed',
            'selectSpotView' : 'selectSpotView',
            'selectedSpotView' : 'selectedSpotView',
            'checkoutOrderView' : 'checkoutOrderView',
            'buyerDetailsView' : 'buyerDetailsView',
            'payOrderView' : 'payOrderView',
            'checkUrl' : function (url) {
                            if (url.includes('make_order?vendorid=') && !url.includes('&typeId=') && !url.includes('&spotid=')) {
                                return this['selectTypeView']
                            }
                            if (url.includes('closed')) {
                                console.dir(url);
                                return this['closed']
                            }
                            if (url.includes('make_order?vendorid=') && url.includes('&typeId=') && !url.includes('&spotid=')) {
                                return this['selectSpotView']
                            }
                            if (url.includes('make_order?vendorid=') && !url.includes('&typeId=') && url.includes('&spotid=')) {
                                return this['selectedSpotView']
                            }
                            if (url.includes('checkout_order?order=')) {
                                return this['checkoutOrderView']
                            }
                            if (url.includes('buyer_details?order=')) {
                                return this['buyerDetailsView']
                            }
                            if (url.includes('pay_order?order=')) {
                                return this['payOrderView']
                            }
                            return false;
                        }
        }
        return globals;
    }());
</script>