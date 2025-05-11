@extends('backend.app')
@section('title', 'মাসিক মিল তথ্য')
@section('content')
    <!-- Premium Dependencies -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.11.4/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #eef2ff;
            --secondary: #3f37c9;
            --accent: #f72585;
            --dark: #1e1b4b;
            --light: #f8f9fa;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #ef233c;
            --gray: #6c757d;
            --gray-light: #e9ecef;
        }

        /* Base Styles */
        body {
            font-family: 'Poppins', 'Nikosh', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.25);
        }

        /* Month Selector - Premium Design */
        .month-selector {
            position: relative;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(63, 55, 201, 0.1) 100%);
            border-radius: 16px;
            overflow: hidden;
            padding: 2rem;
            margin-bottom: 2.5rem;
        }

        .month-selector::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
            z-index: 0;
        }

        .month-selector-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .month-selector-label {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .month-selector-label i {
            font-size: 1.5rem;
            color: var(--primary);
            background: rgba(67, 97, 238, 0.1);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .month-selector-label h2 {
            font-weight: 600;
            margin: 0;
            color: var(--dark);
            font-size: 1.5rem;
        }

        .month-select {
            position: relative;
            min-width: 200px;
        }

        .month-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 100%;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            font-weight: 500;
            color: var(--dark);
            background-color: white;
            border: 2px solid rgba(67, 97, 238, 0.3);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .month-select select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .month-select::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--primary);
            font-size: 0.8rem;
        }

        /* Summary Cards - Premium Design */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .summary-card {
            padding: 1.5rem;
            border-radius: 16px;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
        }

        .summary-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .summary-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
        }

        .summary-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .summary-card-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0.5rem 0;
        }

        .summary-card-description {
            font-size: 0.875rem;
            color: var(--gray);
            margin: 0;
        }

        .progress-container {
            margin-top: 1rem;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.75rem;
            color: var(--gray);
        }

        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: var(--gray-light);
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: width 1s ease;
        }

        /* Data Table - Premium Design */
        .data-table-container {
            position: relative;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(63, 55, 201, 0.1) 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .table-title i {
            color: var(--primary);
        }

        .table-actions {
            display: flex;
            gap: 0.75rem;
        }

        .table-action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .table-action-btn:hover {
            background: var(--primary);
            color: white;
        }

        .table-wrapper {
            overflow-x: auto;
            padding: 0 1.5rem;
        }

        .meal-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 1rem 0;
        }

        .meal-table thead th {
            background-color: white;
            color: var(--dark);
            font-weight: 600;
            font-size: 0.875rem;
            padding: 1rem;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .meal-table tbody tr {
            transition: all 0.3s ease;
        }

        .meal-table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }

        .meal-table td {
            padding: 1rem;
            text-align: center;
            font-size: 0.875rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .meal-table td:first-child {
            font-weight: 500;
            text-align: left;
            color: var(--dark);
        }

        .meal-badge {
            display: inline-block;
            padding: 0.35rem 0.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .breakfast-badge {
            background-color: rgba(255, 193, 7, 0.1);
            color: #d97706;
        }

        .lunch-badge {
            background-color: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .dinner-badge {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e40af;
        }

        .total-badge {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            font-weight: 600;
        }

        /* No Data State - Premium Design */
        .no-data-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            text-align: center;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .no-data-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(239, 35, 60, 0.1);
            color: var(--danger);
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .no-data-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .no-data-description {
            font-size: 1rem;
            color: var(--gray);
            margin-bottom: 1.5rem;
            max-width: 500px;
        }

        .no-data-action {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .no-data-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .loading-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(67, 97, 238, 0.1);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Notification System */
        .notification-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .notification {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 1rem;
            transform: translateX(120%);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            max-width: 350px;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notification-success .notification-icon {
            background: rgba(76, 201, 240, 0.1);
            color: var(--success);
        }

        .notification-error .notification-icon {
            background: rgba(239, 35, 60, 0.1);
            color: var(--danger);
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--dark);
        }

        .notification-message {
            font-size: 0.875rem;
            color: var(--gray);
            margin: 0;
        }

        .notification-close {
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            font-size: 1rem;
            margin-left: 0.5rem;
        }

        /* Animations */
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .month-selector-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .table-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <!-- Month Selector -->
        <div class="month-selector glass-card">
            <div class="month-selector-content">
                <div class="month-selector-label">
                    <i class="fas fa-calendar-alt"></i>
                    <h2>মাসিক মিল রিপোর্ট</h2>
                </div>
                <div class="month-select">
                    <select id="month-select" name="month">
                        @for ($month = 1; $month <= 12; $month++)
                            <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div id="dashboard-content">
            @if (!empty($monthlyData['days']))
                <!-- Summary Cards -->
                <div class="summary-grid">
                    <div class="summary-card glass-card">
                        <div class="summary-card-header">
                            <h3 class="summary-card-title">মোট মিল</h3>
                            <div class="summary-card-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                        </div>
                        <h2 class="summary-card-value">{{ number_format($totalMeals, 1) }}</h2>
                        <p class="summary-card-description">এই মাসের মোট মিল সংখ্যা</p>
                    </div>

                    <div class="summary-card glass-card">
                        <div class="summary-card-header">
                            <h3 class="summary-card-title">সর্বোচ্চ মিল গ্রহণ</h3>
                            <div class="summary-card-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        @php
                            $maxMealUser = $members->sortByDesc(function($member) use ($perUserMeals) {
                                return $perUserMeals[$member->id] ?? 0;
                            })->first();
                            $maxMealCount = $perUserMeals[$maxMealUser->id] ?? 0;
                        @endphp
                        <h2 class="summary-card-value">{{ $maxMealUser->name }}</h2>
                        <p class="summary-card-description">{{ number_format($maxMealCount, 1) }} মিল</p>
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>মোটের {{ $totalMeals ? number_format(($maxMealCount / $totalMeals) * 100, 1) : 0 }}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $totalMeals ? ($maxMealCount / $totalMeals) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-card glass-card">
                        <div class="summary-card-header">
                            <h3 class="summary-card-title">গড় মিল হার</h3>
                            <div class="summary-card-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <h2 class="summary-card-value">
                            @if(count($members) > 0)
                                {{ number_format($totalMeals / count($members), 1) }}
                            @else
                                0.0
                            @endif
                        </h2>
                        <p class="summary-card-description">প্রতিজন সদস্যের গড় মিল সংখ্যা</p>
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>মাসের {{ now()->daysInMonth ? number_format((($totalMeals / count($members)) / now()->daysInMonth) * 100, 1) : 0 }}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ now()->daysInMonth ? (($totalMeals / count($members)) / now()->daysInMonth) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Meal Data Table -->
                <div class="data-table-container glass-card">
                    <div class="table-header">
                        <h3 class="table-title">
                            <i class="fas fa-table"></i>
                            মাসিক মিল ডেটা টেবিল
                        </h3>
                        <div class="table-actions">
                            <button class="table-action-btn" title="Print" onclick="window.print()">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="table-action-btn" title="Download CSV" id="download-csv">
                                <i class="fas fa-file-csv"></i>
                            </button>
                            <button class="table-action-btn" title="Refresh Data" id="refresh-data">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="meal-table">
                            <thead>
                                <tr>
                                    <th>তারিখ</th>
                                    @foreach ($members as $member)
                                        <th colspan="4">{{ $member->name }}</th>
                                    @endforeach
                                    <th>মোট</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    @foreach ($members as $member)
                                        <th>সকাল</th>
                                        <th>দুপুর</th>
                                        <th>রাত</th>
                                        <th>মোট</th>
                                    @endforeach
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthlyData['days'] as $day => $meals)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', now()->year . '-' . $selectedMonth . '-' . $day)->translatedFormat('d F Y') }}
                                        </td>
                                        @foreach ($members as $member)
                                            <td>
                                                <span class="meal-badge breakfast-badge">
                                                    {{ isset($meals[$member->id]) ? number_format($meals[$member->id]['breakfast'], 1) : '0.0' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="meal-badge lunch-badge">
                                                    {{ isset($meals[$member->id]) ? number_format($meals[$member->id]['lunch'], 1) : '0.0' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="meal-badge dinner-badge">
                                                    {{ isset($meals[$member->id]) ? number_format($meals[$member->id]['dinner'], 1) : '0.0' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="meal-badge total-badge">
                                                    {{ isset($meals[$member->id]) ? number_format($meals[$member->id]['breakfast'] + $meals[$member->id]['lunch'] + $meals[$member->id]['dinner'], 1) : '0.0' }}
                                                </span>
                                            </td>
                                        @endforeach
                                        <td>
                                            <span class="meal-badge total-badge">
                                                {{ number_format(array_sum(array_map(function($meal) {
                                                    return $meal['breakfast'] + $meal['lunch'] + $meal['dinner'];
                                                }, $meals)), 1) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <!-- No Data State -->
                <div class="no-data-state glass-card">
                    <div class="no-data-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="no-data-title">কোনো তথ্য পাওয়া যায়নি!</h3>
                    <p class="no-data-description">
                        আপনি যে মাসটি নির্বাচন করেছেন, সেই মাসের জন্য কোনো মিলের তথ্য আমাদের ডেটাবেসে নেই।
                        অনুগ্রহ করে অন্য কোনো মাস নির্বাচন করুন অথবা নতুন তথ্য যোগ করুন।
                    </p>
                    <button class="no-data-action" onclick="document.getElementById('month-select').focus()">
                        <i class="fas fa-calendar-alt mr-2"></i> মাস পরিবর্তন করুন
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Notification Container -->
    <div class="notification-container" id="notification-container"></div>

    <script>
        // DOM Elements
        const monthSelect = document.getElementById('month-select');
        const dashboardContent = document.getElementById('dashboard-content');
        const loadingOverlay = document.getElementById('loading-overlay');
        const notificationContainer = document.getElementById('notification-container');
        const refreshDataBtn = document.getElementById('refresh-data');
        const downloadCsvBtn = document.getElementById('download-csv');

        // Initialize Member Distribution Chart
        function initMemberDistributionChart(members, perUserMeals) {
            const ctx = document.getElementById('memberDistributionChart').getContext('2d');

            // Prepare data
            const labels = members.map(member => member.name);
            const data = members.map(member => perUserMeals[member.id] || 0);
            const backgroundColors = members.map((_, index) => {
                const hue = (index * 137.508) % 360; // Golden angle approximation
                return `hsl(${hue}, 70%, 60%)`;
            });

            // Create chart
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                        borderWidth: 1,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} মিল (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%',
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        }

        // Show Notification
        function showNotification(title, message, type) {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <div class="notification-icon">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                </div>
                <div class="notification-content">
                    <h4 class="notification-title">${title}</h4>
                    <p class="notification-message">${message}</p>
                </div>
                <button class="notification-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;

            notificationContainer.appendChild(notification);

            // Trigger reflow to enable animation
            void notification.offsetWidth;

            notification.classList.add('show');

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 400);
            }, 5000);
        }

        // Fetch Monthly Data
        async function fetchMonthlyData(month) {
            loadingOverlay.classList.add('active');

            try {
                const response = await fetch(`/api/meals/monthly?month=${month}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (!response.ok) throw new Error('Network response was not ok');

                const data = await response.json();

                // Animate content out
                gsap.to(dashboardContent, {
                    opacity: 0,
                    y: 20,
                    duration: 0.3,
                    onComplete: () => {
                        updateDashboard(data, month);
                        // Animate content back in
                        gsap.fromTo(dashboardContent,
                            { opacity: 0, y: 20 },
                            { opacity: 1, y: 0, duration: 0.4, ease: "power2.out" }
                        );
                    }
                });

                showNotification('সফল!', 'নতুন মাসের তথ্য সফলভাবে লোড করা হয়েছে।', 'success');
            } catch (error) {
                console.error('Error fetching monthly data:', error);
                showNotification('ত্রুটি!', 'তথ্য লোড করতে সমস্যা হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।', 'error');
            } finally {
                loadingOverlay.classList.remove('active');
            }
        }

        // Update Dashboard
        function updateDashboard(data, selectedMonth) {
            if (!data.days || !Object.keys(data.days).length) {
                dashboardContent.innerHTML = `
                    <div class="no-data-state glass-card">
                        <div class="no-data-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3 class="no-data-title">কোনো তথ্য পাওয়া যায়নি!</h3>
                        <p class="no-data-description">
                            আপনি যে মাসটি নির্বাচন করেছেন, সেই মাসের জন্য কোনো মিলের তথ্য আমাদের ডেটাবেসে নেই।
                            অনুগ্রহ করে অন্য কোনো মাস নির্বাচন করুন অথবা নতুন তথ্য যোগ করুন।
                        </p>
                        <button class="no-data-action" onclick="document.getElementById('month-select').focus()">
                            <i class="fas fa-calendar-alt mr-2"></i> মাস পরিবর্তন করুন
                        </button>
                    </div>
                `;
                return;
            }

            // Calculate totals
            const totalMeals = Object.values(data.days).reduce((sum, day) => {
                return sum + Object.values(day).reduce((daySum, meal) => daySum + (meal.breakfast + meal.lunch + meal.dinner), 0);
            }, 0);

            const perUserMeals = {};
            data.members.forEach(member => {
                perUserMeals[member.id] = Object.values(data.days).reduce((sum, day) => {
                    return sum + (day[member.id] ? day[member.id].breakfast + day[member.id].lunch + day[member.id].dinner : 0);
                }, 0);
            });

            // Find member with max meals
            const maxMealUser = data.members.reduce((max, member) => {
                return (perUserMeals[member.id] || 0) > (perUserMeals[max.id] || 0) ? member : max;
            }, data.members[0]);
            const maxMealCount = perUserMeals[maxMealUser.id] || 0;

            // Update dashboard content
            dashboardContent.innerHTML = `
                <!-- Summary Cards -->
                <div class="summary-grid">
                    <div class="summary-card glass-card">
                        <div class="summary-card-header">
                            <h3 class="summary-card-title">মোট মিল</h3>
                            <div class="summary-card-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                        </div>
                        <h2 class="summary-card-value">${totalMeals.toFixed(1)}</h2>
                        <p class="summary-card-description">এই মাসের মোট মিল সংখ্যা</p>
                    </div>

                    <div class="summary-card glass-card">
                        <div class="summary-card-header">
                            <h3 class="summary-card-title">সর্বোচ্চ মিল গ্রহণ</h3>
                            <div class="summary-card-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        <h2 class="summary-card-value">${maxMealUser.name}</h2>
                        <p class="summary-card-description">${maxMealCount.toFixed(1)} মিল</p>
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>মোটের ${totalMeals ? ((maxMealCount / totalMeals) * 100).toFixed(1) : 0}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: ${totalMeals ? (maxMealCount / totalMeals) * 100 : 0}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-card glass-card">
                        <div class="summary-card-header">
                            <h3 class="summary-card-title">গড় মিল হার</h3>
                            <div class="summary-card-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <h2 class="summary-card-value">
                            ${data.members.length > 0 ? (totalMeals / data.members.length).toFixed(1) : '0.0'}
                        </h2>
                        <p class="summary-card-description">প্রতিজন সদস্যের গড় মিল সংখ্যা</p>
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>মাসের ${new Date(0, selectedMonth - 1).getDate() ? ((totalMeals / data.members.length) / new Date(0, selectedMonth - 1).getDate() * 100).toFixed(1) : 0}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: ${new Date(0, selectedMonth - 1).getDate() ? (totalMeals / data.members.length) / new Date(0, selectedMonth - 1).getDate() * 100 : 0}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Distribution Chart -->
                <div class="glass-card p-6 mb-8">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-pie text-primary"></i>
                        সদস্য অনুযায়ী মিল বণ্টন
                    </h3>
                    <canvas id="memberDistributionChart" height="300"></canvas>
                </div>

                <!-- Meal Data Table -->
                <div class="data-table-container glass-card">
                    <div class="table-header">
                        <h3 class="table-title">
                            <i class="fas fa-table"></i>
                            মাসিক মিল ডেটা টেবিল
                        </h3>
                        <div class="table-actions">
                            <button class="table-action-btn" title="Print" onclick="window.print()">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="table-action-btn" title="Download CSV" id="download-csv">
                                <i class="fas fa-file-csv"></i>
                            </button>
                            <button class="table-action-btn" title="Refresh Data" id="refresh-data">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="meal-table">
                            <thead>
                                <tr>
                                    <th>তারিখ</th>
                                    ${data.members.map(member => `
                                        <th colspan="4">${member.name}</th>
                                    `).join('')}
                                    <th>মোট</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    ${data.members.map(() => `
                                        <th>সকাল</th>
                                        <th>দুপুর</th>
                                        <th>রাত</th>
                                        <th>মোট</th>
                                    `).join('')}
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                ${Object.keys(data.days).map(day => {
                                    const date = new Date(new Date().getFullYear(), selectedMonth - 1, day);
                                    const formattedDate = date.toLocaleDateString('bn-BD', {
                                        day: 'numeric',
                                        month: 'long',
                                        year: 'numeric'
                                    });

                                    return `
                                        <tr>
                                            <td>${formattedDate}</td>
                                            ${data.members.map(member => `
                                                <td>
                                                    <span class="meal-badge breakfast-badge">
                                                        ${data.days[day][member.id] ? data.days[day][member.id].breakfast.toFixed(1) : '0.0'}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="meal-badge lunch-badge">
                                                        ${data.days[day][member.id] ? data.days[day][member.id].lunch.toFixed(1) : '0.0'}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="meal-badge dinner-badge">
                                                        ${data.days[day][member.id] ? data.days[day][member.id].dinner.toFixed(1) : '0.0'}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="meal-badge total-badge">
                                                        ${data.days[day][member.id] ?
                                                            (data.days[day][member.id].breakfast +
                                                             data.days[day][member.id].lunch +
                                                             data.days[day][member.id].dinner).toFixed(1) : '0.0'}
                                                    </span>
                                                </td>
                                            `).join('')}
                                            <td>
                                                <span class="meal-badge total-badge">
                                                    ${Object.values(data.days[day]).reduce((sum, meal) =>
                                                        sum + (meal.breakfast + meal.lunch + meal.dinner), 0).toFixed(1)}
                                                </span>
                                            </td>
                                        </tr>
                                    `;
                                }).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            `;

            // Reinitialize chart
            initMemberDistributionChart(data.members, perUserMeals);

            // Reattach event listeners
            document.getElementById('refresh-data').addEventListener('click', () => fetchMonthlyData(selectedMonth));
            document.getElementById('download-csv').addEventListener('click', downloadCsv);
        }

        // Download CSV
        function downloadCsv() {
            // Implement CSV download functionality
            showNotification('Coming Soon!', 'CSV download feature will be implemented soon.', 'success');
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize chart if data exists
            @if (!empty($monthlyData['days']))
                initMemberDistributionChart(@json($members), @json($perUserMeals));
            @endif

            // Month select change
            monthSelect.addEventListener('change', () => {
                fetchMonthlyData(monthSelect.value);
            });

            // Refresh data button
            if (refreshDataBtn) {
                refreshDataBtn.addEventListener('click', () => {
                    fetchMonthlyData(monthSelect.value);
                });
            }

            // Download CSV button
            if (downloadCsvBtn) {
                downloadCsvBtn.addEventListener('click', downloadCsv);
            }

            // Add pulse animation to summary cards
            const summaryCards = document.querySelectorAll('.summary-card');
            summaryCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate__animated', 'animate__fadeInUp');
            });
        });
    </script>
@endsection
