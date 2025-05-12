@extends('backend.app')
@section('title', 'মিল উপস্থিতি ব্যবস্থাপনা')
@section('content')
    <!-- Include Dependencies -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <style>
           :root {

            --success-color: #4cc9f0;
            --error-color: #f72585;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #6c757d;
            --white: #ffffff;
        }
        /* Base Styles */
        .business_layout_body {
            font-family: 'Nikosh', 'Hind Siliguri', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e6e9f0, #eef1f5);
            padding: 30px;
            min-height: 100vh;
            color: #1a202c;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e40af;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #10b981);
            border-radius: 2px;
        }

        /* Dashboard Header */
        .dashboard-header {
            background: linear-gradient(120deg, #1e3a8a, #3b82f6);
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            color: #fff;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .dashboard-header:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            opacity: 0.4;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h4 {
            font-size: 0.9rem;
            text-transform: uppercase;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        /* Date Selector */
        .date-selector {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            border-left: 6px solid #3b82f6;
            position: relative;
            transition: all 0.3s ease;
        }

        .date-selector:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .date-selector label {
            font-weight: 600;
            color: #1f2937;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-input-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-grow: 1;
        }

        .date-selector input[type="date"] {
            padding: 12px 16px;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            min-width: 220px;
            flex-grow: 1;
        }

        .date-selector input[type="date"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .date-nav-btn {
            background: #3b82f6;
            color: #fff;
            padding: 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .date-nav-btn:hover {
            background: #1e40af;
            transform: translateY(-2px);
        }

        .date-nav-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        .search-btn {
            background: linear-gradient(135deg, #3b82f6, #10b981);
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .search-btn:hover {
            background: linear-gradient(135deg, #1e40af, #059669);
            transform: translateY(-2px);
        }

        /* Loading Spinner */
        .loading-spinner {
            display: none;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            border: 4px solid rgba(59, 130, 246, 0.2);
            border-radius: 50%;
            border-top-color: #3b82f6;
            animation: spin 1s linear infinite;
            z-index: 100;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .is-loading .loading-spinner {
            display: block;
        }

        .is-loading .table-responsive {
            opacity: 0.5;
        }

        /* Date Pills */
        .date-pills {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .date-pill {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: #1e40af;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .date-pill:hover {
            background: rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
        }

        .date-pill.active {
            background: #3b82f6;
            color: #fff;
            border-color: #3b82f6;
        }

        /* Meal Table */
        .table-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            position: relative;
        }

        .table-container:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        }

        .table-header {
            background: #f9fafb;
            padding: 20px;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e40af;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-controls {
            display: flex;
            gap: 15px;
        }

        .table-btn {
            background: #f3f4f6;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            color: #4b5563;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .table-btn:hover {
            background: #e5e7eb;
            color: #1f2937;
        }

        .table-responsive {
            overflow-x: auto;
            transition: opacity 0.3s ease;
        }

        .meal-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .meal-table th {
            padding: 16px 20px;
            background: #f9fafb;
            font-weight: 600;
            color: #1f2937;
            font-size: 0.95rem;
            text-align: left;
            border-bottom: 2px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .meal-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
            transition: all 0.2s ease;
        }

        .meal-table tr:hover td {
            background-color: rgba(59, 130, 246, 0.05);
        }

        .meal-table tr:last-child td {
            border-bottom: none;
        }

        .member-name {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: #1f2937;
        }

        .member-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #10b981);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        tr:hover .member-avatar {
            transform: scale(1.1);
        }

        /* Meal Input */
        .meal-input-group {
            position: relative;
            width: 80px;
        }

        .meal-input {
            width: 80px;
            padding: 8px;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .meal-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .meal-controls {
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 2px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .meal-input-group:hover .meal-controls {
            opacity: 1;
        }

        .meal-control-btn {
            background: #e5e7eb;
            border: none;
            width: 18px;
            height: 18px;
            border-radius: 4px;
            font-size: 12px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #4b5563;
            transition: all 0.2s ease;
        }

        .meal-control-btn:hover {
            background: #d1d5db;
            color: #1f2937;
        }

        /* Total Cell */
        .total-cell {
            font-weight: 600;
            color: #1e40af;
            background-color: rgba(59, 130, 246, 0.1);
            padding: 6px 12px;
            border-radius: 6px;
            text-align: center;
            min-width: 40px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        tr:hover .total-cell {
            background-color: rgba(59, 130, 246, 0.2);
            transform: scale(1.05);
        }

        /* Status Badge */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .present {
            background: #dcfce7;
            color: #166534;
        }

        .present::before {
            content: "•";
            font-size: 1.2rem;
            color: #16a34a;
        }

        .absent {
            background: #fee2e2;
            color: #991b1b;
        }

        .absent::before {
            content: "•";
            font-size: 1.2rem;
            color: #dc2626;
        }

        /* Footer Stats */
        .footer-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .footer-stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
        }

        .footer-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
        }

        .footer-stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .footer-stat-title {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .footer-stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1f2937;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            padding: 20px;
        }

        .reset-btn, .save-btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .reset-btn {
            background: #f3f4f6;
            color: #4b5563;
            border: 2px solid #d1d5db;
        }

        .reset-btn:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        .save-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .save-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
        }

        /* Quick Actions */
        .quick-actions {
            margin-bottom: 30px;
        }

        .quick-actions-title {
            margin-bottom: 15px;
            font-size: 1.1rem;
            color: #4b5563;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quick-action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .quick-action-btn {
            background: #fff;
            border: 1px solid #d1d5db;
            padding: 10px 16px;
            border-radius: 8px;
            color: #4b5563;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quick-action-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            transform: translateY(-2px);
        }

        /* Notification */
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 400px;
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

        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .business_layout_body {
                padding: 15px;
            }

            .dashboard-title {
                font-size: 1.8rem;
            }

            .date-selector {
                flex-direction: column;
                align-items: stretch;
            }

            .date-input-group {
                flex-direction: column;
            }

            .date-selector input[type="date"],
            .search-btn,
            .date-nav-btn {
                width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .reset-btn, .save-btn {
                width: 100%;
                justify-content: center;
            }

            .meal-table th, .meal-table td {
                padding: 12px;
            }

            .meal-controls {
                opacity: 1; /* Always visible on mobile */
                right: -15px;
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
<<<<<<< HEAD
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('meals.store') }}" class="meal-attendance-container" id="mealContainer">
            @csrf
            <!-- Date Selector -->
            <div class="date-selector">
                <label for="meal-date"><i class="fas fa-calendar-alt"></i> তারিখ নির্বাচন করুন:</label>
                <input type="date" id="meal-date" name="date" value="{{ now()->toDateString() }}">
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
                                        <input type="number" class="meal-select breakfast"
                                            name="meals[{{ $member->id }}][0]" min="0" max="9"
                                            step="0.5" value="0" oninput="updateMeal({{ $member->id }})">
                                    </td>
                                    <td>
                                        <input type="number" class="meal-select lunch" name="meals[{{ $member->id }}][1]"
                                            min="0" max="9" step="0.5" value="0"
                                            oninput="updateMeal({{ $member->id }})">
                                    </td>
                                    <td>
                                        <input type="number" class="meal-select dinner"
                                            name="meals[{{ $member->id }}][2]" min="0" max="9"
                                            step="0.5" value="0" oninput="updateMeal({{ $member->id }})">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="button" class="reset-btn" onclick="resetForm()" aria-label="রিসেট করুন">
                    <i class="fas fa-undo"></i> রিসেট করুন
                </button>
                <button class="save-btn" type="submit">
                    <i class="fas fa-save"></i> সেভ করুন
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to update total meal and status dynamically
        function updateMeal(userId) {
            const breakfast = parseFloat(document.querySelector(`input[name="meals[${userId}][0]"]`).value) || 0;
            const lunch = parseFloat(document.querySelector(`input[name="meals[${userId}][1]"]`).value) || 0;
            const dinner = parseFloat(document.querySelector(`input[name="meals[${userId}][2]"]`).value) || 0;

            // Calculate total meals
            const totalMeals = (breakfast + lunch + dinner).toFixed(1);
            document.getElementById(`total-meal-${userId}`).innerText = totalMeals;

            // Update status (Present or Absent)
            const status = document.getElementById(`status-${userId}`);
            if (totalMeals > 0) {
                status.classList.remove('absent');
                status.classList.add('present');
                status.innerText = 'উপস্থিত';
            } else {
                status.classList.remove('present');
                status.classList.add('absent');
                status.innerText = 'অনুপস্থিত';
            }
        }

        // SweetAlert2 for success message
        document.querySelector('.save-btn').addEventListener('click', function(event) {
            event.preventDefault();

            const mealContainer = document.getElementById('mealContainer');

            // Ensure all input fields have values
            document.querySelectorAll('.meal-select').forEach(input => {
                if (input.value === '') {
                    input.value = '0'; // Default to 0 if empty
                }
            });

            mealContainer.submit();

            // Show SweetAlert success message (Toast)
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: 'ডাটা সফলভাবে সংরক্ষিত হয়েছে!',
                showConfirmButton: false,
                timer: 30000,
                toast: true,
                background: '#28a745',
                color: '#fff'
            });
        });

        // Reset Form Function
        function resetForm() {
            document.querySelectorAll('.meal-select').forEach(input => {
                input.value = '0';
            });
        }

        // Optional: Initialize DataTable (if needed)
        $(document).ready(function() {
            $('#mealTable').DataTable({
                paging: false,
                searching: false,
                info: false,
            });
        });
=======
                    <div class="stat-card">
                        <h4>মোট সদস্য</h4>
                        <p id="total-members">{{ count($members) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('meals.store') }}" class="meal-attendance-container" id="mealForm">
            @csrf
            <!-- Date Selector -->
            <div class="date-selector">
                <label for="meal-date"><i class="fas fa-calendar-alt"></i> তারিখ নির্বাচন করুন:</label>
                <div class="date-input-group">
                    <button type="button" class="date-nav-btn" id="prevDay" aria-label="আগের দিন">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <input type="date" id="meal-date" name="date" value="{{ $selectedDate }}">
                    <button type="button" class="date-nav-btn" id="nextDay" aria-label="পরের দিন">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="button" class="date-nav-btn" id="todayBtn" aria-label="আজকের তারিখ">
                        <i class="fas fa-calendar-day"></i>
                    </button>
                    <button type="button" class="search-btn" id="loadDateBtn">
                        <i class="fas fa-search"></i> তথ্য লোড করুন
                    </button>
                </div>

                <!-- Recent dates pills -->
                <div class="date-pills">
                    <div class="date-pill {{ $selectedDate == now()->toDateString() ? 'active' : '' }}" data-date="{{ now()->toDateString() }}">আজ</div>
                    <div class="date-pill" data-date="{{ now()->subDay(1)->toDateString() }}">গতকাল</div>
                    <div class="date-pill" data-date="{{ now()->subDay(2)->toDateString() }}">২ দিন আগে</div>
                    <div class="date-pill" data-date="{{ now()->subDay(3)->toDateString() }}">৩ দিন আগে</div>
                </div>

                <!-- Loading spinner -->
                <div class="loading-spinner"></div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h4 class="quick-actions-title"><i class="fas fa-bolt"></i> দ্রুত কার্যক্রম</h4>
                <div class="quick-action-buttons">
                    <button type="button" class="quick-action-btn" id="setDefaultBtn">
                        <i class="fas fa-star"></i> ডিফল্ট মিল সেট করুন
                    </button>
                    <button type="button" class="quick-action-btn" id="copyYesterdayBtn">
                        <i class="fas fa-copy"></i> গতকালের মিল কপি করুন
                    </button>
                    <button type="button" class="quick-action-btn" id="setZeroBtn">
                        <i class="fas fa-ban"></i> সব মিল শূন্য করুন
                    </button>
                    <button type="button" class="quick-action-btn" id="setFullPresent">
                        <i class="fas fa-check-circle"></i> সবার জন্য পূর্ণ মিল সেট করুন
                    </button>
                </div>
            </div>

            <!-- Meal Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3><i class="fas fa-utensils"></i> মিল উপস্থিতি তালিকা</h3>
                    <div class="table-controls">
                        <button type="button" class="table-btn" id="toggleAllBtn">
                            <i class="fas fa-toggle-on"></i> সব টগল করুন
                        </button>
                    </div>
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
                                    <div class="meal-input-group">
                                        <input type="number" class="meal-input breakfast" name="meals[{{ $member->id }}][0]"
                                               min="0" max="9" step="0.5"
                                               value="{{ isset($meals[$member->id]) ? $meals[$member->id]->breakfast : 0 }}"
                                               oninput="updateMeal({{ $member->id }})">
                                        <div class="meal-controls">
                                            <button type="button" class="meal-control-btn increment" onclick="incrementMeal(this)">+</button>
                                            <button type="button" class="meal-control-btn decrement" onclick="decrementMeal(this)">-</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="meal-input-group">
                                        <input type="number" class="meal-input lunch" name="meals[{{ $member->id }}][1]"
                                               min="0" max="9" step="0.5"
                                               value="{{ isset($meals[$member->id]) ? $meals[$member->id]->lunch : 0 }}"
                                               oninput="updateMeal({{ $member->id }})">
                                        <div class="meal-controls">
                                            <button type="button" class="meal-control-btn increment" onclick="incrementMeal(this)">+</button>
                                            <button type="button" class="meal-control-btn decrement" onclick="decrementMeal(this)">-</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="meal-input-group">
                                        <input type="number" class="meal-input dinner" name="meals[{{ $member->id }}][2]"
                                               min="0" max="9" step="0.5"
                                               value="{{ isset($meals[$member->id]) ? $meals[$member->id]->dinner : 0 }}"
                                               oninput="updateMeal({{ $member->id }})">
                                        <div class="meal-controls">
                                            <button type="button" class="meal-control-btn increment" onclick="incrementMeal(this)">+</button>
                                            <button type="button" class="meal-control-btn decrement" onclick="decrementMeal(this)">-</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="total-cell" id="total-meal-{{ $member->id }}">
                                        {{ isset($meals[$member->id]) ? ($meals[$member->id]->breakfast + $meals[$member->id]->lunch + $meals[$member->id]->dinner) : 0 }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Stats -->
            <div class="footer-stats">
                <div class="footer-stat-card">
                    <div class="footer-stat-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="footer-stat-title">মোট মিল</div>
                    <div class="footer-stat-value" id="footer-total-meals">{{ $totalMeals }}</div>
                </div>
                <div class="footer-stat-card">
                    <div class="footer-stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="footer-stat-title">উপস্থিত সদস্য</div>
                    <div class="footer-stat-value" id="footer-present-members">{{ $attendedMembers }}</div>
                </div>
                <div class="footer-stat-card">
                    <div class="footer-stat-icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="footer-stat-title">অনুপস্থিত সদস্য</div>
                    <div class="footer-stat-value" id="footer-absent-members">{{ $totalMembers - $attendedMembers }}</div>
                </div>
                <div class="footer-stat-card">
                    <div class="footer-stat-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="footer-stat-title">উপস্থিতির হার</div>
                    <div class="footer-stat-value" id="footer-attendance-rate">{{ round($averageMealRate, 2) }}%</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="button" class="reset-btn" onclick="resetForm()" aria-label="রিসেট করুন">
                    <i class="fas fa-undo"></i> রিসেট করুন
                </button>
                <button class="save-btn" type="submit">
                    <i class="fas fa-save"></i> সেভ করুন
                </button>
            </div>
        </form>

        <!-- Notification element -->
        <div class="notification" id="notification"></div>
    </div>

    <script>
        // Global variables
        const today = new Date().toISOString().split('T')[0];
        let isAllToggled = false;

        // DOM elements
        const mealDateInput = document.getElementById('meal-date');
        const loadDateBtn = document.getElementById('loadDateBtn');
        const prevDayBtn = document.getElementById('prevDay');
        const nextDayBtn = document.getElementById('nextDay');
        const todayBtn = document.getElementById('todayBtn');
        const datePills = document.querySelectorAll('.date-pill');
        const dateSelector = document.querySelector('.date-selector');
        const totalMealCount = document.getElementById('total-meal-count');
        const attendanceRate = document.getElementById('attendance-rate');
        const notification = document.getElementById('notification');
        const setDefaultBtn = document.getElementById('setDefaultBtn');
        const copyYesterdayBtn = document.getElementById('copyYesterdayBtn');
        const setZeroBtn = document.getElementById('setZeroBtn');
        const setFullPresentBtn = document.getElementById('setFullPresent');
        const toggleAllBtn = document.getElementById('toggleAllBtn');

        // Footer stats
        const footerTotalMeals = document.getElementById('footer-total-meals');
        const footerPresentMembers = document.getElementById('footer-present-members');
        const footerAbsentMembers = document.getElementById('footer-absent-members');
        const footerAttendanceRate = document.getElementById('footer-attendance-rate');

        // Update meal totals for a member
        function updateMeal(userId) {
            const row = document.querySelector(`tr[data-user-id="${userId}"]`);
            const breakfast = parseFloat(row.querySelector(`input[name="meals[${userId}][0]"]`).value) || 0;
            const lunch = parseFloat(row.querySelector(`input[name="meals[${userId}][1]"]`).value) || 0;
            const dinner = parseFloat(row.querySelector(`input[name="meals[${userId}][2]"]`).value) || 0;
            const totalMeals = breakfast + lunch + dinner;

            document.getElementById(`total-meal-${userId}`).textContent = totalMeals.toFixed(1);
            updateSummaryStats();
        }

        // Update summary stats
        function updateSummaryStats() {
            let totalMeals = 0;
            let presentMembers = 0;
            const totalMembers = document.querySelectorAll('#mealTableBody tr').length;

            document.querySelectorAll('#mealTableBody tr').forEach(row => {
                const userId = row.getAttribute('data-user-id');
                const breakfast = parseFloat(row.querySelector(`input[name="meals[${userId}][0]"]`).value) || 0;
                const lunch = parseFloat(row.querySelector(`input[name="meals[${userId}][1]"]`).value) || 0;
                const dinner = parseFloat(row.querySelector(`input[name="meals[${userId}][2]"]`).value) || 0;
                const memberTotal = breakfast + lunch + dinner;

                totalMeals += memberTotal;
                if (memberTotal > 0) presentMembers++;
            });

            const absentMembers = totalMembers - presentMembers;
            const attendanceRateValue = totalMembers > 0 ? (presentMembers / totalMembers) * 100 : 0;

            totalMealCount.textContent = totalMeals.toFixed(1);
            attendanceRate.textContent = attendanceRateValue.toFixed(2) + '%';
            footerTotalMeals.textContent = totalMeals.toFixed(1);
            footerPresentMembers.textContent = presentMembers;
            footerAbsentMembers.textContent = absentMembers;
            footerAttendanceRate.textContent = attendanceRateValue.toFixed(2) + '%';
        }

        // Fetch meal data for a specific date
        async function fetchMealData(date) {
            dateSelector.classList.add('is-loading');
            try {
                const response = await fetch(`/api/meals/data?date=${date}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                updateMealInputs(data);
                totalMealCount.textContent = data.totalMeals.toFixed(1);
                attendanceRate.textContent = data.averageMealRate.toFixed(2) + '%';
                footerTotalMeals.textContent = data.totalMeals.toFixed(1);
                footerPresentMembers.textContent = data.presentCount;
                footerAbsentMembers.textContent = data.absentCount;
                footerAttendanceRate.textContent = data.averageMealRate.toFixed(2) + '%';

                showNotification('তথ্য সফলভাবে লোড হয়েছে!', 'success');
            } catch (error) {
                console.error('Error fetching meal data:', error);
                showNotification('তথ্য লোড করতে সমস্যা হয়েছে!', 'error');
            } finally {
                dateSelector.classList.remove('is-loading');
            }
        }

        // Update meal inputs with fetched data
        function updateMealInputs(data) {
            const meals = data.meals || {};
            document.querySelectorAll('#mealTableBody tr').forEach(row => {
                const userId = row.getAttribute('data-user-id');
                const breakfastInput = row.querySelector(`input[name="meals[${userId}][0]"]`);
                const lunchInput = row.querySelector(`input[name="meals[${userId}][1]"]`);
                const dinnerInput = row.querySelector(`input[name="meals[${userId}][2]"]`);
                const totalCell = document.getElementById(`total-meal-${userId}`);

                if (meals[userId]) {
                    breakfastInput.value = meals[userId].breakfast || 0;
                    lunchInput.value = meals[userId].lunch || 0;
                    dinnerInput.value = meals[userId].dinner || 0;
                    totalCell.textContent = meals[userId].meal_count || 0;
                } else {
                    breakfastInput.value = 0;
                    lunchInput.value = 0;
                    dinnerInput.value = 0;
                    totalCell.textContent = 0;
                }
                updateMeal(userId);
            });
        }

        // Increment meal value
        function incrementMeal(button) {
            const input = button.closest('.meal-input-group').querySelector('.meal-input');
            let value = parseFloat(input.value) || 0;
            value = Math.min(value + 0.5, 9);
            input.value = value;
            input.dispatchEvent(new Event('input', { bubbles: true }));
        }

        // Decrement meal value
        function decrementMeal(button) {
            const input = button.closest('.meal-input-group').querySelector('.meal-input');
            let value = parseFloat(input.value) || 0;
            value = Math.max(value - 0.5, 0);
            input.value = value;
            input.dispatchEvent(new Event('input', { bubbles: true }));
        }

        // Show notification
        function showNotification(message, type) {
            notification.textContent = message;
            notification.className = `notification ${type} show`;
            setTimeout(() => notification.classList.remove('show'), 3000);
        }

        // Reset form
        function resetForm() {
            Swal.fire({
                title: 'আপনি কি নিশ্চিত?',
                text: 'সমস্ত মিল ইনপুট শূন্য করা হবে!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'হ্যাঁ, রিসেট করুন!',
                cancelButtonText: 'না, বাতিল করুন'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelectorAll('.meal-input').forEach(input => {
                        input.value = 0;
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                    });
                    showNotification('সমস্ত মিল রিসেট করা হয়েছে!', 'success');
                }
            });
        }

        // Set default meals
        function setDefaultMeals() {
            document.querySelectorAll('#mealTableBody tr').forEach(row => {
                const userId = row.getAttribute('data-user-id');
                row.querySelector(`input[name="meals[${userId}][0]"]`).value = 0.5; // Breakfast
                row.querySelector(`input[name="meals[${userId}][1]"]`).value = 1.0; // Lunch
                row.querySelector(`input[name="meals[${userId}][2]"]`).value = 1.0; // Dinner
                updateMeal(userId);
            });
            showNotification('ডিফল্ট মিল সেট করা হয়েছে!', 'success');
        }

        // Copy yesterday's meals
        async function copyYesterdayMeals() {
            const currentDate = new Date(mealDateInput.value);
            currentDate.setDate(currentDate.getDate() - 1);
            const yesterdayDate = currentDate.toISOString().split('T')[0];
            dateSelector.classList.add('is-loading');
            try {
                const response = await fetch(`/api/meals/data?date=${yesterdayDate}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();
                updateMealInputs(data);
                updateSummaryStats();
                showNotification('গতকালের মিল কপি করা হয়েছে!', 'success');
            } catch (error) {
                console.error('Error fetching yesterday\'s meal data:', error);
                showNotification('গতকালের তথ্য লোড করতে সমস্যা হয়েছে!', 'error');
            } finally {
                dateSelector.classList.remove('is-loading');
            }
        }

        // Set all meals to zero
        function setZeroMeals() {
            document.querySelectorAll('.meal-input').forEach(input => {
                input.value = 0;
                input.dispatchEvent(new Event('input', { bubbles: true }));
            });
            showNotification('সমস্ত মিল শূন্য করা হয়েছে!', 'success');
        }

        // Set full attendance
        function setFullAttendance() {
            document.querySelectorAll('#mealTableBody tr').forEach(row => {
                const userId = row.getAttribute('data-user-id');
                row.querySelector(`input[name="meals[${userId}][0]"]`).value = 0.5; // Breakfast
                row.querySelector(`input[name="meals[${userId}][1]"]`).value = 1.0; // Lunch
                row.querySelector(`input[name="meals[${userId}][2]"]`).value = 1.0; // Dinner
                updateMeal(userId);
            });
            showNotification('সবার জন্য পূর্ণ মিল সেট করা হয়েছে!', 'success');
        }

        // Toggle all meals
        function toggleAllMeals() {
            isAllToggled = !isAllToggled;
            document.querySelectorAll('.meal-input').forEach(input => {
                input.value = isAllToggled ? 1 : 0;
                input.dispatchEvent(new Event('input', { bubbles: true }));
            });
            showNotification(isAllToggled ? 'সমস্ত মিল সক্রিয় করা হয়েছে!' : 'সমস্ত মিল নিষ্ক্রিয় করা হয়েছে!', 'success');
            toggleAllBtn.querySelector('i').className = isAllToggled ? 'fas fa-toggle-on' : 'fas fa-toggle-off';
        }

        // Navigate to previous day
        function goToPreviousDay() {
            const currentDate = new Date(mealDateInput.value);
            currentDate.setDate(currentDate.getDate() - 1);
            mealDateInput.value = currentDate.toISOString().split('T')[0];
            fetchMealData(mealDateInput.value);
            updateActiveDatePill();
        }

        // Navigate to next day
        function goToNextDay() {
            const currentDate = new Date(mealDateInput.value);
            currentDate.setDate(currentDate.getDate() + 1);
            if (currentDate <= new Date(today)) {
                mealDateInput.value = currentDate.toISOString().split('T')[0];
                fetchMealData(mealDateInput.value);
                updateActiveDatePill();
            } else {
                showNotification('ভবিষ্যতের তারিখ নির্বাচন করা যাবে না!', 'error');
            }
        }

        // Go to today
        function goToToday() {
            mealDateInput.value = today;
            fetchMealData(today);
            updateActiveDatePill();
        }

        // Update active date pill
        function updateActiveDatePill() {
            const selectedDate = mealDateInput.value;
            datePills.forEach(pill => {
                pill.classList.toggle('active', pill.getAttribute('data-date') === selectedDate);
            });
        }

        // Form submission
        document.getElementById('mealForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            document.querySelectorAll('.meal-input').forEach(input => {
                if (input.value === '') input.value = '0';
            });

            const formData = new FormData(this);
            dateSelector.classList.add('is-loading');
            try {
                const response = await fetch('{{ route('meals.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.error || 'Network response was not ok');

                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    background: '#28a745',
                    color: '#fff'
                });
            } catch (error) {
                console.error('Error saving meal data:', error);
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'ডাটা সংরক্ষণ করতে সমস্যা হয়েছে!',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    background: '#dc3545',
                    color: '#fff'
                });
            } finally {
                dateSelector.classList.remove('is-loading');
            }
        });

        // Event listeners
        document.addEventListener('DOMContentLoaded', () => {
            updateSummaryStats();
            loadDateBtn.addEventListener('click', () => fetchMealData(mealDateInput.value));
            prevDayBtn.addEventListener('click', goToPreviousDay);
            nextDayBtn.addEventListener('click', goToNextDay);
            todayBtn.addEventListener('click', goToToday);
            setDefaultBtn.addEventListener('click', setDefaultMeals);
            copyYesterdayBtn.addEventListener('click', copyYesterdayMeals);
            setZeroBtn.addEventListener('click', setZeroMeals);
            setFullPresentBtn.addEventListener('click', setFullAttendance);
            toggleAllBtn.addEventListener('click', toggleAllMeals);

            datePills.forEach(pill => {
                pill.addEventListener('click', function() {
                    mealDateInput.value = this.getAttribute('data-date');
                    fetchMealData(mealDateInput.value);
                    datePills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            mealDateInput.setAttribute('max', today);
        });
>>>>>>> 90a3b70c5a23fbe29cd509bded00a588c0f43132
    </script>
@endsection
