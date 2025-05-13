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
    </script>
@endsection
