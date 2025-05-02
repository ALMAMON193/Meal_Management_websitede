<section class="section">
    <div class="container" style="margin-top: 150px">
        <div class="row align-items-center gy-4 mb-4">
            <div class="col-lg-9">
                <div class="text-muted mt-5 mt-lg-0">
                    <h5 class="fs-12 text-uppercase text-success">উপস্থিতি ও খাবারের তালিকা</h5>
                    <h1 class="fw-bold">দৈনিক উপস্থিতি ও খাবারের ইনপুট ফর্ম</h1>
                    <p class="ff-secondary mb-2">
                        তারিখ সিলেক্ট করুন এবং তারপর ইউজারের তথ্য ইনপুট দিন।
                    </p>
                </div>
            </div>
        </div>

        <!-- Date Selection -->
        <div class="mb-4">
            <label for="date" class="form-label fw-bold">তারিখ নির্বাচন করুন:</label>
            <input type="date" id="attendanceDate" class="form-control" />
        </div>

        <!-- Data Table (Initially Hidden) -->
        <div id="dataForm" style="display: none;">
            <form action="#" method="POST">
                <table class="table table-bordered">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>নাম</th>
                            <th>ব্রেকফাস্ট</th>
                            <th>লাঞ্চ</th>
                            <th>ডিনার</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                        <tr>

                            <td><input type="text" class="form-control" value="{{ $item->name ?? '' }}" placeholder="নাম লিখুন"></td>
                            <td><select class="form-select">
                                <option value="0.5">0.5</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select></td>
                            <td><select class="form-select"> <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option></select></td>
                            <td><select class="form-select"> <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option></select></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">✅ জমা দিন</button>
                </div>
            </form>
        </div>

        <!-- No Data Message -->
        <div id="noData" class="alert alert-warning text-center" style="display: block;">
            🔍 দয়া করে একটি তারিখ নির্বাচন করুন।
        </div>
    </div>
</section>

<!-- JavaScript -->
<script>
    document.getElementById('attendanceDate').addEventListener('change', function () {
        const dateValue = this.value;
        const dataForm = document.getElementById('dataForm');
        const noData = document.getElementById('noData');

        if (dateValue) {
            dataForm.style.display = 'block';
            noData.style.display = 'none';
        } else {
            dataForm.style.display = 'none';
            noData.style.display = 'block';
        }
    });
</script>
