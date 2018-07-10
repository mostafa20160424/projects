@include('admin.layouts.header')
<body>
@include('admin.layouts.navbar')


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('admin.layouts.messages')
    @yield('content')
    <?php
     //@yield('name of section in page that extends from this page ')*/ 
     ?>
  </section>

</div>
@include('admin.layouts.footer')
