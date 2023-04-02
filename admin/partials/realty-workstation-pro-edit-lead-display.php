<?php
    $args = array(
        'role' => 'rw_agent',
        'orderby' => 'user_nicename',
        'order' => 'ASC'
    );
    $agents = get_users($args);
    $leadAgent = get_post_meta( $lead->ID, 'agent', true );
    $leadType = get_post_meta( $lead->ID, 'type', true );
?>
<div class="wrap realty-workstation-pro-settings-div edit-lead-container">
    <div class="rw-card">
        <div class="rw-card-header">
            <h2 class="wp-heading-inline"><?php _e( 'Update Lead', 'realty-workstation-pro' ); ?></h2>
        </div>
        <div class="rw-card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead->ID; ?>">
                <div class="alert alert-danger"></div>
                <div class="rw-card">
                    <div class="rw-card-header">
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Agent', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group">
                            <label for="agent">Select an Agent</label>
                            <select name="agent" id="agent">
                                <option value="">Unassign the Lead</option>
                                <?php foreach ($agents as $agent) { ?>
                                    <option value="<?php echo $agent->ID; ?>" <?php echo ($leadAgent && $leadAgent == $agent->ID) ? 'selected' : ''; ?>><?php echo $agent->first_name . ' ' . $agent->last_name; ?></option>
                                <?php } ?> 
                            </select>
                        </div>
                    </div>
                </div>
                <div class="rw-card">
                    <div class="rw-card-header">
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Transaction Type', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group">
                            <label for="purchase">Select Type</label>
                            <div class="form-group-checkbox">
                                <label for="purchase" class="checkbox">
                                    <input type="radio" name="type" id="purchase" value="Purchase" <?php echo ($leadType && $leadType == 'Purchase') ? 'checked' : ''; ?>>
                                    Purchase
                                </label>
                                <label for="sale" class="checkbox">
                                    <input type="radio" name="type" id="sale" value="Sale" <?php echo ($leadType && $leadType == 'Sale') ? 'checked' : ''; ?>>
                                    Sale
                                </label>
                                <label for="lease-tenant" class="checkbox">
                                    <input type="radio" name="type" id="lease-tenant" value="Lease - Tenant" <?php echo ($leadType && $leadType == 'Lease - Tenant') ? 'checked' : ''; ?>>
                                    Lease - Tenant
                                </label>
                                <label for="lease-landlord" class="checkbox">
                                    <input type="radio" name="type" id="lease-landlord" value="Lease - Landlord" <?php echo ($leadType && $leadType == 'Lease - Landlord') ? 'checked' : ''; ?>>
                                    Lease - Landlord
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rw-card">
                    <div class="rw-card-header">
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Client', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group wd-50">
                            <label for="fullname">Full Name or Main Contact</label>
                            <input type="text" id="fullname" name="fullname" value="<?php echo get_post_meta( $lead->ID, 'fullname', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="company">Company Name</label>
                            <input type="text" id="company" name="company" value="<?php echo get_post_meta( $lead->ID, 'company', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" value="<?php echo get_post_meta( $lead->ID, 'phone', true ); ?>" placeholder="+1 (123)456-7890">
                        </div>
                        <div class="form-group wd-50">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="<?php echo get_post_meta( $lead->ID, 'email', true ); ?>">
                        </div>
                    </div>
                </div>
                <div class="rw-card">
                    <div class="rw-card-header">
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Property 1', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group wd-50">
                            <label for="address_1">Address</label>
                            <input type="text" id="address_1" name="address_1" value="<?php echo get_post_meta( $lead->ID, 'address_1', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt_1">Apt / Suite</label>
                            <input type="text" id="apt_1" name="apt_1" value="<?php echo get_post_meta( $lead->ID, 'apt_1', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city_1">City</label>
                            <input type="text" id="city_1" name="city_1" value="<?php echo get_post_meta( $lead->ID, 'city_1', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip_1">Zip</label>
                            <input type="text" id="zip_1" name="zip_1" value="<?php echo get_post_meta( $lead->ID, 'zip_1', true ); ?>">
                        </div>
                    </div>
                </div>
                <div class="rw-card">
                    <div class="rw-card-header">
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Property 2', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group wd-50">
                            <label for="address_2">Address</label>
                            <input type="text" id="address_2" name="address_2" value="<?php echo get_post_meta( $lead->ID, 'address_2', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt_2">Apt / Suite</label>
                            <input type="text" id="apt_2" name="apt_2" value="<?php echo get_post_meta( $lead->ID, 'apt_2', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city_2">City</label>
                            <input type="text" id="city_2" name="city_2" value="<?php echo get_post_meta( $lead->ID, 'city_2', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip_2">Zip</label>
                            <input type="text" id="zip_2" name="zip_2" value="<?php echo get_post_meta( $lead->ID, 'zip_2', true ); ?>">
                        </div>
                    </div>
                </div>
                <div class="rw-card">
                    <div class="rw-card-header">
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Property 3', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group wd-50">
                            <label for="address_3">Address</label>
                            <input type="text" id="address_3" name="address_3" value="<?php echo get_post_meta( $lead->ID, 'address_3', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt_3">Apt / Suite</label>
                            <input type="text" id="apt_3" name="apt_3" value="<?php echo get_post_meta( $lead->ID, 'apt_3', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city_3">City</label>
                            <input type="text" id="city_3" name="city_3" value="<?php echo get_post_meta( $lead->ID, 'city_3', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip_3">Zip</label>
                            <input type="text" id="zip_3" name="zip_3" value="<?php echo get_post_meta( $lead->ID, 'zip_3', true ); ?>">
                        </div>
                    </div>
                </div>
                <div class="rw-card margin-bottom-1rem">
                    <div class="rw-card-header">
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Property 4', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group wd-50">
                            <label for="address_4">Address</label>
                            <input type="text" id="address_4" name="address_4" value="<?php echo get_post_meta( $lead->ID, 'address_4', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt_4">Apt / Suite</label>
                            <input type="text" id="apt_4" name="apt_4" value="<?php echo get_post_meta( $lead->ID, 'apt_4', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city_4">City</label>
                            <input type="text" id="city_4" name="city_4" value="<?php echo get_post_meta( $lead->ID, 'city_4', true ); ?>">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip_4">Zip</label>
                            <input type="text" id="zip_4" name="zip_4" value="<?php echo get_post_meta( $lead->ID, 'zip_4', true ); ?>">
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="rw-button update-lead-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>