@extends('adminPages.adminPageMasterLayout')
@section('title') Admin Profile @endsection
@push('customstyle')
   <style>
     .adminProfile {
        background: red;
    }
   </style>
@endpush
@section('content')
   <h1>Admin Profile</h1>
@endsection