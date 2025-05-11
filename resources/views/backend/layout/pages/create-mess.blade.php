@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
@include('backend.partials.style')
<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        position: relative;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
        background: none;
        border: none;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary {
        background: #007bff;
        color: #fff;
    }

    .btn-secondary {
        background: #6c757d;
        color: #fff;
    }

    .disabled-section {
        pointer-events: none;
        opacity: 0.5;
    }
</style>

<div class="business_layout_body">
        <div class="modal-overlay active" id="createMessModal">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('createMessModal')">×</button>
                <h3>মেস তৈরি করুন</h3>
                <form id="messForm" action="{{ route('mess.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="mess_name">মেসের নাম</label>
                        <input type="text" id="mess_name" name="name" required placeholder="মেসের নাম লিখুন" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">ঠিকানা (ঐচ্ছিক)</label>
                        <textarea id="address" name="address" placeholder="মেসের ঠিকানা লিখুন">{{ old('address') }}</textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">মেস তৈরি করুন</button>
                        <button type="button" class="btn btn-secondary" onclick="closeModal('createMessModal')">বাতিল</button>
                    </div>
                </form>
            </div>
        </div>
</div>

<script>
    function openAddMemberModal() {
        document.getElementById('addMemberModal').classList.add('active');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }

    // Show SweetAlert on success
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'সফল!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>
@endsection