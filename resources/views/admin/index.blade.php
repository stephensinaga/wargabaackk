@extends('layouts.app')

@section('contents')
<h2>Daftar Laporan</h2>
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
                <form action="{{ route('admin.reports.verify', $report->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="accepted">
                    <button type="submit" class="btn btn-success btn-sm">Terima</button>
                </form>
                <form action="{{ route('admin.reports.verify', $report->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                </form>
                <a href="{{ route('admin.reports.assignForm', $report->id) }}" class="btn btn-primary btn-sm">Tugaskan</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
