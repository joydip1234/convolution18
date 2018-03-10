var code_lines = [
    "<span class='cd1'> #include < bits/stdc++.h ></span>",
    "<span class='cd1'> #include < juee/convolution > </span>",
    "<span class='cd1'> using namespace std; </span>",
    "<span class='cd2'><span class='cppKeyWord'>int</span> main(){ </span>",
    "<span class='cd2'><span class='tab_in_code'></span>convolition convo18 = <span class='cppKeyWord'>new</span> convolution();</span>",
    "<span class='cd2'><span class='tab_in_code'></span><span class='cppKeyWord'>cout</span> << convo18.details() << <span class='cppKeyWord'>endl</span>; </span>",
    "<span class='cd2'><span class='tab_in_code'></span><span class='cppKeyWord'>cout</span> << convo18.contacts() << <span class='cppKeyWord'>endl</span>;   </span>",
    "<span class='cd2'><span class='tab_in_code'></span><span class='cppKeyWord'>cout</span> << convo18.prizeMoney() << <span class='cppKeyWord'>endl</span>;   </span>",
    "<span class='cd2'><span class='tab_in_code'></span><span class='cppKeyWord'>return</span> 0;</span>",
    "<span class='cd2'>}</span>"
];


$(document).ready(function () {
    console.log("_e2working");
    var code_length = code_lines.length;
    var editor = $("#algo_code");
    function typecode() {
        var index = 0;
        setInterval(function () {
            editor.append("<span class='line_number'>"+('0' + (index+1)).slice(-2).toString()+"</span>   "+code_lines[index] + "<br/>");
            index++;
            if(index === (code_length + 1)){
                index = 0;
                editor.text('');
            }
        },800);
    }
    typecode();
});








// /**
//  * Created by Subhashis on 24-01-2017.
//  */
// $console = $('#algo_code');
// var algomaniac = "<br><div style ='font-size: 3em;'>Algomaniac</div>";
//
// var algo_details = "Coding has never been so awesome before. So you think you can tame an wild territory of algorithms, data structure and AI techniques under shortage of time and space? Then this is the place you deserve! What's more? This year, the format ensures that you get to battle it out with the bests even if you call yourself a novice (we know you aren't). So get ready to become the maniac!<br>Contact: Sudipto Banik: +91 9051073567 || Joydip Panda: +91 8670692665 ";
//
// var python36 = "Python 3.6.4 (v3.6.4:d48eceb, Dec 19 2017, 06:54:40)<br> " +
//                 "[MSC v.1900 64 bit (AMD64)] on win32<br>Type \"help\", " +
//                 "\"copyright\", \"credits\" or \"license\" for more information.<br>";
//
// var algo_prizes = " will be declared soon<br>";
// var convoRoot = "<br><div style='display:inline-block;color:#eb3d3d'>root</div>@<div style='display:inline-block;color:#6e9ff9'>Convolution18</div># ";
// var typing = false;
// var buffer = "";
// var realbuffer = "";
// var totlen = 0;
// var stopped = true;
// var gone = false;
//
// function con_print(s, i) {
//     setTimeout(function () {
//         $console.html($console.html() + "<br><div class=\"consoleprint\">" + s + "</div>");
//         if (i === -2) stopped = true;
//         if (i === 23) stopped = true;
//         loop(i + 1);
//     }, 50);
// }
//
// function bufferType(s, i) {
//     typing = true;
//     $console.html($console.html() + buffer[0]);
//     buffer = buffer.substr(1);
//     if (buffer.length > 0) {
//         setTimeout(function () {
//             bufferType(s, i);
//         }, 50 + Math.random() * 200);
//     } else {
//         $console.html($console.html().substr(0, $console.html().length - totlen) + "<div class=\"consoletext\" style=\"color:" + s + "\">" + realbuffer + "</div>");
//         typing = false;
//         setTimeout(function () {
//             loop(i + 1);
//         }, 0);
//     }
// }
//
// function con_type(s, color, i) {
//     stopped = false;
//     buffer = s + " ";
//     realbuffer = buffer;
//     totlen = buffer.length;
//     setTimeout(function () {
//         bufferType(color, i);
//     }, 200);
//
// }
//
// function con_clear() {
//     setTimeout(function () {
//         $console.html("");
//         if ($('#algo_code').hasClass('active'))
//             loop(0);
//         else {
//             loop(-2);
//         }
//     }, 100);
// }
//
// var jump = false;
//
// function loop(i) {
//
//     if (i === -2) con_print(convoRoot, i);
//     if (i === 0) {
//         con_print(convoRoot, i);
//         jump = true;
//     }
//     else if (jump || (i == 1)) {
//         con_type("python", "white", i);
//         jump = false;
//     }
//     else if (i === 2) con_print(python36, i);
//     else if (i === 3) con_print(">>> ", i);
//     else if (i === 4) con_type("from", "orange", i);
//     else if (i === 5) con_type("convolution", "white", i);
//     else if (i === 6) con_type("import", "orange", i);
//     else if (i === 7) con_type("*", "white", i);
//     else if (i === 8) con_print("<br>>>> ", i);
//     else if (i === 9) con_type("print", "orange", i);
//     else if (i === 10) con_type("algomaniac", "white", i);
//     else if (i === 11) con_print(algomaniac, i);
//     else if (i === 12) con_print(">>> ", i);
//     else if (i === 13) con_type("print", "orange", i);
//     else if (i === 14) con_type("details", "white", i);
//     else if (i === 15) con_print(algo_details, i);
//     else if (i === 16) loop(20)//con_print("<br>>>> ", i);
//     // else if (i == 17)con_type("print", "orange", i);
//     // else if (i == 18)con_type("prizes", "white", i);
//     else if (i === 19) con_print(algo_prizes, i);
//     else if (i === 20) con_print("<br>>>> ", i);
//     else if (i === 21) con_type("exit", "orange", i);
//     else if (i === 22) con_type("()", "yellow", i);
//     else if (i === 23) con_print(convoRoot, i);
//     else if (i === 25) con_type("clear", "white", i);
//     else if (i === 26) con_clear();
// }
//
// function go() {
//     if (stopped) {
//         if (!gone) {
//             gone = true;
//             stopped = false;
//             loop(1);
//         } else {
//             loop(25);
//             stopped = false;
//         }
//     }
// }
//
//
//
//
//
//







