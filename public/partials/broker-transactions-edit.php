<?php
    $rw_bank_name = get_option( 'rw_bank_name' );
    $rw_account_name = get_option( 'rw_account_name' );
    $rw_account_number = get_option( 'rw_account_number' );
    $rw_account_address = get_option( 'rw_account_address' );
    $sale = ['eros', 'contract', 'closing_statement', 'additional_documents'];
    $saleLabel = ['Exclusive Right of Sale', 'Contract', 'Closing Statement', 'Additional Documents'];
    $purchase = ['contract', 'closing_statement', 'additional_documents'];
    $purchaseLabel = ['Contract', 'Closing Statement', 'Additional Documents'];
    $leaseTenant = ['contract', 'additional_documents'];
    $leaseTenantLabel = ['Contract', 'Additional Documents'];
    $leaseLandlord = ['erol', 'contract', 'additional_documents'];
    $leaseLandlordLabel = ['Exclusive Right of Lease', 'Contract', 'Additional Documents'];
    $transaction = get_post( (int) $_GET['transaction-id'] );
?>
<div class="realty-workstation-pro-agents-all edit-transaction-container">
    <h3><?php echo ucfirst($_GET['status']) ?> Transaction - <?php echo get_post_meta( $transaction->ID, 'type', true ); ?></h3>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><?php _e( 'Transaction Details', 'realty-workstation-pro' ); ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="transaction_id" id="transaction_id" value="<?php echo $transaction->ID; ?>">
                <div class="alert alert-danger"></div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Property', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" class="form-control" name="address" value="<?php echo get_post_meta( $transaction->ID, 'address', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="apt" class="form-label">Apt / Suite</label>
                                    <input type="text" id="apt" class="form-control" name="apt" value="<?php echo get_post_meta( $transaction->ID, 'apt', true ); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" class="form-control" name="city" value="<?php echo get_post_meta( $transaction->ID, 'city', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" id="zip" class="form-control" name="zip" value="<?php echo get_post_meta( $transaction->ID, 'zip', true ); ?>">
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
                                <div class="form-group mb-3">
                                    <label for="fullname" class="form-label">Full Name or Main Contact</label>
                                    <input type="text" id="fullname" class="form-control" name="fullname" value="<?php echo get_post_meta( $transaction->ID, 'fullname', true ); ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="company" class="form-label">Company Name</label>
                                    <input type="text" id="company" class="form-control" name="company" value="<?php echo get_post_meta( $transaction->ID, 'company', true ); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" id="phone" class="form-control" name="phone" value="<?php echo get_post_meta( $transaction->ID, 'phone', true ); ?>" placeholder="+1 (123)456-7890">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email" class="form-control" name="email" value="<?php echo get_post_meta( $transaction->ID, 'email', true ); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Documents', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <?php
                            $transactionType = get_post_meta( $transaction->ID, 'type', true );
                        ?>
                        <?php if ($transactionType == 'Sale') { ?>
                            <?php for ($i = 0; $i < count($sale); $i++) { ?>
                                <div id="hud" class="form-group">
                                    <label><?php echo $saleLabel[$i]; ?></label>
                                    <div id="file-upload-form" class="uploader">
                                        <input id="<?php echo $sale[$i]; ?>" type="file" name="<?php echo $sale[$i]; ?>" accept="image/jpeg, image/png, application/pdf" multiple="multiple">
                                        <label for="<?php echo $sale[$i]; ?>" id="file-drag-0">
                                            <img id="file-image" src="#" alt="Preview" class="hidden">
                                            <div id="start">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div><p class="help-block">.jpg / .png / .pdf (If you are uploading multiple pages in seperate files. Please number the files e.g. 'title of document 1of4.jpg'</p></div>
                                                <div id="notimage" class="hidden">Please select an image</div>
                                                <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                            </div>
                                            <div id="response" class="hidden">
                                                <div id="messages"></div>
                                                <progress class="progress" id="file-progress" value="0">
                                                    <span>0</span>%
                                                </progress>
                                            </div>
                                        </label>
                                    </div>
                                    <table id="example" class="table table-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Filename</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $documents = get_posts([
                                                    'post_type' => 'rw-transaction-doc',
                                                    'post_status' => 'publish',
                                                    'numberposts' => -1,
                                                    'meta_query' => array(
                                                        'relation' => 'AND',
                                                        array(
                                                            'key' => 'transactionID',
                                                            'value' => $transaction->ID,
                                                            'compare' => '=',
                                                        ),
                                                        array(
                                                            'key' => 'documentType',
                                                            'value' => $sale[$i],
                                                            'compare' => '=',
                                                        )
                                                    )
                                                ]);
                                            ?>
                                            <?php if (isset($documents) && is_array($documents) && count($documents) > 0) { ?>
                                                <?php foreach ($documents as $document) { ?>
                                                    <tr data-document-id="<?php echo $document->ID; ?>">
                                                        <td><a href="<?php echo get_post_meta( $document->ID, 'documentURL', true ); ?>" target="_blank"><?php echo get_post_meta( $document->ID, 'documentName', true ); ?></a></td>
                                                        <td><div class="badge bg-success">Uploaded</div></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm delete-document-btn">Delete</button></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($transactionType == 'Purchase') { ?>
                            <?php for ($i = 0; $i < count($purchase); $i++) { ?>
                                <div id="hud" class="form-group">
                                    <label><?php echo $purchaseLabel[$i]; ?></label>
                                    <div id="file-upload-form" class="uploader">
                                        <input id="<?php echo $purchase[$i]; ?>" type="file" name="<?php echo $purchase[$i]; ?>" accept="image/jpeg, image/png, application/pdf" multiple="multiple">
                                        <label for="<?php echo $purchase[$i]; ?>" id="file-drag-0">
                                            <img id="file-image" src="#" alt="Preview" class="hidden">
                                            <div id="start">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div><p class="help-block">.jpg / .png / .pdf (If you are uploading multiple pages in seperate files. Please number the files e.g. 'title of document 1of4.jpg'</p></div>
                                                <div id="notimage" class="hidden">Please select an image</div>
                                                <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                            </div>
                                            <div id="response" class="hidden">
                                                <div id="messages"></div>
                                                <progress class="progress" id="file-progress" value="0">
                                                    <span>0</span>%
                                                </progress>
                                            </div>
                                        </label>
                                    </div>
                                    <table id="example" class="table table-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Filename</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $documents = get_posts([
                                                    'post_type' => 'rw-transaction-doc',
                                                    'post_status' => 'publish',
                                                    'numberposts' => -1,
                                                    'meta_query' => array(
                                                        'relation' => 'AND',
                                                        array(
                                                            'key' => 'transactionID',
                                                            'value' => $transaction->ID,
                                                            'compare' => '=',
                                                        ),
                                                        array(
                                                            'key' => 'documentType',
                                                            'value' => $purchase[$i],
                                                            'compare' => '=',
                                                        )
                                                    )
                                                ]);
                                            ?>
                                            <?php if (isset($documents) && is_array($documents) && count($documents) > 0) { ?>
                                                <?php foreach ($documents as $document) { ?>
                                                    <tr data-document-id="<?php echo $document->ID; ?>">
                                                        <td><a href="<?php echo get_post_meta( $document->ID, 'documentURL', true ); ?>" target="_blank"><?php echo get_post_meta( $document->ID, 'documentName', true ); ?></a></td>
                                                        <td><div class="badge bg-success">Uploaded</div></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm delete-document-btn">Delete</button></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($transactionType == 'Lease - Tenant') { ?>
                            <?php for ($i = 0; $i < count($leaseTenant); $i++) { ?>
                                <div id="hud" class="form-group">
                                    <label><?php echo $leaseTenantLabel[$i]; ?></label>
                                    <div id="file-upload-form" class="uploader">
                                        <input id="<?php echo $leaseTenant[$i]; ?>" type="file" name="<?php echo $leaseTenant[$i]; ?>" accept="image/jpeg, image/png, application/pdf" multiple="multiple">
                                        <label for="<?php echo $leaseTenant[$i]; ?>" id="file-drag-0">
                                            <img id="file-image" src="#" alt="Preview" class="hidden">
                                            <div id="start">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div><p class="help-block">.jpg / .png / .pdf (If you are uploading multiple pages in seperate files. Please number the files e.g. 'title of document 1of4.jpg'</p></div>
                                                <div id="notimage" class="hidden">Please select an image</div>
                                                <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                            </div>
                                            <div id="response" class="hidden">
                                                <div id="messages"></div>
                                                <progress class="progress" id="file-progress" value="0">
                                                    <span>0</span>%
                                                </progress>
                                            </div>
                                        </label>
                                    </div>
                                    <table id="example" class="table table-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Filename</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $documents = get_posts([
                                                    'post_type' => 'rw-transaction-doc',
                                                    'post_status' => 'publish',
                                                    'numberposts' => -1,
                                                    'meta_query' => array(
                                                        'relation' => 'AND',
                                                        array(
                                                            'key' => 'transactionID',
                                                            'value' => $transaction->ID,
                                                            'compare' => '=',
                                                        ),
                                                        array(
                                                            'key' => 'documentType',
                                                            'value' => $leaseTenant[$i],
                                                            'compare' => '=',
                                                        )
                                                    )
                                                ]);
                                            ?>
                                            <?php if (isset($documents) && is_array($documents) && count($documents) > 0) { ?>
                                                <?php foreach ($documents as $document) { ?>
                                                    <tr data-document-id="<?php echo $document->ID; ?>">
                                                        <td><a href="<?php echo get_post_meta( $document->ID, 'documentURL', true ); ?>" target="_blank"><?php echo get_post_meta( $document->ID, 'documentName', true ); ?></a></td>
                                                        <td><div class="badge bg-success">Uploaded</div></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm delete-document-btn">Delete</button></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($transactionType == 'Lease - Landlord') { ?>
                            <?php for ($i = 0; $i < count($leaseLandlord); $i++) { ?>
                                <div id="hud" class="form-group">
                                    <label><?php echo $leaseLandlordLabel[$i]; ?></label>
                                    <div id="file-upload-form" class="uploader">
                                        <input id="<?php echo $leaseLandlord[$i]; ?>" type="file" name="<?php echo $leaseLandlord[$i]; ?>" accept="image/jpeg, image/png, application/pdf" multiple="multiple">
                                        <label for="<?php echo $leaseLandlord[$i]; ?>" id="file-drag-0">
                                            <img id="file-image" src="#" alt="Preview" class="hidden">
                                            <div id="start">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div><p class="help-block">.jpg / .png / .pdf (If you are uploading multiple pages in seperate files. Please number the files e.g. 'title of document 1of4.jpg'</p></div>
                                                <div id="notimage" class="hidden">Please select an image</div>
                                                <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                            </div>
                                            <div id="response" class="hidden">
                                                <div id="messages"></div>
                                                <progress class="progress" id="file-progress" value="0">
                                                    <span>0</span>%
                                                </progress>
                                            </div>
                                        </label>
                                    </div>
                                    <table id="example" class="table table-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Filename</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $documents = get_posts([
                                                    'post_type' => 'rw-transaction-doc',
                                                    'post_status' => 'publish',
                                                    'numberposts' => -1,
                                                    'meta_query' => array(
                                                        'relation' => 'AND',
                                                        array(
                                                            'key' => 'transactionID',
                                                            'value' => $transaction->ID,
                                                            'compare' => '=',
                                                        ),
                                                        array(
                                                            'key' => 'documentType',
                                                            'value' => $leaseLandlord[$i],
                                                            'compare' => '=',
                                                        )
                                                    )
                                                ]);
                                            ?>
                                            <?php if (isset($documents) && is_array($documents) && count($documents) > 0) { ?>
                                                <?php foreach ($documents as $document) { ?>
                                                    <tr data-document-id="<?php echo $document->ID; ?>">
                                                        <td><a href="<?php echo get_post_meta( $document->ID, 'documentURL', true ); ?>" target="_blank"><?php echo get_post_meta( $document->ID, 'documentName', true ); ?></a></td>
                                                        <td><div class="badge bg-success">Uploaded</div></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm delete-document-btn">Delete</button></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Price and Commission', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="sales_price" class="form-label"><?php echo ($transactionType == 'Sale' || $transactionType == 'Purchase') ? 'Sale Price' : 'Lease Price'; ?></label>
                            <input type="text" id="sales_price" class="form-control sales-price mask-money" name="sales_price" value="<?php echo get_post_meta( $transaction->ID, 'sales_price', true ); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="total_commission" class="form-label">Total Commission</label>
                            <input type="text" id="total_commission" class="form-control total-commission mask-money" name="total_commission" value="<?php echo get_post_meta( $transaction->ID, 'total_commission', true ); ?>">
                        </div>
                        <div class="mb-3 form-check">
                            <?php $broker_referral = get_post_meta( $transaction->ID, 'broker_referral', true ); ?>
                            <input type="checkbox" class="form-check-input broker-referral" id="broker_referral" name="broker_referral" value="true" <?php echo (isset($broker_referral) && !empty($broker_referral) && $broker_referral == 'true') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="broker_referral">Broker Referral</label>
                        </div>
                        <div class="form-group mb-3">
                            <?php
                                $calculatedCommissionPercentage = 100;
                            ?>
                            <label for="agent_payout" class="form-label">Agent Payout (<span class="commission-percentage"><?php echo $calculatedCommissionPercentage; ?></span>% of Commission)</label>
                            <input type="text" id="agent_payout" class="form-control agent-payout mask-money" name="agent_payout" value="<?php echo get_post_meta( $transaction->ID, 'agent_payout', true ); ?>" readonly data-commission="1.00" data-lease="1.00" data-sale-and-purchase="1.00" data-transaction-type="<?php echo $transactionType; ?>">
                        </div>
                        <div class="card-footer">
                            <p class="help-block" style="cn_color: #111; font-weight: bold; line-height: 25px;">Deposit commission check at <?php echo $rw_bank_name; ?>.  <br> Account name: <?php echo $rw_account_name; ?>. Account Number: <?php echo $rw_account_number; ?> Account Address: <?php echo $rw_account_address; ?></p>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-success w-25 update-broker-transaction-btn">Save</button>
                    <button type="button" class="btn btn-primary w-25 close-broker-transaction-btn">Close and Request Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>