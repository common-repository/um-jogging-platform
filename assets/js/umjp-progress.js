// configuring data object which is a property of the chart object
data = {

    labels: [],
    datasets: [
        {
            label: 'Selection A',
            data: [],
            borderColor: ['rgba(86, 244, 66,1)'],
            fill: false,
            borderWidth: 1,
            hidden: false
        },
        {
            label: 'Selection B',
            data: [],
            borderColor: ['rgba(66, 164, 244,1)'],
            fill: false,
            borderWidth: 1

        }
        ]
};

// creating labels for the runs
let labels  = () => {

    if(!DBdata[1]){
        for(i = 0; i < DBdata[0].length; i++){
            data.labels[i] = `Run ${i + 1}`;
        } 
        return;
    }
    
    if(DBdata[0].length >= DBdata[1].length){
        for(i = 0; i < DBdata[0].length; i++){
            data.labels[i] = `Run ${i + 1}`;
        } 
    }else{
        for(i = 0; i < DBdata[1].length; i++){
            data.labels[i] = `Run ${i + 1}`;
        } 
    }
}

labels();

// function which gets the correct current label
function updateTitles  (unit)  {
    if(unit ==='distance'){
        myChart.options.scales.yAxes[0].scaleLabel.labelString = 'Distance (Km)';
        myChart.options.title.text = 'Distance';
        return;
    } 
    if(unit === 'time'){
        myChart.options.scales.yAxes[0].scaleLabel.labelString = 'Minutes';
        myChart.options.title.text = 'Duration';
        return;
    } 
    if(unit === 'speed'){
        myChart.options.scales.yAxes[0].scaleLabel.labelString = 'Km/hour';
        myChart.options.title.text = 'Average Speed (Km/hour)';
        return;
    }
 }
 

// Adding event listeners to the radio buttons which transform the data object
jQuery("#umjp-distance").click(() => {

    for(i =0; i<DBdata[0].length ;i++){
        data.datasets[0].data[i] = DBdata[0][i].distance;
    }

    if(DBdata[1]){
        for(i =0; i<DBdata[1].length ;i++){
        data.datasets[1].data[i] = DBdata[1][i].distance;      
        }
    }

    if(myChart){
        updateTitles('distance');
        myChart.update();
    }

});


jQuery("#umjp-time").click(() => {

    for(i =0; i<DBdata[0].length ;i++){
        data.datasets[0].data[i] = DBdata[0][i].timeMin;
    }

    if(DBdata[1]){
        for(i =0; i<DBdata[1].length ;i++){
        data.datasets[1].data[i] = DBdata[1][i].timeMin;      
        }
    }

    updateTitles('time');
    myChart.update();

});


jQuery("#umjp-speed").click(() => {

    for(i =0; i<DBdata[0].length ;i++){
        let kmPerhour = DBdata[0][i].distance / (DBdata[0][i].timeMin / 60);
        kmPerhour =  Math.round(kmPerhour * 100) / 100;
        data.datasets[0].data[i] = kmPerhour;
    }

    if(DBdata[1]){
        for(i =0; i<DBdata[1].length ;i++){
            let kmPerhour = DBdata[1][i].distance / (DBdata[1][i].timeMin / 60 );
            kmPerhour =  Math.round(kmPerhour * 100) / 100;
            data.datasets[1].data[i] = kmPerhour;      
        }
    }

    updateTitles('speed');
    myChart.update();
});

// this function is called to have a default value when the page is rendered
jQuery('#umjp-distance').trigger('click');


// rendering the chart
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: data,

    options: {
        
        tooltips: {

// these callbacks are responsible for altering the tooltips when there 
// is hovered over individual data points.
            callbacks: {

                label: function(tooltipItem, data) {

                    return "";
                },

                title: function(tooltipItem, data){

                    if(document.getElementById('umjp-distance').checked){
                        if(tooltipItem[0].datasetIndex === 0){ 
                            return `${DBdata[0][tooltipItem[0].index].distance} Km on:`;
                        }
    
                        if(tooltipItem[0].datasetIndex === 1){
                            return `${DBdata[1][tooltipItem[0].index].distance} Km on:`;
                        }
                    }

                    if(document.getElementById('umjp-time').checked){
                        if(tooltipItem[0].datasetIndex === 0){   
                            return `${DBdata[0][tooltipItem[0].index].timeMin} Minutes on:`;
                        }
    
                        if(tooltipItem[0].datasetIndex === 1){
                            return `${DBdata[1][tooltipItem[0].index].timeMin} Minutes on:`;
                        }
                    }

                    if(document.getElementById('umjp-speed').checked){
                        if(tooltipItem[0].datasetIndex === 0){   
                            return `${data.datasets[0].data[tooltipItem[0].index]} Km/h on:`;
                        }
    
                        if(tooltipItem[0].datasetIndex === 1){
                            return `${data.datasets[1].data[tooltipItem[0].index]} Km/h on:`;
                        }
                    }

                },

                beforeBody: function(tooltipItem, data){

                    if(tooltipItem[0].datasetIndex === 0){                      
                        return DBdata[0][tooltipItem[0].index].dates;
                    }

                    if(tooltipItem[0].datasetIndex === 1){
                        return DBdata[1][tooltipItem[0].index].dates;
                    }
                },

//this callback is to show 2 dates when the points have the same value              
                beforeFooter: function (tooltipItem, data){
                      if(data.datasets[0].data[tooltipItem[0].index] === data.datasets[1].data[tooltipItem[0].index]){
                        return DBdata[1][tooltipItem[0].index].dates;                          
                    }                     
                },
            },
////////////////// end of callbacks

            mode: 'nearest',
            intersect: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:false,
                    stepSize: 2,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Distance (Km)'
                }
            }]
        },
        title: {
            display: true,
            text: 'Distance',
            fontSize: 20,
            padding: 7
        }
    }
});








