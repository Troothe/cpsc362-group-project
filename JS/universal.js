$( window ).on("load", function() {
    console.log('Detect browser: ' + getUserBrowser());
    if(document.getElementById('ImportantError')) {
        startModal('ImportantError');
    }
});

function getUserBrowser() {
    if (navigator.userAgent.search("MSIE") >= 0 || navigator.userAgent.search("Trident") >= 0) {
        return 'Internet Explorer';
    }
    else if (navigator.userAgent.search("OPR") >= 0) {
        return 'Opera';
    }
    else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        return 'Safari';
    }
    else if (navigator.userAgent.search("Edge") >= 0) {
        return 'Edge';
    }
    else if (navigator.userAgent.search("Chrome") >= 0) {
        return 'Chrome';
    }
    else if (navigator.userAgent.search("Firefox") >= 0) {
        return 'Firefox';
    }
    else {
        return 'Unknown';
    }
}


//This function will gray out all of the screen execpt for whatever element has the id attribute of what the function is given
function startModal(id) {
    $("body").prepend("<div id='PopupMask' style='position:fixed;width:100%;height:100%;z-index:10;background-color:gray;'></div>");
    $("#PopupMask").css('opacity', 0.5);  
    $("#"+id).data('saveZindex', $("#"+id).css( "z-index"));
    $("#"+id).data('savePosition', $("#"+id).css( "position"));
    $("#"+id).css( "z-index" , 11 );
    $("#"+id).css( "position" , "fixed" );
}

//This function will stop the screen grayout (return to normal), and needs the id attribute of the element given to the function startModal
function stopModal(id) {
    if ($("#PopupMask") == null) return;
    $("#PopupMask").remove();
    $("#"+id).css( "z-index" , $("#"+id).data('saveZindex') );
    $("#"+id).css( "position" , $("#"+id).data('savePosition') );
}

function showLoadingWheel(message = '') {
    if(!document.getElementById('LoadingWheel')) {
        $("body").prepend("<div id='LoadingWheel' style='position:fixed;width:150px;height:170;z-index:11;background-color:white;border:2px solid black; left: calc(50% - 75px); top:calc(40% - 75px); border-radius: 20px;'><img src='images/loading_wheel.gif' style='width: 100%; height: 150px;' /><p style='width: 100%; height: 20px; text-align: center; font-size: 9pt;'>" + message + "</p></div>");
    } else {
        document.getElementById('LoadingWheel').style.display = '';
    }
}

function hideLoadingWheel() {
    document.getElementById('LoadingWheel').style.display = 'none';
}
