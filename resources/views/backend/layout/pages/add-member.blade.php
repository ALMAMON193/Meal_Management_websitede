@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
@include('backend.partials.style')
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="business_layout_body">
        <!-- Dashboard Header with Stats -->
        <div class="dashboard-header">
            <div class="dashboard-header-content">
                <h2 class="dashboard-title">সকল সদস্যের তালিকা</h2>
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <h4>মোট বাজার</h4>
                        <p id="total-market-count">5 টি</p>
                    </div>
                    <div class="stat-card">
                        <h4>মোট ব্যয়</h4>
                        <p>৳ 5,250.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

