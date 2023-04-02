<div class="wrap realty-workstation-pro-settings-div">
    <div class="rw-card">
        <div class="rw-card-header">
            <h2 class="wp-heading-inline"><?php _e( 'Contract', 'realty-workstation-pro' ); ?></h2>
        </div>
        <div class="rw-card-body">
            <embed src="<?php echo get_post_meta( $contract->ID, 'documentURL', true ); ?>" type="" width="100%" height="1000px">
        </div>
    </div>
</div>