@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<style>
    .dashboard-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 25px 20px 50px;
    }

    .dashboard-header {
        margin-bottom: 30px;
    }

    .dashboard-header h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
        color: #212529;
    }

    .dashboard-header .date {
        font-size: 17px;
        color: #6c757d;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 18px;
    }

    .section {
        margin-bottom: 35px;
    }

    /* ================= STAT CARD ================= */

    .stat-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .stat-card-header {
        padding: 15px 20px;
        border-bottom: 1px solid #eeeeee;
        color: #6c757d;
        font-size: 14px;
        font-weight: 600;
    }

    .stat-card-body {
        padding: 22px 20px;
    }

    .stat-value {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #212529;
    }

    .stat-description {
        margin-top: 5px;
        color: #6c757d;
        font-size: 13px;
    }

    /* ================= INVENTORY CARD ================= */

    .inventory-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        height: 100%;
    }

    .inventory-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #eeeeee;
    }

    .inventory-card-header h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .inventory-card-body {
        padding: 0;
    }

    /* ================= TABLE ================= */

    .dashboard-table {
        margin-bottom: 0;
    }

    .dashboard-table thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-size: 13px;
        font-weight: 600;
        padding: 13px 15px;
        border-bottom: 1px solid #dee2e6;
        white-space: nowrap;
    }

    .dashboard-table tbody td {
        padding: 13px 15px;
        vertical-align: middle;
        color: #343a40;
        font-size: 14px;
    }

    .dashboard-table tbody tr:last-child td {
        border-bottom: none;
    }

    .dashboard-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* ================= BADGE ================= */

    .stock-low {
        display: inline-block;
        background-color: #fff3cd;
        color: #856404;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-empty {
        display: inline-block;
        background-color: #f8d7da;
        color: #842029;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-safe {
        display: inline-block;
        background-color: #d1e7dd;
        color: #0f5132;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    /* ================= BEST SELLER ================= */

    .best-seller-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .best-seller-header {
        padding: 18px 20px;
        border-bottom: 1px solid #eeeeee;
    }

    .best-seller-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .rank-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #f1f3f5;
        font-weight: 600;
        font-size: 13px;
    }

    .product-name {
        font-weight: 600;
        color: #212529;
    }

    .sold-badge {
        background-color: #e7f1ff;
        color: #0d6efd;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .empty-message {
        padding: 25px !important;
        text-align: center;
        color: #6c757d;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 768px) {

        .dashboard-wrapper {
            padding: 20px 15px 40px;
        }

        .dashboard-header h1 {
            font-size: 26px;
        }

        .section-title {
            font-size: 21px;
        }

        .stat-value {
            font-size: 24px;
        }
    }
</style>


<div class="dashboard-wrapper">

    {{-- ================= HEADER ================= --}}
    <div class="dashboard-header">
        <h1>
            Ringkasan Hari Ini
        </h1>

        <div class="date">
            {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
        </div>
    </div>


    {{-- ========================================================= --}}
    {{--                    PENJUALAN HARI INI                     --}}
    {{-- ========================================================= --}}

    @can('viewAny', App\Models\Dashboard::class)

    <div class="section">

        <h2 class="section-title">
            Penjualan Hari Ini
        </h2>

        <div class="row g-4">

            {{-- Total Penjualan --}}
            <div class="col-md-6">

                <div class="stat-card">

                    <div class="stat-card-header">
                        Total Nilai Penjualan
                    </div>

                    <div class="stat-card-body">

                        <h3 class="stat-value">
                            Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                        </h3>

                        <div class="stat-description">
                            Total penjualan yang berhasil dilakukan hari ini
                        </div>

                    </div>

                </div>

            </div>


            {{-- Jumlah Transaksi --}}
            <div class="col-md-6">

                <div class="stat-card">

                    <div class="stat-card-header">
                        Jumlah Transaksi
                    </div>

                    <div class="stat-card-body">

                        <h3 class="stat-value">
                            {{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }}
                        </h3>

                        <div class="stat-description">
                            Jumlah transaksi selesai hari ini
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{--                    PAYMENT STATUS                         --}}
    {{-- ========================================================= --}}

    <div class="section">

        <h2 class="section-title">
            Status Pembayaran
        </h2>

        <div class="row g-4">

            {{-- Cash --}}
            <div class="col-md-6">

                <div class="stat-card">

                    <div class="stat-card-header">
                        Total Pembayaran Tunai
                    </div>

                    <div class="stat-card-body">

                        <h3 class="stat-value">
                            Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                        </h3>

                        <div class="stat-description">
                            Total transaksi yang dibayar secara tunai
                        </div>

                    </div>

                </div>

            </div>


            {{-- Non Cash --}}
            <div class="col-md-6">

                <div class="stat-card">

                    <div class="stat-card-header">
                        Total Pembayaran Non-Tunai
                    </div>

                    <div class="stat-card-body">

                        <h3 class="stat-value">
                            Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                        </h3>

                        <div class="stat-description">
                            Total transaksi menggunakan pembayaran non-tunai
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @endcan


    {{-- ========================================================= --}}
    {{--                  INVENTORY STATUS                         --}}
    {{-- ========================================================= --}}

    <div class="section">

        <h2 class="section-title">
            Status Persediaan
        </h2>

        <div class="row g-4">

            {{-- Stok Rendah --}}
            <div class="col-md-6">

                <div class="inventory-card">

                    <div class="inventory-card-header">

                        <h3>
                            Stok Produk Rendah
                        </h3>

                    </div>

                    <div class="inventory-card-body">

                        <div class="table-responsive">

                            <table class="table dashboard-table">

                                <thead>
                                    <tr>
                                        <th width="70">#</th>
                                        <th>Nama Produk</th>
                                        <th width="100">Stok</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse ($produkStokRendah as $index => $produk)

                                    <tr>

                                        <td>
                                            {{ $produkStokRendah->firstItem() + $index }}
                                        </td>

                                        <td class="product-name">
                                            {{ $produk->name }}
                                        </td>

                                        <td>
                                            <span class="stock-low">
                                                {{ $produk->stok }}
                                            </span>
                                        </td>

                                    </tr>

                                    @empty

                                    <tr>
                                        <td colspan="3" class="empty-message">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="mt-3">
                    {{ $produkStokRendah->links() }}
                </div>

            </div>


            {{-- Stok Habis --}}
            <div class="col-md-6">

                <div class="inventory-card">

                    <div class="inventory-card-header">

                        <h3>
                            Produk Habis Stok
                        </h3>

                    </div>

                    <div class="inventory-card-body">

                        <div class="table-responsive">

                            <table class="table dashboard-table">

                                <thead>
                                    <tr>
                                        <th width="70">#</th>
                                        <th>Nama Produk</th>
                                        <th width="100">Stok</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse ($produkStokHabis as $index => $produk)

                                    <tr>

                                        <td>
                                            {{ $produkStokHabis->firstItem() + $index }}
                                        </td>

                                        <td class="product-name">
                                            {{ $produk->name }}
                                        </td>

                                        <td>
                                            <span class="stock-empty">
                                                Habis
                                            </span>
                                        </td>

                                    </tr>

                                    @empty

                                    <tr>
                                        <td colspan="3" class="empty-message">
                                            Seluruh produk berada dalam stok aman.
                                        </td>
                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="mt-3">
                    {{ $produkStokHabis->links() }}
                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{--                    BEST SELLER                            --}}
    {{-- ========================================================= --}}

    <div class="section">

        <h2 class="section-title">
            Produk Terlaris
        </h2>

        <div class="best-seller-card">

            <div class="best-seller-header">

                <h3>
                    Best Seller Products
                </h3>

            </div>

            <div class="table-responsive">

                <table class="table dashboard-table">

                    <thead>

                        <tr>
                            <th width="80">Peringkat</th>
                            <th>Nama Produk</th>
                            <th width="150">Stok</th>
                            <th width="180">Unit Terjual</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($produkTerlaris as $index => $produk)

                        <tr>

                            <td>
                                <span class="rank-number">
                                    {{ $index + 1 }}
                                </span>
                            </td>

                            <td class="product-name">
                                {{ $produk->name }}
                            </td>

                            <td>
                                {{ $produk->stok }}
                            </td>

                            <td>
                                <span class="sold-badge">
                                    {{ $produk->total_terjual }} unit
                                </span>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="empty-message">
                                Tidak ada produk terlaris hari ini.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
