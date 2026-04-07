@extends('admin.layout')

@section('page-title', 'Debug Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h4>Debug Dashboard Loaded!</h4>
                <p>Jika Anda melihat pesan ini, berarti layout dan view berhasil di-render.</p>
            </div>
            
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Info Session dan Data
                </div>
                <div class="card-body">
                    <h5>Session:</h5>
                    <pre>{{ print_r(session()->all(), true) }}</pre>
                    
                    <h5 class="mt-4">Stats Data:</h5>
                    <pre>{{ isset($stats) ? print_r($stats, true) : 'Variabel stats tidak tersedia' }}</pre>
                    
                    <h5 class="mt-4">Route Info:</h5>
                    <p>Current Route: {{ request()->route()->getName() }}</p>
                    <p>Path: {{ request()->path() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    console.log('Debug dashboard view loaded!');
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Debug dashboard DOM loaded');
    });
</script>
@endsection
