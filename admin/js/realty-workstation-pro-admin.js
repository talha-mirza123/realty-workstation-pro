(function( $ ) {

	const validateEmail = (email) => {
		return String(email)
		  .toLowerCase()
		  .match(
			/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		  );
	};

	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;
	
		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
	
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
		return false;
	};

	function calculateCommission() {
		var totalCommission = $(document).find(".total-commission").maskMoney('unmasked')[0];
		var agentPayout = $(document).find(".agent-payout");
		var brokerReferral = $(document).find(".broker-referral").is(":checked");
		var commission = agentPayout.attr("data-commission");
		var lease = agentPayout.attr("data-lease");
		var saleAndPurchase = agentPayout.attr("data-sale-and-purchase");
		var transactionType = agentPayout.attr("data-transaction-type");
		if (totalCommission && parseInt(totalCommission) > 0) {
			if (brokerReferral) {
				if (transactionType == "Sale" || transactionType == "Purchase") {
					var agentPayoutValue = (parseFloat(saleAndPurchase)) * parseInt(totalCommission);
					agentPayout.maskMoney('mask', agentPayoutValue);
					$(document).find(".commission-percentage").text(parseFloat(saleAndPurchase) * 100);
				}
				if (transactionType == "Lease - Tenant" || transactionType == "Lease - Landlord") {
					var agentPayoutValue = (parseFloat(lease)) * parseInt(totalCommission);
					agentPayout.maskMoney('mask', agentPayoutValue);
					$(document).find(".commission-percentage").text(parseFloat(lease) * 100);
				}
			} else {
				var agentPayoutValue = (parseFloat(commission)) * parseInt(totalCommission);
				agentPayout.maskMoney('mask', agentPayoutValue);
				$(document).find(".commission-percentage").text(parseFloat(commission) * 100);
			}
		} else {
			agentPayout.maskMoney('mask', 0);
		}
	}
	
	$(document).ready( function () {

		// Initialize DataTables
		var dataTable = $(document).find(".realty-workstation-pro-dataTable").DataTable();

		// Initialize MaskMoney
		$(document).find(".rw-mask-money").maskMoney();

		// Calculate Commission if Transaction Edit Page
		if ($(document).find(".edit-transaction-container").length > 0) {
			calculateCommission();
		}

		// Add New Agent Handler
		$(document).on("click", ".add-new-agent-btn", function() {
			var first_name = $(document).find("#first_name").val();
			var last_name = $(document).find("#last_name").val();
			var email = $(document).find("#email").val();
			var password = $(document).find("#password").val();
			var commission = $(document).find("#commission").val();
			var lease = $(document).find("#lease").val();
			var sale_and_purchase = $(document).find("#sale_and_purchase").val();
			if ( ! first_name ) {
				$(document).find(".alert.alert-danger").html("First Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! last_name ) {
				$(document).find(".alert.alert-danger").html("Last Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! email ) {
				$(document).find(".alert.alert-danger").html("Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top	
				}, 2000);
				return false;
			}
			if ( ! password ) {
				$(document).find(".alert.alert-danger").html("Password is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! commission ) {
				$(document).find(".alert.alert-danger").html("Commission is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! lease ) {
				$(document).find(".alert.alert-danger").html("Lease Commission is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! sale_and_purchase ) {
				$(document).find(".alert.alert-danger").html("Sale and Purchase Commission is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! validateEmail(email) ) {
				$(document).find(".alert.alert-danger").html("Email is not valid. Please try again.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_add_new_agent',
				'first_name': first_name,
				'last_name': last_name,
				'email': email,
				'password': password,
				'commission': commission,
				'lease': lease,
				'sale_and_purchase': sale_and_purchase,
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				if ( response ) {
					window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-settings&add-success=true';
				} else {
					$(document).find(".alert.alert-danger").html("Email already exist. Please try again.").show();
					$('html, body').animate({
						scrollTop: $(document).find("body").offset().top
					}, 2000);
					return false;
				}
			});
		});

		// Edit Agent Handler
		$(document).on("click", ".edit-agent-btn", function() {
			var agent_id = $(document).find("#agent_id").val();
			var first_name = $(document).find("#first_name").val();
			var last_name = $(document).find("#last_name").val();
			var email = $(document).find("#email").val();
			var password = $(document).find("#password").val();
			var commission = $(document).find("#commission").val();
			var lease = $(document).find("#lease").val();
			var sale_and_purchase = $(document).find("#sale_and_purchase").val();
			if ( ! first_name ) {
				$(document).find(".alert.alert-danger").html("First Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! last_name ) {
				$(document).find(".alert.alert-danger").html("Last Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! email ) {
				$(document).find(".alert.alert-danger").html("Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! commission ) {
				$(document).find(".alert.alert-danger").html("Commission is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! lease ) {
				$(document).find(".alert.alert-danger").html("Lease Commission is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! sale_and_purchase ) {
				$(document).find(".alert.alert-danger").html("Sale and Purchase Commission is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! validateEmail(email) ) {
				$(document).find(".alert.alert-danger").html("Email is not valid. Please try again.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_update_agent',
				'agent_id': agent_id,
				'first_name': first_name,
				'last_name': last_name,
				'email': email,
				'password': password,
				'commission': commission,
				'lease': lease,
				'sale_and_purchase': sale_and_purchase,
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				if ( response ) {
					window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-settings&update-success=true';
				} else {
					$(document).find(".alert.alert-danger").html("Email already exist. Please try again.").show();
					$('html, body').animate({
						scrollTop: $(document).find("body").offset().top
					}, 2000);
					return false;
				}
			});
		});

		// Delete Agent
		$(document).on("click", ".btn-delete-agent", function() {
			var agentID = $(this).data("agent-id");
			Swal.fire({
				title: 'Do you want to delete the agent?',
				confirmButtonText: 'Delete it!',
				confirmButtonColor: '#c82333',
				showCancelButton: true
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var data = {
						'action': 'realty_workstation_pro_delete_agent',
						'agentID': agentID,
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						window.location.href = response;
					});
				}
			});
		});

		// Create a New Agent Transaction
		$(document).on("click", ".add-new-agent-transaction-btn", function() {
			var category = $(document).find("#category").val();
			var agent = $(document).find("#agent").val();
			var type = $(document).find("input[name='type']:checked").val();
			var address = $(document).find("#address").val();
			var apt = $(document).find("#apt").val();
			var city = $(document).find("#city").val();
			var zip = $(document).find("#zip").val();
			var fullname = $(document).find("#fullname").val();
			var company = $(document).find("#company").val();
			var phone = $(document).find("#phone").val();
			var email = $(document).find("#email").val();
			if ( ! agent ) {
				$(document).find(".alert.alert-danger").html("Agent is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! type ) {
				$(document).find(".alert.alert-danger").html("Type is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! address ) {
				$(document).find(".alert.alert-danger").html("Address is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! city ) {
				$(document).find(".alert.alert-danger").html("City is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! zip ) {
				$(document).find(".alert.alert-danger").html("Zip is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! fullname ) {
				$(document).find(".alert.alert-danger").html("Full Name or Main Contact is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! phone ) {
				$(document).find(".alert.alert-danger").html("Phone Number is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! email ) {
				$(document).find(".alert.alert-danger").html("Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( !validateEmail(email) ) {
				$(document).find(".alert.alert-danger").html("Email is not valid. Please try again.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_add_new_transaction',
				'category': category,
				'agent': agent,
				'type': type,
				'address': address,
				'apt': apt,
				'city': city,
				'zip': zip,
				'fullname': fullname,
				'company': company,
				'phone': phone,
				'email': email
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-agent-transactions-settings&add-success=true';
			});
		});

		// Uploading File to Server
		$(document).on("change", ".edit-transaction-container .uploader input[type='file']", function() {
			var thisInput = $(this);
			var currentDataTable = $(this).closest(".form-group").find("table");
			var transactionID = getUrlParameter("transaction-id");
			var documentType = $(this).attr("id");
			var fd = new FormData();
			var file = $(this);
			var document = file[0].files[0];
			if ( document ) {
				var documentSize = document.size;
				documentSize = (documentSize / 1024) / 1024;
				if (documentSize > 25) {
					Swal.fire(
						'Error!',
						'Document should be less than 25 MB.',
						'error'
					);
					return false;
				}
			}
			fd.append("transactionID", transactionID);
			fd.append("documentType", documentType);
			fd.append("document", document);
			fd.append('action', 'realty_workstation_pro_upload_document');
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					thisInput.val("");
					var responseJSON = JSON.parse(response);
					var html = '<tr data-document-id="'+responseJSON.documentID+'">';
					html += '<td><a href="'+responseJSON.documentURL+'" target="_blank">'+responseJSON.documentName+'</a></td>';
					html += '<td><div class="badge bg-success">Uploaded</div></td>';
					html += '<td><button class="button button-primary btn-delete delete-document-btn">Delete</button></td>';
					html += '</tr>';
					currentDataTable.find("tbody").append(html);
					Swal.fire(
						'Success!',
						'Document has been added to the transaction successfully.',
						'success'
					);
				}
			});
		});

		// Deleting Document
		$(document).on("click", ".delete-document-btn", function() {
			var currentRow = $(this).closest("tr");
			var documentID = currentRow.attr("data-document-id");
			Swal.fire({
				title: 'Do you want to delete the document?',
				confirmButtonText: 'Delete it!',
				confirmButtonColor: '#c82333',
				showCancelButton: true
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var data = {
						'action': 'realty_workstation_pro_delete_document',
						'documentID': documentID
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						currentRow.remove();
						Swal.fire(
							'Success!',
							'Document has been deleted from the transaction successfully.',
							'success'
						);
					})
				}
			});
		});

		// Deleting Agent Transaction
		$(document).on("click", ".btn-delete-agent-transaction", function() {
			var currentRow = $(this).closest("tr");
			var transactionID = $(this).attr("data-transaction-id");
			Swal.fire({
				title: 'Do you want to delete the transaction?',
				confirmButtonText: 'Delete it!',
				confirmButtonColor: '#c82333',
				showCancelButton: true
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var data = {
						'action': 'realty_workstation_pro_delete_transaction',
						'transactionID': transactionID
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						dataTable.row(currentRow).remove().draw();
						Swal.fire(
							'Success!',
							'Transaction has been deleted from the system successfully.',
							'success'
						);
					})
				}
			});
		});

		// Calculating Commission
		$(document).on("keyup", ".total-commission", function() {
			calculateCommission();
		});

		// Agent Payout Change
		$(document).on("change", ".broker-referral", function() {
			calculateCommission();
		});

		// Update Agent Transaction Button
		$(document).on("click", ".update-agent-transaction-btn", function() {
			var transactionID = $(document).find("input[name='transaction_id']").val();
			var address = $(document).find("#address").val();
			var apt = $(document).find("#apt").val();
			var city = $(document).find("#city").val();
			var zip = $(document).find("#zip").val();
			var fullname = $(document).find("#fullname").val();
			var company = $(document).find("#company").val();
			var phone = $(document).find("#phone").val();
			var email = $(document).find("#email").val();
			var salesPrice = $(document).find("#sales_price").val();
			var totalCommission = $(document).find("#total_commission").val();
			var brokerReferral = $(document).find("#broker_referral").is(":checked");
			var agentPayout = $(document).find("#agent_payout").val();
			if ( ! address ) {
				$(document).find(".alert.alert-danger").html("Address is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! city ) {
				$(document).find(".alert.alert-danger").html("City is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! zip ) {
				$(document).find(".alert.alert-danger").html("Zip is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! fullname ) {
				$(document).find(".alert.alert-danger").html("Full Name or Main Contact is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! phone ) {
				$(document).find(".alert.alert-danger").html("Phone Number is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! email ) {
				$(document).find(".alert.alert-danger").html("Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( !validateEmail(email) ) {
				$(document).find(".alert.alert-danger").html("Email is not valid. Please try again.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_update_transaction',
				'transactionID': transactionID,
				'address': address,
				'apt': apt,
				'city': city,
				'zip': zip,
				'fullname': fullname,
				'company': company,
				'phone': phone,
				'email': email,
				'salesPrice': salesPrice,
				'totalCommission': totalCommission,
				'brokerReferral': brokerReferral,
				'agentPayout': agentPayout
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-agent-transactions-settings&update-success=true';
			});
		});

		// Close Agent Transaction Button
		$(document).on("click", ".close-agent-transaction-btn", function() {
			var transactionID = $(document).find("input[name='transaction_id']").val();
			var address = $(document).find("#address").val();
			var apt = $(document).find("#apt").val();
			var city = $(document).find("#city").val();
			var zip = $(document).find("#zip").val();
			var fullname = $(document).find("#fullname").val();
			var company = $(document).find("#company").val();
			var phone = $(document).find("#phone").val();
			var email = $(document).find("#email").val();
			var salesPrice = $(document).find("#sales_price").val();
			var totalCommission = $(document).find("#total_commission").val();
			var brokerReferral = $(document).find("#broker_referral").is(":checked");
			var agentPayout = $(document).find("#agent_payout").val();
			var data = {
				'action': 'realty_workstation_pro_close_transaction',
				'transactionID': transactionID,
				'address': address,
				'apt': apt,
				'city': city,
				'zip': zip,
				'fullname': fullname,
				'company': company,
				'phone': phone,
				'email': email,
				'salesPrice': salesPrice,
				'totalCommission': totalCommission,
				'brokerReferral': brokerReferral,
				'agentPayout': agentPayout
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-agent-transactions-settings&closed-agent-transactions=true&closed-success=true';
			});
		});

		// Create a New Broker Transaction
		$(document).on("click", ".add-new-broker-transaction-btn", function() {
			var category = $(document).find("#category").val();
			var type = $(document).find("input[name='type']:checked").val();
			var address = $(document).find("#address").val();
			var apt = $(document).find("#apt").val();
			var city = $(document).find("#city").val();
			var zip = $(document).find("#zip").val();
			var fullname = $(document).find("#fullname").val();
			var company = $(document).find("#company").val();
			var phone = $(document).find("#phone").val();
			var email = $(document).find("#email").val();
			if ( ! type ) {
				$(document).find(".alert.alert-danger").html("Type is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! address ) {
				$(document).find(".alert.alert-danger").html("Address is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! city ) {
				$(document).find(".alert.alert-danger").html("City is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! zip ) {
				$(document).find(".alert.alert-danger").html("Zip is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! fullname ) {
				$(document).find(".alert.alert-danger").html("Full Name or Main Contact is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! phone ) {
				$(document).find(".alert.alert-danger").html("Phone Number is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! email ) {
				$(document).find(".alert.alert-danger").html("Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( !validateEmail(email) ) {
				$(document).find(".alert.alert-danger").html("Email is not valid. Please try again.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_add_new_transaction',
				'category': category,
				'agent': 0,
				'type': type,
				'address': address,
				'apt': apt,
				'city': city,
				'zip': zip,
				'fullname': fullname,
				'company': company,
				'phone': phone,
				'email': email
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-broker-transactions-settings&add-success=true';
			});
		});

		// Deleting Broker Transaction
		$(document).on("click", ".btn-delete-broker-transaction", function() {
			var currentRow = $(this).closest("tr");
			var transactionID = $(this).attr("data-transaction-id");
			Swal.fire({
				title: 'Do you want to delete the transaction?',
				confirmButtonText: 'Delete it!',
				confirmButtonColor: '#c82333',
				showCancelButton: true
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var data = {
						'action': 'realty_workstation_pro_delete_transaction',
						'transactionID': transactionID
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						dataTable.row(currentRow).remove().draw();
						Swal.fire(
							'Success!',
							'Transaction has been deleted from the system successfully.',
							'success'
						);
					});
				}
			});
		});

		// Update Broker Transaction Button
		$(document).on("click", ".update-broker-transaction-btn", function() {
			var transactionID = $(document).find("input[name='transaction_id']").val();
			var address = $(document).find("#address").val();
			var apt = $(document).find("#apt").val();
			var city = $(document).find("#city").val();
			var zip = $(document).find("#zip").val();
			var fullname = $(document).find("#fullname").val();
			var company = $(document).find("#company").val();
			var phone = $(document).find("#phone").val();
			var email = $(document).find("#email").val();
			var salesPrice = $(document).find("#sales_price").val();
			var totalCommission = $(document).find("#total_commission").val();
			var brokerReferral = $(document).find("#broker_referral").is(":checked");
			var agentPayout = $(document).find("#agentPayout").val();
			if ( ! address ) {
				$(document).find(".alert.alert-danger").html("Address is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! city ) {
				$(document).find(".alert.alert-danger").html("City is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! zip ) {
				$(document).find(".alert.alert-danger").html("Zip is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! fullname ) {
				$(document).find(".alert.alert-danger").html("Full Name or Main Contact is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! phone ) {
				$(document).find(".alert.alert-danger").html("Phone Number is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! email ) {
				$(document).find(".alert.alert-danger").html("Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( !validateEmail(email) ) {
				$(document).find(".alert.alert-danger").html("Email is not valid. Please try again.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_update_transaction',
				'transactionID': transactionID,
				'address': address,
				'apt': apt,
				'city': city,
				'zip': zip,
				'fullname': fullname,
				'company': company,
				'phone': phone,
				'email': email,
				'salesPrice': salesPrice,
				'totalCommission': totalCommission,
				'brokerReferral': brokerReferral,
				'agentPayout': agentPayout
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-broker-transactions-settings&update-success=true';
			});
		});

		// Close Broker Transaction Button
		$(document).on("click", ".close-broker-transaction-btn", function() {
			var transactionID = $(document).find("input[name='transaction_id']").val();
			var address = $(document).find("#address").val();
			var apt = $(document).find("#apt").val();
			var city = $(document).find("#city").val();
			var zip = $(document).find("#zip").val();
			var fullname = $(document).find("#fullname").val();
			var company = $(document).find("#company").val();
			var phone = $(document).find("#phone").val();
			var email = $(document).find("#email").val();
			var salesPrice = $(document).find("#sales_price").val();
			var totalCommission = $(document).find("#total_commission").val();
			var brokerReferral = $(document).find("#broker_referral").is(":checked");
			var agentPayout = $(document).find("#agentPayout").val();
			var data = {
				'action': 'realty_workstation_pro_close_transaction',
				'transactionID': transactionID,
				'address': address,
				'apt': apt,
				'city': city,
				'zip': zip,
				'fullname': fullname,
				'company': company,
				'phone': phone,
				'email': email,
				'salesPrice': salesPrice,
				'totalCommission': totalCommission,
				'brokerReferral': brokerReferral,
				'agentPayout': agentPayout
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-broker-transactions-settings&closed-broker-transactions=true&closed-success=true';
			});
		});

		// Save Settings Button Handler
		$(document).on("click", ".save-general-settings-btn", function() {
			var rw_webpage = $(document).find("#rw_webpage").val();
			var rw_name = $(document).find("#rw_name").val();
			var rw_broker_email = $(document).find("#rw_broker_email").val();
			var rw_broker_password = $(document).find("#rw_broker_password").val();
			var rw_bank_name = $(document).find("#rw_bank_name").val();
			var rw_account_name = $(document).find("#rw_account_name").val();
			var rw_account_number = $(document).find("#rw_account_number").val();
			var rw_account_address = $(document).find("#rw_account_address").val();
			if ( ! rw_webpage ) {
				$(document).find(".alert.alert-danger").html("Web Version Page is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! rw_name ) {
				$(document).find(".alert.alert-danger").html("Workstation Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! rw_broker_email ) {
				$(document).find(".alert.alert-danger").html("Broker Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! rw_broker_password ) {
				$(document).find(".alert.alert-danger").html("Broker Password is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! rw_bank_name ) {
				$(document).find(".alert.alert-danger").html("Bank Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! rw_account_name ) {
				$(document).find(".alert.alert-danger").html("Account Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! rw_account_number ) {
				$(document).find(".alert.alert-danger").html("Account Number is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! rw_account_address ) {
				$(document).find(".alert.alert-danger").html("Account Address is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_update_general_settings',
				'rw_webpage': rw_webpage,
				'rw_name': rw_name,
				'rw_broker_email': rw_broker_email,
				'rw_broker_password': rw_broker_password,
				'rw_bank_name': rw_bank_name,
				'rw_account_name': rw_account_name,
				'rw_account_number': rw_account_number,
				'rw_account_address': rw_account_address
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-general-settings&success=true';
			});
		});

		// Activate License Key Handler
		$(document).on("click", ".check-license-key-btn", function() {
			var website = $(this).data("website-url");
			var licenseKey = $(document).find("#rw_license_key").val();
			if ( !licenseKey ) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Please enter license key and then continue.',
				});
				return false;
			} else {
				var data = {
					'licenseKey': licenseKey,
					'website': website
				}
				var settings = {
					"url": "https://www.realtyworkstation.com/wp-json/realty-workstation-license-system/v1/validate-license-key/",
					"method": "POST",
					'data': data 
				};
				$.ajax(settings).success(function (response) {
					var data = {
						'action': 'realty_workstation_pro_activate_license_key_settings',
						'rw_license_key': licenseKey
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-general-settings&success=true';
					});
				}).error(function (response) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: response.responseJSON.message,
					});
					return false;
				});
			}
		});

		// Create a New Lead
		$(document).on("click", ".add-new-lead-btn", function() {
			var type = $(document).find("input[name='type']:checked").val();
			var fullname = $(document).find("#fullname").val();
			var company = $(document).find("#company").val();
			var phone = $(document).find("#phone").val();
			var email = $(document).find("#email").val();
			var address_1 = $(document).find("#address_1").val();
			var apt_1 = $(document).find("#apt_1").val();
			var city_1 = $(document).find("#city_1").val();
			var zip_1 = $(document).find("#zip_1").val();
			var address_2 = $(document).find("#address_2").val();
			var apt_2 = $(document).find("#apt_2").val();
			var city_2 = $(document).find("#city_2").val();
			var zip_2 = $(document).find("#zip_2").val();
			var address_3 = $(document).find("#address_3").val();
			var apt_3 = $(document).find("#apt_3").val();
			var city_3 = $(document).find("#city_3").val();
			var zip_3 = $(document).find("#zip_3").val();
			var address_4 = $(document).find("#address_4").val();
			var apt_4 = $(document).find("#apt_4").val();
			var city_4 = $(document).find("#city_4").val();
			var zip_4 = $(document).find("#zip_4").val();
			if ( ! type ) {
				$(document).find(".alert.alert-danger").html("Type is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! address_1 ) {
				$(document).find(".alert.alert-danger").html("Address is required field for Property 1.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! city_1 ) {
				$(document).find(".alert.alert-danger").html("City is required field for Property 1.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! zip_1 ) {
				$(document).find(".alert.alert-danger").html("Zip is required field for Property 1.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! fullname ) {
				$(document).find(".alert.alert-danger").html("Full Name or Main Contact is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! phone ) {
				$(document).find(".alert.alert-danger").html("Phone Number is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! email ) {
				$(document).find(".alert.alert-danger").html("Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( !validateEmail(email) ) {
				$(document).find(".alert.alert-danger").html("Email is not valid. Please try again.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_add_new_lead',
				'type': type,
				'fullname': fullname,
				'company': company,
				'phone': phone,
				'email': email,
				'address_1': address_1,
				'apt_1': apt_1,
				'city_1': city_1,
				'zip_1': zip_1,
				'address_2': address_2,
				'apt_2': apt_2,
				'city_2': city_2,
				'zip_2': zip_2,
				'address_3': address_3,
				'apt_3': apt_3,
				'city_3': city_3,
				'zip_3': zip_3,
				'address_4': address_4,
				'apt_4': apt_4,
				'city_4': city_4,
				'zip_4': zip_4,
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-leads-settings&add-success=true';
			});
		});

		// Update Lead Button
		$(document).on("click", ".update-lead-btn", function() {
			var leadID = $(document).find("input[name='lead_id']").val();
			var agent = $(document).find("#agent").val();
			var type = $(document).find("input[name='type']:checked").val();
			var fullname = $(document).find("#fullname").val();
			var company = $(document).find("#company").val();
			var phone = $(document).find("#phone").val();
			var email = $(document).find("#email").val();
			var address_1 = $(document).find("#address_1").val();
			var apt_1 = $(document).find("#apt_1").val();
			var city_1 = $(document).find("#city_1").val();
			var zip_1 = $(document).find("#zip_1").val();
			var address_2 = $(document).find("#address_2").val();
			var apt_2 = $(document).find("#apt_2").val();
			var city_2 = $(document).find("#city_2").val();
			var zip_2 = $(document).find("#zip_2").val();
			var address_3 = $(document).find("#address_3").val();
			var apt_3 = $(document).find("#apt_3").val();
			var city_3 = $(document).find("#city_3").val();
			var zip_3 = $(document).find("#zip_3").val();
			var address_4 = $(document).find("#address_4").val();
			var apt_4 = $(document).find("#apt_4").val();
			var city_4 = $(document).find("#city_4").val();
			var zip_4 = $(document).find("#zip_4").val();
			if ( ! fullname ) {
				$(document).find(".alert.alert-danger").html("Full Name or Main Contact is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! phone ) {
				$(document).find(".alert.alert-danger").html("Phone Number is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! email ) {
				$(document).find(".alert.alert-danger").html("Email is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( !validateEmail(email) ) {
				$(document).find(".alert.alert-danger").html("Email is not valid. Please try again.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! address_1 ) {
				$(document).find(".alert.alert-danger").html("Address is required field for Property 1.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! city_1 ) {
				$(document).find(".alert.alert-danger").html("City is required field for Property 1.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! zip_1 ) {
				$(document).find(".alert.alert-danger").html("Zip is required field for Property 1.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var data = {
				'action': 'realty_workstation_pro_update_lead',
				'leadID': leadID,
				'agent': agent,
				'type': type,
				'fullname': fullname,
				'company': company,
				'phone': phone,
				'email': email,
				'address_1': address_1,
				'apt_1': apt_1,
				'city_1': city_1,
				'zip_1': zip_1,
				'address_2': address_2,
				'apt_2': apt_2,
				'city_2': city_2,
				'zip_2': zip_2,
				'address_3': address_3,
				'apt_3': apt_3,
				'city_3': city_3,
				'zip_3': zip_3,
				'address_4': address_4,
				'apt_4': apt_4,
				'city_4': city_4,
				'zip_4': zip_4,
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				if (parseInt(agent) > 0) {
					window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-leads-settings&assigned-leads=true&update-success=true';
				} else {
					window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-leads-settings&update-success=true';
				}
			});
		});

		// Deleting Lead Temporary
		$(document).on("click", ".btn-delete-lead-temporary", function() {
			var currentRow = $(this).closest("tr");
			var leadID = $(this).attr("data-lead-id");
			Swal.fire({
				title: 'Do you want to delete the lead?',
				confirmButtonText: 'Delete it!',
				confirmButtonColor: '#c82333',
				showCancelButton: true
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var data = {
						'action': 'realty_workstation_pro_delete_lead_temporary',
						'leadID': leadID
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						dataTable.row(currentRow).remove().draw();
						Swal.fire(
							'Success!',
							'Lead has been marked as deleted successfully.',
							'success'
						);
					});
				}
			});
		});

		// Deleting Lead
		$(document).on("click", ".btn-delete-lead", function() {
			var currentRow = $(this).closest("tr");
			var leadID = $(this).attr("data-lead-id");
			Swal.fire({
				title: 'Do you want to delete the lead?',
				confirmButtonText: 'Delete it!',
				confirmButtonColor: '#c82333',
				showCancelButton: true
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var data = {
						'action': 'realty_workstation_pro_delete_lead',
						'leadID': leadID
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						Swal.fire(
							'Success!',
							'Lead has been marked as deleted successfully.',
							'success'
						);
					});
				}
			});
		});

		// Create a New Contract File Trigger
		$(document).on("change", ".add-contract-container .uploader input[type='file']", function() {
			var thisInput = $(this);
			var contractDocument = thisInput[0].files[0];
			if ( contractDocument ) {
				var documentSize = contractDocument.size;
				documentSize = (documentSize / 1024) / 1024;
				if (documentSize > 25) {
					Swal.fire(
						'Error!',
						'Document should be less than 25 MB.',
						'error'
					);
					return false;
				}
			}
			var contractDocumentName = contractDocument.name;
			var currentDataTable = $(document).find("table");
			var html = '<tr>';
			html += '<td>'+contractDocumentName+'</td>';
			html += '<td><button type="button" class="button button-primary btn-delete delete-contract-document-btn">Delete</button></td>';
			html += '</tr>';
			currentDataTable.find("tbody").append(html);
			$(document).find(".uploader").hide();
		});

		// Delete Contract Button on New Contract Screen
		$(document).on("click", ".add-contract-container .delete-contract-document-btn", function() {
			$(this).closest("tr").remove();
			$(document).find(".uploader").show();
		});

		// Create a New Contract
		$(document).on("click", ".add-new-contract-btn", function() {
			var thisInput = $(document).find("input[type='file']");
			var name = $(document).find("#name").val();
			var description = $(document).find("#description").val();
			if ( ! name ) {
				$(document).find(".alert.alert-danger").html("Contract Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! description ) {
				$(document).find(".alert.alert-danger").html("Contract Description is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( thisInput[0].files.length == 0 ) {
				$(document).find(".alert.alert-danger").html("Contract Document is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var fd = new FormData();
			var file = $(document).find("input[type='file']");
			var contractDocument = file[0].files[0];
			fd.append("document", contractDocument);
			fd.append('action', 'realty_workstation_pro_add_new_contract');
			fd.append('name', name);
			fd.append('description', description);
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-contracts-settings&add-success=true';
				}
			});
		});

		// Deleting Contract
		$(document).on("click", ".btn-delete-contract", function() {
			var currentRow = $(this).closest("tr");
			var contractID = $(this).attr("data-contract-id");
			Swal.fire({
				title: 'Do you want to delete the contract?',
				confirmButtonText: 'Delete it!',
				confirmButtonColor: '#c82333',
				showCancelButton: true
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var data = {
						'action': 'realty_workstation_pro_delete_contract',
						'contractID': contractID
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						dataTable.row(currentRow).remove().draw();
						Swal.fire(
							'Success!',
							'Contract has been marked as deleted successfully.',
							'success'
						);
					});
				}
			});
		});

		// Update Contract File Trigger
		$(document).on("change", ".edit-contract-container .uploader input[type='file']", function() {
			var thisInput = $(this);
			var contractDocument = thisInput[0].files[0];
			if ( contractDocument ) {
				var documentSize = contractDocument.size;
				documentSize = (documentSize / 1024) / 1024;
				if (documentSize > 25) {
					Swal.fire(
						'Error!',
						'Document should be less than 25 MB.',
						'error'
					);
					return false;
				}
			}
			var contractDocumentName = contractDocument.name;
			var currentDataTable = $(document).find("table");
			var html = '<tr>';
			html += '<td>'+contractDocumentName+'</td>';
			html += '<td><button type="button" class="button button-primary btn-delete delete-contract-document-btn">Delete</button></td>';
			html += '</tr>';
			currentDataTable.find("tbody").append(html);
			$(document).find(".uploader").hide();
		});

		// Delete Contract Button on Update Contract Screen
		$(document).on("click", ".edit-contract-container .delete-contract-document-btn", function() {
			$(this).closest("tr").remove();
			$(document).find(".uploader").show();
		});

		// Update Contract
		$(document).on("click", ".update-contract-btn", function() {
			var thisInput = $(document).find("input[type='file']");
			var contractID = $(document).find("input[name='contract_id']").val();
			var name = $(document).find("#name").val();
			var description = $(document).find("#description").val();
			if ( ! name ) {
				$(document).find(".alert.alert-danger").html("Contract Name is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			if ( ! description ) {
				$(document).find(".alert.alert-danger").html("Contract Description is required field.").show();
				$('html, body').animate({
					scrollTop: $(document).find("body").offset().top
				}, 2000);
				return false;
			}
			var fd = new FormData();
			if ( thisInput[0].files.length > 0 ) {
				var file = $(document).find("input[type='file']");
				var contractDocument = file[0].files[0];
				fd.append("document", contractDocument);
			}
			fd.append('action', 'realty_workstation_pro_update_contract');
			fd.append('contractID', contractID);
			fd.append('name', name);
			fd.append('description', description);
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					window.location.href = rw_object.admin_url + 'admin.php?page=realty-workstation-pro-contracts-settings&update-success=true';
				}
			});
		});

		// Create Backup
		$(document).on("click", ".create-backup", function() {
			Swal.fire({
				title: 'Do you want to create backup of whole system?',
				confirmButtonText: 'Yes!',
				confirmButtonColor: '#c82333',
				showCancelButton: true
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var data = {
						'action': 'realty_workstation_pro_create_backup'
					};
					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					jQuery.post(ajaxurl, data, function(response) {
						Swal.fire({
							title: 'Success!',
							text: 'Backup has been created successfully.',
							icon: 'success'
						}).then((result) => {
							JSON.parse(response).forEach(element => {
								window.open(element, '_blank');
							});
						});
					});
				}
			});
		});

		// Restore Backup
		$(document).on("change", "#backup", function() {
			var file = $(this);
			var backup = file[0].files;
			var backupFiles = [];
			var counter = 1;
			$.each(backup, function(j, file) {
				var fd = new FormData();
				fd.append('backup', file);
				fd.append('action', 'realty_workstation_pro_upload_backup');
				jQuery.ajax({
					type: 'POST',
					url: ajaxurl,
					data: fd,
					contentType: false,
					processData: false,
					success: function(response) {
						backupFiles.push(response);
						if ( backupFiles.length == backup.length ) {
							var data = {
								'action': 'realty_workstation_pro_restore_backup',
								'backups': backupFiles
							};
							console.log(data);
							// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
							jQuery.post(ajaxurl, data, function(response) {
								Swal.fire({
									title: 'Success!',
									text: 'Backup has been restored successfully.',
									icon: 'success'
								});
							});
						}
					}
				});
			});
		});

	} );

})( jQuery );
