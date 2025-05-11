@extends('backend.app')
@section('title', 'বাজার ব্যবস্থাপনা ড্যাশবোর্ড')
@section('content')
    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --secondary: #047857;
            --danger: #b91c1c;
            --warning: #b45309;
            --info: #0284c7;
            --dark: #1f2937;
            --light: #f9fafb;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 6px 12px rgba(0, 0, 0, 0.1);
            --rounded: 0.75rem;
        }

        .business_layout_body {
            font-family: 'Kalpurush', 'Noto Sans Bengali', sans-serif;
            background: linear-gradient(180deg, #f1f5f9 0%, #e2e8f0 100%);
            padding: 2rem;
            min-height: 100vh;
        }

        /* Dashboard Header */
        .dashboard-header {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--rounded);
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.15"><circle cx="50" cy="50" r="40" stroke="white" stroke-width="4" fill="none"/></svg>');
            opacity: 0.15;
        }

        .dashboard-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(6px);
            border-radius: 0.5rem;
            padding: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .stat-card h4 {
            font-size: 0.875rem;
            font-weight: 500;
            opacity: 0.9;
        }

        .stat-card p {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* User Balance */
        .user-balance {
            background: white;
            border-radius: var(--rounded);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .user-balance:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .user-balance h4 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .user-balance p {
            font-size: 1rem;
            margin: 0.5rem 0;
            display: flex;
            justify-content: space-between;
        }

        .user-balance .balance-amount {
            font-weight: 600;
        }

        .positive {
            color: var(--secondary);
        }

        .negative {
            color: var(--danger);
        }

        /* Action Bar */
        .action-bar {
            margin-bottom: 1.5rem;
        }

        .filter-card {
            background: white;
            border-radius: var(--rounded);
            padding: 1rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .filter-input {
            padding: 0.5rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.5rem;
            min-width: 200px;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            border-color: var(--gray-300);
            color: var(--dark);
        }

        .btn-outline:hover {
            background-color: var(--gray-200);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #991b1b;
        }

        .btn-icon {
            padding: 0.5rem;
            border-radius: 50%;
            width: 2.25rem;
            height: 2.25rem;
        }

        /* Markets Grid */
        .markets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .market-card {
            background: white;
            border-radius: var(--rounded);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .market-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .market-header {
            padding: 1rem;
            background: linear-gradient(45deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .market-date h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .market-date p {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .market-body {
            padding: 1.5rem;
        }

        .market-items h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--dark);
        }

        .items-content {
            max-height: 120px;
            overflow-y: auto;
            padding-right: 0.5rem;
            line-height: 1.6;
            color: #4b5563;
        }

        .items-content::-webkit-scrollbar {
            width: 4px;
        }

        .items-content::-webkit-scrollbar-thumb {
            background-color: var(--gray-300);
            border-radius: 2px;
        }

        .market-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed var(--gray-200);
        }

        .price-label {
            font-weight: 500;
            color: #6b7280;
        }

        .price-amount {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }

        .market-footer {
            padding: 1rem;
            background-color: #f9fafb;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        /* Analytics Section */
        .analytics-section {
            background: white;
            border-radius: var(--rounded);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            margin-top: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .chart-container {
            max-width: 100%;
            height: 400px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination-item {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            border: 1px solid var(--gray-300);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pagination-item:hover:not(.disabled) {
            background-color: var(--gray-200);
        }

        .pagination-item.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
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

        Radical Improvement .modal-content {
            background-color: white;
            border-radius: var(--rounded);
            box-shadow: var(--shadow-md);
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #6b7280;
        }

        .close-btn:hover {
            color: var(--danger);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.625rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .modal-footer {
            padding: 1.25rem;
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 1rem;
        }

        .empty-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .empty-text {
            color: #6b7280;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .business_layout_body {
                padding: 1rem;
            }

            .dashboard-header-content {
                text-align: center;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .markets-grid {
                grid-template-columns: 1fr;
            }

            .filter-card {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-input {
                min-width: 100%;
            }
        }
    </style>

    <!-- Include dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="business_layout_body">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="dashboard-header-content">
                <h2 class="dashboard-title">বাজার ব্যবস্থাপনা ড্যাশবোর্ড</h2>
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <h4>মোট বাজার</h4>
                        <p>{{ $totalMarkets }} টি</p>
                    </div>
                    <div class="stat-card">
                        <h4>মোট ব্যয়</h4>
                        <p>৳ {{ number_format($totalExpenses, 2) }}</p>
                    </div>
                    <div class="stat-card">
                        <h4>এই মাসের ব্যয়</h4>
                        <p>৳ {{ number_format($currentMonthExpenses, 2) }}</p>
                    </div>
                    <div class="stat-card">
                        <h4>মিল রেট</h4>
                        <p>৳ {{ number_format($mealRate, 2) }}/মিল</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Balance -->
       
    </div>
@endsection
