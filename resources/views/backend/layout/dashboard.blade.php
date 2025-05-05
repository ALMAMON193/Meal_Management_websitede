@extends('backend.app')
@section('title', 'বাজার ব্যবস্থাপনা ড্যাশবোর্ড')
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
            flex: 1;
            min-width: 180px;
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
                        <p id="total-market-count">5 টি</p>
                    </div>
                    <div class="stat-card">
                        <h4>মোট ব্যয়</h4>
                        <p>৳ 5,250.00</p>
                    </div>
                    <div class="stat-card">
                        <h4>এই মাসের ব্যয়</h4>
                        <p id="current-month-total">৳ 2,500.00</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Markets Grid with Cards -->
        <div class="markets-grid" id="markets-grid">
            <div class="market-card" data-id="1" data-date="2023-06-15" data-price="1200.50">
                <div class="market-header">
                    <div class="market-date">
                        <div class="date-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="date-text">
                            <h3>15 June, 2023</h3>
                            <p>Thursday</p>
                        </div>
                    </div>
                </div>
                <div class="market-body">
                    <div class="market-items">
                        <h4><i class="fas fa-shopping-basket"></i> বাজারের আইটেম</h4>
                        <div class="items-content">- মাছ: 1kg (500৳)
                            - চাল: 5kg (300৳)
                            - ডাল: 2kg (200৳)
                            - সবজি: 200৳</div>
                    </div>
                    <div class="market-price">
                        <div class="price-label">মোট খরচ:</div>
                        <div class="price-amount">৳ 1,200.50</div>
                    </div>
                </div>
                <div class="market-footer">
                    <button class="btn btn-outline btn-icon" onclick="editMarket(1)" title="সম্পাদনা করুন">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-icon" onclick="confirmDeleteMarket(1)" title="মুছে ফেলুন">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <div class="market-card" data-id="2" data-date="2023-06-10" data-price="850.00">
                <div class="market-header">
                    <div class="market-date">
                        <div class="date-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="date-text">
                            <h3>10 June, 2023</h3>
                            <p>Saturday</p>
                        </div>
                    </div>
                </div>
                <div class="market-body">
                    <div class="market-items">
                        <h4><i class="fas fa-shopping-basket"></i> বাজারের আইটেম</h4>
                        <div class="items-content">- মুরগি: 1kg (350৳)
                            - ডিম: 12pcs (120৳)
                            - তেল: 1L (150৳)
                            - পেঁয়াজ: 1kg (80৳)
                            - রসুন: 250g (50৳)
                            - মসলা: 100৳</div>
                    </div>
                    <div class="market-price">
                        <div class="price-label">মোট খরচ:</div>
                        <div class="price-amount">৳ 850.00</div>
                    </div>
                </div>
                <div class="market-footer">
                    <button class="btn btn-outline btn-icon" onclick="editMarket(2)" title="সম্পাদনা করুন">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-icon" onclick="confirmDeleteMarket(2)" title="মুছে ফেলুন">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <div class="market-card" data-id="3" data-date="2023-06-05" data-price="450.00">
                <div class="market-header">
                    <div class="market-date">
                        <div class="date-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="date-text">
                            <h3>05 June, 2023</h3>
                            <p>Monday</p>
                        </div>
                    </div>
                </div>
                <div class="market-body">
                    <div class="market-items">
                        <h4><i class="fas fa-shopping-basket"></i> বাজারের আইটেম</h4>
                        <div class="items-content">- দুধ: 2L (120৳)
                            - রুটি: 10pcs (50৳)
                            - কলা: 1dozen (80৳)
                            - আপেল: 4pcs (100৳)
                            - বিস্কুট: 100৳</div>
                    </div>
                    <div class="market-price">
                        <div class="price-label">মোট খরচ:</div>
                        <div class="price-amount">৳ 450.00</div>
                    </div>
                </div>
                <div class="market-footer">
                    <button class="btn btn-outline btn-icon" onclick="editMarket(3)" title="সম্পাদনা করুন">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-icon" onclick="confirmDeleteMarket(3)" title="মুছে ফেলুন">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <div class="pagination-item disabled">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="pagination-item active">1</div>
            <div class="pagination-item">2</div>
            <div class="pagination-item">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
    </div>

    <!-- Add/Edit Market Modal (Hidden by default) -->
    <div class="modal-overlay" id="marketModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">নতুন বাজার যোগ করুন</h3>
                <button class="close-btn" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="marketForm">
                    <input type="hidden" id="marketId">
                    <div class="form-group">
                        <label for="bazaar_date">তারিখ</label>
                        <input type="text" id="bazaar_date" class="form-control" placeholder="তারিখ নির্বাচন করুন"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="item_details">বাজারের আইটেম</label>
                        <textarea id="item_details" class="form-control" placeholder="প্রতিটি আইটেম নতুন লাইনে লিখুন (যেমন: মাছ - 500৳)"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="total_price">মোট মূল্য (৳)</label>
                        <input type="number" id="total_price" class="form-control" placeholder="মোট মূল্য"
                            step="0.01" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal()">বাতিল করুন</button>
                <button class="btn btn-primary" id="saveMarketBtn" onclick="saveMarket()">সংরক্ষণ করুন</button>
            </div>
        </div>
    </div>

    <script>
        // Initialize date picker
        flatpickr("#bazaar_date", {
            dateFormat: "Y-m-d",
            defaultDate: "today"
        });

        flatpickr("#filter_calendar", {
            mode: "range",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    filterMarketsByDate(selectedDates[0], selectedDates[1]);
                    document.getElementById('clearFilterBtn').style.display = 'inline-flex';
                }
            }
        });

        // Modal functions
        function openBazaarModal(marketId = null) {
            const modal = document.getElementById('marketModal');
            const form = document.getElementById('marketForm');

            if (marketId) {
                document.getElementById('modalTitle').textContent = 'বাজার সম্পাদনা করুন';
                document.getElementById('marketId').value = marketId;

                // Here you would typically fetch the market data and populate the form
                // For static demo, we'll just set some values
                document.getElementById('bazaar_date').value = '2023-06-15';
                document.getElementById('item_details').value =
                    '- মাছ: 1kg (500৳)\n- চাল: 5kg (300৳)\n- ডাল: 2kg (200৳)\n- সবজি: 200৳';
                document.getElementById('total_price').value = '1200.50';
            } else {
                document.getElementById('modalTitle').textContent = 'নতুন বাজার যোগ করুন';
                form.reset();
            }

            modal.classList.add('active');
        }

        function closeModal() {
            document.getElementById('marketModal').classList.remove('active');
        }

        function saveMarket() {
            // Here you would typically save the data via AJAX
            // For static demo, we'll just show a success message
            Toastify({
                text: "বাজার তথ্য সফলভাবে সংরক্ষণ করা হয়েছে!",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                className: "toast-success"
            }).showToast();

            closeModal();
        }

        function editMarket(marketId) {
            openBazaarModal(marketId);
        }

        function confirmDeleteMarket(marketId) {
            Swal.fire({
                title: 'আপনি কি নিশ্চিত?',
                text: "আপনি এই বাজার তথ্য মুছে ফেলতে চান?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'হ্যাঁ, মুছে ফেলুন!',
                cancelButtonText: 'বাতিল করুন'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Here you would typically delete the record via AJAX
                    // For static demo, we'll just show a success message
                    Swal.fire(
                        'মুছে ফেলা হয়েছে!',
                        'বাজার তথ্য সফলভাবে মুছে ফেলা হয়েছে।',
                        'success'
                    );
                }
            });
        }

        function filterMarketsByDate(startDate, endDate) {
            // In a real app, this would filter the markets via AJAX
            // For static demo, we'll just show a message
            Toastify({
                text: `Showing markets from ${startDate.toDateString()} to ${endDate.toDateString()}`,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                className: "toast-success"
            }).showToast();
        }

        document.getElementById('clearFilterBtn').addEventListener('click', function() {
            document.getElementById('filter_calendar').value = '';
            document.getElementById('clearFilterBtn').style.display = 'none';

            // In a real app, this would reset the markets list
            Toastify({
                text: "ফিল্টার সাফ করা হয়েছে",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                className: "toast-success"
            }).showToast();
        });
    </script>
@endsection
