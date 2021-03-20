(function($){
    var colours = ["#000000", "#FF0000", "#990066", "#FF9966", "#996666", "#CC9933"];
    var sizes = ["30px", "35px", "40px"];
    var rotations = ["-20deg", "-15deg", "-10deg", "0deg", "10deg", "15deg", "20deg"];
    $(function() {
        var div = $('.captcha-code'); 
        var chars = div.text().split('');
        div.html('');     
        for(var i=0; i<chars.length; i++) {
            idx = Math.floor(Math.random() * colours.length);
            idxS = Math.floor(Math.random() * sizes.length);
            idxR = Math.floor(Math.random() * rotations.length);
            var span = $('<span>' + chars[i] + '</span>').css({
                "color": colours[idx],
                "font-size": sizes[idxS],
                "float": 'left',
                "-webkit-transform": "rotate("+rotations[idxR]+")"
            });
            div.append(span);
        }
    });
})(jQuery)