@extends('backend.app')
@section('title', 'মিল উপস্থিতি ব্যবস্থাপনা')
@section('content')
<style>
    /* Base Styles */
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
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .date-selector label {
        font-weight: 600;
        color: #4b5563;
    }

    .date-selector input[type="date"] {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-family: inherit;
    }

    .search-btn {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-btn:hover {
        background: linear-gradient(135deg, #4338ca, #6d28d9);
    }

    /* Meal Table */
    .table-responsive {
        overflow-x: auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .meal-table {
        width: 100%;
        border-collapse: collapse;
    }

    .meal-table th, .meal-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    .meal-table th {
        background-color: #f9fafb;
        font-weight: 600;
        color: #374151;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .meal-table tr:hover {
        background-color: #f9fafb;
    }

    /* Meal Select Dropdown */
    .meal-select {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background-color: white;
        font-family: inherit;
        min-width: 100px;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .present {
        background-color: #dcfce7;
        color: #166534;
    }

    .absent {
        background-color: #fee2e2;
        color: #991b1b;
    }

    /* Save Button */
    .save-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
    }

    .save-btn:hover {
        background: linear-gradient(135deg, #0d9b6c, #047857);
    }

    .save-btn:disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    /* Summary Card */
    .summary-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
    }

    .summary-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
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
        font-size: 1.1rem;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1rem;
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
        }

        .meal-table th, .meal-table td {
            padding: 8px 10px;
        }
    }
</style>

<div class="business_layout_body">
    <!-- Dashboard Header with Stats -->
    <div class="dashboard-header">
        <div class="dashboard-header-content">
            <h2 class="dashboard-title">মিল উপস্থিতি ব্যবস্থাপনা</h2>
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h4>আজকের মোট মিল</h4>
                    <p id="total-meal-count">0.0</p>
                </div>
                <div class="stat-card">
                    <h4>গড় মিল হার</h4>
                    <p id="attendance-rate">0%</p>
                </div>
            </div>
        </div>
    </div>

    <div class="meal-attendance-container" id="mealContainer">
        <div class="section-header">
            <h3 class="section-title">মিল উপস্থিতি</h3>
        </div>

        <div class="date-selector">
            <label for="meal-date">তারিখ নির্বাচন করুন:</label>
            <input type="date" id="meal-date" value="{{ date('Y-m-d') }}">
            <button class="search-btn" onclick="loadMealData()">
                <i class="fas fa-search"></i> খুঁজুন
            </button>
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
                    <!-- Dynamic content will be loaded here -->
                </tbody>
            </table>
        </div>

        <button class="save-btn" id="saveBtn" onclick="saveMealData()" disabled>
            <i class="fas fa-save"></i> সেভ করুন
        </button>
    </div>

    <div class="summary-card">
        <h3 class="summary-title">আজকের সারাংশ</h3>
        <div class="summary-row">
            <span class="summary-label">মোট সদস্য:</span>
            <span class="summary-value" id="total-members">0 জন</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">উপস্থিত সদস্য:</span>
            <span class="summary-value" id="present-count">0 জন</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">অনুপস্থিত সদস্য:</span>
            <span class="summary-value" id="absent-count">0 জন</span>
        </div>
        <div class="summary-row total-row">
            <span class="summary-label">মোট মিল:</span>
            <span class="summary-value total-value" id="total-meal-summary">0.0</span>
        </div>
    </div>
</div>

<script>
    // Sample member data - in a real app, this would come from your database
    const members = [
        { id: 1, name: "আব্দুল করিম", breakfast: 0, lunch: 0, dinner: 0 },
        { id: 2, name: "রহিমা খাতুন", breakfast: 0, lunch: 0, dinner: 0 },
        { id: 3, name: "জামাল উদ্দিন", breakfast: 0, lunch: 0, dinner: 0 },
        { id: 4, name: "সালমা বেগম", breakfast: 0, lunch: 0, dinner: 0 },
        { id: 5, name: "মোঃ রফিকুল ইসলাম", breakfast: 0, lunch: 0, dinner: 0 }
    ];

    // Meal options with 0.5 increments
    const mealOptions = [
        { value: 0, label: "0 (না)" },
        { value: 0.5, label: "0.5 (অর্ধেক)" },
        { value: 1, label: "1 (পুরো)" }
    ];

    // Load meal data when page loads
    document.addEventListener('DOMContentLoaded', function() {
        loadMealData();
    });

    // Function to load meal data for selected date
    function loadMealData() {
        const date = document.getElementById('meal-date').value;

        // In a real app, you would fetch data from your backend API here
        // For now, we'll use the sample data

        // Clear table body
        const tableBody = document.getElementById('mealTableBody');
        tableBody.innerHTML = '';

        // Populate table with member data
        members.forEach(member => {
            const row = document.createElement('tr');

            // Member name
            const nameCell = document.createElement('td');
            nameCell.textContent = member.name;
            row.appendChild(nameCell);

            // Breakfast dropdown
            const breakfastCell = document.createElement('td');
            const breakfastSelect = createMealSelect(member.id, 'breakfast', member.breakfast);
            breakfastCell.appendChild(breakfastSelect);
            row.appendChild(breakfastCell);

            // Lunch dropdown
            const lunchCell = document.createElement('td');
            const lunchSelect = createMealSelect(member.id, 'lunch', member.lunch);
            lunchCell.appendChild(lunchSelect);
            row.appendChild(lunchCell);

            // Dinner dropdown
            const dinnerCell = document.createElement('td');
            const dinnerSelect = createMealSelect(member.id, 'dinner', member.dinner);
            dinnerCell.appendChild(dinnerSelect);
            row.appendChild(dinnerCell);

            // Total meals
            const totalCell = document.createElement('td');
            totalCell.textContent = (member.breakfast + member.lunch + member.dinner).toFixed(1);
            row.appendChild(totalCell);

            // Status
            const statusCell = document.createElement('td');
            const totalMeals = member.breakfast + member.lunch + member.dinner;
            const statusBadge = document.createElement('span');
            statusBadge.className = 'status-badge ' + (totalMeals > 0 ? 'present' : 'absent');
            statusBadge.textContent = totalMeals > 0 ? 'উপস্থিত' : 'অনুপস্থিত';
            statusCell.appendChild(statusBadge);
            row.appendChild(statusCell);

            tableBody.appendChild(row);
        });

        // Enable save button
        document.getElementById('saveBtn').disabled = false;

        // Update summary
        updateSummary();
    }

    // Function to create meal select dropdown
    function createMealSelect(memberId, mealType, selectedValue) {
        const select = document.createElement('select');
        select.className = 'meal-select';
        select.dataset.memberId = memberId;
        select.dataset.mealType = mealType;

        mealOptions.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.value;
            opt.textContent = option.label;
            opt.selected = option.value == selectedValue;
            select.appendChild(opt);
        });

        // Add change event listener to update totals
        select.addEventListener('change', function() {
            updateMemberMeal(memberId, mealType, parseFloat(this.value));
            updateSummary();
        });

        return select;
    }

    // Function to update member meal data
    function updateMemberMeal(memberId, mealType, value) {
        const member = members.find(m => m.id == memberId);
        if (member) {
            member[mealType] = value;

            // Update the total cell in the table
            const row = document.querySelector(`tr[data-member-id="${memberId}"]`) ||
                        Array.from(document.querySelectorAll('#mealTableBody tr')).find(tr =>
                            tr.querySelector(`select[data-member-id="${memberId}"]`));

            if (row) {
                const totalCell = row.cells[4]; // 5th cell (0-based index 4)
                const total = (member.breakfast + member.lunch + member.dinner).toFixed(1);
                totalCell.textContent = total;

                // Update status badge
                const statusCell = row.cells[5];
                const statusBadge = statusCell.querySelector('.status-badge');
                statusBadge.className = 'status-badge ' + (total > 0 ? 'present' : 'absent');
                statusBadge.textContent = total > 0 ? 'উপস্থিত' : 'অনুপস্থিত';
            }
        }
    }

    // Function to update summary statistics
    function updateSummary() {
        const totalMembers = members.length;
        let presentCount = 0;
        let totalMeals = 0;

        members.forEach(member => {
            const memberTotal = member.breakfast + member.lunch + member.dinner;
            totalMeals += memberTotal;
            if (memberTotal > 0) presentCount++;
        });

        const absentCount = totalMembers - presentCount;
        const attendanceRate = totalMembers > 0 ? Math.round((presentCount / totalMembers) * 100) : 0;

        // Update UI
        document.getElementById('total-members').textContent = `${totalMembers} জন`;
        document.getElementById('present-count').textContent = `${presentCount} জন`;
        document.getElementById('absent-count').textContent = `${absentCount} জন`;
        document.getElementById('total-meal-summary').textContent = totalMeals.toFixed(1);
        document.getElementById('total-meal-count').textContent = totalMeals.toFixed(1);
        document.getElementById('attendance-rate').textContent = `${attendanceRate}%`;
    }

    // Function to save meal data
    function saveMealData() {
        const date = document.getElementById('meal-date').value;
        const mealData = members.map(member => ({
            memberId: member.id,
            date: date,
            breakfast: member.breakfast,
            lunch: member.lunch,
            dinner: member.dinner,
            total: member.breakfast + member.lunch + member.dinner
        }));

        // In a real app, you would send this data to your backend API
        console.log('Saving meal data:', mealData);

        // Show success message
        alert('মিল উপস্থিতি ডাটা সফলভাবে সেভ করা হয়েছে!');
    }
</script>
@endsection
