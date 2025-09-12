$(document).ready(function () {
    if($('#viewed_products_slider').length){
        var slider = tns({
            container: '#viewed_products_slider',
            nav: false,
            controlsText: ["",""],
            edgePadding: 2,
            gutter: 20,
            items: 1,
            autoplayButton: true,
            speed: 1000,
            autoplayPosition: 'bottom',
            mouseDrag : true,
            responsive: {
                500: {
                    edgePadding: 15,
                    gutter: 30,
                    items: 1
                },
                800: {
                    edgePadding: 20,
                    gutter: 30,
                    items: 2,
                },
                1100: {
                    edgePadding: 20,
                    gutter: 30,
                    items: 3,
                },
                1407: {
                    edgePadding: 0,
                    gutter: 0,
                    items: 4,
                }
            },

            gutter: 1,
            slideBy: 'page',
            autoplay: false
        });
    }
});