function isMobile() {
    var itIs = false;
    if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || screen.width < 700) {
        itIs = true;
    }
    return itIs;
}



$('document').ready(function () {

    $(".pdf").click(function (e) {
        e.preventDefault();
        var event=$(this).attr('event');
        
        if(!isMobile()){
            
            $("#detailsDivFrame").attr('src','php/pdf.php?pdf='+event);
            $("#detailsDivWrapper").fadeIn(100);
             
        }else{
                var link = document.createElement('a');
            link.href = '../pdf/'+event.toString() + '.pdf';
        link.download = event.toString() + '.pdf';
        link.dispatchEvent(new MouseEvent('click'));
        }
    });
    $("#detailsDivClose").click(function () {
        $("#detailsDivWrapper").fadeOut(50);
        $('#detailsDivFrame').attr('src','');
    });

});