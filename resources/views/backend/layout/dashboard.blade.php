@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
<style>
/* Base Styles */
.business_layout_body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
    padding: 15px;
    background-color: #f8fafc;
}

/* Header Section */
.dashboard-header {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.dashboard-card {
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.card-title {
    font-size: 0.9rem;
    color: #64748b;
    font-weight: 500;
}

.card-icon {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
}

.card-icon svg {
    width: 18px;
    height: 18px;
}

.card-value {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 5px;
}

.card-subtext {
    font-size: 0.8rem;
    color: #64748b;
}

/* Report Section */
.report-section {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.report-card {
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.report-title {
    font-size: 0.9rem;
    color: #1e293b;
    font-weight: 500;
    margin-bottom: 5px;
}

.report-btn {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    font-weight: 500;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.report-btn:hover {
    background: linear-gradient(135deg, #4338ca, #6d28d9);
    transform: translateY(-2px);
}

/* Tables and Lists */
.section-title {
    font-size: 1.1rem;
    color: #1e293b;
    font-weight: 600;
    margin-bottom: 15px;
}

.member-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
}

.member-table th {
    background: #f1f5f9;
    padding: 10px 12px;
    text-align: left;
    font-weight: 600;
    color: #475569;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

.member-table td {
    padding: 10px 12px;
    border-bottom: 1px solid #e2e8f0;
    color: #334155;
    font-size: 0.85rem;
    white-space: nowrap;
}

.member-table tr:last-child td {
    border-bottom: none;
}

.member-table tr:hover td {
    background: #f8fafc;
}

/* Bazaar Cards */
.bazaar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 15px;
}

.bazaar-card {
    background: white;
    border-radius: 10px;
    padding: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    overflow: hidden;
}

.bazaar-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.bazaar-card h4 {
    font-size: 0.95rem;
    color: #1e293b;
    margin-bottom: 10px;
    font-weight: 600;
}

.bazaar-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.bazaar-card li {
    display: flex;
    margin-bottom: 5px;
    font-size: 0.8rem;
    overflow-wrap: break-word;
    word-break: break-word;
}

.bazaar-card li:last-child {
    margin-bottom: 0;
}

.bazaar-card span {
    font-weight: 500;
    color: #475569;
    min-width: 60px;
    display: inline-block;
}

/* Responsive */
@media (max-width: 1024px) {
    .dashboard-header {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .dashboard-header {
        grid-template-columns: 1fr;
    }

    .report-section {
        grid-template-columns: 1fr;
    }

    /* Member Table Responsive */
    .member-table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: #64748b #e2e8f0;
    }

    .member-table {
        min-width: 600px;
    }

    .member-table th,
    .member-table td {
        min-width: 100px;
        padding: 8px 10px;
        font-size: 0.8rem;
    }

    /* Bazaar Grid Responsive */
    .bazaar-grid {
        grid-template-columns: 1fr;
    }

    .report-btn {
        padding: 5px 10px;
    }
}

@media (max-width: 480px) {
    .business_layout_body {
        padding: 10px;
    }

    .card-value {
        font-size: 1.3rem;
    }

    .member-table-container {
        margin: 0 -10px;
        padding: 0 10px;
    }

    .member-table th,
    .member-table td {
        min-width: 80px;
        font-size: 0.75rem;
        padding: 6px 8px;
    }

    .report-btn {
        font-size: 0.75rem;
        padding: 4px 8px;
    }

    .bazaar-card {
        padding: 10px;
    }

    .bazaar-card h4 {
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .bazaar-card li {
        font-size: 0.75rem;
        margin-bottom: 4px;
    }

    .bazaar-card span {
        min-width: 50px;
    }
}

@media (max-width: 320px) { /* iPhone 5 and similar small screens */
    .member-table th,
    .member-table td {
        min-width: 70px;
        font-size: 0.7rem;
        padding: 5px 6px;
    }

    .card-value {
        font-size: 1.2rem;
    }

    .section-title {
        font-size: 1rem;
    }

    .bazaar-card {
        padding: 8px;
    }

    .bazaar-card h4 {
        font-size: 0.85rem;
        margin-bottom: 6px;
    }

    .bazaar-card li {
        font-size: 0.7rem;
        margin-bottom: 3px;
    }

    .bazaar-card span {
        min-width: 45px;
    }
}

/* Custom Scrollbar for Webkit Browsers */
.member-table-container::-webkit-scrollbar {
    height: 8px;
}

.member-table-container::-webkit-scrollbar-track {
    background: #e2e8f0;
    border-radius: 4px;
}

.member-table-container::-webkit-scrollbar-thumb {
    background: #64748b;
    border-radius: 4px;
}

.member-table-container::-webkit-scrollbar-thumb:hover {
    background: #475569;
}
</style>

<div class="business_layout_body">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">মোট মিল</h3>
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path d="M12.9 6l-1.4 7h-1l-1.4-7h3.8zm-.8-4H9.8L9 4h4l-.9-2zM6 8.5l1.7 8.6c.1.5.5.9 1 .9h6.6c.5 0 .9-.4 1-.9L18 8.5c.1-.5-.3-1-.8-1.1-.1 0-.1 0-.2 0H7c-.6 0-1 .4-1 1 0 0 0 .1 0 .1z"
                            stroke="white" stroke-width="1.5" fill="white"/>
                        <path d="M14 18v1c0 1.1-.9 2-2 2s-2-.9-2-2v-1h4zM16 5h6M2 5h6"
                            stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
            <div class="card-value">357</div>
            <div class="card-subtext">এই মাসে</div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">মোট বাজার</h3>
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12 15V9M9 10.5h2.25M12.75 10.5H15M7 18.5h10c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2H7c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 20.5v-2M8 20.5v-2M16 20.5v-2"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <div class="card-value">৳15,750</div>
            <div class="card-subtext">এই মাসে</div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">মিল রেট</h3>
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
            <div class="card-value">৳3,450</div>
            <div class="card-subtext">বর্তমান রেট</div>
        </div>
    </div>

    <!-- Report Section -->
    <div class="report-section">
        <div class="report-card">
            <div>
                <h3 class="report-title">পূর্ববর্তী মিল রিপোর্ট</h3>
                <p class="card-subtext">গত মাসের মিল রিপোর্ট দেখুন</p>
            </div>
            <button class="report-btn">দেখুন</button>
        </div>

        <div class="report-card">
            <div>
                <h3 class="report-title">নতুন মেনু সংযোজন</h3>
                <p class="card-subtext">এই সপ্তাহের মেনু যোগ করুন</p>
            </div>
            <button class="report-btn">যোগ করুন</button>
        </div>
    </div>

    <!-- Member List Section -->
    <div class="meal-management-section">
        <h3 class="section-title">সদস্য তালিকা</h3>
        <div class="member-table-container">
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
                        <td><button class="report-btn" style="padding: 5px 10px; font-size: 0.8rem;">সম্পাদনা</button></td>
                    </tr>
                    <tr>
                        <td>রফিক ইসলাম</td>
                        <td>42</td>
                        <td>৳60</td>
                        <td>৳2,800</td>
                        <td><button class="report-btn" style="padding: 5px 10px; font-size: 0.8rem;">সম্পাদনা</button></td>
                    </tr>
                    <tr>
                        <td>মাহফুজুর রহমান</td>
                        <td>48</td>
                        <td>৳60</td>
                        <td>৳3,200</td>
                        <td><button class="report-btn" style="padding: 5px 10px; font-size: 0.8rem;">সম্পাদনা</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bazaar List Section -->
    <div class="meal-management-section">
        <h3 class="section-title">বাজারের তালিকা</h3>
        <div class="bazaar-grid">
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
</div>
@endsection
