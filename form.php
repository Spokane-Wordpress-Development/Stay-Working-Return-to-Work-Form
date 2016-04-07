<form class="form-horizontal">

	<h2>Injury Worker's Information</h2>

	<div class="form-group">
		<label for="first-name" class="col-sm-2 control-label">Email:</label>
		<div class="col-sm-4">
			<input class="form-control" id="first-name" name="first_name">
		</div>
		<label for="address-1" class="col-sm-2 control-label">Address 1:</label>
		<div class="col-sm-4">
			<input class="form-control" id="address-1" name="address1">
		</div>
	</div>

	<div class="form-group">
		<label for="last-name" class="col-sm-2 control-label">Last Name:</label>
		<div class="col-sm-4">
			<input class="form-control" id="last-name" name="last_name">
		</div>
		<label for="address-2" class="col-sm-2 control-label">Address 2:</label>
		<div class="col-sm-4">
			<input class="form-control" id="address-2" name="address2">
		</div>
	</div>

	<div class="form-group">
		<label for="claim-number" class="col-sm-2 control-label">L&I Claim #:</label>
		<div class="col-sm-4">
			<input class="form-control" id="claim-number" name="claim_number">
		</div>
		<label for="city" class="col-sm-2 control-label">City:</label>
		<div class="col-sm-4">
			<input class="form-control" id="city" name="city">
		</div>
	</div>

	<div class="form-group">
		<label for="state" class="col-sm-8 control-label">State:</label>
		<div class="col-sm-4">
			<select id="state" name="state" class="form-control">
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
		<label for="zip" class="col-sm-8 control-label">Zip:</label>
		<div class="col-sm-4">
			<input class="form-control" id="zip" name="zip">
		</div>
	</div>

	<h2>Dates</h2>

	<div class="form-group">
		<label for="doctor-approval" class="col-sm-2 control-label">Doctor's Approval:</label>
		<div class="col-sm-4">
			<input class="form-control date-picker" id="doctor-approval" name="doctor_approval">
		</div>
		<label for="report-to-work" class="col-sm-2 control-label">Report to Work:</label>
		<div class="col-sm-4">
			<input class="form-control date-picker" id="report-to-work" name="report_to_work">
		</div>
	</div>

	<h2>Working Hours and Days</h2>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="start-time" class="col-sm-4 control-label">Start Time:</label>
				<div class="col-sm-8">
					<input class="form-control" id="start-time" name="start_time" placeholder="hh:mm AM/PM">
				</div>
			</div>
			<div class="form-group">
				<label for="end-time" class="col-sm-4 control-label">End Time:</label>
				<div class="col-sm-8">
					<input class="form-control" id="end-time" name="end_time" placeholder="hh:mm AM/PM">
				</div>
			</div>
			<div class="form-group">
				<label for="hours-per-week" class="col-sm-4 control-label">Hours Perk Week:</label>
				<div class="col-sm-8">
					<input class="form-control" id="hours-per-week" name="hours_per_week">
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="days-of-week" class="col-sm-4 control-label">Days of the Week:</label>
				<div class="col-sm-8">
					<input type="checkbox" id="days-of-week" name="day_of_week[]" value="1"> Monday<br>
					<input type="checkbox" id="days-of-week" name="day_of_week[]" value="2"> Tuesday<br>
					<input type="checkbox" id="days-of-week" name="day_of_week[]" value="3"> Wednesday<br>
					<input type="checkbox" id="days-of-week" name="day_of_week[]" value="4"> Thursday<br>
					<input type="checkbox" id="days-of-week" name="day_of_week[]" value="5"> Friday<br>
					<input type="checkbox" id="days-of-week" name="day_of_week[]" value="6"> Saturday<br>
					<input type="checkbox" id="days-of-week" name="day_of_week[]" value="7"> Sunday
				</div>
			</div>
		</div>
	</div>

	<h2>Wages</h2>

	<div class="form-group">
		<label for="dollar-amount" class="col-sm-2 control-label">Dollar Amount $:</label>
		<div class="col-sm-4">
			<input class="form-control" id="dollar-amount" name="dollar_amount">
		</div>
		<label for="per" class="col-sm-2 control-label">Per:</label>
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
		<label for="location-address" class="col-sm-2 control-label">Location Address:</label>
		<div class="col-sm-4">
			<input class="form-control" id="location-address" name="location_address">
		</div>
		<label for="supervisor-name" class="col-sm-2 control-label">Supervisor Name:</label>
		<div class="col-sm-4">
			<input class="form-control" id="supervisor-name" name="supervisor_name">
		</div>
	</div>

	<div class="form-group">
		<label for="location-city" class="col-sm-2 control-label">Location Ciy:</label>
		<div class="col-sm-4">
			<input class="form-control" id="location-city" name="location_city">
		</div>
		<label for="contact-phone" class="col-sm-2 control-label">Contact Phone #:</label>
		<div class="col-sm-4">
			<input class="form-control" id="contact-phone" name="contact_phone">
		</div>
	</div>

	<div class="form-group">
		<label for="location-state" class="col-sm-2 control-label">Location State:</label>
		<div class="col-sm-4">
			<select id="location-state" name="location_state" class="form-control">
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
		<label for="valediction" class="col-sm-2 control-label">Valediction:</label>
		<div class="col-sm-4">
			<input class="form-control" id="valediction" name="valediction">
		</div>
	</div>

	<div class="form-group">

		<label for="location-zip" class="col-sm-2 control-label">Location Zip:</label>
		<div class="col-sm-4">
			<input class="form-control" id="location-zip" name="location_zip">
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
				<label for="job-length" class="col-sm-4 control-label">Job Length:</label>
				<div class="col-sm-8">
					<input type="checkbox" id="job-length" name="job_length[]" value="transitional/light duty"> transitional/light duty<br>
					<input type="checkbox" id="job-length" name="job_length[]" value="permanent"> permanent
				</div>
			</div>
		</div>
	</div>

	<h2>Offer Letter Language Selection</h2>

	<div class="form-group">
		<label for="language" class="col-sm-2 control-label">Language(s):</label>
		<div class="col-sm-4">
			<input type="checkbox" id="language" name="language[]" value="English"> English<br>
			<input type="checkbox" id="language" name="language[]" value="Russian"> Russian<br>
			<input type="checkbox" id="language" name="language[]" value="Spanish"> Spanish
		</div>
	</div>

	<p class="pull-right">
		<button class="btn btn-primary">
			Generate Letter(s)
		</button>
	</p>

</form>
