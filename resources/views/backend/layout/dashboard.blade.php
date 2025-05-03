@extends('backend.app')
@section('title', 'ড্যাশবোর্ড')

@section('content')
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
            --success-color: #22c55e;
            --info-color: #0ea5e9;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-color: #f9fafb;
            --dark-color: #1e293b;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Hind Siliguri', sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .card-animate {
            position: relative;
        }

        .card-animate::before {
            content: '';
            position: absolute;
            height: 6px;
            width: 100%;
            top: 0;
            left: 0;
            background: linear-gradient(90deg, var(--primary-color), var(--info-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .card-animate:hover::before {
            transform: scaleX(1);
        }

        .avatar-sm {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background-color: var(--light-color);
            transition: transform 0.3s;
        }

        .card-animate:hover .avatar-sm {
            transform: rotate(15deg);
        }

        .counter-value {
            animation: fadeIn 1s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn {
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-soft-success {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success-color);
            border: none;
        }

        .btn-soft-success:hover {
            background-color: rgba(34, 197, 94, 0.2);
            color: var(--success-color);
        }

        .minimal-border {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .material-shadow-none {
            box-shadow: none !important;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background-color: rgba(99, 102, 241, 0.05);
            color: var(--dark-color);
            font-weight: 600;
            border-bottom: none;
        }

        .table td, .table th {
            padding: 12px 16px;
            vertical-align: middle;
        }

        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 12px 20px;
        }

        .list-group-item:first-child {
            border-top: none;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .badge {
            padding: 6px 10px;
            font-weight: 500;
            border-radius: 6px;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-info {
            background-color: rgba(14, 165, 233, 0.1);
            color: #0369a1;
        }

        /* Individual card styles */
        .card-balance {
            background: linear-gradient(45deg, #22c55e10, #22c55e20);
        }

        .card-deposit {
            background: linear-gradient(45deg, #0ea5e910, #0ea5e920);
        }

        .card-meal {
            background: linear-gradient(45deg, #6366f110, #6366f120);
        }

        .card-rate {
            background: linear-gradient(45deg, #f59e0b10, #f59e0b20);
        }

        /* Interactive hover effects */
        .member-card {
            position: relative;
            z-index: 1;
        }

        .member-card .card-header {
            transition: background-color 0.3s;
        }

        .member-card:hover .card-header {
            background-color: var(--light-color);
        }

        .member-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 100%;
            background-color: rgba(99, 102, 241, 0.03);
            z-index: -1;
            transition: width 0.4s ease;
        }

        .member-card:hover::after {
            width: 100%;
            left: 0;
            right: auto;
        }

        /* Personal Info Cards */
        .bg-light {
            background-color: #f8fafc !important;
            transition: all 0.3s;
        }

        .card.bg-light:hover {
            background-color: #f1f5f9 !important;
            transform: translateY(-3px);
        }
    </style>
    <div class="page-content">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col">
                    <div class="h-100">
                        <div class="row mb-4 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column bg-white p-4 rounded-3 shadow-sm">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-5 mb-1 d-flex align-items-center">
                                            <i class="bx bx-sun text-warning me-2 fs-4"></i>
                                            শুভ সকাল, আন্না!
                                        </h4>
                                        <p class="text-muted mb-0">আপনার মেসের বর্তমান অবস্থা দেখুন</p>
                                    </div>
                                    <div class="mt-3 mt-lg-0">
                                        <form action="javascript:void(0);">
                                            <div class="row g-3 mb-0 align-items-center">
                                                <div class="col-sm-auto">
                                                    <div class="input-group">
                                                        <input type="text"
                                                               class="form-control border-0 minimal-border dash-filter-picker shadow-sm"
                                                               placeholder="তারিখ নির্বাচন করুন"
                                                               data-provider="flatpickr" data-range-date="true"
                                                               data-date-format="d M, Y"
                                                               data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                        <div class="input-group-text bg-primary border-primary text-white">
                                                            <i class="bx bx-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button"
                                                            class="btn btn-soft-success material-shadow-none">
                                                        <i class="bx bx-plus-circle align-middle me-1"></i>
                                                        বাজার যোগ করুন
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mess Summary Cards -->
                        <div class="row g-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate card-balance">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">মেস ব্যালেন্স</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold mb-4">৳<span class="counter-value" data-target="0.00">0</span></h4>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-success-subtle rounded fs-3">
                                                    <i class="bx bx-wallet text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate card-deposit">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">মোট ডিপোজিট</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold mb-4">৳<span class="counter-value" data-target="568.00">0</span></h4>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-info-subtle rounded fs-3">
                                                    <i class="bx bx-money text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate card-meal">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">মোট মিল</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold mb-4">
                                                    <span class="counter-value" data-target="2.50">0</span>
                                                </h4>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                    <i class="bx bx-restaurant text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate card-rate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">মিল রেট</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold mb-4">৳<span class="counter-value" data-target="227.20">0</span></h4>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                    <i class="bx bx-purchase-tag-alt text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Info Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <i class="bx bx-user-circle text-primary me-2 fs-4"></i>
                                        <h5 class="card-title mb-0">আমার ব্যক্তিগত তথ্য</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-4">
                                            <div class="col-md-3">
                                                <div class="card bg-light mb-0">
                                                    <div class="card-body text-center py-4">
                                                        <i class="bx bx-food-menu text-primary mb-2 fs-3"></i>
                                                        <h6 class="text-muted">আমার মোট মিল</h6>
                                                        <h3 class="mt-2">2.50</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card bg-light mb-0">
                                                    <div class="card-body text-center py-4">
                                                        <i class="bx bx-credit-card text-success mb-2 fs-3"></i>
                                                        <h6 class="text-muted">আমার ডিপোজিট</h6>
                                                        <h3 class="mt-2">৳568.00</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card bg-light mb-0">
                                                    <div class="card-body text-center py-4">
                                                        <i class="bx bx-cart-alt text-danger mb-2 fs-3"></i>
                                                        <h6 class="text-muted">আমার খরচ</h6>
                                                        <h3 class="mt-2">৳568.00</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card bg-light mb-0">
                                                    <div class="card-body text-center py-4">
                                                        <i class="bx bx-line-chart text-info mb-2 fs-3"></i>
                                                        <h6 class="text-muted">আমার ব্যালেন্স</h6>
                                                        <h3 class="mt-2">৳0.00</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bazar and Members Section -->
                        <div class="row mt-4 g-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center">
                                        <i class="bx bx-calendar-check text-warning me-2 fs-4"></i>
                                        <h5 class="card-title mb-0">আমার বাজার তারিখ</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-info mb-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bx bx-calendar text-info me-2 fs-5"></i>
                                                <h6 class="mb-0">আপনার নির্ধারিত বাজারের তারিখ</h6>
                                            </div>
                                            <p class="mb-1 d-flex align-items-center">
                                                <i class="bx bx-check-circle me-2"></i>
                                                শনিবার, ৩ মে ২০২৫
                                            </p>
                                            <p class="mb-0 d-flex align-items-center">
                                                <i class="bx bx-check-circle me-2"></i>
                                                বুধবার, ১৪ মে ২০২৫
                                            </p>
                                        </div>
                                        <button class="btn btn-primary w-100">
                                            <i class="bx bx-calendar-edit me-1"></i>
                                            বাজার ডেট সেট করুন
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-group text-info me-2 fs-4"></i>
                                                <h5 class="card-title mb-0">সদস্য তথ্য</h5>
                                            </div>
                                            <span class="badge bg-success">মোট ২ সদস্য</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th>নাম</th>
                                                    <th>মিল</th>
                                                    <th>ব্যালেন্স</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="cursor-pointer" onclick="highlight(this)">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2 d-flex align-items-center justify-content-center bg-primary-subtle rounded-circle">
                                                                <span class="text-primary">AL</span>
                                                            </div>
                                                            AL Mamon
                                                        </div>
                                                    </td>
                                                    <td>2.50</td>
                                                    <td>৳0.00</td>
                                                </tr>
                                                <tr class="cursor-pointer" onclick="highlight(this)">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2 d-flex align-items-center justify-content-center bg-info-subtle rounded-circle">
                                                                <span class="text-info">MI</span>
                                                            </div>
                                                            Midul
                                                        </div>
                                                    </td>
                                                    <td>0.00</td>
                                                    <td>৳0.00</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Member Details Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <i class="bx bx-detail text-success me-2 fs-4"></i>
                                        <h5 class="card-title mb-0">সদস্যদের বিস্তারিত তথ্য</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-4">
                                            <!-- Member 1 -->
                                            <div class="col-md-6">
                                                <div class="card member-card">
                                                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2 d-flex align-items-center justify-content-center bg-primary-subtle rounded-circle">
                                                                <span class="text-primary">AL</span>
                                                            </div>
                                                            <h6 class="mb-0">AL Mamon</h6>
                                                        </div>
                                                        <span class="badge bg-primary">Active</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-food-menu text-muted me-2"></i> মোট মিল</span>
                                                                <span class="fw-semibold">2.50</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-credit-card text-muted me-2"></i> মোট ডিপোজিট</span>
                                                                <span class="fw-semibold">৳568.00</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-restaurant text-muted me-2"></i> মিল খরচ</span>
                                                                <span class="fw-semibold">৳568.00</span>
                                                            </li>

                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-calculator text-muted me-2"></i> মোট খরচ</span>
                                                                <span class="fw-semibold">৳568.00</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-wallet text-muted me-2"></i> ব্যালেন্স</span>
                                                                <span class="fw-semibold">৳0.00</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Member 2 -->
                                            <div class="col-md-6">
                                                <div class="card member-card">
                                                    <div class="card-header bg-light d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2 d-flex align-items-center justify-content-center bg-info-subtle rounded-circle">
                                                                <span class="text-info">MI</span>
                                                            </div>
                                                            <h6 class="mb-0">Midul</h6>
                                                        </div>
                                                        <span class="badge bg-warning text-dark">Inactive</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-food-menu text-muted me-2"></i> মোট মিল</span>
                                                                <span class="fw-semibold">0.00</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-credit-card text-muted me-2"></i> মোট ডিপোজিট</span>
                                                                <span class="fw-semibold">৳0.00</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-restaurant text-muted me-2"></i> মিল খরচ</span>
                                                                <span class="fw-semibold">৳0.00</span>
                                                            </li>

                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-calculator text-muted me-2"></i> মোট খরচ</span>
                                                                <span class="fw-semibold">৳0.00</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span><i class="bx bx-wallet text-muted me-2"></i> ব্যালেন্স</span>
                                                                <span class="fw-semibold">৳0.00</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.counter-value');
            const speed = 200;

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if(count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(animateCounters, 1);
                } else {
                    counter.innerText = target.toFixed(2);
                }
            });
        }

        // Highlight table row on click
        function highlight(row) {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(r => r.classList.remove('table-active'));
            row.classList.add('table-active');
        }

        // Initialize on page load
        window.onload = function() {
            animateCounters();
        };
    </script>
@endsection
