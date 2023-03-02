/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
 */

/* 
* Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
* Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
*/

let currentPopup = null;

$(document).ready(function(){
    main();
});

function main() {
    const thumbnails = getThumbnails();
    addEventListeners(thumbnails);
    Close_popup();
}

function checkAndRemoveCurrentPopup() {
    if (currentPopup) {
        currentPopup.remove();
        currentPopup = null;
    }
}

function getThumbnails() {
    const thumbnails = document.querySelectorAll(".img-thumbnail");
    return thumbnails;
}

function createPopup(thumbnail) {
    const popup = document.createElement("img");
    let src = thumbnail.src.replace("small", "large");
    popup.src = src;
    popup.setAttribute("class", "img-popup");
    thumbnail.parentNode.insertBefore(popup, thumbnail.nextSibling);
    currentPopup = popup;
}

function addEventListeners(thumbnails) {
    for (let i = 0; i < thumbnails.length; i++) {
        thumbnails[i].addEventListener("click", function(){
           checkAndRemoveCurrentPopup();
           createPopup(thumbnails[i]);
        });
    }
}

function Close_popup() {
    document.addEventListener("click", function(event) {
        if (!event.target.classList.contains('img-thumbnail') && !event.target.classList.contains('img-popup')) {
            checkAndRemoveCurrentPopup();
        }
    });
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