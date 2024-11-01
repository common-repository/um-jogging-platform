
<?php
// this template gets rendered on the Account page under the usual input fields 
// This template also gets rendered the first time a users fills in data
       $aob = substr(get_user_meta( get_current_user_id(), 'aob', true ), 0, 10);
       ?>
        <div id="umjp-age-ob" class="um-field um-field-type-text">
			<div class="um-field-label"><label for="aob"><?php _e('Date of Birth','um-jogging-platform')?></label></div>
          	<div class="um-field-area">
			 	<input id="umjp-input-account" data-key="user_email" type="text" maxlength="10" minlength="10" placeholder="For instance 1992-05-06"  name="aob" required
          		<?php if($aob){ echo "value=$aob";} ?>>
			</div>

        </div>

		<br>

        <div class="umjp-inputfield">
        <div id="umjp-gender-label"><?php _e('<b>Gender</b>', 'um-jogging-platform') ?></div>
            <div class="umjp-radio-flexbox">
            <div class="umjp-gender-box">
                <input type="radio" class="umjp-gender-button" id="male" required 
                <?php if(get_user_meta( get_current_user_id(), 'gender', true ) == 'male'){ echo "checked";}  ?>
                 name="gender" value="male">
                <label for="male" class="umjp-gender-radio"><?php _e('Male','um-jogging-platform')?></label>
            </div>

            <div class="umjp-gender-box">
                <input type="radio"  class="umjp-gender-button" id="female" required
                <?php if(get_user_meta( get_current_user_id(), 'gender', true ) == 'female'){ echo "checked";}  ?>
                name="gender" value="female">
                <label for="female" class="umjp-gender-radio"><?php _e('Female', 'um-jogging-platform') ?></label>
            </div>


            </div>
        </div>




