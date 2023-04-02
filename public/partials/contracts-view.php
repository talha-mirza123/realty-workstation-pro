<?php
    $contract = get_post( (int) $_GET['contract-id'] );
?>
<div class="realty-workstation-pro-agents-all add-contract-container">
    <h3>All Contracts</h3>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><?php echo get_post_meta( $contract->ID, 'name', true ); ?></h6>
        </div>
        <div class="card-body">
            <embed src="<?php echo get_post_meta( $contract->ID, 'documentURL', true ); ?>" type="" width="100%" height="1000px">
        </div>
    </div>
</div>