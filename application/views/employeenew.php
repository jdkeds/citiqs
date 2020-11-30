<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/home/styles/employeenew.css">
<!-- Add Modal -->
<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewModalLabel">Add New Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- ITEM EDITOR FOR NEW USER -->
			<div class="item-editor">


<div class="edit-single-user-container">
	<form class="form-inline" id="addEmployee" method="post" action="<?php echo $this->baseUrl . 'addNewEmployeeSetup'; ?>">
		<input type="text" readonly name="ownerId" required value="<?php echo $ownerId ?>" hidden />
		<div>
			<label for="username">Name</label>
			<input type="text" class="form-control" id="username" name="username" required />
		</div>
		<div>
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" required />
		</div>
		<div>
			<label for="expiration_time_value">Expiration time value</label>
			<input type="number" step="1" min="1" class="form-control" id="expiration_time_value" name="expiration_time_value" required />
		</div>
		<div>
			<label for="expiration_time_type">Expiration time type</label>
			<select class="form-control" id="expiration_time_type" name="expiration_time_type" required>
				<option value="">Select</option>
				<option value="minutes">Minutes</option>
				<option value="hours">Hours</option>
				<option value="days">Days</option>
				<option value="months">Months</option>
			</select>
		</div>
		<div>
			<label for="INSZnumber">INSZ number</label>
			<input type="number" step="1" min="1" class="form-control" id="INSZnumber" name="INSZnumber" />
		</div>
	</form>
</div>
</div>
      </div>
      <div class="modal-footer">
		<input style="width: 100px;" type="button" class="grid-button button theme-editor-header-button" onclick="submitForm('addEmployee')" value="Submit" />
        <button style="width: 100px;" type="button" class="grid-button-cancel button theme-editor-header-button" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>
<div style="margin-top:0;" class="main-wrapper theme-editor-wrapper">
	<div style="background: #f3d0b1 !important;" class="grid-wrapper">
		<div class="grid-list">
			
			<div class="grid-list-header row">
			<div class="col-lg-2 col-md-2 col-sm-12 search-container">
				    <h4>Filter Options</h4>
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-12 date-picker-column">
					<div>
						<!-- From:-->
						<div class='date-picker-content'>
							<input type="text" placeholder="Select from.." data-input class="flatpickr" /> <!-- input is mandatory -->
						</div>
					</div>
					<div>
						<!-- To:-->
						<div class='date-picker-content'>
							<input type="text" placeholder="Select to.." data-input class="flatpickr-to" /> <!-- input is mandatory -->
						</div>
					</div>
				</div><!-- end date picker -->

				<div class="col-lg-3 col-md-3 col-sm-12 search-container">
					<!--                    Search by name:-->
					<form>
						<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						
				</div>

				<div class="col-lg-2 col-md-2 col-sm-12 search-container">
				<button class="btn btn-outline-success my-2 my-sm-0 button grid-button" type="submit">Search</button>
					</form>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 search-container">
				    <button type="button" class="btn button-security my-2 my-sm-0 button grid-button" data-toggle="modal" data-target="#addNewModal">Add new</button>
				</div>
			</div><!-- end grid header -->
			<!-- SINGLE GIRD ITEM -->
			<?php
			if(!empty($employees))
			{
			foreach ($employees as $employee)
			{
			?>
			<div class="grid-item" <?php if (intval($employee->expiration_time) < $time){ ?>style="background-color:rgba(226, 95, 42)" <?php } ?>>
				<div class="item-header">
					<p class="item-description">Name: <?php echo $employee->username; ?></p>
					<p class="item-category">Email: <?php echo $employee->email; ?></p>
					<p class="item-category">INSZ number: <?php echo $employee->INSZnumber; ?></p>
					<p class="item-category">Unique number: <?php echo $employee->uniquenumber; ?></p>
					<!-- <p class="item-category"><?php #echo date('Y-m-d H:i:s', $employee->expiration_time); ?></p> -->
					<!-- <p class="item-category"><? #echo date('Y-m-d H:i:s', $employee->validitytime); ?></p>
							<p class="item-category"><? #echo date('Y-m-d H:i:s', $employee->expiration_time); ?></p>
							<p class="item-category"><? #echo $employee->expiration_time_value; ?></p>
							<p class="item-category"><? #echo $employee->expiration_time_type; ?></p> -->
				</div><!-- end item header -->
				<div class="grid-footer">
					<div class="iconWrapper">
						<span class="fa-stack fa-2x edit-icon btn-edit-item" onclick="editEmployee('<?php echo $employee->id; ?>')">
							<i class="far fa-edit"></i>
						</span>
					</div>
					<div 
						title="Click to delete employee" class="iconWrapper delete-icon-wrapper"
						onclick="deleteObject(
							this,
							'<?php echo $this->baseUrl . 'index.php/employee/deleteEmployee/' . $employee->id; ?>'
						)">
								<span class="fa-stack fa-2x delete-icon">
									<i class="fas fa-times"></i>
								</span>
					</div>
					<div class="iconWrapper"  onclick="emailEmployee(
						<?php echo $employee->id ?>,
						'<?php echo $this->baseUrl . 'index.php/employee/emailEmployee'; ?>'
					)">
                        <span class="fa-stack fa-2x print-icon">
                            <i class="fas fa-envelope"></i>
                        </span>
					</div>
				</div>
				<button style="display: none" type="button" id="editEmployee<?php echo $employee->id; ?>" class="btn btn-primary" data-toggle="modal" data-target="#editEmployee<?php echo $employee->id; ?>Modal">Edit</button>
				<!-- Edit Modal -->
<div class="modal fade" id="editEmployee<?php echo $employee->id; ?>Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- ITEM EDITOR -->
				<div class="item-editor" id="editEmployeeId<?php echo $employee->id; ?>">
					<div class="edit-single-user-container">
						<form class="form-inline" id="editEmployeeForm<?php echo $employee->id; ?>" method="post" action="<?php echo $this->baseUrl . 'index.php/employeeEdit/' . $employee->id; ?>" >
							<div>
								<label for="username<?php echo $employee->id; ?>">Name</label>
								<input type="text" class="form-control" id="username<?php echo $employee->id; ?>" name="username" required value="<?php echo $employee->username; ?>" />
							</div>
							<div>
								<label for="email<?php echo $employee->id; ?>">Email</label>
								<input type="text" class="form-control" id="email<?php echo $employee->id; ?>" name="email" required value="<?php echo $employee->email; ?>"  />
							</div>
							<div>
								<label for="validitytime<?php echo $employee->id; ?>">Validity time</label>
								<input type="text" data-input class="form-control flatpickr-to" id="validitytime<?php echo $employee->id; ?>" value="<?php echo date("Y-m-d H:i:s", intval($employee->validitytime)); ?>" name="validitytime" readonly disabled />
							</div>
							<div>
								<label for="expiration_time<?php echo $employee->id; ?>">Expiration time</label>
								<input type="text" data-input class="form-control flatpickr-to" id="expiration_time<?php echo $employee->id; ?>" value="<?php echo date("Y-m-d H:i:s", intval($employee->expiration_time)); ?>" name="expiration_time"  readonly disabled />
							</div>
							<div>
								<label for="expiration_time_value<?php echo $employee->id; ?>">Expiration time value</label>
								<input type="number" step="1" min="1" class="form-control" id="expiration_time_value<?php echo $employee->id; ?>" name="expiration_time_value" value="<?php echo $employee->expiration_time_value; ?>" required />
							</div>
							<div>
								<label for="expiration_time_type<?php echo $employee->id; ?>">Expiration time type</label>
								<select class="form-control" id="expiration_time_type<?php echo $employee->id; ?>" name="expiration_time_type" required>
									<option value="">Select</option>
									<option <?php if ($employee->expiration_time_type === 'minutes') echo 'selected'; ?> value="minutes">Minutes</option>
									<option <?php if ($employee->expiration_time_type === 'hours') echo 'selected'; ?> value="hours">Hours</option>
									<option <?php if ($employee->expiration_time_type === 'days') echo 'selected'; ?> value="days">Days</option>
									<option <?php if ($employee->expiration_time_type === 'months') echo 'selected'; ?> value="months">Months</option>
								</select>
							</div>
							<div>
								<label for="INSZnumber<?php echo $employee->id; ?>">INSZ number</label>
								<input
									type="text"
									class="form-control"
									value="<?php echo $employee->INSZnumber; ?>"
									id="INSZnumber<?php echo $employee->id; ?>"
									name="INSZnumber"
								/>
							</div>
						</form>
					</div>
				</div>
      </div>
      <div class="modal-footer">
	    <input style="width: 100px;" type="button" onclick="submitForm('editEmployeeForm<?php echo $employee->id; ?>')" class="grid-button button theme-editor-header-button" value="Submit" />
        <button style="width: 100px;" type="button" class="grid-button-cancel button theme-editor-header-button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
				
				<!-- END EDIT FOR NEW USER -->
			</div>
			<!-- END SINGLE GRID ITEM -->
			<?php
			}
			}
			?>
		</div>
		<!-- end grid list -->
	</div>
</div>
<script>

function editEmployee(employeeId){
	$('#editEmployee'+employeeId).click();
}
</script>
