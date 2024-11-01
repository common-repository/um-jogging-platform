
<div class="umjp-form-container">
    <div class="umjp-form-holder">

<form action="" method="post">

<div class="umjp-master-form">   
<!-- The age of birth and gender are only shown if the user has not filled them in yet -->
<?php if(!get_user_meta( get_current_user_id(), 'aob', true )){
    umjp_render_template('umjp-account-template');               
}?> 


<div class="um-field um-field-type-text">
    <div class="um-field-label"><label for="distance"><?php _e('Distance (Km)','um-jogging-platform') ?></label></div> 
    <div class="um-field-area"><input id="umjp-input-nr" required
    type="text" step="0.1" name="enter__distance" value="8.0" placeholder="For instance 8.5" max=100 min=1></div>
</div>

<div class="um-field um-field-type-text">
  <div class="um-field-label"><label for="Date"><?php _e('Date','ultimate-member-UMJP') ?></label></div> 
  <div class="um-field-area"><input type="text" required  name="date" value="<?php  echo date("Y-m-d") ?>"></div> 
</div>

<div class="umjp-submit-holder um-field um-field-type-text">
    <div class="um-field-label"><label for="time"><?php _e('Time (Min)','um-jogging-platform') ?></label></div>
    <div class="um-field-area"><input value="45" type="text" name="time" required placeholder="Enter time here"></div>
    <br/>
    <button class="umjp-submit-btn" type="submit"><?php _e('Submit', 'um-jogging-platform') ?></button>
</div>

</div>
  


<br>
</form>

    </div>        
</div>







