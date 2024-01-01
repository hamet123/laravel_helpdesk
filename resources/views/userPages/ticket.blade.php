@extends("Layouts.masterLayout")
@section('title') Ticket - {{ $ticket['subject'] }} @endsection
@push('customstyle')
<style>
   
</style>
@endpush
@section('content')
<div class="container" style="border-radius:10px;">
    <div class="row">
        <div class="col-xl-12 mt-5 p-5" style="background:rgba(0,0,0,0.7);">
            <div class="" style="border: 1px solid grey; padding:20px;">
                <h2 class="text-center text-white">Subject - {{ $ticket['subject'] }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 pb-5" style="background:rgba(0,0,0,0.7);">
            <div class="p-3" style="border: 1px solid grey; padding:20px;" >
                <h4 class="text-white text-center mb-3">Ticket Description </h4><hr style="background:white;">
                <textarea style="background:rgba(0,0,0,0.2);color:white; width:100%; min-height:250px; padding:20px;" id="" disabled>{{ $ticket['description'] }}</textarea>
                @foreach ($ticketAttachments as $singleAttachment)
                    <a class="mx-2 text-danger" href="{{ Storage::url($singleAttachment->path) }}">Attachment {{ $loop->iteration }}  </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 pb-5" style="background:rgba(0,0,0,0.7);">
            <div style="border: 1px solid grey; padding:20px; min-height:330px;">
                <h4 class=" text-white">Ticket Configuration</h4><hr style="background:white;">
                <form action="">
                    <h6 class="text-danger mt-2" style="font-weight:bold;">Ticket Creator : {{ $ticketUser['name'] }}</h6>
                    <label class="text-white mt-2" for="">Support Department</label>
                    <select class="mt-2" name="" id="">
                        <option value="" selected>Hindi</option>
                        <option value="">English</option>
                        <option value="">Mathematics</option>
                        <option value="">Examinations</option>
                        <option value="">Regsitration and Migration</option>
                    </select>
                    <br>
                    <label class="text-white mt-2" for="">Status</label>
                    <br>
                    <select class="mt-2" name="" id="">
                        <option value="" selected>Pending</option>
                        <option value="">On Hold</option>
                        <option value="">In Progress</option>
                        <option value="">Closed</option>
                        <option value="">Waiting for User Reply</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection