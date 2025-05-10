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
{{$errors}}
     <form method="POST" action="{{route('meal.store')}}" class="meal-attendance-container">
    @csrf
    <!-- Date Selector -->
    <div class="date-selector">
        <label for="meal-date"><i class="fas fa-calendar-alt"></i> তারিখ নির্বাচন করুন:</label>
        <input type="date" id="meal-date" name="date" value="{{ $selectedDate ?? now()->toDateString() }}">
    </div>

    <!-- Meal Table - Keep your original design -->
    <div class="table-container">
        <div class="table-responsive">
            <table class="meal-table" id="mealTable">
                <tbody id="mealTableBody">
                    @foreach ($users as $user)
                        <tr data-user-id="{{ $user->id }}">
                            <td>
                                <div class="member-name">
                                    <div class="member-avatar">{{ substr($user->name, 0, 1) }}</div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <!-- Breakfast -->
                            <td>
                                <div class="meal-select-container">
                                    <span class="meal-label">সকালের নাস্তা</span>
                                    <select class="meal-select breakfast" name="meals[{{ $user->id }}][breakfast]">
                                        <option value="0">0</option>
                                        <option value="0.5">0.5</option>
                                        <option value="1" selected>1</option>
                                    </select>
                                </div>
                            </td>
                            <!-- Lunch -->
                            <td>
                                <div class="meal-select-container">
                                    <span class="meal-label">দুপুরের খাবার</span>
                                    <select class="meal-select lunch" name="meals[{{ $user->id }}][lunch]">
                                        <option value="0">0</option>
                                        <option value="0.5">0.5</option>
                                        <option value="1" selected>1</option>
                                    </select>
                                </div>
                            </td>
                            <!-- Dinner -->
                            <td>
                                <div class="meal-select-container">
                                    <span class="meal-label">রাতের খাবার</span>
                                    <select class="meal-select dinner" name="meals[{{ $user->id }}][dinner]">
                                        <option value="0">0</option>
                                        <option value="0.5">0.5</option>
                                        <option value="1" selected>1</option>
                                    </select>
                                </div>
                            </td>
                            <!-- Hidden user_id field -->
                            <input type="hidden" name="meals[{{ $user->id }}][user_id]" value="{{ $user->id }}">
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <button type="submit" class="save-btn">
            <i class="fas fa-save"></i> সেভ করুন
        </button>
    </div>
</form>
        <!-- Summary Section -->
        {{-- <div class="summary-section">
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
        </div> --}}
    </div>

@endsection
