<div class="wrap realty-workstation-pro-settings-div">
    <div class="rw-card">
        <div class="rw-card-header">
            <h2 class="wp-heading-inline"><?php _e( 'Add New Broker Transaction', 'realty-workstation-pro' ); ?></h2>
        </div>
        <div class="rw-card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="category" id="category" value="broker">
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
                        <h2 class="wp-heading-inline fs-larger"><?php _e( 'Property', 'realty-workstation-pro' ); ?></h2>
                    </div>
                    <div class="rw-card-body">
                        <div class="form-group wd-50">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="apt">Apt / Suite</label>
                            <input type="text" id="apt" name="apt" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" value="">
                        </div>
                        <div class="form-group wd-50">
                            <label for="zip">Zip</label>
                            <input type="text" id="zip" name="zip" value="">
                        </div>
                    </div>
                </div>
                <div class="rw-card margin-bottom-1rem">
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
                <div class="button-group">
                    <button type="button" class="rw-button add-new-broker-transaction-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>