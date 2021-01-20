let ml = {timelines: {}};

ml.timelines["ml15"] = anime.timeline({loop: false})

    .add({
        targets: '.ml15 .word',
        scale: [10,1],
        opacity: [0,1],
        easing: "easeOutCirc",
        duration: 900,
        delay: function(el, i) {
            return 1000 * i;
        }
    })
    .add({
        targets: '.ml15',
        opacity: 0,
        duration: 2000,
        easing: "easeOutCubic",
        delay: 1500
    });


//removing the moving-letters after display to prevent div overlapping issues
$(function(){
    const movingletters = $('.moving-letters');

    setTimeout(function(){
        movingletters.remove();
    },5000);

});
