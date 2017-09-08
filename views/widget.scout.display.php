<?php
    $scout = get_option( 'sailthru_scout_options' );
    $sailthru = get_option( 'sailthru_setup_options' );

    // check if this is an SPM widget or a Scout Widget
    if (sailthru_spm_ready()) {
        $use_spm = true;
    } else {
        $use_spm = false;
        $title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );
    }

    /** This filter is documented in class-sailthru-scout.php */
    if ( ! isset( $scout['sailthru_scout_is_on'] ) ||  ! $scout['sailthru_scout_is_on'] || ! apply_filters( 'sailthru_scout_on', true ) ) {
        // do nothing, get outta here
        return;
    }
    // Grab the settings from $instance and fill out default values as needed.
	$title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );
?>
<?php if ($use_spm): ?>
    <div class="sailthru-spm-widget">
         <div id="<?php echo $this->id; ?>"></div>
          <script type="text/javascript">
            jQuery(function() {
                SPM.addSection('<?php echo $section; ?>', {
                    elementId: '<?php echo $this->id; ?>'
                });
                SPM.personalize({
                    timeout: 2000
            });
         });
    </script>

    </div>
 <div class="sailthru-recommends-widget">
    </div>
<?php else: ?>
<?php
        // Title.
        if ( ! empty( $title ) ) {
            if ( ! isset( $before_title ) ) {
                $before_title = '';
            }
            if ( ! isset( $after_title ) ) {
                $after_title = '';
            }
            echo $before_title . trim( $title ) . $after_title;
        }
    ?>
    <div id="sailthru-scout"><div class="loading"></div></div>
<?php endif; ?>
