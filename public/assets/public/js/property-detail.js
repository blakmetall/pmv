(function($){
    $(function(){
        var rw = localStorage.getItem('rw') || '[]';
        rw = JSON.parse(rw);

        if(rw.length > 0){
            $('#block-recent-views-recent-views-block').removeClass('hide-recent-views');
        }else{
            $('#block-recent-views-recent-views-block').addClass('hide-recent-views');
        }

        var theIndex = false;
        for (var i = 0; i < rw.length; i++) {
            if (rw[i].id == property.id) {
                theIndex = true;
                break;
            }
        }
        if(!theIndex){
            if(rw.length >= 5){
                rw.pop();
            }
            addItemRw(property, rw);
        }

    });

    function addItemRw(property, rw){
        var data = {
            id:    property.id,
            name:  property.name,
            baths: property.baths,
            beds:  property.beds,
            pax:   property.pax,
            route: property.route,
            image: property.image,
            rate:  property.rate,
        };
        
        rw.push(data);
        localStorage.setItem('rw', JSON.stringify(rw));
    }
})(jQuery)