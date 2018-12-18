<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Advertising Billboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <style>
        /* Center the loader */
        #loader {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            box-shadow: 0 4px 0 0 #3498db;
            width: 120px;
            height: 120px;

            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        #myDiv {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
</head>
<body onload="showPage()">
<div id="loader"></div>

<div style="display:none;" id="myDiv">
<div id="app"></div></div>
<script>

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }
</script>
<script src='{{'/js/app.js'}}'></script>
</body>
</html>