@extends('frontend.app')
@section('title', 'মেস ম্যানেজমেন্ট সিস্টেম')
@section('content')
<main>
    <!-- Hero Section Start -->
    <section class="hero_section">
        <div class="container">
            <div class="hero_section_wrapper">
                <div class="hero_section_left">
                    <h1 class="hero_section_title">
                        আপনার মেস, আমাদের ব্যবস্থাপনা। সহজ ও স্মার্ট!
                    </h1>
                    <p class="hero_section_text">
                        খাবার পরিকল্পনা, খরচ ট্র্যাকিং এবং সদস্য ব্যবস্থাপনা এক জায়গায়। <br />
                        কোনো ঝামেলা ছাড়াই মেস পরিচালনা করুন!
                    </p>

                    <div class="hero_left_rating">
                        <div class="hero_left_rating_img">
                            <img src="frontend/images/hero-rating.png" alt="রেটিং" />
                        </div>
                        <div class="hero_left_rating_text">
                            <h6 class="hero_left_rating_title">৩৫০০+ রেটিং</h6>
                            <div class="hero_left_rating_stars">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path
                                        d="M15.9583 6.32491C15.9071 6.16636 15.8104 6.02637 15.6802 5.92239C15.5501 5.81842 15.3922 5.75506 15.2262 5.74021L10.6082 5.32085L8.78209 1.04668C8.6474 0.733454 8.34077 0.530762 8.00007 0.530762C7.65938 0.530762 7.35271 0.733486 7.21808 1.04746L5.39197 5.32088L0.7732 5.74021C0.607451 5.75539 0.449802 5.81889 0.3198 5.92282C0.189799 6.02676 0.0931609 6.16657 0.0418688 6.32491C-0.0634776 6.64892 0.0338061 7.00427 0.290531 7.22828L3.78125 10.2896L2.75191 14.8238C2.67659 15.1572 2.80597 15.5018 3.0826 15.7017C3.23126 15.8092 3.40524 15.8639 3.58065 15.8639C3.7319 15.8639 3.8819 15.8231 4.0166 15.7425L8.00007 13.3617L11.9821 15.7425C12.2735 15.9178 12.6408 15.9018 12.9168 15.7017C13.0519 15.6039 13.1553 15.4686 13.2141 15.3125C13.2729 15.1564 13.2845 14.9864 13.2475 14.8238L12.2182 10.2896L15.7089 7.2289C15.8345 7.11923 15.925 6.97508 15.9694 6.81437C16.0137 6.65365 16.0099 6.48345 15.9583 6.32491Z"
                                        fill="#FFC107" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path
                                        d="M15.9583 6.32491C15.9071 6.16636 15.8104 6.02637 15.6802 5.92239C15.5501 5.81842 15.3922 5.75506 15.2262 5.74021L10.6082 5.32085L8.78209 1.04668C8.6474 0.733454 8.34077 0.530762 8.00007 0.530762C7.65938 0.530762 7.35271 0.733486 7.21808 1.04746L5.39197 5.32088L0.7732 5.74021C0.607451 5.75539 0.449802 5.81889 0.3198 5.92282C0.189799 6.02676 0.0931609 6.16657 0.0418688 6.32491C-0.0634776 6.64892 0.0338061 7.00427 0.290531 7.22828L3.78125 10.2896L2.75191 14.8238C2.67659 15.1572 2.80597 15.5018 3.0826 15.7017C3.23126 15.8092 3.40524 15.8639 3.58065 15.8639C3.7319 15.8639 3.8819 15.8231 4.0166 15.7425L8.00007 13.3617L11.9821 15.7425C12.2735 15.9178 12.6408 15.9018 12.9168 15.7017C13.0519 15.6039 13.1553 15.4686 13.2141 15.3125C13.2729 15.1564 13.2845 14.9864 13.2475 14.8238L12.2182 10.2896L15.7089 7.2289C15.8345 7.11923 15.925 6.97508 15.9694 6.81437C16.0137 6.65365 16.0099 6.48345 15.9583 6.32491Z"
                                        fill="#FFC107" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path
                                        d="M15.9583 6.32491C15.9071 6.16636 15.8104 6.02637 15.6802 5.92239C15.5501 5.81842 15.3922 5.75506 15.2262 5.74021L10.6082 5.32085L8.78209 1.04668C8.6474 0.733454 8.34077 0.530762 8.00007 0.530762C7.65938 0.530762 7.35271 0.733486 7.21808 1.04746L5.39197 5.32088L0.7732 5.74021C0.607451 5.75539 0.449802 5.81889 0.3198 5.92282C0.189799 6.02676 0.0931609 6.16657 0.0418688 6.32491C-0.0634776 6.64892 0.0338061 7.00427 0.290531 7.22828L3.78125 10.2896L2.75191 14.8238C2.67659 15.1572 2.80597 15.5018 3.0826 15.7017C3.23126 15.8092 3.40524 15.8639 3.58065 15.8639C3.7319 15.8639 3.8819 15.8231 4.0166 15.7425L8.00007 13.3617L11.9821 15.7425C12.2735 15.9178 12.6408 15.9018 12.9168 15.7017C13.0519 15.6039 13.1553 15.4686 13.2141 15.3125C13.2729 15.1564 13.2845 14.9864 13.2475 14.8238L12.2182 10.2896L15.7089 7.2289C15.8345 7.11923 15.925 6.97508 15.9694 6.81437C16.0137 6.65365 16.0099 6.48345 15.9583 6.32491Z"
                                        fill="#FFC107" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path
                                        d="M15.9583 6.32491C15.9071 6.16636 15.8104 6.02637 15.6802 5.92239C15.5501 5.81842 15.3922 5.75506 15.2262 5.74021L10.6082 5.32085L8.78209 1.04668C8.6474 0.733454 8.34077 0.530762 8.00007 0.530762C7.65938 0.530762 7.35271 0.733486 7.21808 1.04746L5.39197 5.32088L0.7732 5.74021C0.607451 5.75539 0.449802 5.81889 0.3198 5.92282C0.189799 6.02676 0.0931609 6.16657 0.0418688 6.32491C-0.0634776 6.64892 0.0338061 7.00427 0.290531 7.22828L3.78125 10.2896L2.75191 14.8238C2.67659 15.1572 2.80597 15.5018 3.0826 15.7017C3.23126 15.8092 3.40524 15.8639 3.58065 15.8639C3.7319 15.8639 3.8819 15.8231 4.0166 15.7425L8.00007 13.3617L11.9821 15.7425C12.2735 15.9178 12.6408 15.9018 12.9168 15.7017C13.0519 15.6039 13.1553 15.4686 13.2141 15.3125C13.2729 15.1564 13.2845 14.9864 13.2475 14.8238L12.2182 10.2896L15.7089 7.2289C15.8345 7.11923 15.925 6.97508 15.9694 6.81437C16.0137 6.65365 16.0099 6.48345 15.9583 6.32491Z"
                                        fill="#FFC107" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path
                                        d="M15.9583 6.32491C15.9071 6.16636 15.8104 6.02637 15.6802 5.92239C15.5501 5.81842 15.3922 5.75506 15.2262 5.74021L10.6082 5.32085L8.78209 1.04668C8.6474 0.733454 8.34077 0.530762 8.00007 0.530762C7.65938 0.530762 7.35271 0.733486 7.21808 1.04746L5.39197 5.32088L0.7732 5.74021C0.607451 5.75539 0.449802 5.81889 0.3198 5.92282C0.189799 6.02676 0.0931609 6.16657 0.0418688 6.32491C-0.0634776 6.64892 0.0338061 7.00427 0.290531 7.22828L3.78125 10.2896L2.75191 14.8238C2.67659 15.1572 2.80597 15.5018 3.0826 15.7017C3.23126 15.8092 3.40524 15.8639 3.58065 15.8639C3.7319 15.8639 3.8819 15.8231 4.0166 15.7425L8.00007 13.3617L11.9821 15.7425C12.2735 15.9178 12.6408 15.9018 12.9168 15.7017C13.0519 15.6039 13.1553 15.4686 13.2141 15.3125C13.2729 15.1564 13.2845 14.9864 13.2475 14.8238L12.2182 10.2896L15.7089 7.2289C15.8345 7.11923 15.925 6.97508 15.9694 6.81437C16.0137 6.65365 16.0099 6.48345 15.9583 6.32491Z"
                                        fill="#FFC107" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="hero_left_btns">
                        <a href="/register" class="hero_left_join_btn">
                            এখনই যোগ দিন <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="hero_section_right">
                    <div class="hero-right-main-image">
                        <img src="frontend/images/qna-left.png" alt="মেস ব্যানার" />
                    </div>

                    <img class="hero_right_shadow_top" src="frontend/images/shadow-white.png" alt="" />
                    <img class="hero_right_shadow_bottom" src="frontend/images/shadow-white.png" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Mess Management Section Start -->
    <section class="about_feedback_section">
        <div class="container">
            <div class="about_feedback_wrapper">
                <div class="about_feedback_top">
                    <h2 class="about_feedback_section_title section_title">
                        মেস ম্যানেজমেন্ট সম্পর্কে
                    </h2>
                </div>
                <div class="about_feedback_bottom">
                    <div class="about_feedback_item">
                        <div class="about_feedback_item_top">
                            <h5>১০০% <span>সময় সাশ্রয়</span></h5>
                        </div>
                        <div class="about_feedback_item_bottom">
                            <h5 class="about_feedback_item_bottom_title">
                                সহজ ব্যবস্থাপনা
                            </h5>
                            <p class="about_feedback_item_bottom_text">
                                আমাদের সিস্টেম খাবার পরিকল্পনা, খরচ ট্র্যাকিং এবং সদস্য ব্যবস্থাপনাকে সহজ করে, যাতে আপনি সময় বাঁচাতে পারেন।
                            </p>
                        </div>
                    </div>
                    <div class="about_feedback_item">
                        <div class="about_feedback_item_top">
                            <h5>৯০% <span>১ বছরে বৃদ্ধি</span></h5>
                        </div>
                        <div class="about_feedback_item_bottom">
                            <h5 class="about_feedback_item_bottom_title">
                                সঠিক হিসাব
                            </h5>
                            <p class="about_feedback_item_bottom_text">
                                বাজার খরচ এবং সদস্যদের আমানত সঠিকভাবে ট্র্যাক করে মেসের আর্থিক ব্যবস্থাপনাকে শক্তিশালী করুন।
                            </p>
                        </div>
                    </div>
                    <div class="about_feedback_item">
                        <div class="about_feedback_item_top">
                            <h5>৮৫% <span>সদস্য সন্তুষ্টি</span></h5>
                        </div>
                        <div class="about_feedback_item_bottom">
                            <h5 class="about_feedback_item_bottom_title">
                                স্বচ্ছতা
                            </h5>
                            <p class="about_feedback_item_bottom_text">
                                প্রতিটি সদস্যের খরচ এবং মিলের হিসাব স্বচ্ছভাবে দেখুন, যাতে কোনো বিভ্রান্তি না থাকে।
                            </p>
                        </div>
                    </div>
                    <div class="about_feedback_item">
                        <div class="about_feedback_item_top">
                            <h5>৭৫% <span>দক্ষতা বৃদ্ধি</span></h5>
                        </div>
                        <div class="about_feedback_item_bottom">
                            <h5 class promen="about_feedback_item_bottom_title">
                                স্মার্ট পরিকল্পনা
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <img class="about_feedback_bg" src="frontend/images/mess-bg.png" alt="মেস ব্যাকগ্রাউন্ড" />
        </div>
    </section>
    <!-- About Mess Management Section End -->

    <!-- QNA Section Start -->
    <section class="qna_section">
        <div class="container">
            <div class="qna_wrapper">
                <div class="qna_left">
                    <h3 class="qna_left_title">আমাদের সম্পর্কে আরও জানুন</h3>
                    <p class="qna_left_text">
                        আমাদের মেস ম্যানেজমেন্ট সিস্টেম আপনার দৈনন্দিন মেস পরিচালনাকে আরও সহজ ও কার্যকর করে। আমাদের সাথে যোগ দিন এবং অভিজ্ঞতা নিন।
                    </p>
                    <a href="/register" class="qna_left_join_btn">এখনই যোগ দিন <i
                            class="fa-solid fa-arrow-right"></i></a>

                    <div class="qna_left_img">
                        <img src="frontend/images/mess-qna.png" alt="প্রশ্নোত্তর ছবি" />
                    </div>
                </div>
                <div class="qna_right">
                    <!-- bs accordion starts -->
                    <div class="accordion accordion-wrapper" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    মেস ম্যানেজমেন্ট সিস্টেম কীভাবে কাজ করে?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="accordion_body_text">
                                        আমাদের সিস্টেম খাবার পরিকল্পনা, খরচ ট্র্যাকিং এবং সদস্য ব্যবস্থাপনার জন্য একটি সহজ প্ল্যাটফর্ম প্রদান করে। আপনি সহজেই মিল হিসাব করতে পারেন এবং বাজার খরচ নিয়ন্ত্রণ করতে পারেন।
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    কীভাবে বাজার খরচ ট্র্যাক করবেন?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="accordion_body_text">
                                        আপনি প্রতিদিনের বাজার তালিকা যোগ করতে পারেন এবং সিস্টেম স্বয়ংক্রিয়ভাবে খরচ হিসাব করে সদস্যদের মধ্যে ভাগ করে দেয়।
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    সদস্যদের তথ্য কীভাবে সুরক্ষিত থাকে?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="accordion_body_text">
                                        আমরা উন্নত নিরাপত্তা ব্যবস্থা ব্যবহার করি যাতে সদস্যদের তথ্য সুরক্ষিত থাকে এবং শুধুমাত্র অনুমোদিত ব্যক্তিরা এটি অ্যাক্সেস করতে পারে।
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    কেন আমাদের সিস্টেম বেছে নেবেন?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="accordion_body_text">
                                        আমাদের সিস্টেম সহজ, ব্যবহারকারী-বান্ধব এবং সময় সাশ্রয়ী। এটি মেস পরিচালনার প্রতিটি দিককে সুগম করে।
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">
                                    কীভাবে মিল পরিকল্পনা করবেন?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="headingFive">
                                <div class="accordion-body">
                                    <p class="accordion_body_text">
                                        আপনি দৈনিক বা সাপ্তাহিক মিল পরিকল্পনা তৈরি করতে পারেন এবং সদস্যদের উপস্থিতি ও পছন্দ অনুযায়ী হিসাব করতে পারেন।
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                    aria-controls="collapseSix">
                                    কীভাবে শুরু করবেন?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse"
                                aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="accordion_body_text">
                                        একটি ফ্রি অ্যাকাউন্ট তৈরি করুন, আপনার মেসের তথ্য যোগ করুন এবং ম্যানেজমেন্ট শুরু করুন!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- bs accordion ends -->
                </div>
            </div>
        </div>
    </section>
    <!-- QNA Section End -->

    <!-- Our Team Section Start -->
    <section class="our_team_section">
        <div class="container">
            <div class="our_team_wrapper">
                <div class="our_team_top">
                    <h2 class="our_team_section_title section_title">
                        আমাদের টিমের সাথে পরিচিত হন
                    </h2>
                    <p class="our_team_section_text">
                        আমাদের দক্ষ টিম মেস ম্যানেজমেন্ট সিস্টেমকে আরও উন্নত করতে নিরলস কাজ করে যাচ্ছে।
                    </p>
                </div>
                <div class="our_team_bottom">
                    <div class="our_team_item">
                        <div class="our_team_item_img">
                            <img src="frontend/images/team1.png" alt="টিম সদস্য" />
                        </div>
                        <div class="our_team_item_text">
                            <h6 class="our_team_item_title">আল মামুন</h6>
                            <p class="our_team_item_position">প্রতিষ্ঠাতা</p>
                        </div>
                    </div>
                    <div class="our_team_item">
                        <div class="our_team_item_img">
                            <img src="frontend/images/team2.png" alt="টিম সদস্য" />
                        </div>
                        <div class="our_team_item_text">
                            <h6 class="our_team_item_title">মিডুল হাসান</h6>
                            <p class="our_team_item_position">প্রোগ্রামার</p>
                        </div>
                    </div>
                    <div class="our_team_item">
                        <div class="our_team_item_img">
                            <img src="frontend/images/team3.png" alt="টিম সদস্য" />
                        </div>
                        <div class="our_team_item_text">
                            <h6 class="our_team_item_title">রহিম খান</h6>
                            <p class="our_team_item_position">ডিজাইনার</p>
                        </div>
                    </div>
                    <div class="our_team_item">
                        <div class="our_team_item_img">
                            <img src="frontend/images/team4.png" alt="টিম সদস্য" />
                        </div>
                        <div class="our_team_item_text">
                            <h6 class="our_team_item_title">করিম আলী</h6>
                            <p class="our_team_item_position">সাপোর্ট ম্যানেজার</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Team Section End -->

    <!-- Contact Us Section Start -->
    <section class="contact_us_section"
        style="
      background: url(frontend/images/contact-bg.png) no-repeat center/cover;
    ">
        <div class="container">
            <div class="contact_us_wrapper">
                <h2 class="contact_us_title">
                    কোনো প্রশ্ন থাকলে আমাদের সাথে যোগাযোগ করুন
                </h2>

                <ul class="contact_us_btns">
                    <li>
                        <a href="/register" class="contact_btn">
                            এখনই যোগ দিন <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="tel:+8801234567890" class="contact_btn">
                            <i class="fa-solid fa-phone"></i> +৮৮০১২৩৪৫৬৭৮৯০
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Contact Us Section End -->
</main>
@endsection
