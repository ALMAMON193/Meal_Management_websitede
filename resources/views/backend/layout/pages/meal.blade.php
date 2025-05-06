@extends('backend.app')
@section('title', 'মিল উপস্থিতি ব্যবস্থাপনা')
@section('content')
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

    /* Dashboard Header - KEEPING AS REQUESTED */
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

    /* NEW UPDATED STYLES */

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

    .meal-table tr:hover {
        background-color: #f1f5f9;
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

    /* Updated Meal Select Dropdown */
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

    .meal-type-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        font-size: 1rem;
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

    /* Save Button */
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

        .meal-table th, .meal-table td {
            padding: 12px 15px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .reset-btn, .save-btn {
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
    <!-- Dashboard Header with Stats - KEEPING AS REQUESTED -->
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
        <div class="date-selector">
            <label for="meal-date"><i class="fas fa-calendar-alt"></i> তারিখ নির্বাচন করুন:</label>
            <input type="date" id="meal-date" value="{{ $selectedDate }}">
            <button class="search-btn" onclick="loadMealData()">
                <i class="fas fa-search"></i> খুঁজুন
            </button>
        </div>

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
                                        <select class="meal-select breakfast" id="breakfast-{{ $member->id }}" onchange="updateTotalMeal({{ $member->id }})">
                                            <option value="0">0</option>
                                            <option value="0.5">0.5</option>
                                            <option value="1">1</option>
                                            <option value="1.5">1.5</option>
                                            <option value="2">2</option>
                                            <option value="2.5">2.5</option>
                                            <option value="3">3</option>
                                            <option value="3.5">3.5</option>
                                            <option value="4">4</option>
                                            <option value="4.5">4.5</option>
                                            <option value="5">5</option>
                                            <option value="5.5">5.5</option>
                                            <option value="6">6</option>
                                            <option value="6.5">6.5</option>
                                            <option value="7">7</option>
                                            <option value="7.5">7.5</option>
                                            <option value="8">8</option>
                                            <option value="8.5">8.5</option>
                                            <option value="9">9</option>
                                            <option value="9.5">9.5</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="meal-select-container">
                                        <span class="meal-label">দুপুরের খাবার</span>
                                        <select class="meal-select lunch" id="lunch-{{ $member->id }}" onchange="updateTotalMeal({{ $member->id }})">
                                            <option value="0">0</option>
                                            <option value="0.5">0.5</option>
                                            <option value="1">1</option>
                                            <option value="1.5">1.5</option>
                                            <option value="2">2</option>
                                            <option value="2.5">2.5</option>
                                            <option value="3">3</option>
                                            <option value="3.5">3.5</option>
                                            <option value="4">4</option>
                                            <option value="4.5">4.5</option>
                                            <option value="5">5</option>
                                            <option value="5.5">5.5</option>
                                            <option value="6">6</option>
                                            <option value="6.5">6.5</option>
                                            <option value="7">7</option>
                                            <option value="7.5">7.5</option>
                                            <option value="8">8</option>
                                            <option value="8.5">8.5</option>
                                            <option value="9">9</option>
                                            <option value="9.5">9.5</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="meal-select-container">
                                        <span class="meal-label">রাতের খাবার</span>
                                        <select class="meal-select dinner" id="dinner-{{ $member->id }}" onchange="updateTotalMeal({{ $member->id }})">
                                            <option value="0">0</option>
                                            <option value="0.5">0.5</option>
                                            <option value="1">1</option>
                                            <option value="1.5">1.5</option>
                                            <option value="2">2</option>
                                            <option value="2.5">2.5</option>
                                            <option value="3">3</option>
                                            <option value="3.5">3.5</option>
                                            <option value="4">4</option>
                                            <option value="4.5">4.5</option>
                                            <option value="5">5</option>
                                            <option value="5.5">5.5</option>
                                            <option value="6">6</option>
                                            <option value="6.5">6.5</option>
                                            <option value="7">7</option>
                                            <option value="7.5">7.5</option>
                                            <option value="8">8</option>
                                            <option value="8.5">8.5</option>
                                            <option value="9">9</option>
                                            <option value="9.5">9.5</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="total-meal-value" id="total-meal-{{ $member->id }}">{{ isset($meals[$member->id]) ? $meals[$member->id]->meal_count : '0.0' }}</td>
                                <td>
                                    <span class="status-badge {{ isset($meals[$member->id]) && $meals[$member->id]->meal_count > 0 ? 'present' : 'absent' }}" id="status-{{ $member->id }}">
                                        {{ isset($meals[$member->id]) && $meals[$member->id]->meal_count > 0 ? 'উপস্থিত' : 'অনুপস্থিত' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="action-buttons">
            <button class="reset-btn" onclick="resetForm()">
                <i class="fas fa-undo"></i> রিসেট করুন
            </button>
            <button class="save-btn" id="saveBtn" onclick="saveMealData()">
                <i class="fas fa-save"></i> সেভ করুন
            </button>
        </div>
    </div>

    <div class="summary-section">
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


    </div>
</div>

<script>
    // Initialize with today's data
    document.addEventListener('DOMContentLoaded', function() {
        calculateMealDistribution();
        setupDefaultValues();
    });

    // Setup default values based on existing data
    function setupDefaultValues() {
        const tableRows = document.querySelectorAll('#mealTableBody tr');
        tableRows.forEach(row => {
            const userId = row.dataset.userId;
            const totalMeal = parseFloat(document.getElementById(`total-meal-${userId}`).textContent);

            // Distribute the total meal among breakfast, lunch, and dinner
            // This is just a default distribution, you may need to adjust based on actual data
            let remainingMeal = totalMeal;

            if (remainingMeal >= 1) {
                document.getElementById(`breakfast-${userId}`).value = "1";
                remainingMeal -= 1;
            }

            if (remainingMeal >= 1) {
                document.getElementById(`lunch-${userId}`).value = "1";
                remainingMeal -= 1;
            }

            if (remainingMeal > 0) {
                document.getElementById(`dinner-${userId}`).value = remainingMeal.toString();
            }
        });
    }

    // Load meal data for the selected date
    function loadMealData() {
        const date = document.getElementById('meal-date').value;

        // Show loading state
        document.getElementById('mealTableBody').innerHTML = `
            <tr>
                <td colspan="6" style="text-align: center; padding: 30px;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 24px; color: #6366f1;"></i>
                    <p style="margin-top: 10px; color: #6b7280;">তথ্য লোড হচ্ছে...</p>
                </td>
            </tr>
        `;

        fetch(`{{ route('meals.data') }}?date=${date}`, {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update dashboard stats
            document.getElementById('total-meal-count').textContent = data.totalMeals.toFixed(1);
            document.getElementById('attendance-rate').textContent = `${data.averageMealRate}%`;

            // Update summary card
            document.getElementById('total-members').textContent = `${data.totalMembers} জন`;
            document.getElementById('present-count').textContent = `${data.presentCount} জন`;
            document.getElementById('absent-count').textContent = `${data.absentCount} জন`;
            document.getElementById('total-meal-summary').textContent = data.totalMeals.toFixed(1);

            // Update meal table
            const tableBody = document.getElementById('mealTableBody');
            tableBody.innerHTML = '';

            data.members.forEach(member => {
                const meal = data.meals[member.id] || { meal_count: 0 };

                // Calculate default distribution of meals
                let breakfastVal = 0, lunchVal = 0, dinnerVal = 0;
                let remainingMeal = meal.meal_count;

                if (remainingMeal >= 1) {
                    breakfastVal = 1;
                    remainingMeal -= 1;
                }

                if (remainingMeal >= 1) {
                    lunchVal = 1;
                    remainingMeal -= 1;
                }

                if (remainingMeal > 0) {
                    dinnerVal = remainingMeal;
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
                                    ${generateMealOptions(breakfastVal)}
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="meal-select-container">
                                <span class="meal-label">দুপুরের খাবার</span>
                                <select class="meal-select lunch" id="lunch-${member.id}" onchange="updateTotalMeal(${member.id})">
                                    ${generateMealOptions(lunchVal)}
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="meal-select-container">
                                <span class="meal-label">রাতের খাবার</span>
                                <select class="meal-select dinner" id="dinner-${member.id}" onchange="updateTotalMeal(${member.id})">
                                    ${generateMealOptions(dinnerVal)}
                                </select>
                            </div>
                        </td>
                        <td class="total-meal-value" id="total-meal-${member.id}">${meal.meal_count.toFixed(1)}</td>
                        <td>
                            <span class="status-badge ${meal.meal_count > 0 ? 'present' : 'absent'}" id="status-${member.id}">
                                ${meal.meal_count > 0 ? 'উপস্থিত' : 'অনুপস্থিত'}
                            </span>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });

            // Calculate meal distribution
            calculateMealDistribution();

            // Show success notification
            showNotification('সফলভাবে লোড হয়েছে', 'success');
        })
        .catch(error => {
            console.error('Error loading meal data:', error);
            showNotification('তথ্য লোড করতে সমস্যা হচ্ছে', 'error');
        });
    }

    // Generate dropdown options for meal count
    function generateMealOptions(selectedValue) {
        const options = [];
        for (let i = 0; i <= 10; i += 0.5) {
            options.push(`<option value="${i}" ${i === selectedValue ? 'selected' : ''}>${i}</option>`);
        }
        return options.join('');
    }

    // Update total meal for a member
    function updateTotalMeal(userId) {
        const breakfast = parseFloat(document.getElementById(`breakfast-${userId}`).value);
        const lunch = parseFloat(document.getElementById(`lunch-${userId}`).value);
        const dinner = parseFloat(document.getElementById(`dinner-${userId}`).value);
        const totalMeal = breakfast + lunch + dinner;

        document.getElementById(`total-meal-${userId}`).textContent = totalMeal.toFixed(1);
        const statusBadge = document.getElementById(`status-${userId}`);
        statusBadge.textContent = totalMeal > 0 ? 'উপস্থিত' : 'অনুপস্থিত';
        statusBadge.className = `status-badge ${totalMeal > 0 ? 'present' : 'absent'}`;

        document.getElementById('saveBtn').disabled = false;

        // Recalculate meal distribution
        calculateMealDistribution();
    }

    // Calculate meal distribution
    function calculateMealDistribution() {
        let breakfastTotal = 0;
        let lunchTotal = 0;
        let dinnerTotal = 0;

        document.querySelectorAll('#mealTableBody tr').forEach(row => {
            const userId = row.dataset.userId;
            if(userId) {
                const breakfastSelect = document.getElementById(`breakfast-${userId}`);
                const lunchSelect = document.getElementById(`lunch-${userId}`);
                const dinnerSelect = document.getElementById(`dinner-${userId}`);

                if(breakfastSelect && lunchSelect && dinnerSelect) {
                    breakfastTotal += parseFloat(breakfastSelect.value);
                    lunchTotal += parseFloat(lunchSelect.value);
                    dinnerTotal += parseFloat(dinnerSelect.value);
                }
            }
        });

        document.getElementById('breakfast-total').textContent = breakfastTotal.toFixed(1);
        document.getElementById('lunch-total').textContent = lunchTotal.toFixed(1);
        document.getElementById('dinner-total').textContent = dinnerTotal.toFixed(1);
        document.getElementById('meal-distribution-total').textContent = (breakfastTotal + lunchTotal + dinnerTotal).toFixed(1);
    }

    // Reset the form
    function resetForm() {
        if(confirm('আপনি কি সত্যিই সমস্ত মিল ডেটা রিসেট করতে চান?')) {
            document.querySelectorAll('#mealTableBody tr').forEach(row => {
                const userId = row.dataset.userId;
                if(userId) {
                    document.getElementById(`breakfast-${userId}`).value = "0";
                    document.getElementById(`lunch-${userId}`).value = "0";
                    document.getElementById(`dinner-${userId}`).value = "0";
                    updateTotalMeal(userId);
                }
            });
            showNotification('সমস্ত ডেটা রিসেট করা হয়েছে', 'info');
        }
    }

    // Save meal data
    function saveMealData() {
        const date = document.getElementById('meal-date').value;
        const mealData = {};
        const saveBtn = document.getElementById('saveBtn');

        // Disable button and show saving state
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> সেভ হচ্ছে...';

        document.querySelectorAll('#mealTableBody tr').forEach(row => {
            const userId = row.dataset.userId;
            if(userId) {
                const breakfast = parseFloat(document.getElementById(`breakfast-${userId}`).value);
                const lunch = parseFloat(document.getElementById(`lunch-${userId}`).value);
                const dinner = parseFloat(document.getElementById(`dinner-${userId}`).value);
                mealData[userId] = [breakfast, lunch, dinner];
            }
        });

        fetch('{{ route('meals.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ date, meals: mealData })
        })
        .then(response => response.json())
        .then(data => {
            // Reset button state
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="fas fa-save"></i> সেভ করুন';

            // Show success notification
            showNotification(data.message, 'success');

            // Reload data to show updated information
            loadMealData();
        })
        .catch(error => {
            console.error('Error saving meal data:', error);
            // Reset button state
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="fas fa-save"></i> সেভ করুন';

            // Show error notification
            showNotification('সেভ করতে সমস্যা হচ্ছে', 'error');
        });
    }

    // Show notification
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="notification-icon">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            </div>
            <div class="notification-message">${message}</div>
        `;

        // Add styles inline for the notification
        notification.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: ${type === 'success' ? '#dcfce7' : type === 'error' ? '#fee2e2' : '#e0f2fe'};
            color: ${type === 'success' ? '#166534' : type === 'error' ? '#991b1b' : '#075985'};
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
        `;

        // Add to body
        document.body.appendChild(notification);

        // Trigger animation
        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateY(0)';
        }, 10);

        // Remove after 4 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(20px)';

            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 4000);
    }
</script>
@endsection
