@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
    <style>
        /* ===== ALTERNATIVE INTERACTIVE DESIGN ===== */
        :root {

            --success-color: #4cc9f0;
            --error-color: #f72585;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #6c757d;
            --white: #ffffff;
        }

        body {
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            background-color: var(--light-gray);
            color: #212529;
            margin: 0;
            overflow-x: hidden;
            line-height: 1.6;
        }

        .business_layout_body {
            padding: 1.5rem;
            max-width: 1600px;
            margin: 0 auto;
            transition: padding 0.3s ease;
        }

        /* Dashboard Header */
        .dashboard-header {
            background: linear-gradient(135deg, var(--white) 0%, var(--light-gray) 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            animation: fadeInDown 0.6s ease-out;
        }

        .dashboard-title {
            color: var(--secondary-color);
            font-size: clamp(1.75rem, 5vw, 2rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .dashboard-title::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .dashboard-title:hover::after {
            width: 100px;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid var(--medium-gray);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: scaleIn 0.5s ease-out forwards;
            animation-delay: calc(0.1s * var(--index));
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(67, 97, 238, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            background-color: var(--light-gray);
        }

        .stat-card h4 {
            color: var(--dark-gray);
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
        }

        .stat-card p {
            color: var(--secondary-color);
            font-size: clamp(1.5rem, 4vw, 1.75rem);
            font-weight: 700;
            margin: 0;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
            background-color: var(--white);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            position: sticky;
            top: 1rem;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            animation: slideIn 0.5s ease-out;
        }

        .filter-card {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            flex: 1;
            min-width: 0;
        }

        .filter-group {
            flex: 1;
            min-width: 220px;
        }

        .filter-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--dark-gray);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .filter-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            font-size: 0.875rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
        }

        .filter-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15);
            transform: scale(1.01);
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        /* Markets Grid */
        .markets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .market-card {
            background-color: var(--white);
            border-radius: 16px;
            border: 1px solid var(--medium-gray);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 0.6s ease-out forwards;
            animation-delay: calc(0.1s * var(--index));
            position: relative;
            cursor: pointer;
        }

        .market-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
        }

        .market-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            transform: translateX(-100%);
            transition: transform 0.4s ease;
        }

        .market-card:hover::after {
            transform: translateX(0);
        }

        .market-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--medium-gray);
            background-color: var(--light-gray);
        }

        .market-date {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .date-icon {
            color: var(--primary-color);
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .market-card:hover .date-icon {
            transform: rotate(360deg);
        }

        .date-text h3 {
            color: #212529;
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0;
        }

        .date-text p {
            color: var(--dark-gray);
            font-size: 0.875rem;
            margin: 0;
        }

        .market-body {
            padding: 1.5rem;
        }

        .market-items h4 {
            color: var(--dark-gray);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .items-content {
            color: #212529;
            font-size: 0.875rem;
            line-height: 1.8;
            max-height: 100px;
            overflow-y: auto;
        }

        .market-price {
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background-color: var(--light-gray);
            border-radius: 8px;
        }

        .price-label {
            color: var(--dark-gray);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .price-amount {
            color: var(--secondary-color);
            font-size: 1.125rem;
            font-weight: 700;
        }

        .market-footer {
            padding: 1rem;
            background-color: var(--white);
            display: flex;
            gap: 0.75rem;
            border-top: 1px solid var(--medium-gray);
        }

        /* Buttons */
        .btn {
            position: relative;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }

        .btn:hover::before {
            width: 200px;
            height: 200px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--dark-gray);
            border: 1px solid var(--medium-gray);
        }

        .btn-outline:hover {
            background-color: var(--light-gray);
        }

        .btn-danger {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--error-color);
        }

        .btn-danger:hover {
            background-color: rgba(247, 37, 133, 0.2);
        }

        .btn-icon {
            padding: 0.5rem;
            font-size: 0.875rem;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background-color: var(--white);
            border-radius: 16px;
            border: 2px dashed var(--medium-gray);
            animation: fadeIn 0.6s ease-out;
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--medium-gray);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .empty-state:hover .empty-icon {
            transform: scale(1.2);
        }

        .empty-title {
            color: var(--dark-gray);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .empty-text {
            color: var(--dark-gray);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(50px);
            transition: transform 0.4s ease, opacity 0.4s ease;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-header h3 {
            color: var(--secondary-color);
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .close-btn {
            background: none;
            border: none;
            color: var(--dark-gray);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.3s ease;
        }

        .close-btn:hover {
            color: var(--primary-color);
            transform: rotate(180deg);
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--dark-gray);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.875rem 1rem;
            background-color: var(--white);
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            color: #212529;
            font-size: 0.875rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15);
            transform: scale(1.01);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .form-group:focus-within::after {
            width: 100%;
        }

        .modal-footer {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .pagination a {
            padding: 0.75rem 1.25rem;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            color: var(--dark-gray);
            text-decoration: none;
            font-size: 0.875rem;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        }

        .pagination a:hover {
            background-color: var(--primary-color);
            color: var(--white);
            transform: scale(1.05);
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .business_layout_body {
                padding: 1rem;
            }

            .markets-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }

            .action-bar {
                top: 0.5rem;
            }
        }

        @media (max-width: 768px) {
            .business_layout_body {
                padding: 0.75rem;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
                position: static;
                padding: 1rem;
            }

            .filter-group {
                min-width: 100%;
            }

            .markets-grid {
                grid-template-columns: 1fr;
            }

            .market-card,
            .stat-card {
                animation-delay: 0s;
            }
        }

        @media (max-width: 480px) {
            .dashboard-title {
                font-size: 1.5rem;
            }

            .stat-card p {
                font-size: 1.5rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.75rem;
            }

            .modal-content {
                padding: 1.5rem;
                width: 95%;
            }

            .modal-header h3 {
                font-size: 1.25rem;
            }

            .form-group input,
            .form-group textarea {
                font-size: 0.75rem;
            }

            .pagination a {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
            }
        }

        /* Notification Styles */
        .swal2-popup {
            border-radius: 16px !important;
            font-family: 'Inter', 'Hind Siliguri', sans-serif !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .swal2-title,
        .swal2-content,
        .swal2-confirm,
        .swal2-cancel {
            font-family: 'Hind Siliguri', sans-serif !important;
        }

        .swal2-title {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
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
            border-radius: 8px !important;
            padding: 0.75rem 1.5rem !important;
            transition: transform 0.2s ease;
        }

        .swal2-confirm:hover {
            transform: scale(1.05);
        }

        .swal2-confirm:focus {
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.3) !important;
        }

        .toast-success,
        .toast-error,
        .toast-warning {
            font-family: 'Hind Siliguri', sans-serif;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
                        <p id="total-market-count">{{ $markets->total() }} টি</p>
                    </div>
                    <div class="stat-card">
                        <h4>মোট ব্যয়</h4>
                        <p>৳ {{ number_format($total_amount, 2) }}</p>
                    </div>
                    <div class="stat-card">
                        <h4>এই মাসের ব্যয়</h4>
                        <p id="current-month-total">৳ {{ number_format($current_month_total, 2) }}</p>
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
