@extends('frontend.app')
@section('title', 'মেস ম্যানেজমেন্ট সিস্টেম')
@section('content')
<section class="section job-hero-section bg-light pb-0" id="hero">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div>
                    <h1 class="display-6 fw-semibold text-capitalize mb-3 lh-base">আপনার মেস পরিচালনার জন্য সেরা সমাধান খুঁজুন</h1>
                    <p class="lead text-muted lh-base mb-4">মেস ম্যানেজমেন্ট সিস্টেমের মাধ্যমে আপনার মেসের খরচ, খাবারের হিসাব এবং সদস্যদের তথ্য সহজে পরিচালনা করুন।</p>
                    <ul class="treding-keywords list-inline mb-0 mt-3 fs-13">
                        <li class="list-inline-item text-danger fw-semibold"><i class="ri-tag-fill align-middle"></i> জনপ্রিয় কীওয়ার্ড:</li>
                        <li class="list-inline-item"><a href="javascript:void(0)">ছাত্র মেস,</a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)">বাজেট মেস,</a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)">পেশাদার মেস,</a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)">পরিচ্ছন্ন মেস</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="position-relative home-img text-center mt-5 mt-lg-0">
                    <div class="card p-3 rounded shadow-lg inquiry-box">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0 me-3">
                                <div class="avatar-title bg-warning-subtle text-warning rounded fs-18">
                                    <i class="ri-mail-send-line"></i>
                                </div>
                            </div>
                            <h5 class="fs-15 lh-base mb-0">মেস সম্পর্কিত তথ্যের জন্য যোগাযোগ</h5>
                        </div>
                    </div>
                    <div class="card p-3 rounded shadow-lg application-box">
                        <h5 class="fs-15 lh-base mb-3">সদস্যদের তালিকা</h5>
                        <div class="avatar-group">
                            <a href="javascript:void(0);" class="avatar-group-item" data-bs-toggle="tooltip" title="রহিম">
                                <div class="avatar-xs">
                                    <img src="https://via.placeholder.com/50" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="avatar-group-item" data-bs-toggle="tooltip" title="করিম">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-danger">ক</div>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="avatar-group-item" data-bs-toggle="tooltip" title="আলী">
                                <div class="avatar-xs">
                                    <img src="" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="avatar-group-item" data-bs-toggle="tooltip" title="আরও সদস্য">
                                <div class="avatar-xs">
                                    <div class="avatar-title fs-13 rounded-circle bg-light border-dashed border text-primary">১০+</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <img src="{{asset('frontend/images/job-profile2.png')}}" alt="মেসের ছবি" class="user-img">
                    <div class="circle-effect">
                        <div class="circle"></div>
                        <div class="circle2"></div>
                        <div class="circle3"></div>
                        <div class="circle4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section">
    <div class="container">
        <div class="row align-items-center justify-content-lg-between justify-content-center gy-4">
            <div class="col-lg-5 col-sm-7">
                <div class="about-img-section mb-5 mb-lg-0 text-center">
                    <div class="card rounded shadow-lg inquiry-box d-none d-lg-block">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0 me-3">
                                <div class="avatar-title bg-secondary-subtle text-secondary rounded-circle fs-18">
                                    <i class="ri-briefcase-2-line"></i>
                                </div>
                            </div>
                            <h5 class="fs-15 lh-base mb-0">১০,০০০+ মেস পরিচালিত</h5>
                        </div>
                    </div>
                    <div class="card feedback-box">
                        <div class="card-body d-flex shadow-lg">
                            <div class="flex-shrink-0 me-3">
                                <img src="https://via.placeholder.com/50" alt="" class="avatar-sm rounded-circle">
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-14 lh-base mb-0">তানিয়া রহমান</h5>
                                <p class="text-muted fs-11 mb-1">মেস ম্যানেজার</p>
                                <div class="text-warning">
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{asset('frontend/images/about.jpg')}}" alt="মেসের ছবি" class="img-fluid mx-auto rounded-3" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-muted">
                    <h1 class="mb-3 lh-base">এক জায়গায় আপনার <span class="text-primary">মেস পরিচালনা</span></h1>
                    <p class="ff-secondary fs-16 mb-2">আপনার মেসের সমস্ত কার্যক্রম সহজে পরিচালনা করুন। খরচের হিসাব, খাবারের মেনু এবং সদস্যদের তথ্য এক জায়গায় রাখুন।</p>
                    <p class="ff-secondary fs-16">আমাদের সিস্টেম আপনাকে সময় এবং শ্রম বাঁচাতে সাহায্য করবে।</p>
                    <div class="vstack gap-2 mb-4 pb-1">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <div class="avatar-xs icon-effect">
                                    <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                        <i class="ri-check-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0">স্বয়ংক্রিয় খরচ হিসাব</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <div class="avatar-xs icon-effect">
                                    <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                        <i class="ri-check-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0">খাবারের মেনু পরিকল্পনা</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <div class="avatar-xs icon-effect">
                                    <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                        <i class="ri-check-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0">সদস্যদের তথ্য সংরক্ষণ</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="#!" class="btn btn-primary">আরও জানুন <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Features Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center mb-5">
                    <h2 class="mb-3">আমাদের সিস্টেমের <span class="text-primary">বিশেষ সুবিধা</span></h2>
                    <p class="text-muted fs-15">আপনার মেস পরিচালনাকে সহজ, সুন্দর এবং কার্যকর করার জন্য আমরা নিচের সুবিধাগুলো প্রদান করি</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card">
                    <div class="card-body p-4">
                        <div class="avatar-md mb-4">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded fs-20 text-primary">
                                <i class="ri-line-chart-line"></i>
                            </div>
                        </div>
                        <h5 class="fs-17">খরচ ট্র্যাকিং</h5>
                        <p class="text-muted mb-0">প্রতিদিনের বাজার, বিল এবং অন্যান্য খরচের স্বয়ংক্রিয় হিসাব রাখুন</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card">
                    <div class="card-body p-4">
                        <div class="avatar-md mb-4">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded fs-20 text-primary">
                                <i class="ri-restaurant-line"></i>
                            </div>
                        </div>
                        <h5 class="fs-17">মেনু প্ল্যানিং</h5>
                        <p class="text-muted mb-0">সাপ্তাহিক বা মাসিক খাবারের মেনু তৈরি করুন এবং সদস্যদের সাথে শেয়ার করুন</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card">
                    <div class="card-body p-4">
                        <div class="avatar-md mb-4">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded fs-20 text-primary">
                                <i class="ri-team-line"></i>
                            </div>
                        </div>
                        <h5 class="fs-17">সদস্য ব্যবস্থাপনা</h5>
                        <p class="text-muted mb-0">সকল সদস্যের তথ্য, বকেয়া এবং উপস্থিতি এক জায়গায় সংরক্ষণ করুন</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card">
                    <div class="card-body p-4">
                        <div class="avatar-md mb-4">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded fs-20 text-primary">
                                <i class="ri-notification-line"></i>
                            </div>
                        </div>
                        <h5 class="fs-17">স্বয়ংক্রিয় নোটিফিকেশন</h5>
                        <p class="text-muted mb-0">জরুরী নোটিশ, বিলের রিমাইন্ডার এবং অন্যান্য তথ্য সদস্যদের জানান</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card">
                    <div class="card-body p-4">
                        <div class="avatar-md mb-4">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded fs-20 text-primary">
                                <i class="ri-file-chart-line"></i>
                            </div>
                        </div>
                        <h5 class="fs-17">রিপোর্ট জেনারেশন</h5>
                        <p class="text-muted mb-0">মাসিক বা বাৎসরিক খরচের বিশদ রিপোর্ট তৈরি করুন</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card">
                    <div class="card-body p-4">
                        <div class="avatar-md mb-4">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded fs-20 text-primary">
                                <i class="ri-smartphone-line"></i>
                            </div>
                        </div>
                        <h5 class="fs-17">মোবাইল ফ্রেন্ডলি</h5>
                        <p class="text-muted mb-0">যেকোনো ডিভাইস থেকে আপনার মেসের তথ্য এক্সেস করুন</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center mb-5">
                    <h2 class="mb-3">এটি কিভাবে <span class="text-primary">কাজ করে</span></h2>
                    <p class="text-muted fs-15">মাত্র কয়েকটি সহজ ধাপে আপনার মেস ব্যবস্থাপনা শুরু করুন</p>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="how-it-work-box text-center p-4">
                    <div class="how-it-work-img mb-4">
                        <div class="avatar-lg mx-auto">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded-circle text-primary fs-20">
                                1
                            </div>
                        </div>
                    </div>
                    <h5 class="fs-17">অ্যাকাউন্ট তৈরি করুন</h5>
                    <p class="text-muted mb-0">আমাদের ওয়েবসাইটে রেজিস্ট্রেশন করুন এবং আপনার মেসের প্রোফাইল তৈরি করুন</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="how-it-work-box text-center p-4">
                    <div class="how-it-work-img mb-4">
                        <div class="avatar-lg mx-auto">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded-circle text-primary fs-20">
                                2
                            </div>
                        </div>
                    </div>
                    <h5 class="fs-17">সদস্য যোগ করুন</h5>
                    <p class="text-muted mb-0">আপনার মেসের সকল সদস্যের প্রোফাইল তৈরি করুন এবং তাদের তথ্য সংরক্ষণ করুন</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="how-it-work-box text-center p-4">
                    <div class="how-it-work-img mb-4">
                        <div class="avatar-lg mx-auto">
                            <div class="avatar-title bg-primary bg-opacity-10 rounded-circle text-primary fs-20">
                                3
                            </div>
                        </div>
                    </div>
                    <h5 class="fs-17">পরিচালনা শুরু করুন</h5>
                    <p class="text-muted mb-0">খরচের হিসাব, মেনু প্ল্যানিং এবং অন্যান্য কার্যক্রম শুরু করুন</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center mb-5">
                    <h2 class="mb-3">ব্যবহারকারীদের <span class="text-primary">মতামত</span></h2>
                    <p class="text-muted fs-15">আমাদের সিস্টেম ব্যবহার করে এমন মেস ম্যানেজারদের অভিজ্ঞতা</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel owl-theme" id="testimonial-carousel">
                    <div class="item">
                        <div class="card testi-box">
                            <div class="card-body">
                                <div class="d-flex mb-4 align-items-center">
                                    <img src="{{asset('frontend/images/users/avatar-2.jpg')}}" class="rounded-circle avatar-sm" alt="">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-16 mb-0">আহসান হাবীব</h5>
                                        <p class="text-muted mb-0">মেস ম্যানেজার, ঢাকা</p>
                                    </div>
                                </div>
                                <div class="mb-4 pb-2">
                                    <p class="text-muted mb-0">"এই সিস্টেম ব্যবহার করে আমাদের মেসের মাসিক খরচ ২০% কমিয়েছি। হিসাব রাখা এখন অনেক সহজ।"</p>
                                </div>
                                <div class="text-warning">
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card testi-box">
                            <div class="card-body">
                                <div class="d-flex mb-4 align-items-center">
                                    <img src="{{asset('frontend/images/users/avatar-2.jpg')}}" class="rounded-circle avatar-sm" alt="">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-16 mb-0">ফারহানা আক্তার</h5>
                                        <p class="text-muted mb-0">ছাত্রী মেস মালিক, চট্টগ্রাম</p>
                                    </div>
                                </div>
                                <div class="mb-4 pb-2">
                                    <p class="text-muted mb-0">"খাবারের মেনু প্ল্যানিং এখন খুবই সহজ। সদস্যরা তাদের পছন্দ-অপছন্দ জানাতে পারে যা ব্যবস্থাপনাকে সহজ করে।"</p>
                                </div>
                                <div class="text-warning">
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-half-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card testi-box">
                            <div class="card-body">
                                <div class="d-flex mb-4 align-items-center">
                                    <img src="{{asset('frontend/images/users/avatar-2.jpg')}}" class="rounded-circle avatar-sm" alt="">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-16 mb-0">রফিকুল ইসলাম</h5>
                                        <p class="text-muted mb-0">পেশাদার মেস মালিক, সিলেট</p>
                                    </div>
                                </div>
                                <div class="mb-4 pb-2">
                                    <p class="text-muted mb-0">"বিল সংগ্রহ এবং হিসাব রাখার কাজটি এখন সম্পূর্ণ স্বয়ংক্রিয়। সময় বাঁচানোর জন্য অসাধারণ একটি সমাধান।"</p>
                                </div>
                                <div class="text-warning">
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-s-fill"></i>
                                    <i class="ri-star-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center mb-5">
                    <h2 class="mb-3">সাশ্রয়ী মূল্যের <span class="text-primary">প্যাকেজ</span></h2>
                    <p class="text-muted fs-15">আপনার চাহিদা অনুযায়ী সঠিক প্যাকেজ নির্বাচন করুন</p>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="card pricing-box">
                    <div class="card-body p-4 m-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">বেসিক</h5>
                                <p class="text-muted mb-0">ছোট মেসের জন্য</p>
                            </div>
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary bg-opacity-10 rounded-circle text-primary">
                                    <i class="ri-user-line fs-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <h2><sup><small>৳</small></sup>500<span class="fs-13 text-muted">/মাস</span></h2>
                        </div>
                        <hr class="my-4 text-muted">
                        <div>
                            <ul class="list-unstyled text-muted vstack gap-3">
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            সর্বোচ্চ ১০ সদস্য
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            মাসিক খরচ ট্র্যাকিং
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            মৌলিক রিপোর্টিং
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-danger me-1">
                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            অ্যাডভান্সড রিপোর্টিং
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-danger me-1">
                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            মাল্টি-মেস ব্যবস্থাপনা
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="#!" class="btn btn-soft-primary w-100">নির্বাচন করুন</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card pricing-box ribbon-box right">
                    <div class="card-body p-4 m-2">
                        <div class="ribbon ribbon-primary round-shape">সেরা অফার</div>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">স্ট্যান্ডার্ড</h5>
                                <p class="text-muted mb-0">মাঝারি আকারের মেসের জন্য</p>
                            </div>
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary bg-opacity-10 rounded-circle text-primary">
                                    <i class="ri-team-line fs-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <h2><sup><small>৳</small></sup>800<span class="fs-13 text-muted">/মাস</span></h2>
                        </div>
                        <hr class="my-4 text-muted">
                        <div>
                            <ul class="list-unstyled text-muted vstack gap-3">
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            সর্বোচ্চ ২০ সদস্য
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            ডেইলি খরচ ট্র্যাকিং
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            অ্যাডভান্সড রিপোর্টিং
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            মেনু প্ল্যানিং
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-danger me-1">
                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            মাল্টি-মেস ব্যবস্থাপনা
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="#!" class="btn btn-primary w-100">নির্বাচন করুন</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card pricing-box">
                    <div class="card-body p-4 m-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">প্রিমিয়াম</h5>
                                <p class="text-muted mb-0">বড় মেস বা একাধিক মেসের জন্য</p>
                            </div>
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary bg-opacity-10 rounded-circle text-primary">
                                    <i class="ri-building-4-line fs-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <h2><sup><small>৳</small></sup>1500<span class="fs-13 text-muted">/মাস</span></h2>
                        </div>
                        <hr class="my-4 text-muted">
                        <div>
                            <ul class="list-unstyled text-muted vstack gap-3">
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            সদস্য সীমাহীন
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            ডিটেইলড খরচ ট্র্যাকিং
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            কাস্টম রিপোর্টিং
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            মাল্টি-মেস ব্যবস্থাপনা
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 text-success me-1">
                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            প্রায়োরিটি সাপোর্ট
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="#!" class="btn btn-soft-primary w-100">নির্বাচন করুন</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center mb-5">
                    <h2 class="mb-3">সচরাচর জিজ্ঞাসিত <span class="text-primary">প্রশ্নাবলী</span></h2>
                    <p class="text-muted fs-15">আপনার মনে থাকা সাধারণ প্রশ্নগুলোর উত্তর</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                এই সিস্টেম ব্যবহার করতে কি প্রযুক্তিগত জ্ঞান প্রয়োজন?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="text-muted mb-0">না, আমাদের সিস্টেম ব্যবহার করা খুবই সহজ। মোবাইল বা কম্পিউটার ব্যবহার করতে পারলেই আপনি এটি ব্যবহার করতে পারবেন। আমরা ব্যবহারকারী বান্ধব ইন্টারফেস প্রদান করি।</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                আমার ডেটা কতটা নিরাপদ?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="text-muted mb-0">আমরা আধুনিক এনক্রিপশন প্রযুক্তি ব্যবহার করে আপনার সমস্ত ডেটা সুরক্ষিত রাখি। শুধুমাত্র আপনার অনুমতিপ্রাপ্ত ব্যবহারকারীরা ডেটা দেখতে পারবে।</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                প্যাকেজ পরিবর্তন করা যাবে কি?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="text-muted mb-0">হ্যাঁ, আপনি যেকোনো সময় আপনার প্যাকেজ আপগ্রেড বা ডাউনগ্রেড করতে পারবেন। নতুন প্যাকেজের বিলিং পরবর্তী বিলিং সাইকেল থেকে কার্যকর হবে।</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                ফ্রি ট্রায়াল আছে কি?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="text-muted mb-0">হ্যাঁ, আমরা ১৪ দিনের ফ্রি ট্রায়াল প্রদান করি। ট্রায়াল পিরিয়ড শেষ হওয়ার পর আপনি আমাদের যেকোনো প্যাকেজ নির্বাচন করতে পারবেন।</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary position-relative">
    <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-sm">
                <div>
                    <h4 class="text-white mb-2">শুরু করতে প্রস্তুত?</h4>
                    <p class="text-white-50 mb-0">একটি নতুন অ্যাকাউন্ট তৈরি করুন এবং আপনার মেস পরিচালনা শুরু করুন</p>
                </div>
            </div>
            <div class="col-sm-auto">
                <div>
                    <a href="#!" class="btn bg-gradient btn-danger">ফ্রি অ্যাকাউন্ট তৈরি করুন</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection