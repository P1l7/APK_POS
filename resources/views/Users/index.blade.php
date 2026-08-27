@extends('layouts.app')

@section('title', 'Users')

@section('content')

    @include('layouts.navbar')

    <style>
        .users-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px 50px;
        }

        /* ================= HEADER ================= */

        .users-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .users-header h1 {
            margin: 0 0 6px;
            font-size: 32px;
            font-weight: 700;
            color: #212529;
        }

        .users-header p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }

        .btn-add-user {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* ================= SEARCH ================= */

        .users-toolbar {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .search-wrapper {
            display: flex;
            gap: 10px;
        }

        .search-wrapper .form-control {
            height: 40px;
            border-color: #dee2e6;
            border-radius: 7px;
            font-size: 14px;
            box-shadow: none;
        }

        .search-wrapper .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.08);
        }

        .btn-search {
            height: 40px;
            padding: 0 18px;
            border-radius: 7px;
            font-size: 14px;
            white-space: nowrap;
        }

        /* ================= TABLE CARD ================= */

        .users-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .users-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 17px 20px;
            border-bottom: 1px solid #eeeeee;
        }

        .users-card-header h2 {
            margin: 0;
            font-size: 17px;
            font-weight: 600;
            color: #212529;
        }

        .users-count {
            color: #6c757d;
            font-size: 13px;
        }

        .users-table {
            margin: 0;
        }

        .users-table thead th {
            background: #f8f9fa;
            color: #495057;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            padding: 13px 20px;
            border-bottom: 1px solid #dee2e6;
            white-space: nowrap;
        }

        .users-table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            color: #343a40;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }

        .users-table tbody tr:last-child td {
            border-bottom: none;
        }

        .users-table tbody tr {
            transition: background-color 0.15s ease;
        }

        .users-table tbody tr:hover {
            background-color: #fafbfc;
        }

        /* ================= USER NAME ================= */

        .user-name {
            font-weight: 600;
            color: #212529;
        }

        .user-email {
            color: #6c757d;
        }

        /* ================= ROLE ================= */

        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            background: #e7f1ff;
            color: #0d6efd;
            font-size: 12px;
            font-weight: 600;
        }

        /* ================= ACTION ================= */

        .action-wrapper {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .action-wrapper .btn {
            font-size: 12px;
            font-weight: 500;
            border-radius: 6px;
            padding: 6px 11px;
        }

        /* ================= EMPTY ================= */

        .empty-users {
            text-align: center;
            padding: 50px 20px !important;
            color: #6c757d;
        }

        .empty-users-title {
            margin-bottom: 5px;
            color: #495057;
            font-weight: 600;
        }

        .empty-users-text {
            margin: 0;
            font-size: 13px;
        }

        /* ================= PAGINATION ================= */

        .users-pagination {
            display: flex;
            justify-content: flex-end;
            padding: 16px 20px;
            border-top: 1px solid #eeeeee;
        }

        .users-pagination nav {
            margin: 0;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 768px) {

            .users-wrapper {
                padding: 20px 15px 40px;
            }

            .users-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .users-header h1 {
                font-size: 27px;
            }

            .btn-add-user {
                width: 100%;
                justify-content: center;
            }

            .search-wrapper {
                flex-direction: column;
            }

            .btn-search {
                width: 100%;
            }

            .users-card-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .users-pagination {
                justify-content: center;
            }
        }
    </style>


    <div class="users-wrapper">

        {{-- ================= HEADER ================= --}}

        <div class="users-header">

            <div>
                <h1>Users</h1>

                <p>
                    Kelola akun pengguna dan hak akses sistem.
                </p>
            </div>

            <a href="{{ route('admin.users.create') }}"
               class="btn btn-primary btn-add-user">
                + Tambah User
            </a>

        </div>


        {{-- ================= SEARCH ================= --}}

        <div class="users-toolbar">

            <form action="{{ route('admin.users') }}"
                  method="GET">

                <div class="search-wrapper">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari berdasarkan nama atau email..."
                    >

                    <button
                        class="btn btn-outline-secondary btn-search"
                        type="submit">
                        Cari
                    </button>

                </div>

            </form>

        </div>


        {{-- ================= TABLE ================= --}}

        <div class="users-card">

            <div class="users-card-header">

                <h2>Daftar User</h2>

                <span class="users-count">
                    {{ $users->total() }} user
                </span>

            </div>


            <div class="table-responsive">

                <table class="table users-table">

                    <thead>

                        <tr>
                            <th width="70">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th width="130">Role</th>
                            <th width="180">Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($users as $user)

                            <tr>

                                <td>
                                    {{ $users->firstItem() + $loop->index }}
                                </td>


                                <td>
                                    <div class="user-name">
                                        {{ $user->name }}
                                    </div>
                                </td>


                                <td>
                                    <div class="user-email">
                                        {{ $user->email }}
                                    </div>
                                </td>


                                <td>

                                    <span class="role-badge">
                                        {{ ucfirst($user->role->name) }}
                                    </span>

                                </td>


                                <td>

                                    <div class="action-wrapper">

                                        <a
                                            href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-sm btn-warning">
                                            Edit
                                        </a>


                                        <form
                                            action="{{ route('admin.users.destroy', $user->id) }}"
                                            method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin hapus user ini?')">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="empty-users">

                                    <div class="empty-users-title">
                                        User tidak ditemukan
                                    </div>

                                    <p class="empty-users-text">
                                        Belum ada user yang sesuai dengan pencarian.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================= PAGINATION ================= --}}

            @if ($users->hasPages())

                <div class="users-pagination">

                    {{ $users->links() }}

                </div>

            @endif

        </div>

    </div>

@endsection
