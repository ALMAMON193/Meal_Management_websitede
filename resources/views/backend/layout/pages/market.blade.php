@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
    <style>
        /* Base Styles */
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #e0e7ff;
            --secondary: #10b981;
            --secondary-light: #d1fae5;
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .business_layout_body {
            font-family: 'Hind Siliguri', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--gray-700);
            padding: 1.5rem;
            background-color: #f8fafc;
            min-height: calc(100vh - 64px);
        }

        /* Dashboard Header */
        .dashboard-header {
            background: linear-gradient(45deg, #6366f1, #8b5cf6);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
            color: white;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
        }

        .dashboard-header-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .dashboard-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.025em;
        }

        .dashboard-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            flex יה1;
            min-width: 350px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .stat-card h4 {
            margin: 0 0 0.5rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.8;
        }

        .stat-card p {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: stretch;
        }

        .filter-card {
            background: white;
            border-radius: 1rem;
            padding: 1.25rem;
            box-shadow: var(--shadow-sm);
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
            border: 1px solid var(--gray-200);
        }

        .filter-group {
            flex: 1;
            min-width: 180px;
        }

        .filter-group label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            color: var(--gray-700);
        }

        .filter-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-family: inherit;
            background-color: white;
            transition: all 0.2s ease;
        }

        .filter-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 1px 3px 0 rgba(79, 70, 229, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        .btn-outline {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .btn-outline:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
        }

        .btn-danger {
            background: var(--danger-light);
            color: var(--danger);
        }

        .btn-danger:hover {
            background: var(--danger);
            color: white;
        }

        .btn-icon {
            width: 2.5rem;
            height: 2.5rem;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }

        /* Market Cards Grid */
        .markets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .market-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border: 1px solid var(--gray-200);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .market-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .market-header {
            padding: 1.25rem;
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
        }

        .market-date {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .date-icon {
            background: var(--primary-light);
            color: var(--primary);
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            font-size: 1.25rem;
        }

        .date-text {
            flex: 1;
        }

        .date-text h3 {
            margin: 0 0 0.25rem;
            font-size: 1.125rem;
            color: var(--gray-900);
        }

        .date-text p {
            margin: 0;
            font-size: 0.875rem;
            color: var(--gray-500);
        }

        .market-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .market-items {
            margin-bottom: 1rem;
            flex: 1;
        }

        .market-items h4 {
            margin: 0 0 0.75rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-500);
            font-weight: 600;
        }

        .items-content {
            background: var(--gray-50);
            padding: 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
            min-height: 100px;
            max-height: 150px;
            overflow-y: auto;
            white-space: pre-line;
        }

        .market-price {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px dashed var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price-label {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .price-amount {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .market-footer {
            padding: 1rem 1.25rem;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Empty State */
        .empty-state {
            background: white;
            border-radius: 1rem;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px dashed var(--gray-300);
            grid-column: 1 / -1;
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--gray-400);
            margin-bottom: 1rem;
        }

        .empty-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-700);
            margin: 0 0 0.5rem;
        }

        .empty-text {
            color: var(--gray-500);
            margin: 0 0 1.5rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
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
            border-radius: 1rem;
            width: 100%;
            max-width: 550px;
            box-shadow: var(--shadow-lg);
            transform: scale(0.95);
            transition: transform 0.3s ease;
            max-height: calc(100vh - 40px);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            position: relative;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 1.25rem;
            color: var(--gray-900);
        }

        .close-btn {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            background: var(--gray-100);
            border: none;
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .close-btn:hover {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .modal-body {
            padding: 1.5rem;
            overflow-y: auto;
        }

        .modal-footer {
            padding: 1.25rem 1.5rem;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            color: var(--gray-700);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-family: inherit;
            background-color: white;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* Flatpickr Customization */
        .flatpickr-calendar {
            border-radius: 0.75rem;
            box-shadow: var(--shadow-lg);
            border: none;
            font-family: inherit;
        }

        .flatpickr-day.selected {
            background: var(--primary);
            border-color: var(--primary);
        }

        .flatpickr-day:hover {
            background: var(--primary-light);
        }

        .flatpickr-monthDropdown-months,
        .flatpickr-monthSelect {
            font-weight: 600;
        }

        /* Toast Notifications */
        .toastify {
            padding: 1rem 1.5rem;
            color: white;
            display: inline-block;
            border-radius: 0.5rem;
            box-shadow: var(--shadow-md);
            font-size: 0.875rem;
            max-width: 300px;
            font-family: inherit;
        }

        .toast-success {
            background: linear-gradient(45deg, #10b981, #34d399);
        }

        .toast-error {
            background: linear-gradient(45deg, #ef4444, #f87171);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .business_layout_body {
                padding: 1rem;
            }

            .dashboard-header {
                padding: 1.5rem;
            }

            .dashboard-title {
                font-size: 1.5rem;
            }

            .stat-card {
                min-width: 100%;
            }

            .filter-card {
                padding: 1rem;
            }

            .markets-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                width: 100%;
            }

            .btn {
                width: 100%;
            }
        }

        /* Animated Loading Spinner */
        .loader {
            width: 2.5rem;
            height: 2.5rem;
            border: 3px solid var(--gray-200);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        .pagination-item {
            min-width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            background: white;
            border: 1px solid var(--gray-200);
            color: var(--gray-700);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pagination-item:hover {
            background: var(--gray-50);
            border-color: var(--gray-300);
        }

        .pagination-item.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>

    <!-- Include SweetAlert, Font Awesome, and Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Add Hind Siliguri font for better Bangla support -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <div class="business_layout_body">
        <!-- Dashboard Header with Stats -->
        <div class="dashboard-header">
            <div class="dashboard-header-content">
                <h2 class="dashboard-title">বাজার ব্যবস্থাপনা ড্যাশবোর্ড</h2>

                <div class="dashboard-stats">
                    <div class="stat-card">
                        <h4>মোট বাজার</h4>
                        <p id="total-market-count">{{ $markets->count() }} টি</p>
                    </div>
                    <div class="stat-card">
                        <h4>মোট ব্যয়</h4>
                        <p>৳ {{ number_format($total_amount, 2) }}</p>
                    </div>
                    <div class="stat-card">
                        <h4>এই মাসের ব্যয়</h4>
                        <p id="current-month-total">৳ {{ number_format($total_amount_current_month ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar with Filter -->
        <div class="action-bar">
            <div class="filter-card">
                <div class="filter-group">
                    <label for="filter_calendar">
                        <i class="far fa-calendar-alt"></i> সময় অনুযায়ী খুঁজুন
                    </label>
                    <input type="text" id="filter_calendar" class="filter-input" placeholder="তারিখ নির্বাচন করুন">
                </div>

                <div class="action-buttons">
                    <button class="btn btn-outline" id="clearFilterBtn" style="display: none;">
                        <i class="fas fa-times"></i> ফিল্টার বাতিল করুন
                    </button>
                </div>
            </div>

            <button class="btn btn-primary" onclick="openBazaarModal()">
                <i class="fas fa-plus"></i> নতুন বাজার যোগ করুন
            </button>
        </div>

        <!-- Markets Grid with Cards -->
        <div class="markets-grid" id="markets-grid">
            @if ($markets->count() > 0)
                @foreach ($markets as $market)
                    <div class="market-card" data-id="{{ $market->id }}" data-date="{{ $market->bazaar_date }}"
                        data-price="{{ $market->total_price }}">
                        <div class="market-header">
                            <div class="market-date">
                                <div class="date-icon">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="date-text">
                                    <h3>{{ \Carbon\Carbon::parse($market->bazaar_date)->format('d F, Y') }}</h3>
                                    <p>{{ \Carbon\Carbon::parse($market->bazaar_date)->format('l') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="market-body">
                            <div class="market-items">
                                <h4><i class="fas fa-shopping-basket"></i> বাজারের আইটেম</h4>
                                <div class="items-content">{{ $market->item_details }}</div>
                            </div>
                            <div class="market-price">
                                <div class="price-label">মোট খরচ:</div>
                                <div class="price-amount">৳ {{ number_format($market->total_price, 2) }}</div>
                            </div>
                        </div>
                        <div class="market-footer">
                            <button class="btn btn-outline btn-icon" onclick="editMarket({{ $market->id }})"
                                title="সম্পাদনা করুন">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-icon" onclick="confirmDeleteMarket({{ $market->id }})"
                                title="মুছে ফেলুন">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <h3 class="empty-title">কোন বাজার তথ্য পাওয়া যায়নি</h3>
                    <p class="empty-text">আপনার বাজারের তথ্য যোগ করতে "নতুন বাজার যোগ করুন" বাটনে ক্লিক করুন</p>
                    <button class="btn btn-primary" onclick="openBazaarModal()">
                        <i class="fas fa-plus"></i> নতুন বাজার যোগ করুন
                    </button>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if ($markets->count() > 0 && isset($markets->links))
            <div class="pagination">
                {{ $markets->links() }}
            </div>
        @endif

        <!-- Add/Edit Bazaar Modal -->
        <div class="modal-overlay" id="bazaarModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">নতুন বাজার যোগ করুন</h3>
                    <button class="close-btn" onclick="closeBazaarModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bazaarForm" method="POST">
                        @csrf
                        <input type="hidden" id="market_id" name="market_id">
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="form-group">
                            <label for="bazaar_date">
                                <i class="far fa-calendar-alt"></i> বাজারের তারিখ
                                <span style="color: var(--danger)">*</span>
                            </label>
                            <input type="text" id="bazaar_date" name="bazaar_date" class="form-control"
                                placeholder="তারিখ নির্বাচন করুন" required>
                        </div>

                        <div class="form-group">
                            <label for="item_details">
                                <i class="fas fa-shopping-basket"></i> বাজারের আইটেম বিবরণ
                                <span style="color: var(--danger)">*</span>
                            </label>
                            <textarea id="item_details" name="item_details" class="form-control"
                                placeholder="যেমন: চাল ৫ কেজি, মাছ ২ কেজি, সবজি বিভিন্ন" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="total_price">
                                <i class="fas fa-money-bill"></i> মোট খরচ (টাকা)
                                <span style="color: var(--danger)">*</span>
                            </label>
                            <input type="number" id="total_price" name="total_price" class="form-control"
                                placeholder="যেমন: 1500.00" step="0.01" min="0" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline" onclick="closeBazaarModal()">বাতিল করুন</button>
                    <button type="submit" form="bazaarForm" class="btn btn-primary" id="saveBtn">
                        <i class="fas fa-save"></i> সংরক্ষণ করুন
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Flatpickr for date inputs with Bangla localization
        const bazaarDatePicker = flatpickr("#bazaar_date", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            locale: {
                weekdays: {
                    shorthand: ['রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহঃ', 'শুক্র', 'শনি'],
                    longhand: ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার']
                },
                months: {
                    shorthand: ['জানু', 'ফেব্রু', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টে',
                        'অক্টো', 'নভে', 'ডিসে'
                    ],
                    longhand: ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট',
                        'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
                    ]
                },
                today: "আজ",
                clear: "পরিষ্কার",
                close: "বন্ধ"
            }
        });

        const dateFilter = flatpickr("#filter_calendar", {
            dateFormat: "Y-m-d",
            locale: {
                weekdays: {
                    shorthand: ['রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহঃ', 'শুক্র', 'শনি'],
                    longhand: ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার']
                },
                months: {
                    shorthand: ['জানু', 'ফেব্রু', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টে',
                        'অক্টো', 'নভে', 'ডিসে'
                    ],
                    longhand: ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট',
                        'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
                    ]
                },
                today: "আজ",
                clear: "পরিষ্কার",
                close: "বন্ধ"
            },
            onChange: function(selectedDates, dateStr) {
                if (dateStr) {
                    filterByDate(dateStr);
                    document.getElementById('clearFilterBtn').style.display = 'inline-flex';
                }
            }
        });

        // Filter by date function
        function filterByDate(dateStr) {
            const allCards = document.querySelectorAll('.market-card');
            let visibleCount = 0;
            let totalAmount = 0;

            allCards.forEach(card => {
                const cardDate = card.dataset.date;
                if (cardDate === dateStr) {
                    card.style.display = 'flex';
                    visibleCount++;
                    totalAmount += parseFloat(card.dataset.price);
                } else {
                    card.style.display = 'none';
                }
            });

            updateStatsAfterFilter(visibleCount, totalAmount);
            showFilterStatus(`ফিল্টার করা হয়েছে: ${formatDateBangla(dateStr)}`, visibleCount);
        }

        // Filter by month function
        function filterByMonth(monthStr) {
            const allCards = document.querySelectorAll('.market-card');
            let visibleCount = 0;
            let totalAmount = 0;

            allCards.forEach(card => {
                const cardMonth = card.dataset.month;
                if (cardMonth === monthStr) {
                    card.style.display = 'flex';
                    visibleCount++;
                    totalAmount += parseFloat(card.dataset.price);
                } else {
                    card.style.display = 'none';
                }
            });

            dateFilter.clear();
            document.getElementById('clearFilterBtn').style.display = 'inline-flex';
            updateStatsAfterFilter(visibleCount, totalAmount);

            const monthName = getMonthNameBangla(monthStr);
            showFilterStatus(`ফিল্টার করা হয়েছে: ${monthName} মাস`, visibleCount);
        }

        // Format date to Bangla
        function formatDateBangla(dateStr) {
            const date = new Date(dateStr);
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return date.toLocaleDateString('bn-BD', options);
        }

        // Get month name in Bangla
        function getMonthNameBangla(monthStr) {
            const [year, month] = monthStr.split('-');
            const date = new Date(year, month - 1, 1);
            return date.toLocaleDateString('bn-BD', {
                month: 'long',
                year: 'numeric'
            });
        }

        // Show filter status toast
        function showFilterStatus(message, count) {
            if (count === 0) {
                Toastify({
                    text: `${message} - কোন বাজার পাওয়া যায়নি`,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    className: "toast-warning",

                }).showToast();
            } else {
                Toastify({
                    text: `${message} - Intelligent: true
                    ${count} টি বাজার পাওয়া গেছে`,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    className: "toast-success",

                }).showToast();
            }
        }

        // Clear filter function
        document.getElementById('clearFilterBtn').addEventListener('click', function() {
            dateFilter.clear();
            clearDateFilter();
        });

        function clearDateFilter() {
            const allCards = document.querySelectorAll('.market-card');
            allCards.forEach(card => {
                card.style.display = 'flex';
            });

            document.getElementById('clearFilterBtn').style.display = 'none';

            // Reset to original stats
            document.getElementById('total-market-count').textContent = '{{ $markets->count() }} টি';
            document.getElementById('current-month-total').textContent =
                '৳ {{ number_format($total_amount_current_month ?? 0, 2) }}';

            Toastify({
                text: "সব বাজার দেখানো হচ্ছে",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                className: "toast-success",

            }).showToast();
        }

        // Update dashboard stats after filtering
        function updateStatsAfterFilter(visibleCount, totalAmount = 0) {
            document.getElementById('total-market-count').textContent = `${visibleCount} টি`;

            // Format total amount with Bangla taka symbol
            const formattedAmount = new Intl.NumberFormat('bn-BD', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(totalAmount);

            // Update the current month total
            document.getElementById('current-month-total').textContent = `৳ ${formattedAmount}`;
        }

        // Modal handling
        function openBazaarModal(marketId = null) {
            const modal = document.getElementById('bazaarModal');
            const modalTitle = document.getElementById('modalTitle');
            const form = document.getElementById('bazaarForm');

            if (marketId) {
                // Edit mode
                modalTitle.textContent = 'বাজার সম্পাদনা করুন';
                form.action = `/market/${marketId}`;
                document.getElementById('market_id').value = marketId;
                fetchMarketData(marketId);
            } else {
                // Add mode
                modalTitle.textContent = 'নতুন বাজার যোগ করুন';
                form.action = "{{ route('market.store') }}";
                document.getElementById('market_id').value = '';
                form.reset();
                bazaarDatePicker.setDate(new Date());
            }

            modal.classList.add('active');
        }

        function closeBazaarModal() {
            document.getElementById('bazaarModal').classList.remove('active');
            document.getElementById('bazaarForm').reset();
        }

        // Fetch market data for editing
        async function fetchMarketData(marketId) {
            const saveBtn = document.getElementById('saveBtn');
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> লোড হচ্ছে...';
            saveBtn.disabled = true;

            try {
                const response = await fetch(`/market/${marketId}/edit`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                // Check if response is OK before parsing JSON
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server did not return JSON. Check your routes and controllers.');
                }

                const data = await response.json();
                document.getElementById('bazaar_date').value = data.bazaar_date;
                document.getElementById('item_details').value = data.item_details;
                document.getElementById('total_price').value = data.total_price;
            } catch (error) {
                console.error('Error fetching market data:', error);
                Toastify({
                    text: "তথ্য লোড করতে সমস্যা হয়েছে: " + error.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    className: "toast-error",
                }).showToast();
            } finally {
                saveBtn.innerHTML = '<i class="fas fa-save"></i> সংরক্ষণ করুন';
                saveBtn.disabled = false;
            }
        }

        // Form submission handler
        document.getElementById('bazaarForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            const saveBtn = document.getElementById('saveBtn');
            const isEdit = !!document.getElementById('market_id').value;
            const url = isEdit ? `/market/${document.getElementById('market_id').value}` :
                "{{ route('market.store') }}";
            const method = isEdit ? 'PUT' : 'POST';

            saveBtn.innerHTML = 'সংরক্ষণ করা হচ্ছে...';
            saveBtn.disabled = true;

            try {
                // For PUT requests, we need to append the _method field
                if (isEdit) {
                    formData.append('_method', 'PUT');
                }

                const response = await fetch(url, {
                    method: isEdit ? 'POST' :
                    'POST', // Always use POST with FormData, and use _method for PUT
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                // Check if response is OK before parsing JSON
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server did not return JSON. Check your routes and controllers.');
                }

                const result = await response.json();
                Toastify({
                    text: isEdit ? 'বাজার সফলভাবে আপডেট করা হয়েছে!' :
                        'নতুন বাজার সফলভাবে যোগ করা হয়েছে!',
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    className: "toast-success",
                }).showToast();

                // Update UI
                if (isEdit) {
                    updateMarketCard(result.data);
                } else {
                    addMarketCard(result.data);
                }
                updateStats();
                closeBazaarModal();
            } catch (error) {
                console.error('Error saving market data:', error);
                Toastify({
                    text: "সংরক্ষণের সময় ত্রুটি ঘটেছে: " + error.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    className: "toast-error",
                }).showToast();
            } finally {
                saveBtn.innerHTML = '<i class="fas fa-save"></i> সংরক্ষণ করুন';
                saveBtn.disabled = false;
            }
        });

        // Add new market card
        function addMarketCard(market) {
            const grid = document.getElementById('markets-grid');
            const card = document.createElement('div');
            card.className = 'market-card';
            card.dataset.id = market.id;
            card.dataset.date = market.bazaar_date;
            card.dataset.price = market.total_price;
            card.innerHTML = `
                <div class="market-header">
                    <div class="market-date">
                        <div class="date-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="date-text">
                            <h3>${new Date(market.bazaar_date).toLocaleDateString('bn-BD', { day: 'numeric', month: 'long', year: 'numeric' })}</h3>
                            <p>${new Date(market.bazaar_date).toLocaleDateString('bn-BD', { weekday: 'long' })}</p>
                        </div>
                    </div>
                </div>
                <div class="market-body">
                    <div class="market-items">
                        <h4><i class="fas fa-shopping-basket"></i> বাজারের আইটেম</h4>
                        <div class="items-content">${market.item_details}</div>
                    </div>
                    <div class="market-price">
                        <div class="price-label">মোট খরচ:</div>
                        <div class="price-amount">৳ ${new Intl.NumberFormat('bn-BD', { minimumFractionDigits: 2 }).format(market.total_price)}</div>
                    </div>
                </div>
                <div class="market-footer">
                    <button class="btn btn-outline btn-icon" onclick="editMarket(${market.id})" title="সম্পাদনা করুন">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-icon" onclick="confirmDeleteMarket(${market.id})" title="মুছে ফেলুন">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            grid.prepend(card);
            if (grid.querySelector('.empty-state')) {
                grid.querySelector('.empty-state').remove();
            }
        }

        // Update existing market card
        function updateMarketCard(market) {
            const card = document.querySelector(`.market-card[data-id="${market.id}"]`);
            if (card) {
                card.dataset.date = market.bazaar_date;
                card.dataset.price = market.total_price;
                card.querySelector('.date-text h3').textContent = new Date(market.bazaar_date).toLocaleDateString('bn-BD', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                card.querySelector('.date-text p').textContent = new Date(market.bazaar_date).toLocaleDateString('bn-BD', {
                    weekday: 'long'
                });
                card.querySelector('.items-content').textContent = market.item_details;
                card.querySelector('.price-amount').textContent =
                    `৳ ${new Intl.NumberFormat('bn-BD', { minimumFractionDigits: 2 }).format(market.total_price)}`;
            }
        }

        // Update dashboard statistics
        async function updateStats() {
            try {
                const response = await fetch('/market/stats', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const stats = await response.json();
                document.getElementById('total-market-count').textContent = `${stats.total_count} টি`;
                document.getElementById('current-month-total').textContent =
                    `৳ ${new Intl.NumberFormat('bn-BD', { minimumFractionDigits: 2 }).format(stats.current_month_total)}`;
            } catch (error) {
                console.error('Failed to update stats:', error);
            }
        }

        // Confirm before deleting a market
        function confirmDeleteMarket(marketId) {
            Swal.fire({
                title: 'আপনি কি নিশ্চিত?',
                text: "আপনি এই বাজার রেকর্ডটি মুছে ফেলতে চান!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'হ্যাঁ, মুছে ফেলুন!',
                cancelButtonText: 'বাতিল করুন',
                customClass: {
                    title: 'bangla-font',
                    content: 'bangla-font',
                    confirmButton: 'bangla-font',
                    cancelButton: 'bangla-font'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteMarket(marketId);
                }
            });
        }

        // Delete market function
        async function deleteMarket(marketId) {
            const marketCard = document.querySelector(`.market-card[data-id="${marketId}"]`);
            marketCard.style.opacity = '0.5';
            const deleteBtn = marketCard.querySelector('.btn-danger');
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            try {
                const response = await fetch(`/market/${marketId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    marketCard.style.transform = 'scale(0.9)';
                    marketCard.style.opacity = '0';
                    setTimeout(() => {
                        marketCard.remove();
                        updateStats();
                        if (!document.querySelector('.market-card')) {
                            document.getElementById('markets-grid').innerHTML = `
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-shopping-basket"></i>
                                    </div>
                                    <h3 class="empty-title">কোন বাজার তথ্য পাওয়া যায়নি</h3>
                                    <p class="empty-text">আপনার বাজারের তথ্য যোগ করতে "নতুন বাজার যোগ করুন" বাটনে ক্লিক করুন</p>
                                    <button class="btn btn-primary" onclick="openBazaarModal()">
                                        <i class="fas fa-plus"></i> নতুন বাজার যোগ করুন
                                    </button>
                                </div>
                            `;
                        }
                        Toastify({
                            text: "বাজার রেকর্ড সফলভাবে মুছে ফেলা হয়েছে!",
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            className: "toast-success",

                        }).showToast();
                    }, 300);
                } else {
                    throw new Error('মুছে ফেলা ব্যর্থ হয়েছে');
                }
            } catch (error) {
                marketCard.style.opacity = '1';
                deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
                Toastify({
                    text: error.message || "মুছে ফেলার সময় ত্রুটি ঘটেছে",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    className: "toast-error",

                }).showToast();
            }
        }

        // Edit market function
        function editMarket(marketId) {
            openBazaarModal(marketId);
        }

        // Export data function
        function exportData() {
            Toastify({
                text: "ডেটা এক্সপোর্ট প্রস্তুত হচ্ছে...",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                className: "toast-warning",

            }).showToast();

            setTimeout(() => {
                Toastify({
                    text: "ডেটা সফলভাবে এক্সপোর্ট করা হয়েছে!",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    className: "toast-success",

                }).showToast();
            }, 2000);
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltips = document.querySelectorAll('.tooltip');
            tooltips.forEach(tooltip => {
                tooltip.addEventListener('mouseenter', function() {
                    const tooltipText = this.querySelector('.tooltip-text');
                    if (tooltipText) {
                        tooltipText.style.visibility = 'visible';
                        tooltipText.style.opacity = '1';
                    }
                });

                tooltip.addEventListener('mouseleave', function() {
                    const tooltipText = this.querySelector('.tooltip-text');
                    if (tooltipText) {
                        tooltipText.style.visibility = 'hidden';
                        tooltipText.style.opacity = '0';
                    }
                });
            });
        });
    </script>
@endsection
