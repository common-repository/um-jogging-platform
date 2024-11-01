// toggle the preferences 
let umjp_preferences =        document.querySelector('.umjp-preferences');
let umjp_preferencesContent = document.querySelector('.umjp-preferences-content');

umjp_preferences.onclick = () => {
    if(umjp_preferencesContent.classList.contains("hideClass")) {
        umjp_preferencesContent.classList.remove("hideClass");
      } else{
        umjp_preferencesContent.classList.add("hideClass");
      }
}



function updateTimeInput(val) {
  let output = document.getElementById('umjp_minutes');
  output.innerText = val;
}

function updateDistanceInput(val) {
  let output = document.getElementById('umjp_Km');
  output.innerText = val;
}


// toggling  the checkboxes in the form which enables the range inputs
let umjp_Time_enabled = false;
let umjp_Distance_enabled = false;

function changeTimeBlock() {

  if(!umjp_Time_enabled) {
    document.getElementById('umjp_minutes').innerText = document.getElementById('umjp_minutePicker').value;
  }

  if(umjp_Time_enabled) {
    document.getElementById('umjp_minutes').innerText = "";
  }

  if(!umjp_Time_enabled) {
    document.getElementById('umjp_min_postfix').style.opacity = 1;
  } else {
    document.getElementById('umjp_min_postfix').style.opacity = 0.5;
  }

  document.getElementById('umjp_minutePicker').disabled = umjp_Time_enabled;
  umjp_Time_enabled = !umjp_Time_enabled;

}

function changeDistanceBlock() {

  if(!umjp_Distance_enabled) {
    document.getElementById('umjp_Km').innerText = document.getElementById('umjp_distancePicker').value;
  }

  if(umjp_Distance_enabled) {
    document.getElementById('umjp_Km').innerText = "";
  }

  if(!umjp_Distance_enabled) {
    document.getElementById('umjp_Km_postfix').style.opacity = 1;
  } else {
    document.getElementById('umjp_Km_postfix').style.opacity = 0.5;
  }


  document.getElementById('umjp_distancePicker').disabled = umjp_Distance_enabled;
  umjp_Distance_enabled = !umjp_Distance_enabled;
}


document.getElementById('umjp_minutePicker').value = 40;
document.getElementById('umjp_distancePicker').value = 10;






// firefox caches the checkbox input so there has to be a check if they are unchecked
document.getElementById('timeEnabler').checked = false;
document.getElementById('distanceEnabler').checked = false;
