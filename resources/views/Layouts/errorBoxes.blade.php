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

@if (session('ticketReopenedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('ticketReopenedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('fileTypeError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('fileTypeError') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('noFileError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('noFileError') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('profilePicUpdatedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('profilePicUpdatedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('profileUpdatedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('profileUpdatedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('passwordChangedSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('passwordChangedSuccess') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('departmentCreatedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('departmentCreatedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('departmentCreationFailed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('departmentCreationFailed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('departmentUpdatedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('departmentUpdatedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('departmentDeletedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('departmentDeletedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('agentCreatedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('agentCreatedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('agentCreationFailed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('agentCreationFailed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('agentUpdatedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('agentUpdatedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('agentUpdateFailed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('agentUpdateFailed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('agentDeletedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('agentDeletedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('statusCreatedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('statusCreatedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('statusCreationFailed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('statusCreationFailed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('statusUpdatedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('statusUpdatedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('statusUpdationFailed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('statusUpdationFailed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('statusDeletedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('statusDeletedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('statusDeletionFailed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('statusDeletionFailed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('noTicketFound'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('noTicketFound') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('noUserFound'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('noUserFound') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('adminLoginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('adminLoginError') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('agentTicketClosedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('agentTicketClosedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('noTicketFoundError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('noTicketFoundError') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('noPermissionError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('noPermissionError') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('agentTicketreOpenedSuccessfully'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('agentTicketreOpenedSuccessfully') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('ticketConfigChanged'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('ticketConfigChanged') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('ticketConfigChangeFailed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('ticketConfigChangeFailed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('commentAddedSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('commentAddedSuccess') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('commentAddFailed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('commentAddFailed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
