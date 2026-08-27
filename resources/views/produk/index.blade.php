@extends('layouts.app')

@section('title', 'Produk')

@section('content')

    @include('layouts.navbar')

    @php
        $isAdmin = auth()->user()->role->name === 'admin';
    @endphp

    <style>
        .produk-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 20px 50px;
        }

        /* Header */
        .produk-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .produk-header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
            color: #212529;
        }

        .produk-header p {
            margin: 6px 0 0;
            color: #6c757d;
            font-size: 14px;
        }

        .btn-tambah {
            border-radius: 7px;
            padding: 9px 16px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Alert */
        .produk-alert {
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Filter */
        .filter-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 230px 1fr auto;
            gap: 10px;
        }

        .filter-form .form-control,
        .filter-form .form-select {
            height: 40px;
            border-radius: 7px;
            border: 1px solid #ced4da;
            font-size: 14px;
            box-shadow: none;
        }

        .filter-form .form-control:focus,
        .filter-form .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .08);
        }

        .btn-search {
            height: 40px;
            padding: 0 18px;
            border-radius: 7px;
            font-size: 14px;
        }

        /* Table Card */
        .produk-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .produk-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 17px 20px;
            border-bottom: 1px solid #eeeeee;
        }

        .produk-card-header h2 {
            margin: 0;
            font-size: 17px;
            font-weight: 600;
            color: #212529;
        }

        .jumlah-produk {
            font-size: 13px;
            color: #6c757d;
        }

        /* Table */
        .produk-table {
            margin: 0;
        }

        .produk-table thead th {
            background: #f8f9fa;
            color: #495057;
            font-size: 12px;
            font-weight: 600;
            padding: 13px 16px;
            border-bottom: 1px solid #dee2e6;
            white-space: nowrap;
        }

        .produk-table tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
            color: #343a40;
        }

        .produk-table tbody tr:last-child td {
            border-bottom: none;
        }

        .produk-table tbody tr:hover {
            background-color: #fafbfc;
        }

        /* Product Image */
        .produk-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 7px;
            border: 1px solid #e5e7eb;
        }

        .no-image {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 7px;
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
            color: #adb5bd;
            font-size: 10px;
            text-align: center;
        }

        /* Text */
        .nama-produk {
            font-weight: 600;
            color: #212529;
        }

        .user-produk {
            color: #6c757d;
        }

        .harga {
            white-space: nowrap;
            color: #343a40;
        }

        /* Stock */
        .stok-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            padding: 5px 9px;
            border-radius: 20px;
            background: #f1f3f5;
            color: #495057;
            font-size: 12px;
            font-weight: 600;
        }

        /* Action */
        .aksi {
            display: flex;
            gap: 6px;
        }

        .aksi .btn {
            border-radius: 6px;
            padding: 6px 11px;
            font-size: 12px;
        }

        /* Empty */
        .produk-kosong {
            padding: 50px 20px !important;
            text-align: center;
            color: #6c757d;
        }

        .produk-kosong strong {
            display: block;
            margin-bottom: 5px;
            color: #495057;
            font-size: 14px;
        }

        .produk-kosong span {
            font-size: 13px;
        }

        /* Pagination */
        .produk-pagination {
            display: flex;
            justify-content: flex-end;
            padding: 16px 20px;
            border-top: 1px solid #eeeeee;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .produk-page {
                padding: 20px 15px 40px;
            }

            .produk-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .produk-header h1 {
                font-size: 27px;
            }

            .btn-tambah {
                width: 100%;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .btn-search {
                width: 100%;
            }

            .produk-card-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .produk-pagination {
                justify-content: center;
            }
        }
    </style>


    <div class="produk-page">

        {{-- ================= HEADER ================= --}}

        <div class="produk-header">

            <div>
                <h1>Produk</h1>

                <p>
                    Kelola produk, harga, dan stok barang.
                </p>
            </div>

            @can('create', App\Models\Produk::class)

                <a
                    href="{{ route('produk.create') }}"
                    class="btn btn-primary btn-tambah"
                >
                    + Tambah Produk
                </a>

            @endcan

        </div>

        {{-- ================= FILTER ================= --}}

        <div class="filter-card">

            <form
                action="{{ route('produk.index') }}"
                method="GET"
            >

                <div class="filter-form">

                    <select
                        name="jenis_id"
                        class="form-select"
                        onchange="this.form.submit()"
                    >

                        <option value="">
                            Semua Jenis
                        </option>

                        @foreach ($jenisList as $j)

                            <option
                                value="{{ $j->id }}"
                                {{ (string) request('jenis_id') === (string) $j->id ? 'selected' : '' }}
                            >
                                {{ $j->nama_jenis }}
                            </option>

                        @endforeach

                    </select>


                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari nama produk..."
                    >


                    <button
                        type="submit"
                        class="btn btn-outline-secondary btn-search"
                    >
                        Cari
                    </button>

                </div>

            </form>

        </div>


        {{-- ================= DAFTAR PRODUK ================= --}}

        <div class="produk-card">

            <div class="produk-card-header">

                <h2>Daftar Produk</h2>

                <span class="jumlah-produk">
                    {{ $products->total() }} produk
                </span>

            </div>


            <div class="table-responsive">

                <table class="table produk-table">

                    <thead>

                        <tr>
                            <th width="55">#</th>
                            <th width="80">Foto</th>
                            <th>User</th>
                            <th>Nama</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th width="90">Stok</th>
                            <th width="150">Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($products as $product)

                            <tr>

                                {{-- Nomor --}}

                                <td>
                                    {{ $products->firstItem() + $loop->index }}
                                </td>


                                {{-- Foto --}}

                                <td>

                                    @if ($product->foto)

                                        <img
                                            src="{{ asset('storage/' . $product->foto) }}"
                                            class="produk-image"
                                            alt="Foto {{ $product->name }}"
                                        >

                                    @else

                                        <div class="no-image">
                                            Tidak ada foto
                                        </div>

                                    @endif

                                </td>


                                {{-- User --}}

                                <td>
                                    <span class="user-produk">
                                        {{ $product->user->name ?? '-' }}
                                    </span>
                                </td>


                                {{-- Nama --}}

                                <td>
                                    <span class="nama-produk">
                                        {{ $product->name }}
                                    </span>
                                </td>


                                {{-- Harga Beli --}}

                                <td>
                                    <span class="harga">
                                        Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                                    </span>
                                </td>


                                {{-- Harga Jual --}}

                                <td>
                                    <span class="harga">
                                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                    </span>
                                </td>


                                {{-- Stok --}}

                                <td>
                                    <span class="stok-badge">
                                        {{ $product->stok }}
                                    </span>
                                </td>


                                {{-- Aksi --}}

                                <td>

                                    <div class="aksi">

                                        @can('update', $product)

                                            <a
                                                href="{{ route('produk.edit', $product) }}"
                                                class="btn btn-warning btn-sm"
                                            >
                                                Edit
                                            </a>

                                        @endcan


                                        @can('delete', $product)

                                            <form
                                                action="{{ route('produk.destroy', $product) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah anda yakin ingin menghapus produk ini?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        @endcan

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="produk-kosong"
                                >

                                    <strong>
                                        Belum ada produk
                                    </strong>

                                    <span>
                                        Produk yang kamu tambahkan akan muncul di sini.
                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================= PAGINATION ================= --}}

            @if ($products->hasPages())

                <div class="produk-pagination">

                    {{ $products->withQueryString()->links() }}

                </div>

            @endif

        </div>

    </div>

@endsection
