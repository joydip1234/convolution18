var prev = 'home';
var papier_not_started = true;
// if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
//     location.replace("mobile/");
// }
// if (screen.width < 700) {
//     document.location = "mobile/";
// }

var teamDivShowing = false;
var teamDivShown = false;


function generateTeamDiv() {
    var teamContents = $("#teamContents");
    var labels = ['Stage Committee', 'Website Development & Management and Designing & Facebook Page Management', 'Team Circuistic', 'Team Algomaniac', 'Team SparkHACK', 'Team Papier', 'Team Decisia', 'Team Inquizzitive'];

    var members = [
        ['Rounakshi Dey', 'Arunima Oraon', 'Sayan Bit', 'Aditya Bhardwaj ', 'Kundan Burnwal', 'Digjoy Roy', 'Saurav Raj', 'Aman Swarnkar', 'Kumar Govind', 'Divyanshu Agarwal', 'Hirak Bose', 'Saptaswa Sen'],
        ['Sudipto Banik', 'Joydip Panda', 'Sourajit Saha'],
        ['Soumyadeep Pal', 'Uddalok Sarkar', 'Ritam Haldar', 'Tamaghna Dasgupta','Arkanjan Das','Himalaya Pramanik','Avishek Ganguly','Trishit Das'],
        ['Joydip Panda', 'Sudipto Banik', 'Hirak Bose'],
        ['Sayantan Roychoudhury', 'Saptaswa Sen', 'Vignesh Thakkar', 'Sahil Panja'],
        ['Swananya Mukherjee', 'Ramit Bar', 'Salokya Deb', 'Digjoy Roy', 'Syed Sohail Sultan'],
        ['Tamal Maity', 'Divyanshu Agarwal', 'Rishav Jaiswal', 'Sounak Som'],
        ['Kumar Govind', 'Sahil Panja', 'Aman Swarnkar', 'Saurav Raj']
    ];

    var len = labels.length;
    for (var i = 0; i < len; i++) {
        teamContents.append("<div class='teamDesignation'>" + labels[i] + "</div>");
        for (var j = 0; j < members[i].length; j++) {
            var x = '';
            x += '<div class=\"member\">' +
                '<div class=\"member_img\">' +
                '<img src=\"img/contacts/' + members[i][j].split(' ')[0].toLowerCase() + '.jpg\" ' +
                'onerror=\'$(this).attr("src","img/contacts/user.jpg");\'>' +
                '</div>' +
                '<div class=\"member_name\">' + members[i][j].toString() + '</div>' +
                '</div>';
            teamContents.append(x);
            //teamContents.append("<div class=\"member_name\">" + members[i][j] + "</div>");
            //teamContents.append("</div>");
        }
    }
}


var scale = 1;
var papier_disp = false;


var max = 1;
var min = 1;
var holder;

function hidePreloader() {
    var $loader = $('#loader');
    setTimeout(function () {
        $loader.css({'opacity': '0'});
    }, 500);
    setTimeout(function () {
        $loader.remove();
    }, 800);
}

$(window).on('load', function () {
    hidePreloader();
    console.log('JUEE Convolution18');
    if (isMobile()) {
        papierGo();
        papier_disp = true;
    }

});
$(document).ready(function () {






    // animate scroll
    var $root = $('html, body');

    $('a[href^="#"]').click(function () {
        $root.animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);

        return false;
    });
    // animate scroll
    var papier_top = Math.floor($('#papier').offset().top - $(window).height() + 50);


    var papier_eh = function () {
        var distanceToTop = $(window).scrollTop();
        if (distanceToTop > papier_top) {
            papierGo();
            window.removeEventListener('scroll', papier_eh);
        }
    }
var boolMob=false;
    if (!isMobile()) {
        window.addEventListener('scroll', papier_eh);
    }else{
    	boolMob = true;
    	$("#zzz").fadeIn();
	    		$("#expandnoti").text("Event Schedule");
    }

    var zzzshowing = false;
    $("#expandnoti").click(function(){
    	if(!boolMob){
    		if(!zzzshowing){
	  		$("#zzz").fadeIn(300,"swing");
	    		$("#expandnoti").text("Hide Event Schedule");
	    		zzzshowing=true;
	//    		console.log(zzzshowing);
	    	}else{
	   		$("#zzz").fadeOut(200,"swing");
	    		$("#expandnoti").text("Show Event Schedule");
	    		zzzshowing=false;
	 //   		console.log(zzzshowing);
	    	}
    	}
    });


    $('#settings').click(function () {
        $('#settings_div').fadeIn(500);
    });
    $('#removeAcct').click(function () {
        document.location.href = 'php/removeAcct.php';
    });

    setTimeout(function () {
        $('.hidden').removeClass('hidden');
    }, 1000);

    if (window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        if (hash === '0' && $('#message_div').text() !== '') {
            // $('#message_div').show();
            if ($('#message_div').text().toString().includes("Wrong Username or Password")) {

                setTimeout(function () {
                    $("#login_signup_div").fadeIn(200);
                    setTimeout(function () {
                        $('#wup').show('fast');
                    }, 100);
                }, 100);
            }
        }
        window.location.hash = '';
    }
    $('#message_div .message_remove').click(function () {
        $(this).parent().fadeOut('fast');
    });
    var expanded = false;
    var changing = false;
    $('#right_div').on('click', function () {
        $('#noti_num').fadeOut('fast');
        if (!changing) {
            changing = true;
            $('#right_div').addClass('expanded');
            $("#arrow_a").addClass('arrow_rotate');
            setTimeout(function () {
                if (!expanded) {
                    $('#right_div>.content').fadeIn(200);
                }
                expanded = true;

            }, 200);
            setTimeout(function () {
                changing = false;
            }, 1000);
        }
    });

    $('#close').on('click', function () {
        if (!changing) {
            changing = true;
            setTimeout(function () {
                $('#right_div>.content').fadeOut(300);
            }, 50);
            setTimeout(function () {
                $('#right_div').removeClass('expanded');
                $("#arrow_a").attr('class', '');
                expanded = false;
            }, 250);
            setTimeout(function () {
                changing = false;
            }, 1000);
        }
    });
    $('#arrow').on('click', function () {
        $('#noti_num').fadeOut('fast');

        if (!changing) {
            if (expanded) {
                setTimeout(function () {
                    $('#right_div>.content').fadeOut(300);
                }, 50);
                setTimeout(function () {
                    $('#right_div').removeClass('expanded');
                    $("#arrow_a").attr('class', '');
                    expanded = false;
                }, 250);
            }
            setTimeout(function () {
                changing = false;
            }, 1000);
        }
    });

    $("#login_signup_btn").on('click', function () {
        $("#login_signup_div").fadeIn(200);
    });
    $("#login_signup_div_close").click(function () {

        $("#login_signup_div").fadeOut(100);
    });


    $("#know_the_team_btn").on('click', function () {
        if (!teamDivShowing) {
            teamDivShowing = true;

            $("#teamWrapper").fadeIn(200);
            if (!teamDivShown) {
                generateTeamDiv();
                teamDivShown = true;
            }
        }
    });
    $("#teamClose").click(function () {
        if (teamDivShowing) {
            $("#teamWrapper").fadeOut(100);
            teamDivShowing = false;
        }
    });

    $("#settings_close").click(function () {
        $("#settings_div").fadeOut(100);
    });


    $(".contact_preview_link").click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $("#profile_preview").fadeIn(400);
        var Name = $(this).parent().attr("info_name");
        var Contact = $(this).parent().attr("info_contact");
        setTimeout(function () {
            $("#profile_img").hide();
            $("#profile_img").find("img").attr('src', 'img/contacts/'+Name.split(' ')[0].toLowerCase()+'.jpg');
            $("#profile_img").fadeIn(200);
            $("#profile_name").text(Name);
            $("#profile_contact").text(Contact);
        },100);
    });
    $("#close_profile_btn").click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $("#profile_preview").fadeOut(200);
        setTimeout(function () {
            $("#profile_img").find("img").attr('src', '');
            $("#profile_contact").text('');
            $("#profile_name").text('');
        },300);

    });

});