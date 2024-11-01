<div class="umjp-getData-title"><?php _e('Request Data:', 'um-jogging-platform'); ?></div>

<form action="" method="post">

<div class="umjp-progress-form">

    <div class="umjp-progress-unit1">
        <label for="amount"><i class="um-tip-w um-faicon-info-circle" 
        title= "<?php _e("Fill in amount of runs, leave other fields open to get last X runs", 'um-jogging-platform'); ?>" ></i>  
        <?php _e('Amount of runs:', 'um-jogging-platform'); ?> </label>
        <input id="umjp-progress-number" type="number" name="amount" min="3" max="50" required>       
    </div>

    <div class="umjp-progress-unit1">
        <label for="firstDate"><i class="um-tip-w um-faicon-info-circle" 
        title="<?php _e("(Optional) only runs are shown after this chosen date ", 'um-jogging-platform'); ?>"></i>  
        <?php _e('Starting from:', 'um-jogging-platform'); ?></label>
        <input id="umjp-secondinput-id" class="umjp-progress-input" type="date" name="firstDate" placeholder="Format: YYYY-MM-DD">
    </div>


    <div class="umjp-progress-unit1">
        <label for="compareDate"><i class="um-tip-w um-faicon-info-circle" 
        title="<?php _e("(Optional) only runs are shown after this chosen date ", 'um-jogging-platform'); ?>"></i> 
        <?php _e('Compare to:', 'um-jogging-platform'); ?></label>
        <input class="umjp-progress-input" type="date" name="compareDate" placeholder="Format: YYYY-MM-DD">
    </div>

    <div class="umjp-button-container">
        <button class="umjp-progress-button" type="submit"><?php _e('Get Data', 'um-jogging-platform'); ?></button>
    </div>

</div>


</form>