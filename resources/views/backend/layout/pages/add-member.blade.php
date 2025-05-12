@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
    <style>
        /* ===== CLEAN & INTERACTIVE DESIGN ===== */
        :root {
            --success-color: #4cc9f0;
            --error-color: #f72585;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #6c757d;
            --white: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
            color: #212529;
        }

        .business_layout_body {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Dashboard Header */
        .dashboard-header {
            background-color: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .dashboard-title {
            color: var(--secondary-color);
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .dashboard-stats {
            display: flex;
            gap: 1.5rem;
        }

        .stat-card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 1.25rem;
            flex: 1;
            min-width: 200px;
            border: 1px solid var(--medium-gray);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card h4 {
            color: var(--dark-gray);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            color: var(--secondary-color);
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        /* Member Section */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: var(--secondary-color);
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .add-member-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .add-member-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .add-member-btn i {
            font-size: 1rem;
        }

        /* Members Grid */
        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .member-card {
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--medium-gray);
            transition: all 0.3s ease;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid var(--medium-gray);
        }

        .member-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.25rem;
            font-weight: 600;
        }

        .member-info {
            flex: 1;
        }

        .member-name {
            color: #212529;
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0 0 0.25rem 0;
        }

        .member-role {
            color: var(--dark-gray);
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .card-body {
            padding: 1.25rem;
        }

        .info-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .info-icon {
            color: var(--primary-color);
            font-size: 1rem;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-content h4 {
            color: var(--dark-gray);
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0 0 0.25rem 0;
        }

        .info-content p {
            color: #212529;
            font-size: 1rem;
            font-weight: 500;
            margin: 0;
        }

        .card-footer {
            padding: 1rem;
            display: flex;
            gap: 0.75rem;
            background-color: var(--light-gray);
            border-top: 1px solid var(--medium-gray);
        }

        .action-btn {
            flex: 1;
            padding: 0.5rem;
            border-radius: 6px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .edit-btn {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .edit-btn:hover {
            background-color: rgba(67, 97, 238, 0.2);
        }

        .delete-btn {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--error-color);
        }

        .delete-btn:hover {
            background-color: rgba(247, 37, 133, 0.2);
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background-color: var(--white);
            border-radius: 10px;
            border: 1px dashed var(--medium-gray);
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--medium-gray);
            margin-bottom: 1rem;
        }

        .empty-text {
            color: var(--dark-gray);
            font-size: 1.25rem;
            font-weight: 500;
            margin: 0;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
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
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: var(--dark-gray);
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .close-btn:hover {
            color: #212529;
        }

        .modal-content h3 {
            color: var(--secondary-color);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: var(--dark-gray);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            background-color: var(--white);
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            color: #212529;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            flex: 1;
            padding: 0.875rem;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: var(--white);
            color: var(--dark-gray);
            border: 1px solid var(--medium-gray);
        }

        .btn-secondary:hover {
            background-color: var(--light-gray);
        }

        /* Interactive Elements */
        .member-card {
            position: relative;
            overflow: hidden;
        }

        .member-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: var(--primary-color);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .member-card:hover::after {
            transform: scaleX(1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-stats {
                flex-direction: column;
            }
            
            .members-grid {
                grid-template-columns: 1fr;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        /* Notification Styles */
        .swal2-popup {
            border-radius: 12px !important;
            font-family: 'Inter', sans-serif !important;
        }

        .swal2-title {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
        }

        .swal2-success {
            color: var(--success-color) !important;
            border-color: var(--success-color) !important;
        }

        .swal2-error {
            color: var(--error-color) !important;
            border-color: var(--error-color) !important;
        }

        .swal2-confirm {
            background-color: var(--primary-color) !important;
            border-radius: 6px !important;
            padding: 0.5rem 1.25rem !important;
        }

        .swal2-confirm:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.3) !important;
        }
    </style>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <div class="business_layout_body">
        <!-- Dashboard Header with Stats -->
        <div class="dashboard-header">
            <div class="dashboard-header-content">
                <h2 class="dashboard-title">সকল সদস্যের তালিকা</h2>
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <h4>মোট সদস্য</h4>
                        <p id="total-member-count">{{ count($members) }} জন</p>
                    </div>
                    <div class="stat-card">
                        <h4>সক্রিয় সদস্য</h4>
                        <p>{{ count($members) }} জন</p>
                    </div>
                </div>
            </div>
        </div>

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
                                <div class="member-role">{{ $member->role == 'manager' ? 'ম্যানেজার' : 'সদস্য' }}</div>
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
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        }

        function closeModal() {
            document.getElementById('addMemberModal').classList.remove('active');
            document.body.style.overflow = ''; // Re-enable scrolling
        }

        // Close modal when clicking outside
        document.getElementById('addMemberModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Form Submission with Notification
        document.getElementById('memberForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            showLoadingAlert('অপেক্ষা করুন...');
            
            // Simulate AJAX submission
            setTimeout(() => {
                // In a real app, you would use fetch or axios here
                this.submit();
            }, 1500);
        });

        // Interactive Notification Functions
        function showSuccessAlert(message) {
            Swal.fire({
                icon: 'success',
                title: 'সফল!',
                text: message,
                confirmButtonText: 'ঠিক আছে',
                background: 'var(--white)',
                color: '#212529',
                confirmButtonColor: 'var(--primary-color)',
                backdrop: `
                    rgba(0,0,0,0.5)
                    left top
                    no-repeat
                `
            });
        }

        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'ত্রুটি!',
                text: message,
                confirmButtonText: 'বুঝেছি',
                background: 'var(--white)',
                color: '#212529',
                confirmButtonColor: 'var(--primary-color)'
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
                background: 'var(--white)',
                color: '#212529',
                confirmButtonColor: 'var(--primary-color)',
                cancelButtonColor: 'var(--medium-gray)'
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
                background: 'var(--white)',
                color: '#212529'
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
                        // Reload the page to see changes
                        window.location.reload();
                    }, 1500);
                }
            });
        }

        // Display flash messages as notifications
        @if(session('success'))
            showSuccessAlert('{{ session('success') }}');
        @endif

        @if(session('error'))
            showErrorAlert('{{ session('error') }}');
        @endif

        // Add hover effects to cards programmatically
        document.querySelectorAll('.member-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.1)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.boxShadow = '0 3px 8px rgba(0, 0, 0, 0.05)';
            });
        });
    </script>
@endsection