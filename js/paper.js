var papierGone=false;
var papierDetails=" By 2029, computers will have emotional intelligence and be convincing as people'-Ray Kurzweil,computer scientist. These advancements are possible with quality research works and innovative ideas. Have you performed any interesting experiment or do you have any such idea? Have you made any new model or prototypes? This year Convolution 5.0, organised by Department of Electrical Engineering, Jadavpur University brings you a brand new event of Paper Presentation. We encourage you to take part in this exciting event and place your innovative ideas. All presented paper will receive a  certificate from IEEE Kolkata Section. ";
var bufferP="";
var posi=0;

function papierGo() {
    if(papierGone) return;
    papierGone=true;
    var $papier=$('#papier');
    var $header=$papier.find('#header');
    $header.find('div').removeClass('hide');
    // console.log($header);
    setTimeout(function () {
        $header.find('#convo_papier').removeClass('hide');
    },400);
    setTimeout(function () {
        $header.find('#contacts_papier').removeClass('hide');
    },600);
    setTimeout(function () {
        $papier.find('#left').removeClass('hide');
        $papier.find('#right').removeClass('hide');
    },800);

    setTimeout(papier,1000);
}
function papier() {
    papierType(papierDetails);
}

function papierType(s) {
    // bufferP=s;
    posi=0;
    pbufferType();

}


 function pbufferType() {
//     var x=buffer.charAt(posi++);
//     // buffer=buffer.substr(1);
    var $left=$('#typer');
    $left.html(papierDetails.substring(0,posi+1));
    if(papierDetails.length>posi++){
        setTimeout(pbufferType,10);
    }
}

//
//
// (function(){
// 	console.API;
// 	if (typeof console._commandLineAPI !== 'undefined') {
// 	    console.API = console._commandLineAPI; //chrome
// 	} else if (typeof console._inspectorCommandLineAPI !== 'undefined') {
// 	    console.API = console._inspectorCommandLineAPI; //Safari
// 	} else if (typeof console.clear !== 'undefined') {
// 	    console.API = console;
// 	}
// 	console.API.clear();
// })();
