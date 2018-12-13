//navigation on page show




$(document).ready(function() {
    //show menu
    $("#show-menu-button").click(function(){
            $("#main-menu-list-from-db").toggleClass("visible-inline-block");
    });

    $("#main-menu-list-from-db a").click(function() {

        $.scrollTo($("#footer"), 5000, {
            offset: -500
        });
    });

    $("#footer a").click(function() {

        $.scrollTo($("#navigation-menu"), 1000, {
            offset: 0
        });
    });

    //start page do action
    $("#run-over").fadeIn(3000);

    $("#popup-snowboard-block i").click(function(){
        $("#popup-snowboard-block").slideUp("slow");
    });

    // hide features
    $("#features-popup i").click(function(){
        $("#features-popup").slideUp("slow");
    });
    // hide run-over
    $("#run-over a.see-det").click(function(e){
        e.preventDefault();
        $("#run-over").fadeOut("slow");
    });

var  update =function(){
    $("#snowboard-container-block .active .snowboard-item ").each(function(index){

        if((index==1)||(index==2) ){
            $( this ).addClass("center") ;
        }else{
            $( this ).removeClass("center") ;        }
    });
}


    //Каруселька
    //Документация: http://owlgraphic.com/owlcarousel/
    var owl = $("#slide-bar-excited");
    owl.owlCarousel({
         singleItem:true,
        autoPlay : 5000,
        stopOnHover : false,
        pagination : false,
        mouseDrag : false,
        touchDrag : false,
        addClassActive : true
    });
    owl.on("mousewheel", "#my-owl-slide-bar", function (e) {
        if (e.deltaY > 0) {
            owl.trigger("owl.prev");
        } else {
            owl.trigger("owl.next");
            alert("privet");
        }
        e.preventDefault();
    });
    $(".next_button").click(function(){
        owl.trigger("owl.next");
    });
    $(".prev_button").click(function(){
        owl.trigger("owl.prev");
    });
  new  update();
    var owl_snowboards = $("#snowboard-container-block");
    owl_snowboards.owlCarousel({
        // singleItem:true,
        items : 4,
        itemsCustom : false,
        itemsDesktop : false,
        itemsDesktopSmall : false,
        itemsTablet: false,
        itemsTabletSmall: false,
        itemsMobile : false,
        singleItem : false,
        itemsScaleUp : false,
        autoPlay : 5000,
        stopOnHover : false,
        pagination : false,
        mouseDrag : true,
        touchDrag : true,
        addClassActive : true,
        afterMove:function(){
            update();

        },
        afterInit : function(){
            update();
        }
    });
    owl_snowboards.on("mousewheel", "#my-owl-slide-bar", function (e) {
        if (e.deltaY > 0) {
            owl_snowboards.trigger("owl.prev");
        } else {
            owl_snowboards.trigger("owl.next");

        }
        e.preventDefault();
    });
    $(".next_button").click(function(){
        owl_snowboards.trigger("owl.next");
    });
    $(".prev_button").click(function(){
        owl_snowboards.trigger("owl.prev");
    });




});