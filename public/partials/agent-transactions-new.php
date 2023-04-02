<?php
    $args = array(
        'role' => 'rw_agent',
        'orderby' => 'user_nicename',
        'order' => 'ASC'
    );
    $agents = get_users($args);
?>
<div class="realty-workstation-pro-agents-all">
    <h3>New Transaction</h3>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><?php _e( 'Add New Agent Transaction', 'realty-workstation-pro' ); ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="category" id="category" value="agent">
                <?php if ($_SESSION['rwUser'] == 'agent') { ?>
                    <input type="hidden" name="agent" id="agent" value="<?php echo get_current_user_id(); ?>">
                <?php } ?>
                <div class="alert alert-danger"></div>
                <?php if ($_SESSION['rwUser'] == 'broker') { ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0 fs-larger"><?php _e( 'Agent', 'realty-workstation-pro' ); ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="agent" class="form-label">Select an Agent</label>
                                <select name="agent" id="agent" class="form-control">
                                    <option value="">Select one option</option>
                                    <?php foreach ($agents as $agent) { ?>
                                        <option value="<?php echo $agent->ID; ?>"><?php echo $agent->first_name . ' ' . $agent->last_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Transaction Type', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="purchase" class="form-label">Select Type</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="purchase" value="Purchase">
                                <label class="form-check-label" for="purchase">Purchase</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="sale" value="Sale">
                                <label class="form-check-label" for="sale">Sale</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="lease-tenant" value="Lease - Tenant">
                                <label class="form-check-label" for="lease-tenant">Lease - Tenant</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="lease-landlord" value="Lease - Landlord">
                                <label class="form-check-label" for="lease-landlord">Lease - Landlord</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Property', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" class="form-control" name="address" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="apt" class="form-label">Apt / Suite</label>
                                    <input type="text" id="apt" class="form-control" name="apt" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" class="form-control" name="city" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" id="zip" class="form-control" name="zip" value="">
                                </div>
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
                                    <input type="text" id="fullname" class="form-control" name="fullname" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3 wd-50">
                                    <label for="company" class="form-label">Company Name</label>
                                    <input type="text" id="company" class="form-control" name="company" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3 wd-50">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" id="phone" class="form-control" name="phone" value="" placeholder="+1 (123)456-7890">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3 wd-50">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email" class="form-control" name="email" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-success w-25 add-new-agent-transaction-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>