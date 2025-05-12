@extends('backend.app')
@section('title', 'মিল ম্যানেজমেন্ট ড্যাশবোর্ড')
@section('content')
   
    <style>
        /* ===== GLOBAL STYLES ===== */
        .business_layout_body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            padding: 2rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* ===== CARD STYLES ===== */
        .form-container,
        .mess-details-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            max-width: 800px;
            margin: 2rem auto;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            opacity: 0;
            transform: translateY(20px);
        }

        .form-container.show,
        .mess-details-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== TYPOGRAPHY ===== */
        .page-title {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .page-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #8B00FF, #4B0082);
            border-radius: 4px;
        }

        .section-title {
            color: #4B0082;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        /* ===== BUTTON SYSTEM ===== */
        .btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            overflow: hidden;
            text-decoration: none;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            z-index: 1;
        }

        .btn svg {
            width: 18px;
            height: 18px;
            transition: all 0.3s ease;
        }

        /* Primary Button */
        .btn-primary {
            background: linear-gradient(135deg, #8B00FF 0%, #6A0DAD 50%, #4B0082 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #9B30FF 0%, #7B2CBF 50%, #5A00A0 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(139, 0, 255, 0.4);
        }

        /* Secondary Button */
        .btn-secondary {
            background: linear-gradient(135deg, #f1f1f1 0%, #e1e1e1 100%);
            color: #4B0082;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #ffffff 0%, #f1f1f1 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Premium Button */
        .premium-button {
            background: linear-gradient(135deg, #8B00FF 0%, #4B0082 50%, #2E0854 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(139, 0, 255, 0.3),
                        0 0 0 1px rgba(255, 255, 255, 0.1) inset,
                        0 0 10px rgba(139, 0, 255, 0.5) inset;
        }

        .premium-button:hover {
            background: linear-gradient(135deg, #9B30FF 0%, #5A00A0 50%, #3D0066 100%);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 25px rgba(139, 0, 255, 0.5),
                        0 0 0 1px rgba(255, 255, 255, 0.2) inset,
                        0 0 15px rgba(139, 0, 255, 0.7) inset;
        }

        /* ===== FORM ELEMENTS ===== */
        .form-group {
            margin-bottom: 1.8rem;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4B0082;
            font-weight: 500;
            font-size: 0.95rem;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 12px 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: #8B00FF;
            box-shadow: 0 0 0 3px rgba(139, 0, 255, 0.2);
            outline: none;
        }

        /* ===== DETAILS CARD ===== */
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 500;
            color: #4B0082;
        }

        .detail-value {
            color: #2c3e50;
        }

        /* ===== NOTIFICATION STYLES ===== */
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 400px;
            transform: translateX(100%);
            transition: transform 0.5s ease, opacity 0.5s ease;
            z-index: 1000;
            color: white;
            opacity: 0;
        }

        .notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .notification-icon {
            font-size: 1.2rem;
        }

        .notification-success {
            background: #27ae60;
        }

        .notification-error {
            background: #e74c3c;
        }

        .notification-message {
            font-size: 0.9rem;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            .business_layout_body {
                padding: 1rem;
            }
            
            .form-container,
            .mess-details-card {
                padding: 1.5rem;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
<div class="business_layout_body">
        <h1 class="page-title">মেস ম্যানেজমেন্ট</h1>

        @if ($mess && !request()->has('edit'))
            <!-- Mess Details Card -->
            <div class="mess-details-card show">
                <h3 class="section-title">মেসের বিবরণ</h3>

                <div class="detail-row">
                    <div class="detail-label">মেসের নাম:</div>
                    <div class="detail-value">{{ $mess->name }}</div>
                </div>

                @if ($mess->address)
                    <div class="detail-row">
                        <div class="detail-label">ঠিকানা:</div>
                        <div class="detail-value">{{ $mess->address }}</div>
                    </div>
                @endif

                <div class="detail-row">
                    <div class="detail-label">তৈরি করেছেন:</div>
                    <div class="detail-value">{{ Auth::user()->name }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">তৈরির তারিখ:</div>
                    <div class="detail-value">{{ $mess->created_at->format('d M, Y h:i A') }}</div>
                </div>

                <div class="form-actions" style="margin-top: 2rem;">
                    <button type="button" class="btn premium-button"
                        onclick="window.location.href='{{ route('mess.index') }}?edit=true'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                        সম্পাদনা করুন
                    </button>
                </div>
            </div>
        @else
            <!-- Mess Form -->
            <div class="form-container show" id="messFormContainer">
                <h3 class="section-title">{{ $mess ? 'মেস সম্পাদনা করুন' : 'মেস তৈরি করুন' }}</h3>

                <form id="messForm" action="{{ $mess ? route('mess.update', $mess->id) : route('mess.store') }}" method="POST">
                    @csrf
                    @if ($mess)
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="mess_name">মেসের নাম</label>
                        <input type="text" id="mess_name" name="name" required 
                               placeholder="মেসের নাম লিখুন"
                               value="{{ $mess ? $mess->name : old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">ঠিকানা (ঐচ্ছিক)</label>
                        <textarea id="address" name="address" placeholder="মেসের ঠিকানা লিখুন">{{ $mess ? $mess->address : old('address') }}</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2h-2a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                            </svg>
                            {{ $mess ? 'আপডেট করুন' : 'মেস তৈরি করুন' }}
                        </button>

                        <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='{{ route('mess.index') }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            বাতিল
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <!-- Notification System -->
    <div id="notification" class="notification">
        <span class="notification-icon"></span>
        <span class="notification-message"></span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('messForm');
            const notification = document.getElementById('notification');
            const formContainer = document.querySelector('.form-container');
            const messDetailsCard = document.querySelector('.mess-details-card');

            // Show animation for form or details card
            if (formContainer) {
                setTimeout(() => formContainer.classList.add('show'), 100);
            }
            if (messDetailsCard) {
                setTimeout(() => messDetailsCard.classList.add('show'), 100);
            }

            // Show notification if there are flash messages
            @if (session('success'))
                showNotification('{{ session('success') }}', 'success');
            @endif

            @if (session('error'))
                showNotification('{{ session('error') }}', 'error');
            @endif

            // Add interactive effects
            if (form) {
                const inputs = form.querySelectorAll('input, textarea');
                const submitBtn = form.querySelector('button[type="submit"]');

                // Add focus and typing effects
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentNode.style.transform = 'scale(1.03)';
                        this.parentNode.querySelector('label').style.color = '#3498db';
                    });

                    input.addEventListener('blur', function() {
                        this.parentNode.style.transform = 'scale(1)';
                        this.parentNode.querySelector('label').style.color = '#34495e';
                    });

                    // Real-time validation feedback
                    input.addEventListener('input', function() {
                        if (this.value.trim() !== '') {
                            this.style.borderColor = '#27ae60';
                        } else {
                            this.style.borderColor = '#ddd';
                        }
                    });
                });

                // Form submission animation
                form.addEventListener('submit', function(e) {
                    submitBtn.innerHTML = `
                    <svg class="spinner" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px;">
                        <path d="M12 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M12 18V22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M4.93 4.93L7.76 7.76" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16.24 16.24L19.07 19.07" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M2 12H6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M18 12H22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M4.93 19.07L7.76 16.24" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16.24 7.76L19.07 4.93" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Processing...
                `;
                    submitBtn.disabled = true;
                    formContainer.style.opacity = '0.7';
                });
            }

            // Button ripple effect
            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const ripple = document.createElement('span');
                    ripple.style.position = 'absolute';
                    ripple.style.background = 'rgba(255, 255, 255, 0.5)';
                    ripple.style.borderRadius = '50%';
                    ripple.style.transform = 'translate(-50%, -50%)';
                    ripple.style.width = '100px';
                    ripple.style.height = '100px';
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    ripple.style.animation = 'ripple 0.6s ease-out';
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // Notification function
            function showNotification(message, type) {
                const icon = notification.querySelector('.notification-icon');
                const messageElement = notification.querySelector('.notification-message');

                // Set icon based on type
                icon.innerHTML = type === 'success' ? '✓' : '✕';
                
                // Set notification class and text color
                notification.className = `notification notification-${type}`;
                messageElement.textContent = message;
                
                // Show notification
                notification.classList.add('show');

                // Auto remove after 5 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        notification.className = 'notification';
                    }, 500);
                }, 5000);
            }
        });

        // Ripple animation
        const style = document.createElement('style');
        style.innerHTML = `
        @keyframes ripple {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 0; }
        }
    `;
        document.head.appendChild(style);
    </script>

@endsection