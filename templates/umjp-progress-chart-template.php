<?php 

global $umjp_master;
$umjp_DataPHP = $umjp_master->progress->get_data();
$umjp_data = json_encode($umjp_DataPHP);

wp_register_script( 'umjp_delete_script', umjp_js . "umjp-delete-record.js" );
wp_localize_script( 'umjp_delete_script', 'umjp_AJAX',
array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


wp_enqueue_script('umjp_chart_script', umjp_js . "umjp-chart.js");
wp_enqueue_script('umjp_progress_script', umjp_js . "umjp-progress.js");
wp_enqueue_script('umjp_delete_script', umjp_js . "umjp-delete-record.js");

?>
<script> var DBdata = <?php echo $umjp_data; ?>; </script>
<canvas id="myChart" width="400" height="400"></canvas>

<br>

<div>
    <div class="umjp_toggleParent">
        <input type="radio" id="umjp-distance"
        name="unit" value="distance" checked="checked">
        <label class="umjp_toggleStats" for="umjp-distance"><?php _e('Distance','ultimate-member-UMJP') ?> (Km)</label>
    </div>
    <div class="umjp_toggleParent">
        <input type="radio" id="umjp-time"
        name="unit" value="time">
        <label class="umjp_toggleStats" for="umjp-time"><?php _e('Time','ultimate-member-UMJP') ?> (min)</label>
    </div>
    <div class="umjp_toggleParent">
        <input type="radio" id="umjp-speed"
         name="unit" value="speed">
        <label class="umjp_toggleStats" for="umjp-speed"><?php _e('Average Speed','ultimate-member-UMJP') ?> (Km/h)</label>
    </div>
</div>

<br> <br>

<div class="umjp_delete_text"><?php _e('Erase records permanently:','ultimate-member-UMJP') ?></div> 

<table class="umjp_progressTable">
    <tr>
        <th> <?php _e('Date','ultimate-member-UMJP') ?></th>
        <th> <?php _e('Distance','ultimate-member-UMJP') ?> (Km)</th>
        <th> <?php _e('Time','ultimate-member-UMJP') ?> (Min)</th>
        <th> <?php _e('Delete record','ultimate-member-UMJP') ?></th>
    </tr>
<?php
for($i = 0; $i < count($umjp_DataPHP[0]); $i++) {
?>
    <tr class="umjp-dataRow">
        <td><?php echo esc_html($umjp_DataPHP[0][$i]->dates); ?></td>
        <td><?php echo esc_html($umjp_DataPHP[0][$i]->distance); ?></td>
        <td><?php echo esc_html($umjp_DataPHP[0][$i]->timeMin); ?></td>
        <td onclick="umjpDeleteRecord(<?php echo $i ?>)"><span class="umjp-deleteData"><?php _e('Delete','ultimate-member-UMJP') ?></span></td>
    </tr>
  
<?php
}
?>

</table>

<br>




