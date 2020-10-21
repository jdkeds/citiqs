<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<h1 style="margin:70px 0px 20px 35px">Sales ledger</h1>
<main class="row" style="margin:0px 20px">
    <div class="col-lg-6 col-md-12">
        <div class="card" style="background-color:#138575">
            <div class="card-body setting-card-body pb-0">
                <a href="<?php echo base_url('visma/config'); ?>" type="button" class="btn btn-primary setting-btn" data-card-widget="collapse" data-toggle="tooltip" title="Setting">Setting</a>
                <p class="lead text-white setting-lead">Overiew</p>
            </div>
        </div>
        <div class="table-responsive project-stats">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ledgers</th>
                        <th class="w60"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($creditors) {
                        foreach ($creditors as $l) {
                            foreach ($categories as $cat) {
                                if ($cat->id == $l->product_category_id) {
                                    $category  = $cat->category;
                                }
                            }
                    ?>
                            <tr>
                                <td><a href="<?php echo base_url(); ?>setting/visma/creditors/<?php echo $l->id ?>">[<?php echo $l->external_id ?>] <?php echo $category ?></a></td>
                                <td class="w80 text-right"><a href="<?php echo base_url(); ?>setting/visma/creditors/<?php echo $l->id ?>" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a> <a href="<?php echo base_url(); ?>setting/visma/credit_delete/<?php echo $l->id; ?>" class="btn btn-default btn-xs delete"><i class="fa fa-trash"></i></a></button></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card" style="background-color:#138575">
            <div class="card-body setting-card-body pb-0">
                <a href="<?php echo base_url('setting/visma/creditors'); ?>" type="button" class="btn btn-success setting-btn" data-card-widget="collapse" data-toggle="tooltip" title="Add">Add</a>
                <p class="lead text-white setting-lead">Setting</p>
            </div>
        </div>
        <?php echo form_open('setting/visma_credit/save') . "\r\n"; ?>

        <div class="form-group">
            <label for="external_id" class="control-label">Sale ledger *</label>
            <select name="external_id" id="external_id" class="form-control" required>
                <option value="" selected="selected">--- select Sale ledger account ---</option>
                <?php
                if (isset($visma_creditors) && is_array($visma_creditors)) {
                    foreach ($visma_creditors as $creditor) {
                        $parts = explode("|", $creditor);
                ?>
                        <option value="<?php echo $parts[0] ?>"><?php echo $parts[1] ?></option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="product_category_id">Product Category *</label>
            <select name="product_category_id" id="product_category_id" class="form-control">
                <option value="" selected="selected">--- select product category ---</option>
                <?php
                if (isset($categories) && is_array($categories)) {
                    foreach ($categories as $cat) { ?>
                        <option value="<?php echo $cat->id ?>"><?php echo $cat->category ?></option>
                <?php  }
                } ?>
            </select>
        </div>
        <p>
            <button type="submit" name="rate_submit" id="rate_submit" class="form_submit btn btn-primary" data-loading-text="Processing">Save Sale Ledger</button>
        </p>
        </form>
    </div>

</main>
<script>
    $(document).ready(function() {
        $('select').select2();
    });
</script>
<style>
    .setting-btn {
        float: right;
        margin-top: 5px;
        margin-right: 5px;
    }

    .setting-lead {
        margin-left: 10px;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .setting-card-body {
        padding: 1px;
    }
</style>