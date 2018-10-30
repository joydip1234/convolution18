<?php
require_once "php/functions.php";
$await_confirm = 0;
$name = "";
$email = "";
$num_noti = 0;
$m = '';
$id = 0;
$info = '';
if (isset($_COOKIE['convo_mail'])) {
    $email = $_COOKIE['convo_mail'];
    if (isset($_COOKIE['convo_token'])) {
        $token = $_COOKIE['convo_token'];
//        echo "SELECT * FROM `cookie` WHERE `mail`='$email' AND `token`='$token'";
        $result = sql("SELECT * FROM `cookie` WHERE `mail`='$email' AND `token`='$token'");
        if ($result->num_rows > 0) {
//            $row = $result->fetch_assoc();
//            $mail = $row['mail'];
            $row = sql("SELECT * FROM `users` WHERE `email`='$email'")->fetch_assoc();
//            print_r($row);
            $name = $row['name'];
            $id = $row['id'];
            if (!isset($_SESSION['on'])) {
                $token = randomString(64);
                sql("UPDATE `cookie` SET `token`='$token' WHERE `mail`='$email'");
                setcookie('convo_token', $token, time() + (86400 * 30), "/");
            }
        } else {
//            $_COOKIE['convo_mail'] = '';
//            $_COOKIE['convo_token'] = '';
            setcookie('convo_mail', '', time() + (86400 * 30), "/");
            setcookie('convo_token', '', time() + (86400 * 30), "/");

        }
    }

    if ($name != '') {
        $result = sql("SELECT * FROM `noti` WHERE `email`='$email' AND `seen`=0 ORDER BY `ts` DESC");
        $num_noti = $result->num_rows;
        $result_seen = sql("SELECT * FROM `noti` WHERE `email`='$email' AND `seen`=1 ORDER BY `ts` DESC");
        $events = sql("SELECT `event` FROM `registration` WHERE `email`='$email'");
        $eventNames = array();
        foreach ($events as $eventName) {
            $eventNames[$eventName['event']] = 1;
        }
        $info = sql("SELECT * FROM `users` WHERE `email`='$email'")->fetch_assoc();
    }
}
pageHit($email);
if (isset($_GET['m'])) $m = $_GET['m'];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website for Convolution 2018"/>
    <meta name="keywords"
          content="event, fest, convolution, 2018, jadavpur university, electrical engineering, 18, 2k18"/>


    <title>Convolution 2018</title>
    <meta property="og:title" content="Convolution 2018"/>
    <meta property="og:description"
          content="The Annual Techno-Management Fest of Jadavpur University Electrical Engineering Department"/>
    <meta property="og:image" content="http://www.convolutionjuee.com/img/og.jpg"/>
    <meta property="og:url" content="http://www.convolutionjuee.com"/>
    <meta property="og:type" content="website"/>
    <meta property="fb:admins" content="100002783466920"/>
    <meta property="fb:app_id" content="748958801934087"/>
    <link rel="shortcut icon" type="image/svg+xml" href="favicon.svg"/>
    <link rel="preload" href="img/new/circular.gif" as="image">
    <script src="js/anime.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/loader.css"/>
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/algo.css"/>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/spinner.css"/>
    <script type="text/javascript" src="js/jq.js"></script>

</head>
<body>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '748958801934087',
            xfbml: true,
            version: 'v2.8'
        });
        FB.AppEvents.logPageView();
        $(document).trigger('fbload');
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    $(document).on('fbload', function () {

        FB.AppEvents.logEvent("pageHit");
        <?php
        if ($id != 0) echo "FB.AppEvents.logEvent(\"pageHitUser_$id\");";
        ?>
    });

    console.log( <?php if (isset($eventNames['circuistic'])) echo "'circuistic registered'"; else echo "'circuistic not'"; ?>);


</script>
<noscript>
    Javascript is disabled. Redirecting...
    <meta HTTP-EQUIV="REFRESH" content="0; url=lite/">
</noscript>
<div id="loader">
    <div id="preloader_custom">
        <div id="preloader_image"><img src="img/new/circular.gif"></div>
        <span id="preloader_text"> <small style="color: #E91E63">juee </small><br>
            <h1 class="ml6">
                <span class="text-wrapper">
                    <span class="letters">
                         CONVOLUTION
                    </span>
                </span>
            </h1>
            <span style="color: #00ACC1;">2018</span>
        </span>
        <script>
            $('.ml6 .letters').each(function () {
                $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
            });
            anime.timeline({loop: true})
                .add({
                    targets: '.ml6 .letter', translateY: ["1.1em", 0], translateZ: 0, duration: 750,
                    delay: function (el, i) {
                        return 50 * i;
                    }
                }).add({
                targets: '.ml6', opacity: 0, duration: 1000, easing: "easeOutExpo", delay: 1000
            });
        </script>

        <div id="mousescroll">
            <img src="img/scroll.svg">
        </div>
        <div id="keyboard">
            <img src="img/keys.svg">
        </div>
    </div>

</div>
<div id="holder">
    <div id='nav'>
        <ul>
            <a href="#home">
                <li id="tab-home" data-id="header">Home</li>
            </a>
            <a href="#about">
                <li id="tab-about" data-id="about">About</li>
            </a>
            <a href="#workshop">
                <li id="tab-workshop" data-id="workshop">Workshop</li>
            </a>
            <a href="#circuistic">
                <li id="tab-circuistic" data-id="circuistic">Circuistic</li>
            </a>
            <a href="#algomaniac">
                <li id="tab-algomaniac" data-id="algomaniac">Algomaniac</li>
            </a>
            <a href="#sparkhack">
                <li id="tab-sparkhack" data-id="sparkhack">SparkHACK</li>
            </a>
            <a href="#papier">
                <li id="tab-papier" data-id="papier">Papier</li>
            </a>
            <a href="#decisia">
                <li id="tab-decisia" data-id="decisia">Decisia</li>
            </a>
            <a href="#inquizzitive">
                <li id="tab-inquizzitive" data-id="inquizzitive">Inquizzitive</li>
            </a>
            <!--<li id="tab-sponsors" data-id="sponsors"><span><b>Sponsors</b></span></li>-->
            <a href="#contact">
                <li id="tab-contact" data-id="contact">Contact</li>
            </a>
        </ul>
    </div>
</div>

<!--<div id="button_login"></div>-->
<!--<div id="message_div" style="display:none;">-->
<!--    <div id="message">--><!--?php
//        if ($m != '') {
//            if ($m == 'li') {
//                echo "Logged In";
//            } else if ($m == 'lo') {
//                echo "Logged Out";
//            } else if ($m == 'wp') {
//                echo "Wrong Username or Password";
//            } else if ($m == 'nc') {
//                echo "Please confirm your e-mail ID first.";// <a id='resend' href='php/resend.php'></a>
//            } else if ($m == 'ar') {
//                echo "Account deleted.";
//            }
//        }
//        ?><!--</div>-->
<!--    <div class="message_remove">&#x2715;</div>-->
<!--</div>-->


<div id="login_signup_div">
    <div id="login_signup_div_content">
        <div id="login_signup_div_close">&#x2715;</div>
        <div id="login_signup_div_content_in">
            <div class="log_sin">
                <form action="php/login.php" method="post" name="login_form">
                    <label>Login</label>
                    <div id="wup" style="color: red;display:none;margin:5px">Wrong Username Or Password.</div>
                    <div id="lif">Sign in or Signup First.</div>
                    <input required="required" type="email" id="login_email" name="login_email"
                           placeholder="Your registered E-mail ID"/>
                    <input required="required" type="password" id="login_pass" name="login_pass"
                           placeholder="Password"/>
                    <button id="login_btn">Sign In</button>
                </form>
            </div>

            <div class="log_sin">
                <form action="php/signup.php" method="post" name="signup_form" id="signup_form">
                    <label>sign up</label>
                    <input required="required" type="text" id="signup_name" name="signup_name" placeholder="Name"/>
                    <input required="required" type="email" id="signup_email" name="signup_email"
                           placeholder="E-mail ID"/>
                    <input required="required" type="tel" maxlength="15" id="signup_contact" name="signup_contact"
                           placeholder="Contact Number"/>
                    <input required="required" pattern=".{8,100}" type="password" id="signup_password"
                           name="signup_password" placeholder="Password (At least 8 characters long)"/>
                    <input required="required" type="password" id="signup_password_2" name="signup_password_2"
                           placeholder="Confirm Password"/>
                    <input required="required" autocomplete="new-password" "type="text" id="signup_institute"
                    name="signup_institute"
                    placeholder="College or University"/>
                    <input required="required" autocomplete="new-password" type="text" id="signup_dept"
                           name="signup_dept"
                           placeholder="Department"/>
                    <select required="required" id="class" name="class">
                        <optgroup label="class">
                            <option>Still in School</option>
                            <option selected="selected">UG 1st yr</option>
                            <option>UG 2nd yr</option>
                            <option>UG 3rd yr</option>
                            <option>UG 4th yr</option>
                        </optgroup>
                    </select>
                    <button id="signup_btn" type="submit">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="detailsDivWrapper">
    <div id="detailsDiv">
        <div id="detailsDivClose">&#x2715;</div>
        <iframe id="detailsDivFrame" src=" "></iframe>
    </div>
</div>

<div id="nameDummy" style="display:none;"><?php echo $name; ?></div>


<div id="right_div" class="home">
    <div id="noti_num" style="<?php if ($num_noti == 0) echo "display:none;" ?>">
        <!--<div style="display: table-cell; vertical-align: middle;">
            
        </div-->
    </div>
    <div class="content" style="display:none; ">
        <div id="close" style="color:white;cursor:pointer;float:right;">&#x2715;</div>

        <div id="content_inside">

            <div <?php if ($name != '') echo 'style="display:none;"'; ?>id="login_signup_btn" class="noSelect">
                Sign In / Sign Up
            </div>
            <div id="name_show" <?php if ($name == '') echo 'style="display:none;"'; ?> >
                <?php echo $name . '<br/>' . $email; ?>

            </div>
            <!--div id="noti_dummy" style="display:none;cursor: pointer">
                <div class="notification">
                    random notification
                    <div class="notification_remove">&#x2715;</div>
                </div>
            </div-->
            <div id="fbWrapper">
                <div id="noti">
                    <div class="notification"
                         style="background-color: rgb(255, 190, 74);margin:2px; height:100px;border-radius: 2px">
                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fconvolution.juee&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId"
                                width="236" height="95" style="border:none;overflow:hidden" scrolling="no"
                                frameborder="0" allowTransparency="true"></iframe>
                    </div>
                </div>
            </div>
            <div id="notifications_wrapper" <?php if ($name == '') echo 'style="display:none;"'; ?> class="noSelect">

            </div>
            <div id="notifications_buttons" <?php if ($name == '') echo 'style="display:none;"'; ?> >
                <!--div id="settings">Settings</div-->
                <a id="logout" href="php/logout.php">
                    <div>Logout</div>
                </a>
            </div>
        </div>
    </div>
    <div id="arrow">
        <div id="arrow_a" style="color:white;cursor:pointer;">

            <?php

            if ($name == '') echo '<i class="fa fa-sign-in"></i> SignIn / SignUp';
            else echo '<i class="fa fa-user"></i> Signed In'

            ?>
        </div>
    </div>
</div>


<!--<div id="bg"></div>-->
<div id="wrapper">

    <div id="teamWrapper" style="display:none">
        <div id="teamDiv">
            <div id="teamClose">&#x2715;</div>
            <div id="teamContents">

            </div>
        </div>
    </div>
    <div id="main">
        <div id="convo">
            <div class="bg" id="landing_animation"></div>
            <div id="home" class="item">
                <div class="inner">
                    <span class="foreground hidden" id="first"><small>juee</small><br>CONVOLUTION</span>
                    <div class="line hidden"></div>
                    <div class='btn-cont hidden'>
                        <div class='btn' href='#'>
                            23rd - 25th February
                            <span class='line-1'></span>
                            <span class='line-2'></span>
                            <span class='line-3'></span>
                            <span class='line-4'></span>
                        </div>
                    </div>
                </div>
            </div>


            <div id="about" class="item">
                <div id="content">
                    <img src="img/logo-transparent.png" id="logo"/>

                    <p class="text">
                        <b><u>Convolution 2018</u></b><br>
                        The annual technical meet organized by the students of the Department of Electrical
                        Engineering, Jadavpur University. It is aimed at providing a platform for engineering students
                        to learn and apply their acquired skills. The 3-day long event will promote extensive
                        interaction
                        among creative solution designers and prominent personalities from academics and industries.
                    </p>
                    <p class="text" style="padding-bottom: 10px;">
                        <span style="padding: 10px;margin-bottom: 2vh"><i class="fa fa-calendar-check-o"></i> 23-25th February </span><br>
                        <span class="line"></span>
                        <span style="padding: 10px;margin-bottom: 2vh">
                        <i class="fa fa-university"></i> Jadavpur University Electrical Engineering Department </span>
                    </p>
                </div>
            </div>

            <div id="workshop" class="item" style="background-color: #333">
                <div id="w_content">


                    <p class="text">
                        <br><br><b><u style="font-size: 1.5em"> Ethical Hacking Workshop </u></b><br>
                        <div style="line-height: 1.3em !important;
font-weight: 400;
color: ghostwhite;
font-size: 1.2em;
padding: 3vw;
background-color: #2f4f4fcc;">
                            Hacking is not about the illegal things it's all about how to secure your cyberspace and
                            system from attacks. In this workshop cyber ethics, email hacking & security, malware
                            attacks, windows system attacks,online data Investigation,credit card frauds & Cases,
                            playing with google by google hacking, android mobile hacking etc. topics will be covered.
                            This workshop aims to give Technocrats a basic knowledge of hacking and how to protect
                            your system against hazardous effects.
                        </div>
                    </p>

                    <p class="text">
                        <br>
                        <a style="border: 1px solid #a9a;padding: 5px 17px;margin: 6px;"
                           href="https://docs.google.com/forms/d/e/1FAIpQLSe4nxTCLmgYr5QRFGKIuOXjF05IjgqLH0CCaAAFM-AwzHxeWw/viewform"
                           target="_blank"> Register For the Workshop </a>
                        <br>
                    </p>


                    <p class="text" style="padding-bottom: 10px;">
                        <span class="workshop_lines"> Certificate of Participation to all Participants from i3indya Technologies </span>
                        <span class="workshop_lines"> Certificate of Coordination to the Organizers/Coordinators </span>
                        <span class="workshop_lines"> Certificate of Association to College/University from i3indya Technologies </span>
                    </p>
                </div>
            </div>


        </div>

        <div id="events">

            <div id="circuistic" class="item">
                <section class="event_width_control">
                    <span id="circuistic_header">CIRCUISTIC 5.0</span><br>
                    <div id="circuistic_text">
                        Tired of reading only text books? Have an inherent love for circuits?
                        Then this is the event you are looking for. CONVOLUTION 2018 presents CIRCUISTIC 5.0, the
                        circuit
                        building event of the year. To all the enthusiasts and hobbyists out there here is your chance
                        to
                        create magic with circuits and walk away with awesome prizes.<br>
                        The contestants will be given a problem statement, which has to be analysed and practically
                        realised
                        by building a prototype circuit. The prototype must be both efficient and economical.
                        Come. Build. Win.
                    </div>
                    <br>
                    <div>
                        <div class="event_button_wrapper">
                            <div class="circuistic_details_btn event_btn pdf"
                                 style="text-decoration:none;float: left;" event="circuistic">DETAILS
                            </div>
                            <div
                                    style="text-decoration:none;float: right;<?php if (isset($eventNames['circuistic'])) echo "cursor:default;"; ?>"
                                    class="event_btn register" event="circuistic">
                                <div class="spinner" style="display:none">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                                <div class="tx" <?php if (isset($eventNames['circuistic'])) echo "status='done'"; ?>>
                                    Register<?php if (isset($eventNames['circuistic'])) echo "ed"; ?></div>
                            </div>

                            <div style="clear: both"></div>
                        </div>
                    </div>
                    <div class="contacts_wrap">
                        <i class="fa fa-phone"></i>
                        Contact :
                        <span class="v_bar"></span>
                        Soumyadeep Pal : 9674087392
                        <span class="v_bar"></span>
                        Uddalok Sarkar : 8927488247
                    </div>

                </section>
            </div>


            <div id="algomaniac" class="item">

                <div id="algomaniac_title">ALGOMANIAC</div>
                <div id="algo_main_div">


                    <div id="code_write" class="algomaniac_divs">
                        <div class="algo_title_bar">main.cpp</div>
                        <code id="algo_code">

                        </code>

                    </div>

                    <div id="code_execute" class="algomaniac_divs">
                        <div class="algo_title_bar">Terminal</div>
                        <div id="show_result">
                            <span class="cd3">root@Convolution18#</span>
                            <span class="cd4">g++ main.cpp -o main</span>
                            <br>
                            <span class="cd3">root@Convolution18#</span>
                            <span class="cd4">./main < input.txt > out.txt </span>
                            <br>
                            <span class="cd3">root@Convolution18#</span>
                            <span class="cd4">cat out.txt </span>
                            <br>
                            <span class="cd4">
                                <p style="line-height: 1.1em">
                                    <b style="color: white">Algomaniac</b> Event Details :<br><br>
                                    Coding has never been so awesome before. So you think you can tame an
                                    wild territory of algorithms, data structures and maths under shortage
                                    of time and space? Then this is the place you deserve! What's more?
                                    This year, the format ensures that you get to battle it out with the
                                    bests even if you call yourself a novice (we know you aren't).
                                    " Think Twice Code Once ".
                                </p>
                            </span>
                            <span class="cd4">
                                <p>
                                    <u>Contacts :</u>
                                    <br><br>
                                    <span><span class="cppKeyWord">Sudipto Banik</span> : <u>9051073567</u> </span>
                                    or
                                    <span><span class="cppKeyWord">Joydip Panda</span> : <u>8670692665</u> </span>
                                </p>


                            </span>
                            <span class="cd4">
                                <p>
                                    PrizeMoney will be declared soon .. :)
                                </p>


                            </span>
                        </div>
                        <div class="algo_interface">
                            <div class="algo_buttons_class pdf" event="algomaniac"> Details</div>
                            <div class="algo_buttons_class register" event="algomaniac"
                            <?php if (isset($eventNames['algomaniac'])) echo "cursor:default;"; ?>">
                            <div class="spinner" style="display:none">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                            <div class="tx" <?php if (isset($eventNames['algomaniac'])) echo "status='done'"; ?>>
                                Register<?php if (isset($eventNames['algomaniac'])) echo "ed"; ?>
                            </div info="class_tx_end">
                        </div>

                    </div info="code_execute_end">

                </div info="algo_main_div_end">
            </div info ="algomaniac_end">


            <div id="sparkhack" class="item">
                <span id="sparkhack_title">SparkHACK 4.0</span><br>

                <div id="sparkhack_wrapper">
                    <section class="event_width_control">
                        <div id="sparkhack_text" style="cursor: default;">
                            Code,create, build and revolutionize in this fourth edition of eastern India's biggest
                            Hackathon, SparkHACK. In this 3-Day hackathon, college students as well professionals
                            will strive to build a model which caters to this year's theme which is Technology and
                            Social
                            Welfare.
                            The latest piece of technical jargon that has been the centre of interests in the world of
                            technology
                            in the recent years. Students and professionals are invited to this <b>3-day</b> hackathon
                            to bring
                            to
                            life
                            their innovative ideas in the field of IOT using their Technical expertise.
                            So step your game up this February as there's a lot to be won.
                            Compete with some of the best minds and your idea just might be the next
                            big thing for this society.

                        </div>
                        <div style="margin: 1.2vw auto">
                            <div class="event_button_wrapper">
                                <div class="sparkhack_details_btn event_btn pdf"
                                     style="float: left;" event="sparkhack">DETAILS
                                </div>
                                <div style="float: right;<?php if (isset($eventNames['sparkhack'])) echo "cursor:default;"; ?>"
                                     class="event_btn register" event="sparkhack">
                                    <div class="spinner" style="display:none">
                                        <div class="bounce1"></div>
                                        <div class="bounce2"></div>
                                        <div class="bounce3"></div>
                                    </div>
                                    <div class="tx" <?php if (isset($eventNames['sparkhack'])) echo "status='done'"; ?>>
                                        Register<?php if (isset($eventNames['sparkhack'])) echo "ed"; ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="contacts_wrap" style="margin-top: 3vh">
                            <i class="fa fa-phone"></i> Contact:
                            <span class="v_bar"></span>
                            Sayantan Roy Choudhury : 8981738669
                        </div>

                    </section>
                </div>
            </div>

            <div id="papier" class="item" style="border:0.4em solid #7d7d7d">
                <div id="papier_title">
                    <div>Papier <br/> ( Paper Presentation )</div>
                    <div>Convolution 2018</div>

                </div>
                <div class="container">
                    <div id="body">
                        <div class="hide" id="left"><b
                                    style="font-weight: bold;text-decoration: underline">Abstract:</b>
                            <div id="typer"></div>
                        </div>
                        <div class="hide" id="right">
                            <div id="papier_notice">
                                To participate in Papier<br>
                                contact with<br>
                                Swananya Mukherjee: <u>8981939095</u>
                                or<br>
                                Ramit Bar: <u>8902760831</u><br>


                            </div>
                            <div id="button_wrapper">
                                <div class="papier_buttons_class pdf" event="papier">
                                    Details
                                </div>
                            </div>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>


            <!--********* Decisia ********-->
            <div id="decisia" class="item">
                <div id="decisia_title">DECISIA</div>
                <section class="event_width_control">
                    <div id="decisia_content">
                        The first word that pops into our mind when we think about
                        'Engineering' is Logic. We all would agree upon the fact that
                        Logical reasoning and decision making comes very natural to us.
                        So are you game to put these instincts and abilities of yours to
                        test? If yes, DECISIA is what you are looking for!
                    </div>
                    <br>
                    <div class="event_button_wrapper">
                        <div class="decisia_details_btn event_btn pdf"
                             style="float: left;" event="decisia">DETAILS
                        </div>
                        <div style="float: right;<?php if (isset($eventNames['decisia'])) echo "cursor:default;"; ?>"
                             class="event_btn register" event="decisia">
                            <div class="spinner" style="display:none">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                            <div class="tx" <?php if (isset($eventNames['decisia'])) echo "status='done'"; ?>>
                                Register<?php if (isset($eventNames['decisia'])) echo "ed"; ?></div>
                        </div>

                        <div style="clear: both"></div>
                    </div>
                    <div class="contacts_wrap">
                        <i class="fa fa-phone"></i>
                        Contact :
                        <span class="v_bar"></span>
                        Tamal Maity : 9831537855
                        <span class="v_bar"></span>
                        Rishav Jaiswal : 7278432298
                        <span class="v_bar"></span>
                        Divyanshu Agarwal : 8585898023
                    </div>

                </section>
            </div>

            <div id="inquizzitive" class="item">
                <div id="inquizitive_title">INQUIZITIVE</div>
                <section class="event_width_control">
                    <div id="inquizzitive_content">

                        We love to ask questions,right? It's one of the characteristics of human nature:
                        inquisitiveness. To question things, to understand how nature works, and why things function in
                        a certain way. This quest of knowledge is what enriches human kind and makes it an intelligent
                        race.

                        We at Convolution promote this culture of acquiring knowledge and answering the important
                        questions. INQUIZZITIVE is a quiz contest we organize as part of Convolution which tests your
                        quizzing skills and your repertoire of knowledge about various things. So play your cards well
                        this February!

                    </div>
                    <br>
                    <div class="event_button_wrapper">
                        <div class="inquizzitive_details_btn event_btn pdf"
                             style="float: left;" event="inquizzitive">DETAILS
                        </div>
                        <div style="float: right;<?php if (isset($eventNames['inquizzitive'])) echo "cursor:default;"; ?>"
                             class="event_btn register" event="inquizzitive">
                            <div class="spinner" style="display:none">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                            <div class="tx" <?php if (isset($eventNames['inquizzitive'])) echo "status='done'"; ?>>
                                Register<?php if (isset($eventNames['inquizzitive'])) echo "ed"; ?></div>
                        </div>

                        <div style="clear: both"></div>
                    </div>
                    <div class="contacts_wrap">
                        <i class="fa fa-phone"></i>
                        Contact :
                        <span class="v_bar"></span>
                        Kumar Govind : 9674635941

                    </div>

                </section>

            </div>

            <!--            <div id="sponsors" class="item">-->
            <!--                <img style="width:100vw" src="img/spons.jpg"/>-->
            <!--            </div>-->
            <!--            <div id="sponsors" class="item cs">-->
            <!--                <!--            <h1 id="sponsors" class="item">SPONSORS</h1>-->
            <!--                <div class="blankDiv">-->
            <!--                    <div class="progress">-->
            <!--                        <div class="indeterminate"></div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->


            <div id="contact" class="item">
                <div style="text-align: center;font-size: 1.5em;color: black;padding:50px 0 0;display: block;">
                    CONTACTS
                </div>
                <div id="contacts_container">
                    <div id="contact_list" style="float: left">
                        <div class="contact_label">JUEE Students Forum Core Team</div>


                        <div class="contact_link" info_name="Rounakshi Dey" info_contact="9477581709">Secretary</div>
                        <div class="contact_link" info_name="Arunima Oraon" info_contact="8017067493">Joint Secretary
                        </div>
                        <div class="contact_link" info_name="Sayan Bit" info_contact="9593697663">Treasurer</div>
                        <div class="contact_link" info_name="Rishav Jaiswal" info_contact="8777031958">Joint Treasurer
                        </div>

                        <br><br>


                        <div class="contact_label">Others</div>


                        <div class="contact_link" info_name="Sudipto Banik" info_contact="9051073567">Website
                            Development and Management
                        </div>
                        <div class="contact_link" info_name="Uddalok Sarkar" info_contact="8927488247">Sponsors Lead
                        </div>
                        <div class="contact_link" info_name="Sourajit Saha" info_contact="8335896006">Design Lead</div>
                        <div class="contact_link" info_name="Hirak Bose" info_contact="8335850526">Logistic Lead</div>
                        <div class="contact_link" info_name="Swananya Mukherjee" info_contact="8981939095">Publicity
                            Lead
                        </div>

                        <div id="know_the_team_btn"> All Members</div>
                    </div>
                    <div id="div_for_query" style="float: right">


                        <div id="event_leads">

                            <div class="contact_label">Event Leads</div>
                            <div class="contact_link" info_name="Soumyadeep Pal" info_contact="9674087392">CIRCUISTIC
                            </div>
                            <div class="contact_link" info_name="Joydip Panda" info_contact="8670692665">ALGOMANIAC
                            </div>
                            <div class="contact_link" info_name="Sayantan Roychoudhury" info_contact="8981738669">
                                SPARKHACK
                            </div>
                            <div class="contact_link" info_name="Swananya Mukherjee" info_contact="8981939095">PAPIER
                            </div>
                            <div class="contact_link" info_name="Tamal Maity" info_contact="9831537855">DECISIA</div>
                            <div class="contact_link" info_name="Kumar Govind" info_contact="9674635941">INQUIZZITIVE
                            </div>
                            <br><br>

                        </div>


                        <div style="display: block;padding: 15px;color: #2a2e39">Have any Query? Ask us..</div>
                        <form id="queryForm" action="" method="post">
                            <textarea placeholder="type here [If you expect a reply from us, please Log In, or put your contact details in the query]" id="query_input"></textarea>                            <button id="query_submit">Send</button>
                        </form>
                    </div>
                </div>
                <div id="footer">
                    <div><a href="https://www.facebook.com/convolution.juee">facebook.com/convolution.juee</a></div>
                    <div><a href="mailto:juconvo18@gmail.com">juconvo18@gmail.com</a></div>
                    <div>CONVOLUTION JUEE</div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="profile_preview">
    <div id="profile">
        <div id="profile_close"><i class="fa fa-close" id="close_profile_btn"></i></div>
        <div id="profile_img" class="profile_info"><img style="width: 100%;max-height: 400px" src=""/></div>
        <div id="profile_name" style="font-size: 2.5em" class="profile_info"></div>
        <div id="profile_contact" style="padding: 1em" class="profile_info"></div>
    </div>
</div>


<script>

    $(document).ready(function () {
        $(".contact_link").append('<i class="fa fa-expand contact_preview_link"></i>');
    });

</script>

<script type="text/javascript" src="js/jquery.flot.js"></script>
<!--<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/login_signup.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<script type="text/javascript" src="js/console.js"></script>
<script type="text/javascript" src="js/paper.js"></script>
<script type="text/javascript" src="js/pdf.js"></script>
<script type="text/javascript" src="js/query.js"></script>
</body>
</html>
