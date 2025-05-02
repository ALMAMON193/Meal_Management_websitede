<section class="section">
    <div class="container" style="margin-top: 150px">
        <div class="row align-items-center gy-4 mb-4">
            <div class="col-lg-9">
                <div class="text-muted mt-5 mt-lg-0">
                    <h5 class="fs-12 text-uppercase text-success">আজকের বাজার</h5>
                    <h1 class="fw-bold">আজকের বাজারের তালিকা</h1>
                    <p class="ff-secondary mb-2">
                        তুমি চাইলে আজকের বাজারের তালিকায় তোমার কেনাকাটা যোগ করতে পারো! যেমন – ফলমূল, শাকসবজি বা যা দরকার।
                        <b>খাবারের নাম, মূল্য এবং তারিখ যোগ করুন।</b>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 text-lg-end">
                <label for="filterDate" class="form-label d-block mb-1 fw-semibold">📅 তারিখ ফিল্টার</label>
                <input type="date" id="filterDate" class="form-control shadow-sm" onchange="filterByDate()">
            </div>
        </div>

        <div class="row" id="itemList">
            @forelse ($marketItems as $date => $users)
                @foreach($users as $userItems)
                    <div class="col-md-6 col-lg-4 col-xl-3 mb-4 item" data-date="{{ $date }}">
                        <div class="card border-0 shadow-lg h-100 glass-card position-relative">
                            <div class="card-header text-white bg-dark text-center rounded-top">
                                {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}
                                <small class="d-block">by {{ $userItems->first()->user->name }}</small>
                            </div>
                            <div class="card-body">
                                @foreach ($userItems as $item)
                                    <div class="mb-2 d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold">{{ $item->name }}</span>
                                        <span class="text-primary">৳{{ number_format($item->price, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer bg-transparent border-0 text-end">
                                <small class="text-muted">মোট আইটেম: {{ count($userItems) }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        কোনো বাজারের আইটেম পাওয়া যায়নি।
                    </div>
                </div>
            @endforelse
        </div>

        <hr>

        <h3 class="mb-4">বর্তমান মাসে ইউজার অনুযায়ী মোট খরচ</h3>
        @if($monthlyUsers->isEmpty())
            <div class="alert alert-info">
                এই মাসে কোনো খরচের রেকর্ড নেই।
            </div>
        @else
            <ul class="list-group mb-5">
                @foreach ($monthlyUsers as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $user->name }}
                        <span class="badge bg-success rounded-pill">৳{{ number_format($user->total_price, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        transition: transform 0.2s ease-in-out;
    }
    .glass-card:hover {
        transform: translateY(-5px);
    }
</style>

<script>
    function filterByDate() {
        const selectedDate = document.getElementById('filterDate').value;
        const items = document.querySelectorAll('.item');

        items.forEach(item => {
            const itemDate = item.getAttribute('data-date');
            item.style.display = (!selectedDate || itemDate === selectedDate) ? 'block' : 'none';
        });
    }
</script>
