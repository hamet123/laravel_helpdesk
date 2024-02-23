@extends('agentPages.agentPageMasterLayout')
@section('title')
    Search Users/Agents
@endsection
@php
    use App\Models\Department;
    use App\Models\Status;
    use App\Models\User;
@endphp
@push('customstyle')
    <style>
        .searchUser {
            background: red;
        }

        <style>.card {
            background: rgba(0, 0, 0, 0.568);
            color: white;
        }

        hr {
            background: white;
            margin: 0;
            padding: 0;
        }

        .resultdiv {
            width: 50%;
            border: 1px solid grey;
            border-radius: 10px;
            padding: 30px;
        }

        .parentdiv {
            background: rgba(0, 0, 0, 0.568);
            color: white;
            padding: 50px;
        }

        hr {
            background: white;
        }

        table thead th {
            font-size: 12px;
        }

        .address,
        .contact {
            font-size: 13px;
            color: white;
            display: block;
        }

        .socialIcons {
            color: white;
            font-size: 40px;
        }

        .socialIcons:hover {
            transform: scale(1.2);
            transition: 0.3s ease;
        }

        .address,
        .contact {

            font-weight: bold;
        }

        .addressTitle,
        .contactTitle,
        .socialTitle {
            font-size: 18px;
            color: #38e126;
            font-weight: bold;
        }

        label {
            color: white;
        }
    </style>
@endpush
@section('content')
    <div class="container parentdiv">
        <div class="row">
            <div class="col-xl-12">
                <h5 class="text-white text-center">Search Agent/User</h5>
                <hr class="my-3">
                <form action="/search-user-by-agent" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row d-flex justify-content-center align-items-center">
                                    @csrf
                                    <div class="col-xl-5">
                                        <input type="text" name="user_identifier" id="user_identifier"
                                            class="form-control" placeholder="Email-ID / Username / Full Name"
                                            style="display:inline-block">
                                    </div>
                                    @error('user_identifier')
                                        <span class="text-danger my-3">{{ $message }}</span>
                                    @enderror
                                    <div class="col-xl-3 d-flex justify-content-start">
                                        <input type="submit" value="Search" class="btn btn-danger my-2"
                                            style="display:inline-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr class="my-3">


                @if (isset($user))
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-center mt-5">
                                <div class="col-xl-6 resultdiv">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ isset($user['profile_pic_path']) ? Storage::url($user['profile_pic_path']) : '/images/profile.png' }}"
                                            alt="" class="text-center my-3"
                                            style="border:1px solid grey; border-radius:50%; height:100px; width:100px; padding:10px;">
                                    </div>
                                    <hr class="my-3">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="address">
                                                <p class="addressTitle">User Info</p>
                                                <p class="address">Full Name : {{ $user['name'] }}</p>
                                                <p class="address">Username : {{ $user['username'] }}</p>
                                                <p class="address">Role : {{ $user['role'] }}</p>
                                                <p class="address">Department Assigned :
                                                    {{ isset($user['department_id']) ? Department::find($user['department_id'])['department'] : 'No Department found' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr class="my-3">
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="contact">
                                                <p class="contactTitle">Address</p>
                                                <p class="contact">
                                                    {{ isset($userDetails['address']) ? $userDetails['address'] : 'Address Not updated by the User' }}
                                                </p>

                                            </div>
                                        </div>
                                        <hr class="my-3">

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="address">
                                                <p class="addressTitle">Contact Details</p>
                                                <p class="address">Phone Number :
                                                    {{ isset($userDetails['phone']) ? $userDetails['phone'] : 'Phone Number Not updated by the User' }}
                                                </p>
                                                <p class="address">Email : {{ $user['email'] }}</p>

                                            </div>
                                        </div>
                                        <hr class="my-3">
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="socialTitle">Social Network</p>
                                            <div class="container">

                                                <div class="row">

                                                    <div class="col-md-3">
                                                        <a
                                                            href="{{ isset($userDetails['facebook']) ? $userDetails['facebook'] : '#' }}">
                                                            <i class="socialIcons fa-brands fa-square-facebook"></i></a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a
                                                            href="{{ isset($userDetails['twitter']) ? $userDetails['twitter'] : '#' }}"><i
                                                                class="socialIcons fa-brands fa-square-x-twitter"></i></a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a
                                                            href="{{ isset($userDetails['youtube']) ? $userDetails['youtube'] : '#' }}"><i
                                                                class="socialIcons fa-brands fa-youtube"></i></a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a
                                                            href="{{ isset($userDetails['instagram']) ? $userDetails['instagram'] : '#' }}"><i
                                                                class="socialIcons fa-brands fa-square-instagram"></i></a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
