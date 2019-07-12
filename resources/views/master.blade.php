<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bánh Ngọt </title>
    <base href="{{asset('')}}">
    <link href='//fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="storage/source/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="storage/source/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="storage/source/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="storage/source/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="storage/source/assets/dest/css/style.css">
    <link rel="stylesheet" href="storage/source/assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="storage/source/assets/dest/css/huong-style.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
@include('header')

@yield('content')

@include('footder')

<!-- include js files -->

<script src="storage/source/assets/dest/js/jquery.js"></script>
<script src="storage/source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="storage/source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="storage/source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="storage/source/assets/dest/vendors/animo/Animo.js"></script>
<script src="storage/source/assets/dest/vendors/dug/dug.js"></script>
<script src="storage/source/assets/dest/js/scripts.min.js"></script>
<script src="storage/source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="storage/source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="storage/source/assets/dest/js/waypoints.min.js"></script>
<script src="storage/source/assets/dest/js/wow.min.js"></script>
<!--customjs-->
<script src="storage/source/assets/dest/js/custom2.js"></script>
<script>
    $(document).ready(function ($) {
        $(window).scroll(function () {
                if ($(this).scrollTop() > 150) {
                    $(".header-bottom").addClass('fixNav')
                } else {
                    $(".header-bottom").removeClass('fixNav')
                }
            }
        )
    })
</script>
</body>
</html>
