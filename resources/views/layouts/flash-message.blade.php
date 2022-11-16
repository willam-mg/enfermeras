@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
</div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible fade show">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible fade show">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
</div>
@endif
  
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    {{ implode('', $errors->all(':message ')) }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
</div>
@endif

@if (session()->has('message'))
    <div wire:poll.4s class="alert alert-danger alert-dismissible fade show">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif