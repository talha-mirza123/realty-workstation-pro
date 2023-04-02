<?php
    $transactions = get_posts([
        'post_type' => 'rw-transaction',
        'post_status' => 'publish',
        'numberposts' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'status',
                'value' => 'open',
                'compare' => '=',
            ),
            array(
                'key' => 'category',
                'value' => 'broker',
                'compare' => '=',
            )
        )
    ]);
    $openBrokerTransactions = (isset($_GET['open-broker-transactions']) && !empty($_GET['open-broker-transactions'])) ? $_GET['open-broker-transactions'] : '';
    $closedBrokerTransactions = (isset($_GET['closed-broker-transactions']) && !empty($_GET['closed-broker-transactions'])) ? $_GET['closed-broker-transactions'] : '';
    if ( isset($openBrokerTransactions) && !empty($openBrokerTransactions) && $openBrokerTransactions == 'true' ) {
        $transactions = get_posts([
            'post_type' => 'rw-transaction',
            'post_status' => 'publish',
            'numberposts' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'status',
                    'value' => 'open',
                    'compare' => '=',
                ),
                array(
                    'key' => 'category',
                    'value' => 'broker',
                    'compare' => '=',
                )
            )
        ]);
    }
    if ( isset($closedBrokerTransactions) && !empty($closedBrokerTransactions) && $closedBrokerTransactions == 'true' ) {
        $transactions = get_posts([
            'post_type' => 'rw-transaction',
            'post_status' => 'publish',
            'numberposts' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'status',
                    'value' => 'closed',
                    'compare' => '=',
                ),
                array(
                    'key' => 'category',
                    'value' => 'broker',
                    'compare' => '=',
                )
            )
        ]);
    }
?>
<div class="wrap realty-workstation-pro-settings-div">
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e( 'All Broker Transactions', 'realty-workstation-pro' ); ?></h1>
        <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-broker-transactions-settings&new-broker-transaction=true') ?>" class="page-title-action">Add New Transaction</a>
    </div>
    <?php if (isset($_GET['add-success']) && !empty($_GET['add-success']) && $_GET['add-success'] == 'true') { ?>
        <br>
        <div class="alert alert-success">Transaction has been added to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['update-success']) && !empty($_GET['update-success']) && $_GET['update-success'] == 'true') { ?>
        <br>
        <div class="alert alert-success">Transaction has been updated to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['delete-success']) && !empty($_GET['delete-success']) && $_GET['delete-success'] == 'true') { ?>
        <br>
        <div class="alert alert-success">Transaction has been deleted from the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['closed-success']) && !empty($_GET['closed-success']) && $_GET['closed-success'] == 'true') { ?>
        <br>
        <div class="alert alert-success">Transaction has been closed in the system successfully.</div>
    <?php } ?>
    <div class="tablenav top margin-bottom-1rem" style="float: left">
		<div class="alignleft actions bulkactions">
            <?php if (isset($openBrokerTransactions) && !empty($openBrokerTransactions) && $openBrokerTransactions == 'true') { ?>
                <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-broker-transactions-settings&open-broker-transactions=true') ?>" class="button action active"><i class="fa fa-folder-open-o"></i> Open</a>
			    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-broker-transactions-settings&closed-broker-transactions=true') ?>" class="button action "><i class="fa fa-folder-o"></i> Closed &amp; Cancelled</a>
            <?php } else if (isset($closedBrokerTransactions) && !empty($closedBrokerTransactions) && $closedBrokerTransactions == 'true') { ?>
                <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-broker-transactions-settings&open-broker-transactions=true') ?>" class="button action"><i class="fa fa-folder-open-o"></i> Open</a>
			    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-broker-transactions-settings&closed-broker-transactions=true') ?>" class="button action active"><i class="fa fa-folder-o"></i> Closed &amp; Cancelled</a>
            <?php } else { ?>
                <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-broker-transactions-settings&open-broker-transactions=true') ?>" class="button action active"><i class="fa fa-folder-open-o"></i> Open</a>
			    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-broker-transactions-settings&closed-broker-transactions=true') ?>" class="button action "><i class="fa fa-folder-o"></i> Closed &amp; Cancelled</a>
            <?php } ?>
			
		</div>
	</div>
    <table id="example" class="display realty-workstation-pro-dataTable" style="width:100%">
        <thead>
            <tr>
                <th>Address</th>
                <th>Client</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) { ?>
                <tr>
                    <td><?php echo get_post_meta( $transaction->ID, 'address', true ); ?></td>
                    <td><?php echo get_post_meta( $transaction->ID, 'fullname', true ); ?></td>
                    <td><?php echo get_post_meta( $transaction->ID, 'type', true ); ?></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-broker-transactions-settings&edit-broker-transaction=true&transaction-id=' . $transaction->ID) ?>" class="button button-primary">Edit</a>
                        <button type="button" class="button button-primary btn-delete btn-delete-broker-transaction" data-transaction-id="<?php echo $transaction->ID; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>