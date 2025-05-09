@extends('backend.app')
@section('title', 'মিল উপস্থিতি ব্যবস্থাপনা')
@section('content')
    <!-- Include Dependencies -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <style>
        /* Base Styles */
        .business_layout_body {
            font-family: 'Hind Siliguri', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding: 20px;
            background-color: #f0f4f8;
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

        /* Dashboard Header */
        .dashboard-header {
            background: linear-gradient(45deg, #6366f1, #8b5cf6);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
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
            min-width: 250px;
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

        /* Date Selector */
        .date-selector {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            background: white;
            padding: 18px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #6366f1;
        }

        .date-selector label {
            font-weight: 600;
            color: #4b5563;
            font-size: 1.05rem;
        }

        .date-selector input[type="date"] {
            padding: 10px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .date-selector input[type="date"]:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .search-btn {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.3);
        }

        .search-btn:hover {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px -2px rgba(99, 102, 241, 0.4);
        }

        .search-btn:active {
            transform: translateY(0);
        }

        .search-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Meal Table */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .table-header {
            background: #f8fafc;
            padding: 16px 20px;
            border-bottom: 2px solid #e5e7eb;
        }

        .table-header h3 {
            margin: 0;
            color: #1e293b;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .table-responsive {
            overflow-x: auto;
            padding: 5px;
        }

        .meal-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .meal-table th {
            padding: 16px 20px;
            text-align: left;
            background-color: #f8fafc;
            font-weight: 600;
            color: #475569;
            font-size: 0.9rem;
            letter-spacing: 0.03em;
            border-bottom: 2px solid #e5e7eb;
            position: sticky;
            top: 0;
        }

        .meal-table td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .meal-table tr:last-child td {
            border-bottom: none;
        }

        .member-name {
            font-weight: 600;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .member-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6366f1;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Meal Select Dropdown */
        .meal-select-container {
            position: relative;
        }

        .meal-select {
            appearance: none;
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            background-color: white;
            font-family: inherit;
            font-size: 1rem;
            color: #1e293b;
            cursor: pointer;
            transition: all 0.3s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            padding-right: 35px;
        }

        .meal-select:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .meal-label {
            position: absolute;
            top: -10px;
            left: 10px;
            background: white;
            padding: 0 5px;
            font-size: 0.75rem;
            color: #6b7280;
            pointer-events: none;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            line-height: 1;
        }

        .present {
            background-color: #dcfce7;
            color: #166534;
        }

        .present::before {
            content: "•";
            font-size: 1.5rem;
            color: #16a34a;
        }

        .absent {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .absent::before {
            content: "•";
            font-size: 1.5rem;
            color: #dc2626;
        }

        .total-meal-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.1rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
            padding: 0 10px;
        }

        .reset-btn {
            background: #f3f4f6;
            color: #4b5563;
            border: 2px solid #e5e7eb;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .reset-btn:hover {
            background: #e5e7eb;
        }

        .reset-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        .save-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
        }

        .save-btn:hover {
            background: linear-gradient(135deg, #0d9488, #047857);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px -2px rgba(16, 185, 129, 0.4);
        }

        .save-btn:active {
            transform: translateY(0);
        }

        .save-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        /* Summary Cards */
        .summary-section {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .summary-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .summary-header {
            background: linear-gradient(135deg, #1e293b, #334155);
            color: white;
            padding: 16px 20px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .summary-body {
            padding: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-label {
            color: #64748b;
            font-weight: 500;
        }

        .summary-value {
            color: #1e293b;
            font-weight: 600;
        }

        .total-row {
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
        }

        .total-value {
            color: #10b981;
            font-size: 1.2rem;
        }

        .meal-chart-card {
            grid-column: span 2;
        }

        .meal-distribution {
            padding: 20px;
            height: 300px;
        }

        /* Notification Styles */
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1000;
            max-width: 350px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .notification.success {
            background: #dcfce7;
            color: #166534;
        }

        .notification.error {
            background: #fee2e2;
            color: #991b1b;
        }

        .notification.info {
            background: #e0f2fe;
            color: #075985;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .dashboard-header {
                padding: 1.5rem;
            }

            .dashboard-title {
                font-size: 1.5rem;
            }

            .stat-card {
                min-width: 100%;
            }

            .date-selector {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 15px;
            }

            .date-selector input[type="date"] {
                width: 100%;
            }

            .search-btn {
                width: 100%;
                justify-content: center;
            }

            .meal-table th,
            .meal-table td {
                padding: 12px 15px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .reset-btn,
            .save-btn {
                width: 100%;
                justify-content: center;
            }

            .summary-section {
                grid-template-columns: 1fr;
            }

            .meal-chart-card {
                grid-column: span 1;
            }
        }
    </style>

    <div class="business_layout_body">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="dashboard-header-content">
                <h2 class="dashboard-title">মিল উপস্থিতি ব্যবস্থাপনা</h2>
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <h4>আজকের মোট মিল</h4>
                        <p id="total-meal-count">{{ $totalMeals }}</p>
                    </div>
                    <div class="stat-card">
                        <h4>গড় মিল হার</h4>
                        <p id="attendance-rate">{{ round($averageMealRate, 2) }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="meal-attendance-container" id="mealContainer">
            <!-- Date Selector -->
            <div class="date-selector">
                <label for="meal-date"><i class="fas fa-calendar-alt"></i> তারিখ নির্বাচন করুন:</label>
                <input type="date" id="meal-date" value="{{ $selectedDate }}" max="">
                <button class="search-btn" onclick="loadMealData()" aria-label="খুঁজুন">
                    <i class="fas fa-search"></i> খুঁজুন
                </button>
            </div>

            <!-- Meal Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3><i class="fas fa-utensils"></i> মিল উপস্থিতি তালিকা</h3>
                </div>
                <div class="table-responsive">
                    <table class="meal-table" id="mealTable">
                        <thead>
                            <tr>
                                <th>সদস্য</th>
                                <th>সকালের নাস্তা</th>
                                <th>দুপুরের খাবার</th>
                                <th>রাতের খাবার</th>
                                <th>মোট মিল</th>
                                <th>স্ট্যাটাস</th>
                            </tr>
                        </thead>
                        <tbody id="mealTableBody">
                            @foreach ($members as $member)
                                <tr data-user-id="{{ $member->id }}">
                                    <td>
                                        <div class="member-name">
                                            <div class="member-avatar">{{ substr($member->name, 0, 1) }}</div>
                                            {{ $member->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="meal-select-container">
                                            <span class="meal-label">সকালের নাস্তা</span>
                                            <select class="meal-select breakfast" id="breakfast-{{ $member->id }}"
                                                onchange="updateTotalMeal({{ $member->id }})">
                                                <option value="0">0</option>
                                                <option value="0.5">0.5</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="meal-select-container">
                                            <span class="meal-label">দুপুরের খাবার</span>
                                            <select class="meal-select lunch" id="lunch-{{ $member->id }}"
                                                onchange="updateTotalMeal({{ $member->id }})">
                                                <option value="0">0</option>
                                                <option value="0.5">0.5</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="meal-select-container">
                                            <span class="meal-label">রাতের খাবার</span>
                                            <select class="meal-select dinner" id="dinner-{{ $member->id }}"
                                                onchange="updateTotalMeal({{ $member->id }})">
                                                <option value="0">0</option>
                                                <option value="0.5">0.5</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="total-meal-value" id="total-meal-{{ $member->id }}">
                                        {{ isset($meals[$member->id]) ? $meals[$member->id]->meal_count : '0.0' }}
                                    </td>
                                    <td>
                                        <span
                                            class="status-badge {{ isset($meals[$member->id]) && $meals[$member->id]->meal_count > 0 ? 'present' : 'absent' }}"
                                            id="status-{{ $member->id }}">
                                            {{ isset($meals[$member->id]) && $meals[$member->id]->meal_count > 0 ? 'উপস্থিত' : 'অনুপস্থিত' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="reset-btn" onclick="resetForm()" aria-label="রিসেট করুন">
                    <i class="fas fa-undo"></i> রিসেট করুন
                </button>
                <button class="save-btn" id="saveBtn" onclick="saveMealData()" aria-label="সেভ করুন">
                    <i class="fas fa-save"></i> সেভ করুন
                </button>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="summary-section">
            <!-- Attendance Summary -->
            <div class="summary-card">
                <div class="summary-header">
                    <i class="fas fa-chart-pie"></i> আজকের সারাংশ
                </div>
                <div class="summary-body">
                    <div class="summary-row">
                        <span class="summary-label">মোট সদস্য:</span>
                        <span class="summary-value" id="total-members">{{ $members->count() }} জন</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">উপস্থিত সদস্য:</span>
                        <span class="summary-value" id="present-count">{{ $meals->count() }} জন</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">অনুপস্থিত সদস্য:</span>
                        <span class="summary-value" id="absent-count">{{ $members->count() - $meals->count() }} জন</span>
                    </div>
                    <div class="summary-row total-row">
                        <span class="summary-label">মোট মিল:</span>
                        <span class="summary-value total-value" id="total-meal-summary">{{ $totalMeals }}</span>
                    </div>
                </div>
            </div>

            <!-- Meal Distribution Summary -->
            <div class="summary-card">
                <div class="summary-header">
                    <i class="fas fa-utensils"></i> মিল বিতরণ
                </div>
                <div class="summary-body">
                    <div class="summary-row">
                        <span class="summary-label">সকালের নাস্তা:</span>
                        <span class="summary-value" id="breakfast-total">0.0</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">দুপুরের খাবার:</span>
                        <span class="summary-value" id="lunch-total">0.0</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">রাতের খাবার:</span>
                        <span class="summary-value" id="dinner-total">0.0</span>
                    </div>
                    <div class="summary-row total-row">
                        <span class="summary-label">মোট:</span>
                        <span class="summary-value total-value" id="meal-distribution-total">0.0</span>
                    </div>
                </div>
            </div>

            <!-- Meal Distribution Chart -->
            <div class="summary-card meal-chart-card">
                <div class="summary-header">
                    <i class="fas fa-chart-bar"></i> মিল বিতরণ চার্ট
                </div>
                <div class="summary-body">
                    <canvas id="mealDistributionChart" class="meal-distribution"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Notification Queue Management
        let notificationQueue = [];
        let isShowingNotification = false;

        // Initialize on DOM load
        document.addEventListener('DOMContentLoaded', function () {
            // Set default date to today if empty
            const mealDateInput = document.getElementById('meal-date');
            if (!mealDateInput.value) {
                mealDateInput.value = new Date().toISOString().split('T')[0];
            }
            // Set max date to today to disable future dates
            mealDateInput.setAttribute('max', new Date().toISOString().split('T')[0]);

            loadMealData(); // Load data on page load
        });

        // Load meal data for selected date
        function loadMealData() {
            const date = document.getElementById('meal-date').value;
            const searchBtn = document.querySelector('.search-btn');

            if (!date) {
                showNotification('তারিখ নির্বাচন করুন', 'error');
                return;
            }

            const tableBody = document.getElementById('mealTableBody');
            if (!tableBody) {
                console.error('Table body not found');
                showNotification('UI ত্রুটি: টেবিল লোড করা যায়নি', 'error');
                return;
            }

            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px;">
                        <i class="fas fa-spinner fa-spin" style="font-size: 24px; color: #6366f1;"></i>
                        <p style="margin-top: 10px; color: #6b7280;">তথ্য লোড হচ্ছে...</p>
                    </td>
                </tr>
            `;
            searchBtn.disabled = true;

            fetch(`{{ route('meals.data') }}?date=${date}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    console.log('loadMealData fetch status:', response.status, response.statusText);
                    if (!response.ok) {
                        return response.text().then(text => {
                            try {
                                const json = JSON.parse(text);
                                throw new Error(json.error || `HTTP error ${response.status}`);
                            } catch {
                                throw new Error(`HTTP error ${response.status}: ${text}`);
                            }
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Loaded data:', data);
                    if (data.error) {
                        showNotification(data.error, 'error');
                        return;
                    }

                    // Update dashboard stats
                    document.getElementById('total-meal-count').textContent = data.totalMeals.toFixed(1);
                    document.getElementById('attendance-rate').textContent = `${data.averageMealRate}%`;

                    // Update summary card
                    document.getElementById('total-members').textContent = `${data.totalMembers} জন`;
                    document.getElementById('present-count').textContent = `${data.presentCount} জন`;
                    document.getElementById('absent-count').textContent = `${data.absentCount} জন`;
                    document.getElementById('total-meal-summary').textContent = data.totalMeals.toFixed(1);

                    // Update meal table
                    tableBody.innerHTML = '';
                    data.members.forEach(member => {
                        const meal = data.meals[member.id] || {
                            meal_count: 0,
                            breakfast: 0,
                            lunch: 0,
                            dinner: 0
                        };
                        // Ensure meal_count is a number
                        const mealCount = typeof meal.meal_count === 'number' ? meal.meal_count : 0;
                        if (typeof meal.meal_count !== 'number') {
                            console.warn(`Invalid meal_count for user ${member.id}:`, meal.meal_count);
                        }

                        const row = `
                            <tr data-user-id="${member.id}">
                                <td>
                                    <div class="member-name">
                                        <div class="member-avatar">${member.name.charAt(0)}</div>
                                        ${member.name}
                                    </div>
                                </td>
                                <td>
                                    <div class="meal-select-container">
                                        <span class="meal-label">সকালের নাস্তা</span>
                                        <select class="meal-select breakfast" id="breakfast-${member.id}" onchange="updateTotalMeal(${member.id})">
                                            ${generateMealOptions(meal.breakfast)}
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="meal-select-container">
                                        <span class="meal-label">দুপুরের খাবার</span>
                                        <select class="meal-select lunch" id="lunch-${member.id}" onchange="updateTotalMeal(${member.id})">
                                            ${generateMealOptions(meal.lunch)}
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="meal-select-container">
                                        <span class="meal-label">রাতের খাবার</span>
                                        <select class="meal-select dinner" id="dinner-${member.id}" onchange="updateTotalMeal(${member.id})">
                                            ${generateMealOptions(meal.dinner)}
                                        </select>
                                    </div>
                                </td>
                                <td class="total-meal-value" id="total-meal-${member.id}">${mealCount.toFixed(1)}</td>
                                <td>
                                    <span class="status-badge ${mealCount > 0 ? 'present' : 'absent'}" id="status-${member.id}">
                                        ${mealCount > 0 ? 'উপস্থিত' : 'অনুপস্থিত'}
                                    </span>
                                </td>
                            </tr>
                        `;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });

                    calculateMealDistribution();
                    initializeChart();
                    showNotification('সফলভাবে লোড হয়েছে', 'success');
                })
                .catch(error => {
                    console.error('Error loading meal data:', error.message);
                    showNotification(`তথ্য লোড করতে ব্যর্থ: ${error.message}`, 'error');
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #991b1b;">
                                তথ্য লোড করতে ব্যর্থ। দয়া করে আবার চেষ্টা করুন।
                            </td>
                        </tr>
                    `;
                })
                .finally(() => {
                    searchBtn.disabled = false;
                });
        }

        // Generate meal dropdown options
        function generateMealOptions(selectedValue) {
            const options = [];
            const values = [0, 0.5, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            for (const value of values) {
                options.push(`<option value="${value}" ${value === parseFloat(selectedValue) ? 'selected' : ''}>${value}</option>`);
            }
            return options.join('');
        }

        // Update total meal for a member
        function updateTotalMeal(userId) {
            const breakfastSelect = document.getElementById(`breakfast-${userId}`);
            const lunchSelect = document.getElementById(`lunch-${userId}`);
            const dinnerSelect = document.getElementById(`dinner-${userId}`);
            const totalMealElement = document.getElementById(`total-meal-${userId}`);
            const statusBadge = document.getElementById(`status-${userId}`);

            if (!breakfastSelect || !lunchSelect || !dinnerSelect || !totalMealElement || !statusBadge) {
                showNotification('UI ত্রুটি: মিল ডেটা লোড করা যায়নি', 'error');
                return;
            }

            const breakfast = parseFloat(breakfastSelect.value) || 0;
            const lunch = parseFloat(lunchSelect.value) || 0;
            const dinner = parseFloat(dinnerSelect.value) || 0;
            const totalMeal = breakfast + lunch + dinner;

            totalMealElement.textContent = totalMeal.toFixed(1);
            statusBadge.textContent = totalMeal > 0 ? 'উপস্থিত' : 'অনুপস্থিত';
            statusBadge.className = `status-badge ${totalMeal > 0 ? 'present' : 'absent'}`;

            document.getElementById('saveBtn').disabled = false;
            calculateMealDistribution();
        }

        // Calculate meal distribution and update chart
        function calculateMealDistribution() {
            let breakfastTotal = 0;
            let lunchTotal = 0;
            let dinnerTotal = 0;

            document.querySelectorAll('#mealTableBody tr').forEach(row => {
                const userId = row.dataset.userId;
                if (!userId) return;

                const breakfastSelect = document.getElementById(`breakfast-${userId}`);
                const lunchSelect = document.getElementById(`lunch-${userId}`);
                const dinnerSelect = document.getElementById(`dinner-${userId}`);

                if (breakfastSelect && lunchSelect && dinnerSelect) {
                    breakfastTotal += parseFloat(breakfastSelect.value) || 0;
                    lunchTotal += parseFloat(lunchSelect.value) || 0;
                    dinnerTotal += parseFloat(dinnerSelect.value) || 0;
                }
            });

            const breakfastTotalElement = document.getElementById('breakfast-total');
            const lunchTotalElement = document.getElementById('lunch-total');
            const dinnerTotalElement = document.getElementById('dinner-total');
            const mealDistributionTotalElement = document.getElementById('meal-distribution-total');

            if (breakfastTotalElement && lunchTotalElement && dinnerTotalElement && mealDistributionTotalElement) {
                breakfastTotalElement.textContent = breakfastTotal.toFixed(1);
                lunchTotalElement.textContent = lunchTotal.toFixed(1);
                dinnerTotalElement.textContent = dinnerTotal.toFixed(1);
                mealDistributionTotalElement.textContent = (breakfastTotal + lunchTotal + dinnerTotal).toFixed(1);
            }

            updateChart(breakfastTotal, lunchTotal, dinnerTotal);
        }

        // Reset form with confirmation
        function resetForm() {
            Swal.fire({
                title: 'আপনি কি নিশ্চিত?',
                text: 'আপনি কি সত্যিই সমস্ত মিল ডেটা রিসেট করতে চান? এই কাজটি পূর্বাবস্থায় ফিরিয়ে আনা যাবে না!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'হ্যাঁ, রিসেট করুন!',
                cancelButtonText: 'বাতিল করুন',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'রিসেট হচ্ছে...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    document.querySelectorAll('#mealTableBody tr').forEach(row => {
                        const userId = row.dataset.userId;
                        if (!userId) return;

                        const breakfastSelect = document.getElementById(`breakfast-${userId}`);
                        const lunchSelect = document.getElementById(`lunch-${userId}`);
                        const dinnerSelect = document.getElementById(`dinner-${userId}`);

                        if (breakfastSelect && lunchSelect && dinnerSelect) {
                            breakfastSelect.value = '0';
                            lunchSelect.value = '0';
                            dinnerSelect.value = '0';
                            updateTotalMeal(userId);
                        }
                    });

                    Swal.fire('রিসেট করা হয়েছে!', 'সমস্ত মিল ডেটা সফলভাবে রিসেট করা হয়েছে।', 'success');
                }
            });
        }

        // Check if data exists for a date
        async function checkDataExists(date) {
            try {
                const response = await fetch(`{{ route('meals.data') }}?date=${date}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                console.log('checkDataExists fetch status:', response.status, response.statusText);
                if (!response.ok) {
                    return response.text().then(text => {
                        try {
                            const json = JSON.parse(text);
                            throw new Error(json.error || `HTTP error ${response.status}`);
                        } catch {
                            throw new Error(`HTTP error ${response.status}: ${text}`);
                        }
                    });
                }
                const data = await response.json();
                console.log('Check data exists response:', data);
                return data.meals && Object.keys(data.meals).length > 0;
            } catch (error) {
                console.error('Error checking data existence:', error.message);
                showNotification(`তথ্য যাচাই করতে সমস্যা: ${error.message}`, 'error');
                return false;
            }
        }

        // Save meal data with confirmation for updates
        async function saveMealData() {
            const date = document.getElementById('meal-date').value;
            const saveBtn = document.getElementById('saveBtn');

            if (!date) {
                showNotification('তারিখ নির্বাচন করুন', 'error');
                return;
            }

            if (!saveBtn) {
                console.error('Save button not found');
                return;
            }

            // Collect meal data
            const mealData = {};
            let hasData = false;

            document.querySelectorAll('#mealTableBody tr').forEach(row => {
                const userId = row.dataset.userId;
                if (!userId) return;

                const breakfastSelect = document.getElementById(`breakfast-${userId}`);
                const lunchSelect = document.getElementById(`lunch-${userId}`);
                const dinnerSelect = document.getElementById(`dinner-${userId}`);

                if (breakfastSelect && lunchSelect && dinnerSelect) {
                    const breakfast = parseFloat(breakfastSelect.value) || 0;
                    const lunch = parseFloat(lunchSelect.value) || 0;
                    const dinner = parseFloat(dinnerSelect.value) || 0;
                    if (breakfast || lunch || dinner) {
                        mealData[userId] = [breakfast, lunch, dinner];
                        hasData = true;
                    }
                }
            });

            if (!hasData) {
                showNotification('কোনো মিল ডেটা নেই', 'error');
                return;
            }

            console.log('Meal data to save:', { date, meals: mealData });

            // Check if data exists for the date
            const dataExists = await checkDataExists(date);

            if (dataExists) {
                // Show confirmation dialog for update
                const result = await Swal.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: 'এই তারিখের জন্য ডেটা ইতিমধ্যে সংরক্ষিত আছে। আপডেট করতে চান? এটি পূর্বের ডেটা প্রতিস্থাপন করবে!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'হ্যাঁ, আপডেট করুন!',
                    cancelButtonText: 'বাতিল করুন',
                    reverseButtons: true
                });

                if (!result.isConfirmed) {
                    return;
                }
            }

            // Proceed with saving
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> সেভ হচ্ছে...';

            fetch('{{ route('meals.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ date, meals: mealData })
            })
                .then(response => {
                    console.log('saveMealData fetch status:', response.status, response.statusText);
                    if (!response.ok) {
                        return response.text().then(text => {
                            try {
                                const json = JSON.parse(text);
                                throw new Error(json.error || `HTTP error ${response.status}`);
                            } catch {
                                throw new Error(`HTTP error ${response.status}: ${text}`);
                            }
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Save response:', data);
                    if (data.error) {
                        showNotification(data.error, 'error');
                        return;
                    }

                    showNotification(data.message || 'সফলভাবে সেভ হয়েছে', 'success');
                    loadMealData();
                })
                .catch(error => {
                    console.error('Error saving meal data:', error.message);
                    showNotification(`সেভ করতে সমস্যা: ${error.message}`, 'error');
                })
                .finally(() => {
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = '<i class="fas fa-save"></i> সেভ করুন';
                });
        }

        // Show notification with queue
        function showNotification(message, type = 'info') {
            notificationQueue.push({ message, type });
            processNotificationQueue();
        }

        function processNotificationQueue() {
            if (isShowingNotification || !notificationQueue.length) return;
            isShowingNotification = true;

            const { message, type } = notificationQueue.shift();
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.setAttribute('role', 'alert');
            notification.innerHTML = `
                <div class="notification-icon">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                </div>
                <div class="notification-message">${message}</div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '1';
                notification.style.transform = 'translateY(0)';
            }, 10);

            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                    isShowingNotification = false;
                    processNotificationQueue();
                }, 300);
            }, 4000);
        }

        // Initialize and update meal distribution chart
        let mealChart = null;

        function initializeChart() {
            const ctx = document.getElementById('mealDistributionChart')?.getContext('2d');
            if (!ctx) return;

            mealChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['সকালের নাস্তা', 'দুপুরের খাবার', 'রাতের খাবার'],
                    datasets: [{
                        label: 'মিল সংখ্যা',
                        data: [0, 0, 0],
                        backgroundColor: ['#6366f1', '#10b981', '#f59e0b'],
                        borderColor: ['#4f46e5', '#059669', '#d97706'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'মিল সংখ্যা'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        function updateChart(breakfastTotal, lunchTotal, dinnerTotal) {
            if (mealChart) {
                mealChart.data.datasets[0].data = [breakfastTotal, lunchTotal, dinnerTotal];
                mealChart.update();
            }
        }
    </script>
@endsection

