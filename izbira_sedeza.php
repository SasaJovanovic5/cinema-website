<?php
	include ('includes/headerSedezi.html');
	//echo"<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css\" integrity=\"sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2\" crossorigin=\"anonymous\">";
?>
		<link rel="stylesheet" type="text/css" href="jquery.seat-charts.css">
		<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
		<script src="jquery.seat-charts.js"></script>
		<style>
			
			.front-indicator {
				width: 145px;
				margin: 5px 32px 15px 32px;
				background-color: #f6f6f6;	
				color: #adadad;
				text-align: center;
				padding: 3px;
				border-radius: 5px;
			}
			.wrapper {
				width: 100%;
				text-align: center;
			    margin-top:150px;
			}
			.container {
				margin: 0 auto;
				width: 500px;
				text-align: left;
			}
			.booking-details {
				float: left;
				text-align: left;
				margin-left: 35px;
				font-size: 12px;
				position: relative;
				height: 401px;
			}
			.booking-details h2 {
				margin: 25px 0 20px 0;
				font-size: 17px;
			}
			.booking-details h3 {
				margin: 5px 5px 0 0;
				font-size: 14px;
			}
			div.seatCharts-cell {
				color: #182C4E;
				height: 25px;
				width: 25px;
				line-height: 25px;
				
			}
			div.seatCharts-seat {
				color: #FFFFFF;
				cursor: pointer;	
			}
			div.seatCharts-row {
				height: 35px;
			}
			div.seatCharts-seat.available {
				background-color: #B9DEA0;

			}
			div.seatCharts-seat.available.first-class {
			/* 	background: url(vip.png); */
				background-color: #3a78c3;
			}
			div.seatCharts-seat.focused {
				background-color: #76B474;
			}
			div.seatCharts-seat.selected {
				background-color: #E6CAC4;
			}
			div.seatCharts-seat.unavailable {
				background-color: #472B34;
			}
			div.seatCharts-container {
				border-right: 1px dotted #adadad;
				width: 200px;
				padding: 20px;
				float: left;
			}
			div.seatCharts-legend {
				padding-left: 0px;
				position: absolute;
				bottom: 16px;
			}
			ul.seatCharts-legendList {
				padding-left: 0px;
			}
			span.seatCharts-legendDescription {
				margin-left: 5px;
				line-height: 30px;
			}
			.checkout-button {
				display: block;
				margin: 10px 0;
				font-size: 14px;
			}
			#selected-seats {
				max-height: 90px;
				overflow-y: scroll;
				overflow-x: none;
				width: 170px;
			}
		</style>

<?php
	
		$zasedeno = array();
	$pid = $_GET['pid'];
	$q1 = "SELECT film.id AS film_id, projekcija.id AS projekcija_id, film.naslov AS naslov, projekcija.datum AS datum, projekcija.ura AS ura FROM film, projekcija WHERE projekcija.id = '$pid' AND film.id = projekcija.TK_film";
	$q2 = "SELECT film.id AS film_id, projekcija.id AS projekcija_id, film.naslov AS naslov, projekcija.datum AS datum, projekcija.ura AS ura, karta.id AS karta_id, karta.sedez AS sedez FROM film, projekcija, karta WHERE projekcija.id = '$pid' AND film.id = projekcija.TK_film AND projekcija.id = karta.TK_projekcija";

	$r1 = mysqli_query ($dbc, $q1);
	$r2 = mysqli_query ($dbc, $q2);
	while($row1 = mysqli_fetch_array($r1)) {
		$naslov = $row1['naslov'];
		$datum = $row1['datum'];
		$ura = $row1['ura'];
		
		
		
	}

	while($row2 = mysqli_fetch_array($r2)) {
		
		$zasedeno[$row2['karta_id']] = $row2['sedez'];
		
		
	}
	
	



?>
	<div class="wrapper">
		<div class="container">
				
			<div id="seat-map">
				<div class="front-indicator">Front</div>
			</div>
			<p id='info'></p>
			<div class="booking-details">
				<h2>Booking Details</h2>
				<h3>Film: </h3> <?php echo $naslov; ?>
				<h3>Datum: </h3> <?php echo $datum; ?>
				<h3>Ura: </h3> <?php echo $ura; ?> 
				<h3> Selected Seats (<span id="counter">0</span>):</h3>
				<ul id="selected-seats">
				</ul>
				Total: <b>€<span id="total">0</span></b>
				<button id="kupi" class="checkout-button" type="submit" value="submit">Checkout &raquo;</button>
				<div id="legend"></div>
			</div>
		</div>
	</div>
	<script>
		var firstSeatLabel = 1;
		
		$(document).ready(function() {
			var $cart = $('#selected-seats'),
				$counter = $('#counter'),
				$total = $('#total'),
				sc = $('#seat-map').seatCharts({
				map: [
					'eeeee',
					'eeeee',
					'eeeee',
					'eeeee',
					'eeeee',
					'eeeee',
					'eeeee',
					'eeeee',
					'eeeee',
				],
				seats: {
					e: {
						price   : 4,
						classes : 'economy-class', //your custom CSS class
						category: 'Sedez'
					}					
				
				},
				naming : {
					top : false,
					getLabel : function (character, row, column) {
						return firstSeatLabel++;
					},
				},
				legend : {
					node : $('#legend'),
					items : [
						[ 'e', 'available',   'Sedez'],
						[ 'f', 'unavailable', 'Zasedeno']
					]					
				},
				click: function () {
					if (this.status() == 'available') {
						//let's create a new <li> which we'll add to the cart items
						$('<li>'+this.data().category+' '+this.settings.label+': <b>€'+this.data().price+'</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
							.attr('id', 'cart-item-'+this.settings.id)
							.data('seatId', this.settings.id)
							.appendTo($cart);
						
						/*
						 * Lets update the counter and total
						 *
						 * .find function will not find the current seat, because it will change its stauts only after return
						 * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
						 */
						$counter.text(sc.find('selected').length+1);
						$total.text(recalculateTotal(sc)+this.data().price);
						console.log(this.settings.id);
						
						return 'selected';
					} else if (this.status() == 'selected') {
						//update the counter
						$counter.text(sc.find('selected').length-1);
						//and total
						$total.text(recalculateTotal(sc)-this.data().price);
					
						//remove the item from our cart
						$('#cart-item-'+this.settings.id).remove();
					
						//seat has been vacated
						return 'available';
					} else if (this.status() == 'unavailable') {
						//seat has been already booked
						return 'unavailable';
					} else {
						return this.style();
					}
				}
			});
			$("#kupi").click(function(){

				let izbraniSedezi = [];
				sc.find('selected').each(function() {
					
					izbraniSedezi.push(this.settings.id);
					
				});
				
				var jsonKarta = '{"karta":[]}';
				var obj = JSON.parse(jsonKarta);

				for(i = 0; i < izbraniSedezi.length; i++) {

					obj['karta'].push({"TK_projekcija":"<?php echo $pid; ?>","sedez":izbraniSedezi[i], "cena": "4"});
					



				}
				
				jsonKarta = JSON.stringify(obj);



				console.log(jsonKarta);
				

			});

			//this will handle "[cancel]" link clicks
			$('#selected-seats').on('click', '.cancel-cart-item', function () {
				//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
				sc.get($(this).parents('li:first').data('seatId')).click();
			});

			//let's pretend some seats have already been booked
			 
			<?php 
			foreach($zasedeno as $zassedez) {
				echo"sc.get(['{$zassedez}']).status('unavailable');";
			}
			
			?>
			
			
			
			

			
	
		});

		function recalculateTotal(sc) {
			var total = 0;
			
	
			//basically find every selected seat and sum its price
			sc.find('selected').each(function () {
				
				total += this.data().price;
				
				
			});
			
			return total;
		}

		




	
	</script>
<?php  ?>

<?php 
mysqli_close($dbc);
include ('includes/footerSedezi.html'); ?>