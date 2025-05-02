@extends('frontend.app')

@section('content')
<div class="layout-wrapper landing">
    @include('frontend.partials.nav')

    <section class="section">
        <div class="container" style="margin-top: 150px">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="text-muted mt-5 mt-lg-0">
                        <h5 class="fs-12 text-uppercase text-success">আজকের বাজার</h5>
                         <h1>আজকের বাজারের তালিকা</h1>
                        <p class="ff-secondary mb-2">
                            তুমি চাইলে আজকের বাজারের তালিকায় তোমার কেনাকাটা যোগ করতে পারো! যেমন – ফলমূল, শাকসবজি বা যা দরকার।
                            <b>খাবারের নাম, মূল্য এবং তারিখ যোগ করুন।</b>
                        </p>

                    </div>
                </div>

                <div class="col-lg-4 col-sm-7 col-10 ms-lg-auto mx-auto order-1 order-lg-2">
                    <div class="card shadow-lg">
                        <div class="card-body p-0">
                            <div class="overflow-auto" style="max-height: 400px;">
                                <form id="mealForm" class="p-3 needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label for="itemDate" class="form-label">বাজারের তারিখ</label>
                                        <input type="date" class="form-control" id="itemDate" required>
                                        <div class="invalid-feedback">দয়া করে তারিখ নির্বাচন করুন</div>
                                    </div>
                                    <div id="itemFieldsContainer">
                                        <div class="mb-3 item-field-group">
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">খাবারের নাম</label>
                                                    <input type="text" class="form-control item-name" placeholder="খাবারের নাম" required>
                                                    <div class="invalid-feedback">খাবারের নাম প্রয়োজন</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">মূল্য (টাকায়)</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control item-price" placeholder="মূল্য" required>
                                                        <span class="input-group-text">৳</span>
                                                        <div class="invalid-feedback">মূল্য প্রয়োজন</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 sticky-bottom py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-outline-success" onclick="addMoreFields()">
                                    <i class="ri-add-circle-line me-1"></i> আরও আইটেম
                                </button>
                                <button type="submit" form="mealForm" class="btn btn-primary">
                                    <i class="ri-check-line me-1"></i> তালিকায় যোগ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.layout.pages.market_list')
    @include('frontend.layout.pages.attandence')
</div>

<style>
    .overflow-auto::-webkit-scrollbar {
        width: 8px;
    }
    .overflow-auto::-webkit-scrollbar-track {
        background: #f8f9fa;
    }
    .overflow-auto::-webkit-scrollbar-thumb {
        background: #dee2e6;
        border-radius: 4px;
    }
    .overflow-auto::-webkit-scrollbar-thumb:hover {
        background: #adb5bd;
    }
    .sticky-bottom {
        position: sticky;
        bottom: 0;
        background: white;
        z-index: 1;
        box-shadow: 0 -5px 15px rgba(0,0,0,0.05);
    }
</style>

<script>
    let items = [];

    // Add more input fields
    function addMoreFields() {
        const container = document.getElementById('itemFieldsContainer');
        const newField = document.createElement('div');
        newField.className = 'mb-3 item-field-group';
        newField.innerHTML = `
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" class="form-control item-name" placeholder="খাবারের নাম" required>
                    <div class="invalid-feedback">খাবারের নাম প্রয়োজন</div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="number" class="form-control item-price" placeholder="মূল্য" required>
                        <span class="input-group-text">৳</span>
                        <div class="invalid-feedback">মূল্য প্রয়োজন</div>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(newField);
        newField.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Form submission
    document.getElementById('mealForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validate form
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        const itemDate = document.getElementById('itemDate').value;
        const nameInputs = document.querySelectorAll('.item-name');
        const priceInputs = document.querySelectorAll('.item-price');

        // Prepare items array
        const itemsToSubmit = [];
        for (let i = 0; i < nameInputs.length; i++) {
            const itemName = nameInputs[i].value.trim();
            const itemPrice = priceInputs[i].value.trim();

            if (itemName && itemPrice) {
                itemsToSubmit.push({
                    name: itemName,
                    price: itemPrice,
                    date: itemDate
                });
            }
        }

        try {
            // Send data to server
            const response = await fetch('/market-items', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ items: itemsToSubmit })
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();
            console.log('Success:', data);

            // Refresh the item list
            await fetchItems();
            resetForm();

            // Show success message
            Toastify({
                text: "আইটেমগুলো সফলভাবে সংরক্ষণ করা হয়েছে",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#28a745",
            }).showToast();
        } catch (error) {
            console.error('Error:', error);
            Toastify({
                text: "একটি সমস্যা হয়েছে: " + error.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#dc3545",
            }).showToast();
        }
    });

    // Reset the form
    function resetForm() {
        const form = document.getElementById('mealForm');
        form.reset();
        form.classList.remove('was-validated');

        // Reset to one field group
        document.getElementById('itemFieldsContainer').innerHTML = `
            <div class="mb-3 item-field-group">
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">খাবারের নাম</label>
                        <input type="text" class="form-control item-name" required>
                        <div class="invalid-feedback">খাবারের নাম প্রয়োজন</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">মূল্য (টাকায়)</label>
                        <div class="input-group">
                            <input type="number" class="form-control item-price" required>
                            <span class="input-group-text">৳</span>
                            <div class="invalid-feedback">মূল্য প্রয়োজন</div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Format date for display
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('bn-BD', options);
    }

    // Load items when page loads
    document.addEventListener('DOMContentLoaded', fetchItems);
</script>
@endsection
