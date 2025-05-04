@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
    <style>
        /* Base Styles */
        .business_layout_body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding: 20px;
            background-color: #f8fafc;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 1.5rem;
            color: #1e293b;
            font-weight: 600;
        }

        .add-member-btn {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-member-btn:hover {
            background: linear-gradient(135deg, #4338ca, #6d28d9);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        /* Member Cards */
        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .member-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            padding: 20px;
            background: linear-gradient(135deg, #f9fafb, #f3f4f6);
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .member-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
        }

        .member-info {
            flex: 1;
        }

        .member-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 3px;
        }

        .member-role {
            font-size: 0.75rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .info-icon {
            width: 30px;
            height: 30px;
            background: #f3f4f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: #4f46e5;
            font-size: 14px;
        }

        .info-content h4 {
            margin: 0;
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-content p {
            margin: 3px 0 0;
            font-size: 0.9rem;
            color: #111827;
            font-weight: 500;
        }

        .card-footer {
            padding: 15px 20px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
        }

        .action-btn {
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .edit-btn {
            background: #e0e7ff;
            color: #4f46e5;
        }

        .edit-btn:hover {
            background: #c7d2fe;
        }

        .delete-btn {
            background: #fee2e2;
            color: #ef4444;
        }

        .delete-btn:hover {
            background: #fecaca;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            position: relative;
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-content h3 {
            margin: 0 0 1.5rem;
            font-size: 1.5rem;
            color: #1e293b;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 1.5rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca, #6d28d9);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #64748b;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #64748b;
            cursor: pointer;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background: #f9fafb;
            border-radius: 10px;
            border: 1px dashed #d1d5db;
            grid-column: 1 / -1;
        }

        .empty-icon {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 15px;
        }

        .empty-text {
            color: #6b7280;
            font-size: 1rem;
        }

        /* SweetAlert Custom Styles */
        .swal2-popup {
            border-radius: 12px !important;
            padding: 30px !important;
            font-family: inherit !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .swal2-title {
            font-size: 1.5rem !important;
            color: #1e293b !important;
            font-weight: 600 !important;
        }

        .swal2-html-container {
            font-size: 1rem !important;
            color: #64748b !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 10px 20px !important;
        }

        .swal2-cancel {
            background: #f1f5f9 !important;
            color: #64748b !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 10px 20px !important;
        }

        @media (max-width: 768px) {
            .members-grid {
                grid-template-columns: 1fr;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="business_layout_body">
        <div class="meal-management-section">
            <div class="section-header">
                <h3 class="section-title">সদস্য তালিকা</h3>
                <button class="add-member-btn" onclick="openModal()">
                    <i class="fas fa-plus"></i> নতুন সদস্য যোগ করুন
                </button>
            </div>
            <div class="members-grid">
                @forelse ($members as $member)
                    <div class="member-card">
                        <div class="card-header">
                            <div class="member-avatar">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                            <div class="member-info">
                                <h3 class="member-name">{{ $member->name }}</h3>
                                <div class="member-role">{{ $member->role }}</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <h4>ইমেইল</h4>
                                    <p>{{ $member->email }}</p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4>যোগদান তারিখ</h4>
                                    <p>{{ $member->created_at->format('d M, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="action-btn edit-btn" onclick="editMember({{ $member->id }})">
                                <i class="fas fa-edit"></i> এডিট
                            </button>
                            <button class="action-btn delete-btn" onclick="deleteMember({{ $member->id }})">
                                <i class="fas fa-trash"></i> ডিলিট
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-users-slash"></i>
                        </div>
                        <h3 class="empty-text">কোনো সদস্য পাওয়া যায়নি</h3>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Add Member Modal -->
        <div class="modal-overlay" id="addMemberModal">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal()">×</button>
                <h3>নতুন সদস্য যোগ করুন</h3>
                <form id="memberForm" action="{{ route('member.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">নাম</label>
                        <input type="text" id="name" name="name" required placeholder="সদস্যের নাম লিখুন"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">ইমেইল</label>
                        <input type="email" id="email" name="email" required placeholder="ইমেইল ঠিকানা লিখুন"
                            value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">পাসওয়ার্ড</label>
                        <input type="password" id="password" name="password" required placeholder="পাসওয়ার্ড লিখুন">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">পাসওয়ার্ড নিশ্চিত করুন</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="পাসওয়ার্ড পুনরায় লিখুন">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">সদস্য যোগ করুন</button>
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">বাতিল</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal Functions
        function openModal() {
            document.getElementById('addMemberModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('addMemberModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('addMemberModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // SweetAlert Functions
        function showSuccessAlert(message) {
            Swal.fire({
                icon: 'success',
                title: 'সফল!',
                text: message,
                confirmButtonText: 'ঠিক আছে',
                customClass: {
                    popup: 'custom-swal',
                    confirmButton: 'swal-confirm-btn'
                }
            });
        }

        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'ত্রুটি!',
                text: message,
                confirmButtonText: 'বুঝেছি',
                customClass: {
                    popup: 'custom-swal',
                    confirmButton: 'swal-confirm-btn'
                }
            });
        }

        function showConfirmAlert(title, text, confirmText, cancelText) {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: confirmText,
                cancelButtonText: cancelText,
                reverseButtons: true,
                customClass: {
                    popup: 'custom-swal',
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            });
        }

        function showLoadingAlert(title) {
            Swal.fire({
                title: title,
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                },
                customClass: {
                    popup: 'custom-swal'
                }
            });
        }

        // Member Functions
        function editMember(id) {
            showConfirmAlert(
                'সদস্য সম্পাদনা',
                'আপনি কি এই সদস্যের তথ্য সম্পাদনা করতে চান?',
                'হ্যাঁ, সম্পাদনা করুন',
                'না, বাতিল করুন'
            ).then((result) => {
                if (result.isConfirmed) {
                    showLoadingAlert('অপেক্ষা করুন...');
                    // AJAX call or form submission for edit
                    setTimeout(() => {
                        Swal.close();
                        showSuccessAlert('সদস্য সফলভাবে সম্পাদিত হয়েছে!');
                    }, 1500);
                }
            });
        }

        function deleteMember(id) {
            showConfirmAlert(
                'সদস্য মুছুন',
                'আপনি কি নিশ্চিতভাবে এই সদস্যকে মুছে ফেলতে চান? এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না।',
                'হ্যাঁ, মুছে ফেলুন',
                'না, বাতিল করুন'
            ).then((result) => {
                if (result.isConfirmed) {
                    showLoadingAlert('অপেক্ষা করুন...');
                    // AJAX call or form submission for delete
                    setTimeout(() => {
                        Swal.close();
                        showSuccessAlert('সদস্য সফলভাবে মুছে ফেলা হয়েছে!');
                    }, 1500);
                }
            });
        }
    </script>
@endsection

