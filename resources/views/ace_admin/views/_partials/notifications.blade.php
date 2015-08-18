@if (count($errors->all()) > 0)
	<br/>
<!--<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
	<strong>Error!</strong>
	@if($errors->has())
	   @foreach ($errors->all() as $error)
	      <p>{{ $error }}.</p> 
	  @endforeach
	@endif
</div>-->
@endif

@if (isset($success))
	<br/>
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
	<strong>Success!</strong>
	      {{ $success }}. 
</div>
@endif

@if ($message = Session::get('success'))
	<br/>
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
	<strong>Success!</strong>
    @if(is_array($message))
        @foreach ($message as $m)
            {{ $m }}
        @endforeach
    @else
        {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('error'))
	<br/>
<div class="alert alert-warning alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
	<strong>Warning!</strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('warning'))
	<br/>
<div class="alert alert-warning alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
	<strong>Warning!</strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('info'))
	<br/>
<div class="alert alert-info alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
	<strong>Info!</strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif
