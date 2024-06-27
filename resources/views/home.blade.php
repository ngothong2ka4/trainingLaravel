@extends('layouts.app')

@push('before-styles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('breadcrumbs')
<li class="breadcrumb-item">
<!-- if breadcrumb is single--><a href="#">Home</a>
</li>
<li class="breadcrumb-item">
<!-- if breadcrumb is single--><a href="#">Components</a>
</li>
<li class="breadcrumb-item active"><span>Charts</span></li>
@endsection

@section('content')
    @include('dashboard')
    
@endsection
@push('before-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        @if ($errors->any())
        Swal.fire({
            title: 'Error!',
            text: '{{ $errors->first() }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
@endpush
