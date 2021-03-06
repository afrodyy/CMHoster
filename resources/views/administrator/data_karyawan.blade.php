@extends('layouts.master')

@section('title')
    {{ '| Data Karyawan' }}
@endsection

@section('admin.karyawan')
    {{ 'active' }}
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-9 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Data Karyawan CMHoster</h2>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success mt-1">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="content-header-right col-3 mb-2">
                    <div class="row">
                        <div class="col-12">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#exampleModal">
                                Add User
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Table head options start -->
                <div class="row" id="table-head">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($karyawan as $k)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}.</th>
                                                    <td>{{ $k->name }}</td>
                                                    <td>
                                                        <a href="{{ url('karyawan/' . $k->id . '/profile') }}"
                                                            class="btn btn-sm bg-gradient-info">View Profile</a>
                                                        <form action="{{ url('karyawan/' . $k->id . '/delete') }}"
                                                            method="get" class="d-inline"
                                                            onclick="return confirm('Data Karyawan dengan Nama {{ $k->name }} akan dihapus?')">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-sm bg-gradient-danger"
                                                                type="submit">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table head options end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/add_user') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" autocomplete="off"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="">-- Select role --</option>
                                <option value="user">User</option>
                                <option value="noc">Noc</option>
                                <option value="admin">Admin</option>
                                <option value="owner">Owner</option>
                                <option value="master">Master</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" autocomplete="off" required>
                        </div>
                        @php
                            $password = bcrypt('password');
                        @endphp
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ $password }}"
                                readonly>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
