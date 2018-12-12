<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('templates/images/favicon.png')}}">
    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('templates/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('templates/css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('templates/css/style.css')}}" rel="stylesheet">

    <style type="text/css">
    body {
        color: #453e3e;
    }
    .table > tbody > tr > td {
        color: #393939;
    }
    .bg-custom-1 {
        background-color: #fcf5bf;
    }
    .bg-custom-2 {
        background-color: #5c4ac7;
    }
    .bg-custom-3 {
        background-color: #e6ecf0;
    }
    .page-wrapper{
        background-color: #e0f1fb !important;
    }
    footer {
        height: 60px;
    }
    .page-wrapper > .container-fluid {
        min-height: calc(100vh - 230px);
    }
    .loading-text {
        color: white;
        text-shadow: 2px 2px #726969;
        font: 300 2.5em/60% Impact;
  }
  .loading-text:after {
      content: ' .';
      animation: dots 1s steps(5, end) infinite;}

      @keyframes dots {
          0%, 20% {
            color: #726969;
            opacity: .5;
            text-shadow:
            .25em 0 0 #726969,
            .5em 0 0 #726969;}
            40% {
                color: black;
                opacity: 1;
                text-shadow:
                .25em 0 0 #726969,
                .5em 0 0 #726969;}
                60% {
                    opacity: 1;
                    text-shadow:
                    .25em 0 0 black,
                    .5em 0 0 #726969;}
                    80%, 100% {
                        opacity: .5;
                        text-shadow:
                        .25em 0 0 black,
                        .5em 0 0 black;}}
                    </style>
                    @yield('header')
                    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
<![endif]-->
</head>