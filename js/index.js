$(document).ready(function() {
	$("#limpar-form").click(function() {
		$("#clear-input > .form-group")
			.find("input")
			.val("");
	});

	$(".login-form").submit(function(event) {		
		if(!$(this).find("input").prop('required')){
			event.preventDefault();
			location.reload();
		}
	});

	$(".register-form").submit(function(event) {		
		if(!$(this).find("input").prop('required')){
			event.preventDefault();
			location.reload();
		}
	});

	$("#search-voo").keyup(function() {
		nVoo = $(this).val();

		$.ajax({
			url: "http://localhost:81/airline/voos/search",
			method: "GET",
			data: {
				nVoo: nVoo
			},
			dataType: "json",
			success: function(data) {
				if(nVoo) {
					if(data == undefined || data.length == 0) {
						console.log("data is empty");
					} else {
						$("#reservas-table").find("tbody").empty();

						for(let i = 0; i < data.length; i++) {
							var result =
								"<tr>" +
								"<td class='align-middle'>" + data[i].nome +
								"</td><td class='align-middle'>" + data[i].nif +
								"</td><td class='align-middle'>" + data[i].nReserva +
								"</td><td class='align-middle'>" + data[i].nVoo +
								"</td><td class='align-middle'>" + "24/02/2020" +
								"</td><td class='align-middle'>" + data[i].origemNome +
								"</td><td class='align-middle'>" + data[i].destinoNome +
								"</td><td class='align-middle'>" + data[i].valor + " €" +
								"</td><td>" + "<div class='actions-wrapper'>" +
								"<?php echo form_open('voos/edit/' + data[i].reservaId + '); ?>" +
								"<button type='submit' class='btn btn-info mr-3'>Edit</button>" +
								"<?php echo form_close(); ?>" +
								"<?php echo form_open('voos/delete/ + data[i].reservaId + '); ?>" +
								"<button type='submit' class='btn btn-danger'>Delete</button>" +
								"<?php echo form_close(); ?>" +
								"</div></td>" +
								"</tr>";

							$("#reservas-table")
								.find("tbody")
								.append(result);
						}
					}
				} else {
					console.log("input is empty");
				}
			},
			error: function(data) {
				alert("Error");
			}
		});
	});
});