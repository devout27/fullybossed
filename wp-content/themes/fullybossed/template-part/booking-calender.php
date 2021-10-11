<?php
/*
 * Template Name: Booking Calender Template
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @page FullyBossed
 * @since FullyBossed 1.0
 */
get_header(); ?>

<div class="content">
	<div class="booking-process u-h-spacing ubg-grey">
		<div class="container">
			<div class="booking-process-inner">
				<ul>
					<li><span></span> Booking Sessions</li>
					<li class="active"><span></span> Booking Calendar</li>
					<li><span></span> Booking Summary</li>
					<li><span></span> Booking Payment</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="booking-fields u-spacing ubg-white">
		<div class="container">
			<div class="booking-calender-area">
				<div class="calender-action">
					<div class="row align-items-end">
					   	<div class="col-sm-6 col-md-8">
					   		<div class="dark">
								<h3>July 2021</h3>
								<h6>Today 09-02-2021</h6>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="calender-nav">
								<a href="#" class="calender-prev"><i class="fas fa-angle-left"></i></a>
								<a href="#" class="calender-next"><i class="fas fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="booking-table">
					<table>
						<thead>
							<tr>
								<th>Session Time</th>
								<th>Monday <br>July 12</th>
								<th>Tuesday <br>July 13</th>
								<th>Wednesday <br>July 14</th>
								<th>Thursday <br>July 15</th>
								<th>Friday <br>July 16</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									01:00pm - 02:00pm <br>
									<span class="booking-price">$80.00 / Session</span>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-avail">
									<input type="radio" value="1" name="available">
									<p><span>Available</span></p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
							</tr>
							<tr>
								<td>
									02:00pm - 03:00pm <br>
									<span class="booking-price">$80.00 / Session</span>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-avail">
									<input type="radio" value="2" name="available">
									<p><span>Available</span></p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
							</tr>
							<tr>
								<td>
									03:00pm - 04:00pm <br>
									<span class="booking-price">$80.00 / Session</span>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
							</tr>
							<tr>
								<td>
									04:00pm - 05:30pm <br>
									<span class="booking-price">$80.00 / Session</span>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-avail">
									<input type="radio" value="4" name="available">
									<p><span>Available</span></p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
								<td class="b-not-avail">
									<p>Not <br>Available</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="u-row text-center u-sitecolor-btn">
					<a href="/booking-sessions"><button type="submit" class="back"><i class="fas fa-chevron-left"></i> Back</button></a>
					<a href="/booking-summary"><button type="submit">Continue</button></a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>