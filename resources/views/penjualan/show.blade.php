@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1">Detail Penjualan</h1>
            <p class="text-muted mb-0">
                Informasi lengkap transaksi
            </p>
        </div>

        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>


    {{-- Informasi Transaksi --}}
    <div class="card mb-4">

        <div class="card-header">
            <strong>Informasi Transaksi</strong>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- Kolom kiri --}}
                <div class="col-md-6">

                    <table class="table table-borderless mb-0">

                        <tr>
                            <th width="180">
                                ID Transaksi
                            </th>

                            <td>
                                #{{ $penjualan->id }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Tanggal Transaksi
                            </th>

                            <td>
                                {{ $penjualan->created_at->translatedFormat('d-m-Y H:i:s') }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Kasir
                            </th>

                            <td>
                                {{ $penjualan->User->name }}
                            </td>
                        </tr>

                    </table>

                </div>


                {{-- Kolom kanan --}}
                <div class="col-md-6">

                    <table class="table table-borderless mb-0">

                        <tr>
                            <th width="180">
                                Metode Pembayaran
                            </th>

                            <td>
                                {{ $penjualan->metode_pembayaran ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Status
                            </th>

                            <td>

                                @if($penjualan->status === 'COMPLETED')

                                    <span class="badge bg-success">
                                        COMPLETED
                                    </span>

                                @elseif($penjualan->status === 'OPEN')

                                    <span class="badge bg-warning text-dark">
                                        OPEN
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ $penjualan->status }}
                                    </span>

                                @endif

                            </td>
                        </tr>

                        <tr>
                            <th>
                                Total Pembayaran
                            </th>

                            <td>
                                <strong>
                                    Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                                </strong>
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- Detail Produk --}}
    <div class="card">

        <div class="card-header">
            <strong>Detail Produk</strong>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover mb-0">

                    <thead class="table-light">

                        <tr>
                            <th width="60">No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($penjualan->itemPenjualan as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->produk->name }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $item->kuantitas }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Tidak ada produk dalam transaksi ini.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>


                    {{-- Total --}}
                    <tfoot>

                        <tr>
                            <th colspan="4" class="text-end">
                                Total Pembayaran
                            </th>

                            <th>
                                Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                            </th>
                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
