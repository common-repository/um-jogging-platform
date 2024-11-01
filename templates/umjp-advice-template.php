<?php wp_enqueue_script('umjp_advice_script', umjp_js . "umjp-advice.js"); ?>

<div class="umjp-Advice-container">
<form class="umjp_Advice_form" action="" method="post">

    <div class="umjp-goalTitle">I want to improve:</div>

    <div class="umjp_chooseGoals">
      <input class="umjp_hide" id="weight" type="radio" name="goal" value="weight">
      <label class="umjp_selectGoal" for="weight">Weight</label>
      <input class="umjp_hide" id="vitality" type="radio" name="goal" value="vitality" checked> 
      <label class="umjp_selectGoal" for="vitality">Vitality</label>
      <input class="umjp_hide" id="cardio" type="radio" name="goal" value="cardio">  
      <label class="umjp_selectGoal" for="cardio">Cardio</label>
    </div>

    <div class="umjp-goalTitle umjp-preferences">
      <div id="arrow"></div>
       Choose preferences:
    </div>

    <div class="umjp-preferences-content hideClass">

      <div class="umjp_preference_header">Times a week:</div>

      <div class="umjp_chooseGoals">
        <input class="umjp_hide" id="umjp_oneTimeWeek" type="radio" name="amountWeek" value="1">
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_oneTimeWeek">1</label>
        <input class="umjp_hide" id="umjp_twoTimeWeek" type="radio" name="amountWeek" value="2" checked> 
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_twoTimeWeek">2</label>
        <input class="umjp_hide" id="umjp_threeTimeWeek" type="radio" name="amountWeek" value="3">  
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_threeTimeWeek">3</label>
        <input class="umjp_hide" id="umjp_fourTimeWeek" type="radio" name="amountWeek" value="4">  
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_fourTimeWeek">4</label>
        <input class="umjp_hide" id="umjp_fiveTimeWeek" type="radio" name="amountWeek" value="5" >  
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_fiveTimeWeek">5</label>
      </div>

        <div class="umjp_preference_header">Intensity:</div>

      <div class="umjp_chooseGoals">
        <input class="umjp_hide" id="umjp_intensity1" type="radio" name="intensity" value="1" >
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_intensity1">1</label>
        <input class="umjp_hide" id="umjp_intensity2" type="radio" name="intensity" value="2" checked> 
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_intensity2">2</label>
        <input class="umjp_hide" id="umjp_intensity3" type="radio" name="intensity" value="3" >  
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_intensity3">3</label>
        <input class="umjp_hide" id="umjp_intensity4" type="radio" name="intensity" value="4">  
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_intensity4">4</label>
        <input class="umjp_hide" id="umjp_intensity5" type="radio" name="intensity" value="5">  
        <label class="umjp_selectGoal umjp_selectAmount" for="umjp_intensity5">5</label>
      </div>

      <div class="umjp_preference_header">Interval training:</div>

      <div class="umjp_chooseGoals">
        <input class="umjp_hide" id="intervalYes" type="radio" name="interval" value="true" checked>
        <label class="umjp_selectGoal umjp_interval" for="intervalYes">Yes</label>
        <input class="umjp_hide" id="intervalNo" type="radio" name="interval" value="false"> 
        <label class="umjp_selectGoal umjp_interval" for="intervalNo">No</label>
      </div>

      <div class="umjp_preference_header">Specify duration:</div>


          <div class="umjp_sliderContainer">
            <span class="umjp_timeLabel">
            <label class="umjp_Label" for="timeEnabler">Select</label>
            <input name="timeMinEnabled" id="timeEnabler" type="checkbox" onchange="changeTimeBlock();">
            </span>

              <input name="timeMin" id="umjp_minutePicker" disabled class="umjp_rangeInput" type="range" min="15" max="100" oninput="updateTimeInput(this.value);">
              <span id="umjp_TimePostFix">
              <span class="umjp_selectedNr" id="umjp_minutes"></span><span id="umjp_min_postfix" class="umjp_postfix">min</span>
            </span>
          </div>

      <div class="umjp_preference_header">Specify distance:</div>

          <div class="umjp_sliderContainer">
            <span class="umjp_timeLabel">
            <label class="umjp_Label" for="distanceEnabler">Select</label>
            <input name="timeMinEnabled" id="distanceEnabler" type="checkbox" onchange="changeDistanceBlock()">
            </span>

              <input name="distance" id="umjp_distancePicker" disabled class="umjp_rangeInput" type="range" step="0.1" min="2" max="20" oninput="updateDistanceInput(this.value);">
              <span id="umjp_TimePostFix">
              <span class="umjp_selectedNr" id="umjp_Km"></span><span id="umjp_Km_postfix" class="umjp_postfix">Km</span>
            </span>

          </div>


    </div>

    <button id="advice_button"  type="submit"> Get Advice </button>


</form>
</div>

<div class="umjp-fill"></div>