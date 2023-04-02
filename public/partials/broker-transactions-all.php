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
    if ( isset($_GET['broker-transactions']) && !empty($_GET['broker-transactions']) && $_GET['broker-transactions'] == 'closed' ) {
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
<div class="realty-workstation-pro-agents-all">
    <h3><?php echo ucfirst($_GET['broker-transactions']); ?> Transactions</h3>
    <?php if (isset($_GET['add-success']) && !empty($_GET['add-success']) && $_GET['add-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Transaction has been added to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['update-success']) && !empty($_GET['update-success']) && $_GET['update-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Transaction has been updated to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['delete-success']) && !empty($_GET['delete-success']) && $_GET['delete-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Transaction has been deleted from the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['closed-success']) && !empty($_GET['closed-success']) && $_GET['closed-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Transaction has been closed in the system successfully.</div>
    <?php } ?>
    <hr>
    <table id="example" class="table table-striped rw-dataTable" style="width:100%">
        <thead>
            <tr>
                <th>Address</th>
                <th>Client</th>
                <th>Type</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) { ?>
                <tr>
                    <td><?php echo get_post_meta( $transaction->ID, 'address', true ); ?></td>
                    <td><?php echo get_post_meta( $transaction->ID, 'fullname', true ); ?></td>
                    <td><?php echo get_post_meta( $transaction->ID, 'type', true ); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($transaction->post_date)); ?></td>
                    <td>
                        <a href="<?php echo $rw_workstation . '?broker-transactions=edit&status=open&transaction-id=' . $transaction->ID; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm btn-delete-broker-transaction" data-transaction-id="<?php echo $transaction->ID; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>