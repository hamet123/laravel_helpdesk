@if (Session::has('loginSuccess'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('loginSuccess') }}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('loginRegister'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('loginRegister') }}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
  
@if (Session::has('ticketCreated'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('ticketCreated') }}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('ticketRaisedSuccessfully'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('ticketRaisedSuccessfully') }}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{ session('loginError') }}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('ticketClosedSuccessfully'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('ticketClosedSuccessfully') }}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('ticketUpdatedSuccessfully'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('ticketUpdatedSuccessfully') }}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif