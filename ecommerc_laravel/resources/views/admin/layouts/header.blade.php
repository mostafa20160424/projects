<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{!(empty($title))?$title:"Admin"}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ url('design/adminlit/jsTree/themes/default/style.css') }}">
  <!-- Theme style -->
  @if (LangDir()=="rtl")
      <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/dist/css//{{ LangDir() }}/AdminLTE.css">
      <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/dist/css//{{ LangDir() }}/AdminLTE.min.css">
      <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/dist/css//{{ LangDir() }}/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/dist/css//{{ LangDir() }}/profile.css">
      <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/dist/css//{{ LangDir() }}/rtl.css">


      
  @else
      <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/dist/css/AdminLTE.min.css">
  @endif

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlit/plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
