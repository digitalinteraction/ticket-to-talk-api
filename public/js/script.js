/**
 * Created by Daniel on 05/04/2017.
 */

$(document).ready(function(){

    $("#subscribe").click(function()
    {
        var email = $("#email").val();

        if (email.length > 1 && email.includes('@'))
        {
            $.get( "subscribe/" + email, function(response)
            {
                console.log(response);

                if (response.status.code === 200)
                {
                    $("#subscribe").addClass('disabled');
                    $("#subscribe").text('Thanks!');
                }
            });
        }
    });

    $('.screenshot-gallery').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 5000
    });

});
