@extends('backend.app')

@section('title', 'Create Project')
@push('style')
    <style>
        .preview-img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .text-muted {
            font-size: 12px;
            color: #6c757d;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .icon-preview-container {
            margin-top: 10px;
            height: auto;
            width: 160px;
        }

        .preview-card {
            position: relative;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 150px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 10px 15px;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border: none;
            padding: 2px 5px;
            cursor: pointer;
            font-size: 12px;
            border-radius: 50%;
        }
    </style>
@endpush
@section('content')

        <div class="page-content">
            <div class="container-fluid">

                <div class="col-xxl-">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="mb-0 card-title flex-grow-1">Project Create</h4>

                        </div><!-- end card header -->
                        <div class="card-body">
                            <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3 row">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter skill name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-lg-3">
                                        <label for="image" class="form-label">Image</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="file" name="image" id="image"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="icon-preview-container" id="iconPreview"></div>

                                        {{-- Script --}}
                                        <script>
                                            const imageInput = document.getElementById('image');
                                            const iconPreview = document.getElementById('iconPreview');

                                            imageInput.addEventListener('change', function(event) {
                                                const file = event.target.files[0];
                                                if (file) {
                                                    const reader = new FileReader();
                                                    reader.onload = function() {
                                                        const imagePreview = document.createElement('img');
                                                        imagePreview.src = reader.result;
                                                        imagePreview.alt = file.name;
                                                        imagePreview.classList.add('img-fluid');

                                                        iconPreview.innerHTML = ''; // Clear previous previews

                                                        // Create a container to hold the image and remove button
                                                        const previewContainer = document.createElement('div');
                                                        previewContainer.classList.add('preview-container');
                                                        previewContainer.style.position = 'relative';

                                                        // Create remove button
                                                        const removeBtn = document.createElement('button');
                                                        removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-btn');
                                                        removeBtn.textContent = 'X';
                                                        removeBtn.addEventListener('click', function() {
                                                            imageInput.value = ''; // Reset file input
                                                            iconPreview.innerHTML = ''; // Clear preview
                                                        });

                                                        previewContainer.appendChild(imagePreview);
                                                        previewContainer.appendChild(removeBtn);
                                                        iconPreview.appendChild(previewContainer);
                                                    };
                                                    reader.readAsDataURL(file);
                                                } else {
                                                    iconPreview.innerHTML = '';
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-lg-3">
                                        <label for="description" class="form-label">Description</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Enter a description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save Skill</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->

        </div> <!-- container-fluid -->

@endsection
@push('script')
    <script>
        function previewFile(input) {
            let file = input.files[0];
            let preview = document.getElementById('icon-preview');

            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = "none";
            }
        }
    </script>
@endpush
