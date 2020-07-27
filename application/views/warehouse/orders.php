<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    #ordersList td, #ordersList th {
        text-align: center;
    }
</style>
<main class="row" style="margin:0px 20px">
    <h1 style="margin:70px 0px 20px 0px">Order list</h1>
    <div class="table-responsive col-sm-12" style="margin-top:20px">
        <table id="ordersList" class="display table table-hover table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Amount</th>
                    <th>Spot name</th>
                    <th>Order status</th>
                    <th>Updated</th>
                    <th>Buyer</th>
                    <th>Buyer Email</th>
                    <th>Buyer Mobile</th>
                    <th>Send Buyer Sms</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Amount</th>
                    <th>Spot name</th>
                    <th>Order status</th>
                    <th>Updated</th>
                    <th>Buyer</th>
                    <th>Buyer Email</th>
                    <th>Buyer Mobile</th>
                    <th>Send Buyer Sms</th>
                </tr>
            </tfoot>
        </table>
    </div>
</main>
<script>
    var orderGlobals = (function(){
        let globals = {
            'orderStatuses' : JSON.parse('<?php echo json_encode($orderStatuses) ?>'),
            'tableId' : 'orders',
            'vendorName' : '<?php echo $vendor; ?>'
        }
        Object.freeze(globals);
        return globals;
    }());
</script>
