@extends('backend.app')

@section('title', 'View Educational Qualification')

@push('style')
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 10px 15px;
        }

        .card-title {
            margin: 0;
            font-size: 18px;
            font-weight: 500;
        }

        .card-body {
            padding: 15px;
        }

        .preview-img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            max-width: 300px;
        }

        .text-muted {
            font-size: 14px;
            color: #6c757d;
        }

        .label {
            font-weight: 500;
            color: #495057;
        }

        .value {
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">View Skill Details</h4>
                        </div>
                    </div>
                </div>

                <!-- Educational Qualification Details Card -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0 card-title">Skill Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="label"><strong>Name:</strong></div>
                                    <div class="value">{{ $service->name }}</div>
                                </div>
                                <div class="mb-3">
                                    <div class="label"><strong>Description:</strong></div>
                                    <div class="value">{{ $service->description ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0 card-title"><strong>Icon</strong></h4>
                            </div>
                            <div class="text-center card-body">
                                @if ($service->image)
                                    <img src="{{ asset($service->image) }}" alt="Skill Preview" class="preview-img">
                                @else
                                    <span>No Skill Image uploaded.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-end">
                            <a href="{{ route('admin.service.index') }}" class="btn btn-secondary">Back to
                                List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@push('script')
@endpush
