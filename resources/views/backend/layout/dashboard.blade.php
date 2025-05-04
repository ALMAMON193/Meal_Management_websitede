@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
<div class="business_layout_body">
    <!-- Meal Management Dashboard -->
    <div class="business--home--header--wrapper">
        <div class="business--home--header--column--row">
            <div class="business--home--header--column">
                <div class="business--home--header--count">
                    <h5>মোট মিল</h5>
                    <div class="business--home--header--count--icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                            <path d="M12.9 6l-1.4 7h-1l-1.4-7h3.8zm-.8-4H9.8L9 4h4l-.9-2zM6 8.5l1.7 8.6c.1.5.5.9 1 .9h6.6c.5 0 .9-.4 1-.9L18 8.5c.1-.5-.3-1-.8-1.1-.1 0-.1 0-.2 0H7c-.6 0-1 .4-1 1 0 0 0 .1 0 .1z"
                                stroke="white" stroke-width="1.5" fill="white"/>
                            <path d="M14 18v1c0 1.1-.9 2-2 2s-2-.9-2-2v-1h4zM16 5h6M2 5h6"
                                stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
                <div class="business--home--body--count">
                    <h2>357<span>এই মাসে</span></h2>
                </div>
            </div>
            <div class="business--home--header--column">
                <div class="business--home--header--count">
                    <h5>মোট বাজার</h5>
                    <div class="business--home--header--count--icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none">
                            <path d="M12 15V9M9 10.5h2.25M12.75 10.5H15M7 18.5h10c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2H7c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2z"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 20.5v-2M8 20.5v-2M16 20.5v-2"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="business--home--body--count">
                    <h2>৳15,750</h2>
                </div>
            </div>
            <div class="business--home--header--column">
                <div class="business--home--header--count">
                    <h5> <h5>মিল রেট</h5>
                    <div class="business--home--header--count--icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20 8.25V18C20 21 18.21 22 16 22H8C5.79 22 4 21 4 18V8.25C4 5 5.79 4.25 8 4.25C8 4.87 8.24997 5.43 8.65997 5.84C9.06997 6.25 9.63 6.5 10.25 6.5H13.75C14.99 6.5 16 5.49 16 4.25C18.21 4.25 20 5 20 8.25Z"
                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M16 4.25C16 5.49 14.99 6.5 13.75 6.5H10.25C9.63 6.5 9.06997 6.25 8.65997 5.84C8.24997 5.43 8 4.87 8 4.25C8 3.01 9.01 2 10.25 2H13.75C14.37 2 14.93 2.25 15.34 2.66C15.75 3.07 16 3.63 16 4.25Z"
                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M8 13H12" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M8 17H16" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="business--home--body--count">
                    <h2>৳3,450</h2>
                </div>
            </div>
        </div>

        <div class="business--home--header--report">
            <div class="business--home--report">
                <h4>পূর্ববর্তী মিল রিপোর্ট</h4>
                <button>দেখুন</button>
            </div>
            <div class="business--home--report">
                <h4>নতুন মেনু সংযোজন</h4>
                <button>যোগ করুন</button>
            </div>
        </div>
    </div>

    <!-- Meal Management Content -->
    <div class="meal-management-content">
        <div class="meal-management-section">
            <h3 class="section-title">সদস্য তালিকা</h3>
            <div class="member-list">
                <table class="member-table">
                    <thead>
                        <tr>
                            <th>সদস্য নাম</th>
                            <th>মোট মিল</th>
                            <th>মিল বাজার</th>
                            <th>মিল ব্যালেন্স</th>
                            <th>সম্পাদনা</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>আবদুল করিম</td>
                            <td>45</td>
                            <td>৳60</td>
                            <td>৳3,000</td>
                            <td>৳300</td>

                        </tr>
                        <tr>
                            <td>রফিক ইসলাম</td>
                            <td>42</td>
                            <td>৳60</td>
                            <td>৳2,800</td>
                            <td>৳280</td>

                        </tr>
                        <tr>
                            <td>মাহফুজুর রহমান</td>
                            <td>48</td>
                            <td>৳60</td>
                            <td>৳3,200</td>
                            <td>৳320</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="meal-management-section">
        <h3 class="section-title">বাজারের তালিকা</h3>
        <div class="bazaar-list">
            <div class="bazaar-card">
                <h4>আবদুল করিমের বাজার</h4>
                <ul>
                    <li><span>তারিখ:</span> 2025-05-01</li>
                    <li><span>মোট খরচ:</span> ৳2,500</li>
                    <li><span>আইটেম:</span> চাল, ডাল, তেল</li>
                </ul>
            </div>
            <div class="bazaar-card">
                <h4>রফিক ইসলামের বাজার</h4>
                <ul>
                    <li><span>তারিখ:</span> 2025-05-02</li>
                    <li><span>মোট খরচ:</span> ৳3,000</li>
                    <li><span>আইটেম:</span> মাছ, মাংস, সবজি</li>
                </ul>
            </div>
            <div class="bazaar-card">
                <h4>মাহফুজুর রহমানের বাজার</h4>
                <ul>
                    <li><span>তারিখ:</span> 2025-05-03</li>
                    <li><span>মোট খরচ:</span> ৳2,800</li>
                    <li><span>আইটেম:</span> ডিম, দুধ, মশলা</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        /* Additional styling for meal management */
        .meal-management-content {
            margin-top: 30px;
        }

        .meal-management-section {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
            font-weight: 600;
        }

        .meal-menu {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .meal-time {
            flex: 1;
            min-width: 250px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
        }

        .meal-time h4 {
            font-size: 16px;
            margin-bottom: 12px;
            color: #444;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .meal-items {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .meal-item {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
        }

        .item-name {
            font-weight: 500;
        }

        .item-quantity {
            color: #666;
        }

        .stats-chart {
            height: 250px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 20px 0;
        }

        .chart-placeholder {
            display: flex;
            align-items: flex-end;
            height: 100%;
            width: 100%;
            gap: 20px;
            padding: 0 20px;
        }

        .chart-bar {
            flex: 1;
            background: #6c7ae0;
            border-radius: 6px 6px 0 0;
            position: relative;
            min-height: 30px;
            display: flex;
            justify-content: center;
            transition: all 0.3s;
        }

        .chart-bar.active {
            background: #4154f1;
        }

        .chart-bar:hover {
            background: #4154f1;
            cursor: pointer;
        }

        .chart-value {
            position: absolute;
            top: -25px;
            font-weight: 600;
            color: #333;
        }

        .chart-bar::after {
            content: attr(data-day);
            position: absolute;
            bottom: -25px;
            font-size: 14px;
            color: #666;
        }

        .member-table {
            width: 100%;
            border-collapse: collapse;
        }

        .member-table th,
        .member-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .member-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #444;
        }

        .member-table tr:hover {
            background-color: #f8f9fa;
        }

        .table-action-btn {
            background: #4154f1;
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .table-action-btn:hover {
            background: #364dd6;
        }

        .meal-management-actions {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .primary-action,
        .secondary-action {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }

        .primary-action {
            background: #4154f1;
            color: white;
        }

        .primary-action:hover {
            background: #364dd6;
        }

        .secondary-action {
            background: #f0f0f0;
            color: #333;
            border: 1px solid #ddd;
        }

        .secondary-action:hover {
            background: #e0e0e0;
        }

        @media (max-width: 768px) {
            .meal-menu {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }
        }
         /* Styling for Bazaar List */
         .bazaar-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .bazaar-card {
            flex: 1;
            min-width: 250px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .bazaar-card h4 {
            font-size: 16px;
            margin-bottom: 12px;
            color: #444;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .bazaar-card ul {
            list-style: none;
            padding: 0;
        }

        .bazaar-card li {
            padding: 6px 0;
            display: flex;
            justify-content: space-between;
        }

        .bazaar-card li span {
            font-weight: 500;
            color: #333;
        }

        @media (max-width: 768px) {
            .bazaar-list {
                flex-direction: column;
            }
        }
    </style>
</div>
@endsection
