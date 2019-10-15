@foreach($errors->all() as $error)
    @if(Session::has('yellow'))
      <div class="alert alert-warning alert-dismissable">
    @elseif(Session::has('red'))
      <div class="alert alert-danger alert-dismissable">
    @elseif(Session::has('blue'))
      <div class="alert alert-info alert-dismissable">
    @elseif(Session::has('green'))
      <div class="alert alert-success alert-dismissable">
    @else
      <div class="alert alert-success alert-dismissable">
    @endif
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {{ ucfirst($error) }}
    </div>
@endforeach
<div id="messages"></div>
<?php Session::forget('yellow'); Session::forget('red'); Session::forget('green'); Session::forget('blue'); ?>