<aside id="business_sidebar" class="business_sidebar">
    <div class="business_sidebar_top">
        <div class="business_sidebar_logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="184" height="40" viewBox="0 0 184 40" fill="none">
                <g clip-path="url(#clip0_33863_2918)">
                    <!-- SVG paths remain unchanged -->
                </g>
                <defs>
                    <clipPath id="clip0_33863_2918">
                        <rect width="183.912" height="39.98" fill="white" />
                    </clipPath>
                </defs>
            </svg>
        </div>

        <div class="business_sidebar_menu">
            <ul class="business_sidebar_menu_list">
                <li class="business_sidebar_menu_list_item">
                    <a href="/business-home.html" class="business_sidebar_menu_link active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path d="M9.02 3.82005L3.63 8.02005C2.73 8.72005 2 10.2101 2 11.3401V18.7501C2 21.0701 3.89 22.9701 6.21 22.9701H17.79C20.11 22.9701 22 21.0701 22 18.7601V11.4801C22 10.2701 21.19 8.72005 20.2 8.03005L14.02 3.70005C12.62 2.72005 10.37 2.77005 9.02 3.82005Z" stroke="#FB8C00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 18.97V15.97" stroke="#FB8C00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        হোম
                    </a>
                </li>

                <li class="business_sidebar_menu_list_item">
                    <a href="{{route('market.list')}}" class="business_sidebar_menu_link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path d="M8 2.98004V5.98004" stroke="#2E1A00" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 2.98004V5.98004" stroke="#2E1A00" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21 9.48004V17.98C21 20.98 19.5 22.98 16 22.98H8C4.5 22.98 3 20.98 3 17.98V9.48004C3 6.48004 4.5 4.48004 8 4.48004H16C19.5 4.48004 21 6.48004 21 9.48004Z" stroke="#2E1A00" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 11.98H16" stroke="#2E1A00" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 16.98H12" stroke="#2E1A00" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        বাজার যোগ করুন
                    </a>
                </li>
                @if (Auth::user()->role == 'manager')
                    <li class="business_sidebar_menu_list_item">
                        <a href="{{route('member.list')}}" class="business_sidebar_menu_link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                <path d="M8 12.98H16" stroke="#2E1A00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 16.98V8.98004" stroke="#2E1A00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 22.98H15C20 22.98 22 20.98 22 15.98V9.98004C22 4.98004 20 2.98004 15 2.98004H9C4 2.98004 2 4.98004 2 9.98004V15.98C2 20.98 4 22.98 9 22.98Z" stroke="#2E1A00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            নতুন সদস্য
                        </a>
                    </li>
                @else
                    <style>
                        .business_sidebar_menu_list_item:nth-child(4) {
                            display: none;
                        }
                    </style>
                @endif

                <li class="business_sidebar_menu_list_item">
                    <a href="{{route('meal.list')}}" class="business_sidebar_menu_link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path d="M12 21.98C14.4853 21.98 16.7353 20.9727 18.3639 19.344C19.9926 17.7153 21 15.4653 21 12.98C21 10.4948 19.9926 8.24478 18.3639 6.61608C16.7353 4.9874 14.4853 3.98004 12 3.98004C9.51474 3.98004 7.26474 4.9874 5.63604 6.61608C4.00736 8.24478 3 10.4948 3 12.98C3 15.4653 4.00736 17.7153 5.63604 19.344C7.26474 20.9727 9.51474 21.98 12 21.98Z" stroke="#2E1A00" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M12 14.98V13.23C13.6568 13.23 15 12.0548 15 10.605C15 9.1553 13.6568 7.98004 12 7.98004C10.3432 7.98004 9 9.1553 9 10.605" stroke="#2E1A00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18.98C12.5523 18.98 13 18.5323 13 17.98C13 17.4278 12.5523 16.98 12 16.98C11.4477 16.98 11 17.4278 11 17.98C11 18.5323 11.4477 18.98 12 18.98Z" fill="#2E1A00" />
                        </svg>
                        উপস্থিতি
                    </a>
                </li>
                <li class="business_sidebar_menu_list_item">
                    <a href="{{ route('meals.monthly') }}" class="business_sidebar_menu_link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path d="M12 21.98C14.4853 21.98 16.7353 20.9727 18.3639 19.344C19.9926 17.7153 21 15.4653 21 12.98C21 10.4948 19.9926 8.24478 18.3639 6.61608C16.7353 4.9874 14.4853 3.98004 12 3.98004C9.51474 3.98004 7.26474 4.9874 5.63604 6.61608C4.00736 8.24478 3 10.4948 3 12.98C3 15.4653 4.00736 17.7153 5.63604 19.344C7.26474 20.9727 9.51474 21.98 12 21.98Z" stroke="#2E1A00" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M12 16.98C12.5523 16.98 13 16.5323 13 15.98C13 15.4278 12.5523 14.98 12 14.98C11.4477 14.98 11 15.4278 11 15.98C11 16.5323 11.4477 16.98 12 16.98Z" fill="#2E1A00" />
                        </svg>
                        সকল উপস্থিতি তথ্য
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="business_sidebar_bottom">
        <div class="business_sidebar_bottom_logout">
            <button type="button" class="business_sidebar_bottom_logout_btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M8.33301 14.1667L12.4997 10L8.33301 5.83337" stroke="#FB8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.5 10H2.5" stroke="#FB8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.5 2.5H15.8333C16.2754 2.5 16.6993 2.67559 17.0118 2.98816C17.3244 3.30072 17.5 3.72464 17.5 4.16667V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H12.5" stroke="#FB8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>লগআউট
            </button>
        </div>

        <div class="business_sidebar_bottom_user">
            <div class="business_sidebar_bottom_user_img">
                <img src="frontend/images/user.png" alt="ব্যবহারকারী" />
            </div>
            <div class="business_sidebar_bottom_user_text">
                <h6 class="business_sidebar_bottom_user_name">সোমর এমকে</h6>
                <a href="/business-view-profile.html" class="business_sidebar_bottom_user_info">প্রোফাইল দেখুন</a>

                <div class="business_sidebar_bottom_user_icon">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
            </div>
        </div>
    </div>
</aside>
