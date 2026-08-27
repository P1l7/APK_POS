@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

    @include('layouts.navbar')

    <style>
        .penjualan-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 20px 50px;
        }

        /* ================= HEADER ================= */

        .penjualan-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .penjualan-header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
            color: #212529;
        }

        .penjualan-header p {
            margin: 6px 0 0;
            color: #6c757d;
            font-size: 14px;
        }

        .btn-tambah {
            padding: 9px 16px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* ================= ALERT ================= */

        .penjualan-alert {
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* ================= SEARCH ================= */

        .search-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form .form-control {
            height: 40px;
            border-radius: 7px;
            border: 1px solid #ced4da;
            font-size: 14px;
            box-shadow: none;
        }

        .search-form .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .08);
        }

        .btn-search {
            height: 40px;
            padding: 0 18px;
            border-radius: 7px;
            font-size: 14px;
        }

        /* ================= TABLE CARD ================= */

        .penjualan-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .penjualan-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 17px 20px;
            border-bottom: 1px solid #eeeeee;
        }

        .penjualan-card-header h2 {
            margin: 0;
            font-size: 17px;
            font-weight: 600;
            color: #212529;
        }

        .jumlah-penjualan {
            font-size: 13px;
            color: #6c757d;
        }

        /* ================= TABLE ================= */

        .penjualan-table {
            margin: 0;
        }

        .penjualan-table thead th {
            background: #f8f9fa;
            color: #495057;
            font-size: 12px;
            font-weight: 600;
            padding: 13px 16px;
            border-bottom: 1px solid #dee2e6;
            white-space: nowrap;
        }

        .penjualan-table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 14px;
            color: #343a40;
            border-bottom: 1px solid #f0f0f0;
        }

        .penjualan-table tbody tr:last-child td {
            border-bottom: none;
        }

        .penjualan-table tbody tr:hover {
            background-color: #fafbfc;
        }

        /* ================= TEXT ================= */

        .kasir {
            font-weight: 500;
            color: #212529;
        }

        .tanggal {
            color: #6c757d;
            white-space: nowrap;
        }

        .total {
            font-weight: 600;
            color: #212529;
            white-space: nowrap;
        }

        /* ================= BADGE ================= */

        .metode-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            background: #f1f3f5;
            color: #495057;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            background: #d1e7dd;
            color: #0f5132;
            font-size: 12px;
            font-weight: 600;
        }

        /* ================= ACTION ================= */

        .aksi {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .aksi .btn {
            padding: 6px 11px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* ================= EMPTY ================= */

        .penjualan-kosong {
            text-align: center;
            padding: 50px 20px !important;
            color: #6c757d;
        }

        .penjualan-kosong strong {
            display: block;
            margin-bottom: 5px;
            color: #495057;
            font-size: 14px;
        }

        .penjualan-kosong span {
            font-size: 13px;
        }

        /* ================= PAGINATION ================= */

        .penjualan-pagination {
            display: flex;
            justify-content: flex-end;
            padding: 16px 20px;
            border-top: 1px solid #eeeeee;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 768px) {

            .penjualan-page {
                padding: 20px 15px 40px;
            }

            .penjualan-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .penjualan-header h1 {
                font-size: 27px;
            }

            .btn-tambah {
                width: 100%;
            }

            .search-form {
                flex-direction: column;
            }

            .btn-search {
                width: 100%;
            }

            .penjualan-card-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .penjualan-pagination {
                justify-content: center;
            }
        }
    </style>


    <div class="penjualan-page">

        {{-- ================= HEADER ================= --}}

        <div class="penjualan-header">

            <div>

                <h1>Penjualan</h1>

                <p>
                    Kelola dan lihat seluruh transaksi penjualan.
                </p>

            </div>

            <a
                href="{{ route('penjualan.create') }}"
                class="btn btn-primary btn-tambah"
            >
                + Tambah Penjualan
            </a>

        </div>


        {{-- ================= ERROR ================= --}}

        @if(session('errors'))

            <div
                class="alert alert-danger alert-dismissible fade show penjualan-alert"
                role="alert"
            >

                {{ session('errors') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- ================= SEARCH ================= --}}

        <div class="search-card">

            <form
                action="{{ route('penjualan.index') }}"
                method="GET"
            >

                <div class="search-form">

                    <input
                        type="text"
                        name="search"
                        value="{{ request()->search }}"
                        class="form-control"
                        placeholder="Cari transaksi penjualan..."
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


        {{-- ================= TABLE ================= --}}

        <div class="penjualan-card">

            <div class="penjualan-card-header">

                <h2>Daftar Penjualan</h2>

                <span class="jumlah-penjualan">
                    {{ $sales->total() }} transaksi
                </span>

            </div>


            <div class="table-responsive">

                <table class="table penjualan-table">

                    <thead>

                        <tr>
                            <th width="55">#</th>
                            <th>Tanggal Transaksi</th>
                            <th>Kasir</th>
                            <th>Total Pembayaran</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th width="220">Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($sales as $sale)

                            <tr>

                                {{-- Nomor --}}

                                <td>
                                    {{ $sales->firstItem() + $loop->index }}
                                </td>


                                {{-- Tanggal --}}

                                <td>

                                    <span class="tanggal">
                                        {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                                    </span>

                                </td>


                                {{-- Kasir --}}

                                <td>

                                    <span class="kasir">
                                        {{ $sale->User->name }}
                                    </span>

                                </td>


                                {{-- Total --}}

                                <td>

                                    <span class="total">
                                        Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- Metode Pembayaran --}}

                                <td>

                                    <span class="metode-badge">
                                        {{ $sale->metode_pembayaran }}
                                    </span>

                                </td>


                                {{-- Status --}}

                                <td>

                                    <span class="status-badge">
                                        {{ $sale->status }}
                                    </span>

                                </td>


                                {{-- Aksi --}}

                                <td>

                                    <div class="aksi">

                                        <a
                                            href="{{ route('penjualan.show', $sale) }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            Detail
                                        </a>


                                        @can('update', $sale)

                                            <a
                                                href="{{ route('penjualan.edit', $sale) }}"
                                                class="btn btn-warning btn-sm"
                                            >
                                                Edit
                                            </a>

                                        @endcan


                                        @can('delete', $sale)

                                            <form
                                                action="{{ route('penjualan.destroy', $sale) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah anda yakin akan menghapus penjualan ini?')"
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
                                    colspan="7"
                                    class="penjualan-kosong"
                                >

                                    <strong>
                                        Belum ada transaksi
                                    </strong>

                                    <span>
                                        Data penjualan yang dibuat akan muncul di sini.
                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================= PAGINATION ================= --}}

            @if ($sales->hasPages())

                <div class="penjualan-pagination">

                    {{ $sales->links() }}

                </div>

            @endif

        </div>

    </div>

@endsection
