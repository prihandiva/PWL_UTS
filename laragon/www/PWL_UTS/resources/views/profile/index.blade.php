@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>

    <div class="container rounded bg-white border shadow-sm mt-4">
        <div class="row" id="profile">
            <div class="col-md-4 border-right">
                <div class="p-3 py-5 text-center">
                    <img class="rounded-circle border mb-3" width="250px" src="{{ asset($user->user_foto) }}">
                    <h5 class="mt-2">{{ $user->nama }}</h5>
                    <div class="mt-4">
                        <button class="btn btn-primary profile-button" 
                                type="button"
                                onclick="modalAction('{{ url('/profile/' . session('user_id') . '/edit_foto') }}')">
                            <i class="fas fa-camera"></i> Edit Foto
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div class="p-3 py-4 w-100 text-center">
                    <h4 class="text-center">Profile Settings</h4>
                    
                    <!-- Profile Information Card -->
                    <div class="card mt-4 mx-auto" style="width: 80%;">
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover table-sm text-center">
                                <tr>
                                    <th>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fas fa-id-card"></i>
                                            <span class="ml-2">ID</span>
                                        </div>
                                    </th>
                                    <td>{{ $user->user_id }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fas fa-user-shield"></i>
                                            <span class="ml-2">Level</span>
                                        </div>
                                    </th>
                                    <td>{{ $user->level->level_nama }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fas fa-user"></i>
                                            <span class="ml-2">Username</span>
                                        </div>
                                    </th>
                                    <td>{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fas fa-user-tag"></i>
                                            <span class="ml-2">Nama</span>
                                        </div>
                                    </th>
                                    <td>{{ $user->nama }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fas fa-lock"></i>
                                            <span class="ml-2">Password</span>
                                        </div>
                                    </th>
                                    <td>**</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button onclick="modalAction('{{ url('/profile/' . session('user_id') . '/edit_ajax') }}')"
                                class="btn btn-primary profile-button"><i class="fas fa-edit"></i> Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .rounded-circle {
            border: 4px solid #007bff; 
        }
        .profile-button {
            width: 150px; 
            transition: background-color 0.3s ease; 
        }
        .profile-button:hover {
            background-color: #0056b3; 
        }
        table {
            border-collapse: separate; 
            border-spacing: 0 10px; 
            margin: 0 auto; 
        }
        th {
            background-color: #f8f9fa; 
            font-weight: bold; 
            text-align: center; /* Center align the text and icons */
            vertical-align: top; /* Align icons to the top */
            padding-left: 10px; /* Add some left padding for spacing */
            display: flex; /* Use flexbox for layout */
            justify-content: center; /* Center the icon horizontally */
            align-items: flex-start; /* Align the icon to the top */
        }
        .card {
            border: none; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
        }
        .ml-2 {
            margin-left: 10px; /* Add margin to the left of the text */
        }
    </style>
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        var profile;
        $(document).ready(function() {
            profile = $('#profile').on({
                autoWidth: false,
                serverSide: true,
                ajax: {
                    "url": "{{ url('penjualan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.user_id = $('#user_id').val();
                    }
                },
            });
            $('#profile').on('change', function() {
                profile.ajax.reload();
            });
        });
    </script>
@endpush