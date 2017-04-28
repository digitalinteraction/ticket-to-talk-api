/**
 * Created by Daniel on 05/04/2017.
 */

$(document).ready(function(){

    $("#subscribe").click(function()
    {
        let email = $("#email").val();

        if (email.length > 1 && email.includes('@'))
        {
            $.post( "subscribe", { email: $("#email").val()}, function(response)
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
});
