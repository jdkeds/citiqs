<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<style>
.custom-file-uploader {
  position: relative;
}

.custom-file-uploader input[type='file'] {
  display: block;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 5;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: default;
}
</style>


<div class="container">
  <header class="page-header">
    <h4 class="text-dark">Compare file with database</h4>
    <h1></h1>
  </header>

  <form action="" method="post" enctype="multipart/form-data">
    
    <div class="row">
      <div class="col-sm-6 col-md-5 col-lg-4">

        <div class="form-group">
          <label for="file" class="sr-only">File</label>
          <div class="input-group">
            <input type="text" name="filename" class="form-control" placeholder="No file selected" readonly="">
            <span class="input-group-btn">
              <div class="btn btn-default  custom-file-uploader">
                <input type="file" name="userfile" onchange="this.form.filename.value = this.files.length ? this.files[0].name : ''">
                Select a file
              </div>
            </span>
          </div>
          <div class="w-100 mt-2 p-1 text-right">
            <input type="submit" name="submit" class="btn btn-success" value="Compare">
          </div>
        </div>

      </div>
    </div>
  
  </form>

  <?php if(isset($diff_order_ids)): ?>
  <table style="display:none" id="tbl_data">
  <thead>
    <tr>
      <th colspan="2">Missing on database</th>
    </tr>
    <tr>
      <th>Order ID</th>
      <th>Price</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($diff_order_ids as $key => $diff_order_id): ?>
    <tr>
      <td><?php echo $diff_order_id; ?></td>
      <td><?php echo $prices[$key]; ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
      <div class="col col-md-12">
        <?php foreach($diff_order_ids as $diff_order_id): ?>
           <p>Order ID: <?php echo $diff_order_id;?> is missing on database</p>
        <?php endforeach; ?>
        </div>
  <?php endif; ?>
  <table id="report" class="table table-striped table-bordered" cellspacing="0" width="100%">
  </table>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.table2excel.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  if($("#tbl_data").html()){
    let html = '<table>'+ $("#tbl_data").html() + '</table>';
    $(html).table2excel({
      exclude: ".noExl",
			name: "Excel Document Name",
			filename: "Missing on database.xls",
			fileext: ".xls",
			exclude_img: true,
			exclude_links: true,
			exclude_inputs: true
		});
    
  }
});
</script>
  
  
  
