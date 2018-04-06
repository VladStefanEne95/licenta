<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
    @yield('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea',plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat', });</script>
    <title>{{ config('app.name', 'Laravel') }}</title>

 <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="/css/app.css">
 <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="/css/sb-admin.css" rel="stylesheet">
  <link href="/css/main.css" rel="stylesheet" type="text/css">
        
</head>
<body>
        <div id="app">
            <div class="wrapper">
                @include('inc.sidebar')
                <div id="content"> 
                        @include('inc.navbar')
                        <div id="no-nav-content">
                        @include('inc.messages')
                        @yield('content')
                </div>
            </div>
                
            </div>
        </div>

    <!-- Scripts -->
    <script>
    <?php
        $rez = [];
        foreach($users as $user)
            array_push($rez, $user->name);
        
        $js_array = json_encode($rez);
        echo "var availableTags = ". $js_array . ";\n";
        ?>
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="/js/autocomplete.js"></script>
    <script src="/js/timer.js"></script>
    <script src="/js/general.js"></script>
    @yield('script')
    @stack('scripts')
    <script>
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});
    </script>
</body>
</html>