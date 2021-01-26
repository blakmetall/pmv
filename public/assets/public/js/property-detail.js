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

        // toggle more rates
        $('#toggle-rates').click(function(evt){
            evt.preventDefault();		
            $('.toggle-table-rates').toggle();
            
            var hide_txt = 'less rates';
            var edit_txt = 'more rates';				
                                    
            if ($('#toggle-rates').hasClass('show-rates')) {
                 $('#toggle-rates').removeClass('show-rates').addClass('hide-rates');
                 $('#toggle-rates').text(hide_txt);
                 $('#toggle-rates').attr('title', hide_txt);
            }
            else {
                 $('#toggle-rates').removeClass('hide-rates').addClass('show-rates');
                 $('#toggle-rates').text(edit_txt);
                 $('#toggle-rates').attr('title', edit_txt);
            }
            
        });
    });


    // Slider
    $(window).load(function() {
        $('#carousel').flexslider({
          animation: "slide",
          controlNav: false,
          animationLoop: false,
          slideshow: false,
          itemWidth: 140,
          itemMargin: 5,
          asNavFor: '#slider'
        });
       
        $('#slider').flexslider({
          animation: "slide",
          controlNav: false,
          animationLoop: false,
          slideshow: false,
          sync: "#carousel"
        });
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