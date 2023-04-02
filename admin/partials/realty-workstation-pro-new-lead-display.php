<div class="wrap realty-workstation-pro-settings-div">
    <div class="rw-card">
        <div class="rw-card-header">
            <h2 class="wp-heading-inline"><?php _e( 'Add New Lead', 'realty-workstation-pro' ); ?></h2>
        </div>
        <div class="rw-card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <div class="alert alert-danger"></div>
                <div class="rw-card">
                    <div class="rw-card-header">
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Transaction Type', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group">
                            <label for="purchase">Select Type</label>
                            <div class="form-group-checkbox">
                                <label for="purchase" class="checkbox">
                                    <input type="radio" name="type" id="purchase" value="Purchase">
                                    Purchase
                                </label>
                                <label for="sale" class="checkbox">
                                    <input type="radio" name="type" id="sale" value="Sale">
                                    Sale
                                </label>
                                <label for="lease-tenant" class="checkbox">
                                    <input type="radio" name="type" id="lease-tenant" value="Lease - Tenant">
                                    Lease - Tenant
                                </label>
                                <label for="lease-landlord" class="checkbox">
                                    <input type="radio" name="type" id="lease-landlord" value="Lease - Landlord">
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
                            <input type="text" id="fullname" name="fullname" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="company">Company Name</label>
                            <input type="text" id="company" name="company" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" value="" placeholder="+1 (123)456-7890">
                        </div>
                        <div class="form-group wd-50">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="">
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
                            <input type="text" id="address_1" name="address_1" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt_1">Apt / Suite</label>
                            <input type="text" id="apt_1" name="apt_1" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city_1">City</label>
                            <input type="text" id="city_1" name="city_1" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip_1">Zip</label>
                            <input type="text" id="zip_1" name="zip_1" value="">
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
                            <input type="text" id="address_2" name="address_2" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt_2">Apt / Suite</label>
                            <input type="text" id="apt_2" name="apt_2" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city_2">City</label>
                            <input type="text" id="city_2" name="city_2" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip_2">Zip</label>
                            <input type="text" id="zip_2" name="zip_2" value="">
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
                            <input type="text" id="address_3" name="address_3" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt_3">Apt / Suite</label>
                            <input type="text" id="apt_3" name="apt_3" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city_3">City</label>
                            <input type="text" id="city_3" name="city_3" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip_3">Zip</label>
                            <input type="text" id="zip_3" name="zip_3" value="">
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
                            <input type="text" id="address_4" name="address_4" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt_4">Apt / Suite</label>
                            <input type="text" id="apt_4" name="apt_4" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city_4">City</label>
                            <input type="text" id="city_4" name="city_4" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip_4">Zip</label>
                            <input type="text" id="zip_4" name="zip_4" value="">
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="rw-button add-new-lead-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>