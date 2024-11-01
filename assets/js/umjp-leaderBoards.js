
let umjp_amount          = document.getElementById('umjp-amountTop');
let umjp_totalKm         = document.getElementById('umjp-totalKm');
let umjp_speed35         = document.getElementById('umjp_speed35');
let umjp_speed58         = document.getElementById('umjp_speed58');
let umjp_speed812        = document.getElementById('umjp_speed812');
let umjp_speed12_plus    = document.getElementById('umjp_speed12_plus');
var umjp_currentState    = 'refDate10';

let umjp_mostRuns = () => {

    for(let i=0; i<5 ; i++){

        if(!DBdata.most_runs[umjp_currentState][i]){
            umjp_amount.childNodes[1].children[i + 1].children[0].innerText = "-";
            umjp_amount.childNodes[1].children[i + 1].children[1].innerText = "-";
            continue;
        }

    umjp_amount.childNodes[1].children[i + 1].children[0].innerText = DBdata.most_runs[umjp_currentState][i].user_id;
    umjp_amount.childNodes[1].children[i + 1].children[1].innerText = DBdata.most_runs[umjp_currentState][i].cnt;
    }
}


let umjp_TotalKms = () => {

    for(let i=0; i<5 ; i++){

        if(!DBdata.most_Km[umjp_currentState][i]){
            umjp_totalKm.childNodes[1].children[i + 1].children[0].innerText = "-";
            umjp_totalKm.childNodes[1].children[i + 1].children[1].innerText = "-";
            continue;
        }

    umjp_totalKm.childNodes[1].children[i + 1].children[0].innerText = DBdata.most_Km[umjp_currentState][i].user_id;
    umjp_totalKm.childNodes[1].children[i + 1].children[1].innerText = Math.round(DBdata.most_Km[umjp_currentState][i].totalKm * 10) /10;
    }
}



let umjp_speed35f = () => {

    for(let i=0; i<5 ; i++){

        if(!DBdata.fastest3_5[umjp_currentState][i]){
            umjp_speed35.childNodes[1].children[i + 1].children[0].innerText = "-";
            umjp_speed35.childNodes[1].children[i + 1].children[1].innerText = "-";
            continue;
        }

    umjp_speed35.childNodes[1].children[i + 1].children[0].innerText = DBdata.fastest3_5[umjp_currentState][i].user_id;
    umjp_speed35.childNodes[1].children[i + 1].children[1].innerText = Math.round(DBdata.fastest3_5[umjp_currentState][i].maxSpeed *100) / 100;
    }
}


let umjp_speed58f = () => {

    for(let i=0; i<5 ; i++){

        if(!DBdata.fastest5_8[umjp_currentState][i]){
            umjp_speed58.childNodes[1].children[i + 1].children[0].innerText = "-";
            umjp_speed58.childNodes[1].children[i + 1].children[1].innerText = "-";
            continue;
        }

    umjp_speed58.childNodes[1].children[i + 1].children[0].innerText = DBdata.fastest5_8[umjp_currentState][i].user_id;
    umjp_speed58.childNodes[1].children[i + 1].children[1].innerText = Math.round(DBdata.fastest5_8[umjp_currentState][i].maxSpeed *100) / 100;
    }
}


let umjp_speed812f = () => {

    for(let i=0; i<5 ; i++){

        if(!DBdata.fastest8_12[umjp_currentState][i]){
            umjp_speed812.childNodes[1].children[i + 1].children[0].innerText = "-";
            umjp_speed812.childNodes[1].children[i + 1].children[1].innerText = "-";
            continue;
        }

    umjp_speed812.childNodes[1].children[i + 1].children[0].innerText = DBdata.fastest8_12[umjp_currentState][i].user_id;
    umjp_speed812.childNodes[1].children[i + 1].children[1].innerText = Math.round(DBdata.fastest8_12[umjp_currentState][i].maxSpeed *100) / 100;
    }
}


let umjp_speed12_plusf = () => {

    for(let i=0; i<5 ; i++){

        if(!DBdata.fastest12_plus[umjp_currentState][i]){
            umjp_speed12_plus.childNodes[1].children[i + 1].children[0].innerText = "-";
            umjp_speed12_plus.childNodes[1].children[i + 1].children[1].innerText = "-";
            continue;
        }

    umjp_speed12_plus.childNodes[1].children[i + 1].children[0].innerText = DBdata.fastest12_plus[umjp_currentState][i].user_id;
    umjp_speed12_plus.childNodes[1].children[i + 1].children[1].innerText = Math.round(DBdata.fastest12_plus[umjp_currentState][i].maxSpeed *100) / 100;
    }
}


let umjp_leaderBoards = () => {

    umjp_mostRuns();
    umjp_TotalKms();
    umjp_speed35f();
    umjp_speed58f();
    umjp_speed812f();
    umjp_speed12_plusf();
}


// this is called to have a have a default value
umjp_leaderBoards();


// console.log(DBdata.most_runs[umjp_currentState]);
// console.log(umjp_amount.childNodes[1].children);



jQuery("#tendays").click(() => {
    umjp_currentState = 'refDate10';
    umjp_leaderBoards();
});

jQuery("#This-month").click(() => {
    umjp_currentState = 'refDateMonth';
    umjp_leaderBoards();    
});

jQuery("#three-months").click(() => {
    umjp_currentState = 'refDate100';
    umjp_leaderBoards();
});

jQuery("#Last-year").click(() => {
    umjp_currentState = 'refDateYear';
    umjp_leaderBoards();
});

