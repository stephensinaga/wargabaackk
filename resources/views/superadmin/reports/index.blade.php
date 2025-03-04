@extends('layouts.app')

@section('contents')
    <h2>Daftar Laporan</h2>

    <!-- Form Filter -->
    <form action="{{ route('admin.reports.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="category" class="form-label">Kategori:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Semua</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Diterima</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Sedang Diproses
                    </option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->category }}</td>
                    <td>{{ $report->description }}</td>
                    <td>{{ ucfirst($report->status) }}</td>
                    <td>
                        <!-- Tombol Terima -->
                        <button type="button" class="btn btn-success btn-sm open-modal" data-bs-toggle="modal"
                            data-bs-target="#assignModal-{{ $report->id }}">
                            Terima
                        </button>

                        <!-- Tombol Tolak -->
                        <form action="{{ route('admin.reports.verify', $report->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
