<form class="form-horizontal" method="post" id="return-to-work-form">

	<input type="hidden" name="return_to_work_form" value="submit">

	<div id="error-messages"></div>

	<h2>Injury Worker's Information</h2>

	<div class="form-group">
		<label for="first-name" class="col-sm-2 control-label"><span class="required">*</span> First Name:</label>
		<div class="col-sm-4">
			<input class="form-control" id="first-name" name="first_name" data-required="1" data-name="First Name">
		</div>
		<label for="address-1" class="col-sm-2 control-label"><span class="required">*</span> Address 1:</label>
		<div class="col-sm-4">
			<input class="form-control" id="address-1" name="address1" data-required="1" data-name="Address 1">
		</div>
	</div>

	<div class="form-group">
		<label for="last-name" class="col-sm-2 control-label"><span class="required">*</span> Last Name:</label>
		<div class="col-sm-4">
			<input class="form-control" id="last-name" name="last_name" data-required="1" data-name="Last Name">
		</div>
		<label for="address-2" class="col-sm-2 control-label">Address 2:</label>
		<div class="col-sm-4">
			<input class="form-control" id="address-2" name="address2">
		</div>
	</div>

	<div class="form-group">
		<label for="claim-number" class="col-sm-2 control-label"><span class="required">*</span> L&I Claim #:</label>
		<div class="col-sm-4">
			<input class="form-control" id="claim-number" name="claim_number" data-required="1" data-name="Claim Number">
		</div>
		<label for="city" class="col-sm-2 control-label"><span class="required">*</span> City:</label>
		<div class="col-sm-4">
			<input class="form-control" id="city" name="city" data-required="1" data-name="City">
		</div>
	</div>

	<div class="form-group">
		<label for="state" class="col-sm-8 control-label"><span class="required">*</span> State:</label>
		<div class="col-sm-4">
			<select id="state" name="state" class="form-control" data-required="1" data-name="State">
				<option value="">
					- Choose a State -
				</option>
				<?php foreach ($this->states as $abbr => $title) { ?>
					<option value="<?php echo $abbr; ?>">
						<?php echo $title; ?>
					</option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="zip" class="col-sm-8 control-label"><span class="required">*</span> Zip:</label>
		<div class="col-sm-4">
			<input class="form-control" id="zip" name="zip" data-required="1" data-name="Zip">
		</div>
	</div>

	<h2>Dates</h2>

	<div class="form-group">
		<label for="doctor-approval" class="col-sm-2 control-label"><span class="required">*</span> Doctor's Approval:</label>
		<div class="col-sm-4">
			<input class="form-control date-picker" id="doctor-approval" name="doctor_approval" data-required="1" data-name="Doctor Approval Date">
		</div>
		<label for="report-to-work" class="col-sm-2 control-label"><span class="required">*</span> Report to Work:</label>
		<div class="col-sm-4">
			<input class="form-control date-picker" id="report-to-work" name="report_to_work" data-required="1" data-name="Report to Work Date">
		</div>
	</div>

	<h2>Working Hours and Days</h2>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="start-time" class="col-sm-4 control-label"><span class="required">*</span> Start Time:</label>
				<div class="col-sm-8">
					<input class="form-control" id="start-time" name="start_time" placeholder="hh:mm AM/PM" data-required="1" data-name="Start Time">
				</div>
			</div>
			<div class="form-group">
				<label for="end-time" class="col-sm-4 control-label"><span class="required">*</span> End Time:</label>
				<div class="col-sm-8">
					<input class="form-control" id="end-time" name="end_time" placeholder="hh:mm AM/PM" data-required="1" data-name="End Time">
				</div>
			</div>
			<div class="form-group">
				<label for="hours-per-week" class="col-sm-4 control-label"><span class="required">*</span> Hours Per Week:</label>
				<div class="col-sm-8">
					<input class="form-control" id="hours-per-week" name="hours_per_week" data-required="1" data-name="Hours Per Week">
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="days-of-week" class="col-sm-4 control-label"><span class="required">*</span> Days of the Week:</label>
				<div class="col-sm-8">
					<input type="checkbox" class="days-of-week" name="day_of_week[]" value="Monday"> Monday<br>
					<input type="checkbox" class="days-of-week" name="day_of_week[]" value="Tuesday"> Tuesday<br>
					<input type="checkbox" class="days-of-week" name="day_of_week[]" value="Wednesday"> Wednesday<br>
					<input type="checkbox" class="days-of-week" name="day_of_week[]" value="Thursday"> Thursday<br>
					<input type="checkbox" class="days-of-week" name="day_of_week[]" value="Friday"> Friday<br>
					<input type="checkbox" class="days-of-week" name="day_of_week[]" value="Saturday"> Saturday<br>
					<input type="checkbox" class="days-of-week" name="day_of_week[]" value="Sunday"> Sunday
				</div>
			</div>
		</div>
	</div>

	<h2>Wages</h2>

	<div class="form-group">
		<label for="dollar-amount" class="col-sm-2 control-label"><span class="required">*</span> Dollar Amount $:</label>
		<div class="col-sm-4">
			<input class="form-control" id="dollar-amount" name="dollar_amount" data-required="1" data-name="Dollar Amount">
		</div>
		<label for="per" class="col-sm-2 control-label"><span class="required">*</span> Per:</label>
		<div class="col-sm-4">
			<select name="per" id="per" class="form-control">
				<option value="hour">hour</option>
				<option value="day">day</option>
				<option value="week">week</option>
			</select>
		</div>
	</div>

	<h2>Miscellaneous Information</h2>

	<div class="form-group">
		<label for="location-address" class="col-sm-2 control-label"><span class="required">*</span> Location Address:</label>
		<div class="col-sm-4">
			<input class="form-control" id="location-address" name="location_address" data-required="1" data-name="Location Address">
		</div>
		<label for="supervisor-name" class="col-sm-2 control-label"><span class="required">*</span> Supervisor Name:</label>
		<div class="col-sm-4">
			<input class="form-control" id="supervisor-name" name="supervisor_name" data-required="1" data-name="Supervisor Name">
		</div>
	</div>

	<div class="form-group">
		<label for="location-city" class="col-sm-2 control-label"><span class="required">*</span> Location City:</label>
		<div class="col-sm-4">
			<input class="form-control" id="location-city" name="location_city" data-required="1" data-name="Location City">
		</div>
		<label for="contact-phone" class="col-sm-2 control-label"><span class="required">*</span> Contact Phone #:</label>
		<div class="col-sm-4">
			<input class="form-control" id="contact-phone" name="contact_phone" data-required="1" data-name="Contact Phone">
		</div>
	</div>

	<div class="form-group">
		<label for="location-state" class="col-sm-2 control-label"><span class="required">*</span> Location State:</label>
		<div class="col-sm-4">
			<select id="location-state" name="location_state" class="form-control" data-required="1" data-name="Location State">
				<option value="">
					- Choose a State -
				</option>
				<?php foreach ($this->states as $abbr => $title) { ?>
					<option value="<?php echo $abbr; ?>">
						<?php echo $title; ?>
					</option>
				<?php } ?>
			</select>
		</div>
		<label for="location-zip" class="col-sm-2 control-label"><span class="required">*</span> Location Zip:</label>
		<div class="col-sm-4">
			<input class="form-control" id="location-zip" name="location_zip" data-required="1" data-name="Location Zip">
		</div>
	</div>

	<h2>CC / Job Length</h2>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="cc1" class="col-sm-4 control-label">CC Line 1:</label>
				<div class="col-sm-8">
					<input class="form-control" id="cc1" name="cc1" placeholder="Claim Manager w/encl.">
				</div>
			</div>
			<div class="form-group">
				<label for="cc2" class="col-sm-4 control-label">CC Line 2:</label>
				<div class="col-sm-8">
					<input class="form-control" id="cc2" name="cc2" placeholder="Physician w/encl.">
				</div>
			</div>
			<div class="form-group">
				<label for="cc3" class="col-sm-4 control-label">CC Line 3:</label>
				<div class="col-sm-8">
					<input class="form-control" id="cc3" name="cc3" placeholder="Additional CC">
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="job-length" class="col-sm-4 control-label"><span class="required">*</span> Job Length:</label>
				<div class="col-sm-8">
					<input type="checkbox" class="job-length" name="job_length[]" value="transitional/light duty"> transitional/light duty<br>
					<input type="checkbox" class="job-length" name="job_length[]" value="permanent"> permanent
				</div>
			</div>
		</div>
	</div>

	<h2>Offer Letter Language Selection</h2>

	<div class="form-group">
		<label for="language" class="col-sm-2 control-label"><span class="required">*</span> Language(s):</label>
		<div class="col-sm-4">
			<input type="checkbox" class="language" name="language[]" value="English"> English<br>
			<input type="checkbox" class="language" name="language[]" value="Russian"> Russian<br>
			<input type="checkbox" class="language" name="language[]" value="Spanish"> Spanish
		</div>
	</div>

	<p class="pull-right">
		<button class="btn btn-primary">
			Generate Letter(s)
		</button>
	</p>

</form>
