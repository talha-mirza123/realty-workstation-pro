<?php
    $args = array(
        'role' => 'rw_agent',
        'orderby' => 'user_nicename',
        'order' => 'ASC'
    );
    $agents = get_users($args);
    $lead = get_post( (int) $_GET['lead-id'] );
    $leadAgent = get_post_meta( $lead->ID, 'agent', true );
    $leadType = get_post_meta( $lead->ID, 'type', true );
?>
<div class="realty-workstation-pro-agents-all">
    <h3>Edit Lead</h3>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><?php _e( 'Edit Lead', 'realty-workstation-pro' ); ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead->ID; ?>">
                <div class="alert alert-danger"></div>
                <?php if ($_SESSION['rwUser'] != 'agent') { ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0 fs-larger"><?php _e( 'Agent', 'realty-workstation-pro' ); ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="agent" class="form-label">Select an Agent</label>
                                <select name="agent" id="agent" class="form-control">
                                    <option value="">Unassign the Lead</option>
                                    <?php foreach ($agents as $agent) { ?>
                                        <option value="<?php echo $agent->ID; ?>" <?php echo ($leadAgent && $leadAgent == $agent->ID) ? 'selected' : ''; ?>><?php echo $agent->first_name . ' ' . $agent->last_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <input type="hidden" name="agent" id="agent" value="<?php echo $leadAgent; ?>">
                <?php } ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Lead Type', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="purchase" class="form-label">Select Type</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="purchase" value="Purchase" <?php echo ($leadType && $leadType == 'Purchase') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="purchase">Purchase</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="sale" value="Sale" <?php echo ($leadType && $leadType == 'Sale') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sale">Sale</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="lease-tenant" value="Lease - Tenant" <?php echo ($leadType && $leadType == 'Lease - Tenant') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="lease-tenant">Lease - Tenant</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="lease-landlord" value="Lease - Landlord" <?php echo ($leadType && $leadType == 'Lease - Landlord') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="lease-landlord">Lease - Landlord</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Client', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3 wd-50">
                                    <label for="fullname" class="form-label">Full Name or Main Contact</label>
                                    <input type="text" id="fullname" class="form-control" name="fullname" value="<?php echo get_post_meta( $lead->ID, 'fullname', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3 wd-50">
                                    <label for="company" class="form-label">Company Name</label>
                                    <input type="text" id="company" class="form-control" name="company" value="<?php echo get_post_meta( $lead->ID, 'company', true ); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3 wd-50">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" id="phone" class="form-control" name="phone" value="<?php echo get_post_meta( $lead->ID, 'phone', true ); ?>" placeholder="+1 (123)456-7890">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3 wd-50">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email" class="form-control" name="email" value="<?php echo get_post_meta( $lead->ID, 'email', true ); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Property 1', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="address_1" class="form-label">Address</label>
                                    <input type="text" id="address_1" class="form-control" name="address_1" value="<?php echo get_post_meta( $lead->ID, 'address_1', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="apt_1" class="form-label">Apt / Suite</label>
                                    <input type="text" id="apt_1" class="form-control" name="apt_1" value="<?php echo get_post_meta( $lead->ID, 'apt_1', true ); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="city_1" class="form-label">City</label>
                                    <input type="text" id="city_1" class="form-control" name="city_1" value="<?php echo get_post_meta( $lead->ID, 'city_1', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="zip_1" class="form-label">Zip</label>
                                    <input type="text" id="zip_1" class="form-control" name="zip_1" value="<?php echo get_post_meta( $lead->ID, 'zip_1', true ); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Property 2', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="address_2" class="form-label">Address</label>
                                    <input type="text" id="address_2" class="form-control" name="address_2" value="<?php echo get_post_meta( $lead->ID, 'address_2', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="apt_2" class="form-label">Apt / Suite</label>
                                    <input type="text" id="apt_2" class="form-control" name="apt_2" value="<?php echo get_post_meta( $lead->ID, 'apt_2', true ); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="city_2" class="form-label">City</label>
                                    <input type="text" id="city_2" class="form-control" name="city_2" value="<?php echo get_post_meta( $lead->ID, 'city_2', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="zip_2" class="form-label">Zip</label>
                                    <input type="text" id="zip_2" class="form-control" name="zip_2" value="<?php echo get_post_meta( $lead->ID, 'zip_2', true ); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Property 3', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="address_3" class="form-label">Address</label>
                                    <input type="text" id="address_3" class="form-control" name="address_3" value="<?php echo get_post_meta( $lead->ID, 'address_3', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="apt_3" class="form-label">Apt / Suite</label>
                                    <input type="text" id="apt_3" class="form-control" name="apt_3" value="<?php echo get_post_meta( $lead->ID, 'apt_3', true ); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="city_3" class="form-label">City</label>
                                    <input type="text" id="city_3" class="form-control" name="city_3" value="<?php echo get_post_meta( $lead->ID, 'city_3', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="zip_3" class="form-label">Zip</label>
                                    <input type="text" id="zip_3" class="form-control" name="zip_3" value="<?php echo get_post_meta( $lead->ID, 'zip_3', true ); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Property 4', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="address_4" class="form-label">Address</label>
                                    <input type="text" id="address_4" class="form-control" name="address_4" value="<?php echo get_post_meta( $lead->ID, 'address_4', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="apt_4" class="form-label">Apt / Suite</label>
                                    <input type="text" id="apt_4" class="form-control" name="apt_4" value="<?php echo get_post_meta( $lead->ID, 'apt_4', true ); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="city_4" class="form-label">City</label>
                                    <input type="text" id="city_4" class="form-control" name="city_4" value="<?php echo get_post_meta( $lead->ID, 'city_4', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="zip_4" class="form-label">Zip</label>
                                    <input type="text" id="zip_4" class="form-control" name="zip_4" value="<?php echo get_post_meta( $lead->ID, 'zip_4', true ); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-success w-25 update-lead-btn">Save</button>
                    <?php if ($_SESSION['rwUser'] == 'agent') { ?>
                        <button type="button" class="btn btn-primary w-25 create-transaction-lead-btn" data-lead-id="<?php echo $lead->ID; ?>">Save and Create Transaction</button>
                        <button type="button" class="btn btn-danger w-25 btn-delete-lead-temporary-from-edit-page" data-lead-id="<?php echo $lead->ID; ?>">Delete</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>