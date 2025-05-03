@extends('backend.app')

@section('title', 'Edit Project')
@section('content')

        <div class="page-content">
            <div class="container-fluid">

                <div class="col-xxl-">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="mb-0 card-title flex-grow-1">Project Edit</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <form action="{{ route('admin.service.update', $skill->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="mb-3 row">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label">Skill Name <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $skill->name) }}">
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
                                            class="form-control @error('image') is-invalid @enderror"
                                            onchange="previewFile(this)">

                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="mt-2">
                                            <img id="icon-preview" src="{{ asset($skill->image) }}" alt="Skill Icon"
                                                width="100" style="display: {{ $skill->icon ? 'block' : 'none' }};">
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <div class="col-lg-3">
                                        <label for="description" class="form-label">Description</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Enter a description">{{ old('description', $skill->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update Skill</button>
                                    <a href="{{ route('admin.service.index') }}" class="btn btn-secondary">Cancel</a>
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
    <!-- JavaScript for Image Preview -->
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
            }
        }
    </script>
@endpush
