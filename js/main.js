$(document).ready(click());

function click() {
        $(".img-thumbnail").hover(imagepopup);
}

function imagepopup() {
    var srcname = $(this).attr("src");
    var otherimage = srcname.replace("small", "large");
    var imagepopup = document.getElementsByClassName("imagepopup");

    if (imagepopup.length === 0) {
        $(this).after("<img class=\"imagepopup\" src=\"" + otherimage + "\"/>");
    } else {
        if (imagepopup.length > 0) {
            imagepopup[0].parentNode.removeChild(imagepopup[0]);
        }
    }   
}

/*
* This function toggles the nav menu active/inactive status as
* different pages are selected. It should be called from $(document).ready()
* or whenever the page loads.
*/
$(document).ready(function activateMenu()
{
    var current_page_URL = location.href;
    $(".navbar-nav a").each(function()
    {
        var target_URL = $(this).prop("href");
        if (target_URL === current_page_URL)
            {
            $('nav a').parents('li, ul').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
            }
});
});