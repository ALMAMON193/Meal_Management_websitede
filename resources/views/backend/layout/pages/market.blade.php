<!-- resources/views/backend/layout/pages/market.blade.php -->
@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
    <style>
        /* Existing styles unchanged */
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

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
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

    <!-- Include SweetAlert JS and Font Awesome for icons -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="business_layout_body">
        <div class="meal-management-section">
            <div class="section-header">
                <h3 class="section-title">আমার বাজারের তালিকা</h3>
                <div>
                    <button class="add-member-btn" onclick="openBazaarModal()">
                        <i class="fas fa-shopping-basket"></i> নতুন বাজার যোগ করুন
                    </button>
                </div>
            </div>
            <div class="members-grid">
                @forelse ($markets as $market)
                    <div class="member-card">
                        <div class="card-header">
                            <div class="member-avatar">
                                {{ substr($market->member->name ?? 'N/A', 0, 1) }}
                            </div>
                            <div class="member-info">
                                <h3 class="member-name">{{ $market->member->name ?? 'Unknown' }}</h3>
                                <div class="member-role">বাজারের তারিখ: {{ $market->bazaar_date->format('d M, Y') }}</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-list"></i>
                                </div>
                                <div class="info-content">
                                    <h4>আইটেম বিবরণ</h4>
                                    <p>{{ Str::limit($market->item_details, 50) }}</p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                                <div class="info-content">
                                    <h4>মোট মূল্য</h4>
                                    <p>{{ number_format($market->total_price, 2) }} টাকা</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <!-- Uncomment and implement edit/delete functionality as needed -->
                            <!--
                            <button class="action-btn edit-btn" onclick="editMember({{ $market->id }})">
                                <i class="fas fa-edit"></i> এডিট
                            </button>
                            <button class="action-btn delete-btn" onclick="deleteMember({{ $market->id }})">
                                <i class="fas fa-trash"></i> ডিলিট
                            </button>
                            -->
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <h3 class="empty-text">কোনো বাজার পাওয়া যায়নি</h3>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Add Bazaar Modal -->
        <div class="modal-overlay" id="addBazaarModal">
            <div class="modal-content">
                <button class="close-btn" onclick="closeBazaarModal()">×</button>
                <h3>নতুন বাজার তথ্য যোগ করুন</h3>
                <form id="bazaarForm" action="{{ route('market.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="form-group">
                        <label for="bazaar_date">বাজারের তারিখ</label>
                        <input type="date" id="bazaar_date" name="bazaar_date" required
                            value="{{ old('bazaar_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="item_details">আইটেম বিবরণ</label>
                        <textarea id="item_details" name="item_details" required
                            placeholder="আইটেম এবং তাদের দাম লিখুন (যেমন: মুরগি ২ কেজি - ৫০০ টাকা)">{{ old('item_details') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="total_price">মোট মূল্য</label>
                        <input type="number" id="total_price" name="total_price" required
                            placeholder="মোট মূল্য লিখুন" step="0.01" value="{{ old('total_price') }}">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">বাজার তথ্য সংরক্ষণ করুন</button>
                        <button type="button" class="btn btn-secondary" onclick="closeBazaarModal()">বাতিল</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Bazaar Modal Functions
        function openBazaarModal() {
            document.getElementById('addBazaarModal').classList.add('active');
        }

        function closeBazaarModal() {
            document.getElementById('addBazaarModal').classList.remove('active');
            document.getElementById('bazaarForm').reset();
        }

        document.getElementById('addBazaarModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBazaarModal();
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

        // Bazaar Form Submission
        document.getElementById('bazaarForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'তথ্য সংরক্ষণ করা হচ্ছে...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                },
                customClass: {
                    popup: 'custom-swal'
                }
            });

            const formData = new FormData(this);
            for (let [key, value] of formData.entries()) {
                console.log(key, value); // Debug form data
            }

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    showSuccessAlert(data.message);
                    closeBazaarModal();
                    location.reload(); // Reload to show new market data
                } else {
                    showErrorAlert(data.message || 'তথ্য সংরক্ষণে সমস্যা হয়েছে!');
                }
            })
            .catch(error => {
                Swal.close();
                showErrorAlert('সার্ভারের সাথে সংযোগে সমস্যা হয়েছে!');
                console.error('Error:', error);
            });
        });
    </script>
@endsection
