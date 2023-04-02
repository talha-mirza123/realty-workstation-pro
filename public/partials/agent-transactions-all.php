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
                'value' => 'agent',
                'compare' => '=',
            )
        )
    ]);
    if ($_SESSION['rwUser'] == 'agent') {
        $transactions = get_posts([
            'post_type' => 'rw-transaction',
            'post_status' => 'publish',
            'numberposts' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'agent',
                    'value' => get_current_user_id(),
                    'compare' => '=',
                ),
                array(
                    'key' => 'status',
                    'value' => 'open',
                    'compare' => '=',
                ),
                array(
                    'key' => 'category',
                    'value' => 'agent',
                    'compare' => '=',
                )
            )
        ]);
    }
    if ( isset($_GET['agent-transactions']) && !empty($_GET['agent-transactions']) && $_GET['agent-transactions'] == 'closed' ) {
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
                    'value' => 'agent',
                    'compare' => '=',
                )
            )
        ]);
        if ($_SESSION['rwUser'] == 'agent') {
            $transactions = get_posts([
                'post_type' => 'rw-transaction',
                'post_status' => 'publish',
                'numberposts' => -1,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'agent',
                        'value' => get_current_user_id(),
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'status',
                        'value' => 'closed',
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'category',
                        'value' => 'agent',
                        'compare' => '=',
                    )
                )
            ]);
        }
    }
?>
<div class="realty-workstation-pro-agents-all">
    <h3><?php echo ucfirst($_GET['agent-transactions']); ?> Transactions</h3>
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
                <?php if ($_SESSION['rwUser'] == 'broker') { ?>
                    <th>Agent</th>
                <?php } ?>
                <th>Date</th>
                <?php if ( $_SESSION['rwUser'] == 'agent' && (isset($_GET['agent-transactions']) && $_GET['agent-transactions'] == 'closed') ) { ?>
                <?php } else { ?>
                    <th>Actions</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) { ?>
                <tr>
                    <td><?php echo get_post_meta( $transaction->ID, 'address', true ); ?></td>
                    <td><?php echo get_post_meta( $transaction->ID, 'fullname', true ); ?></td>
                    <td><?php echo get_post_meta( $transaction->ID, 'type', true ); ?></td>
                    <?php if ($_SESSION['rwUser'] == 'broker') { ?>
                        <td><?php echo get_user_by('ID', get_post_meta( $transaction->ID, 'agent', true ))->first_name . ' ' . get_user_by('ID', get_post_meta( $transaction->ID, 'agent', true ))->last_name; ?></td>
                    <?php } ?>
                    <td><?php echo date('d-m-Y', strtotime($transaction->post_date)); ?></td>
                    <?php if ( $_SESSION['rwUser'] == 'agent' && (isset($_GET['agent-transactions']) && $_GET['agent-transactions'] == 'closed') ) { ?>
                    <?php } else { ?>
                        <td>
                            <a href="<?php echo $rw_workstation . '?agent-transactions=edit&status=open&transaction-id=' . $transaction->ID; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <?php if ($_SESSION['rwUser'] == 'broker') { ?>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-agent-transaction" data-transaction-id="<?php echo $transaction->ID; ?>">Delete</button>
                            <?php } ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>