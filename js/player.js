var state = 'stop';

function buttonPlayPress(num) {
    if(state=='stop'){
        state='play';
        var button = d3.select("#button_play"+num).classed('btn-success', true);
        button.select("i").attr('class', "fa fa-pause");
    }
    else if(state=='play' || state=='resume'){
        state = 'pause';
        d3.select("#button_play"+num+" i").attr('class', "fa fa-play");
    }
    else if(state=='pause'){
        state = 'resume';
        d3.select("#button_play"+num+" i").attr('class', "fa fa-pause");
    }
    console.log("button play"+num+" pressed, play was "+state);
}

function buttonStopPress(num){
    state = 'stop';
    var button = d3.select("#button_play"+num).classed('btn-success', false);
    button.select("i").attr('class', "fa fa-play");
    console.log("button stop"+num+"  invoked.");
}