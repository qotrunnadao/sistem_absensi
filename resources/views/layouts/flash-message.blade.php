    <!-- Flash Msg-->

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('info'))
    <div class="alert alert-info alert-block alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($errors->any())
    @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
     <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>    
      @endforeach
    </ul>
  </div>
  @endif
  @endif

  <script>
    $('.close').on('click',function(){
      $('.alert').hide();
      $(this).hide();
    });
  </script>