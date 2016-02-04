var state = 'stop';

function buttonPlayPress(num, timeValue) {
    if(state=='stop'){
        state='play';
        var button = d3.select("#button_play"+num).classed('btn-success', true);
        button.select("i").attr('class', "fa fa-play");
    }
    console.log("button play"+num+" pressed, play was "+state);
}

function buttonPausePress(num){
    state = 'stop';
    var button = d3.select("#button_play"+num).classed('btn-success', false);
    button.select("i").attr('class', "fa fa-play");
    console.log("button stop"+num+"  invoked.");
}
