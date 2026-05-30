<?php
$Page = "User_Side";
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Campus Nav — PSU's official web room locator, scheduling system, and laboratory attendance & monitoring platform.">
        <title>Navi Track • User</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="user.css">


    </head>
    <body class="bg-[#0A2540] text-white overflow-x-hidden">

        <!-- ============================================================
            LOADING SCREEN
        ============================================================ -->
        <div id="loading-screen">
            <div class="ls-glow"></div>

            <div style="position:relative; text-align:center; display:flex; flex-direction:column; align-items:center;">

                <!-- Compass -->
                <div class="ls-compass-wrap">
                    <!-- Outer dashed ring -->
                    <svg class="ls-ring" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="60" cy="60" r="55" stroke="#E8B923" stroke-width="1.5"
                                stroke-dasharray="5 4" stroke-linecap="round" opacity="0.5"/>
                        <!-- Cardinal ticks -->
                        <rect x="58.5" y="3"  width="3" height="9" rx="1.5" fill="#E8B923"/>
                        <rect x="58.5" y="108" width="3" height="9" rx="1.5" fill="#E8B923" opacity="0.35"/>
                        <rect x="3"   y="58.5" width="9" height="3" rx="1.5" fill="#E8B923" opacity="0.35"/>
                        <rect x="108" y="58.5" width="9" height="3" rx="1.5" fill="#E8B923" opacity="0.35"/>
                    </svg>

                    <!-- Inner dotted ring -->
                    <svg class="ls-ring-inner" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="46" stroke="#E8B923" stroke-width="1"
                                stroke-dasharray="2 6" stroke-linecap="round" opacity="0.3"/>
                    </svg>

                    <!-- Gold disc + needle -->
                    <div class="ls-disc">
                        <div style="position:relative; width:100%; height:100%;">
                            <div class="ls-needle"></div>
                        </div>
                    </div>
                </div>

                <!-- Brand -->
                <div class="ls-brand">Navi Track</div>
                <div class="ls-tagline">Pangasinan State University Bayambang Campus</div>

                <!-- Progress -->
                <div class="ls-progress-wrap">
                    <div class="ls-progress-meta">
                        <span class="ls-status" id="ls-status">Initializing</span>
                        <span class="ls-pct"    id="ls-pct">0%</span>
                    </div>
                    <div class="ls-track">
                        <div class="ls-fill" id="ls-fill"></div>
                    </div>
                </div>

                <!-- Dots -->
                <div class="ls-dots">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>

        <!-- NAVBAR -->
        <nav class="sticky top-0 z-50 bg-[#0A2540]/95 backdrop-blur-lg border-b border-white/10">

    <div class="max-w-screen-2xl mx-auto px-6 md:px-8 py-5 flex items-center justify-between">

    <div class="flex items-center gap-x-3">


        <div class="flex items-center gap-x-3">
        <div class="w-10 h-10 flex items-center justify-center">
            <img 
                src="Logo.png" 
                alt="Pangasinan State University Logo" 
                class="w-full h-full object-contain rounded-full"
            >
        </div>
        
        <h1 class="display-font text-3xl tracking-[-1px]">Navi Track</h1>
        <span class="px-3 py-px text-xs font-medium bg-[#E8B923] text-[#0A2540] rounded-3xl -mt-1">
            Pangasinan State University Bayambang Campus
        </span>
    </div>
                <div class="hidden md:flex items-center gap-x-10 text-sm font-medium">
                    <a href="#hero"       class="nav-link cursor-pointer">Home</a>
                    <a href="#features"   class="nav-link cursor-pointer">Features</a>
                    <a href="#locator"    class="nav-link cursor-pointer">Room Locator</a>
                    <a href="#schedule"   class="nav-link cursor-pointer">Schedules</a>
                    <a href="#about"      class="nav-link cursor-pointer">About</a>
                </div>

                <div class="flex items-center justify-end gap-x-6">
        <!-- Login Button -->
        <button onclick="showLoginModal()"
                class="px-6 py-2.5 text-sm font-semibold border border-[#E8B923] text-[#E8B923] rounded-3xl hover:bg-[#E8B923] hover:text-[#0A2540] flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7" />
            </svg>
            Login
        </button>


        <!-- Mobile Menu Button -->
        <button onclick="toggleMobileMenu()" class="md:hidden w-11 h-11 flex items-center justify-center">
            <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
            <div id="mobile-menu" class="hidden md:hidden bg-[#0A2540] border-t border-white/10 px-8 py-8">
                <div class="flex flex-col gap-y-6 text-lg font-medium">
                    <a href="#hero"       onclick="toggleMobileMenu()" class="nav-link">Home</a>
                    <a href="#features"   onclick="toggleMobileMenu()" class="nav-link">Features</a>
                    <a href="#locator"    onclick="toggleMobileMenu()" class="nav-link">Room Locator</a>
                    <a href="#schedule"   onclick="toggleMobileMenu()" class="nav-link">Schedules</a>
                    <a href="#about"      onclick="toggleMobileMenu()" class="nav-link">About</a>
                    <div class="pt-6 border-t border-white/10">
                        <button onclick="toggleMobileMenu();showLoginModal()"
                                class="w-full py-4 bg-[#E8B923] text-[#0A2540] rounded-3xl font-semibold flex justify-center items-center gap-x-2">
                            Sign in to your PSU account
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- HERO -->
        <section id="hero" class="hero-bg min-h-screen flex items-center relative pt-20">
            <div class="max-w-screen-2xl mx-auto px-8 grid md:grid-cols-12 gap-12 items-center">
                <div class="md:col-span-7">
                    <div class="inline-flex items-center gap-x-2 bg-white/10 text-white text-sm font-medium px-6 py-2 rounded-3xl mb-8 backdrop-blur-md border border-white/20">
                        <div class="w-2 h-2 bg-[#E8B923] rounded-full animate-pulse"></div>
                        LIVE • Now serving 169 students &amp; faculty
                    </div>
                    <h1 class="display-font text-7xl md:text-8xl leading-[1.05] tracking-[-3px] max-w-2xl">
                        Navigate.<br>Schedule.<br>Monitor.
                    </h1>
                    <p class="mt-6 text-2xl text-white/80 max-w-lg">
                        PSU's all-in-one campus companion.<br>
                        Room locator • Smart scheduling • Lab attendance &amp; monitoring
                    </p>
                    <div class="flex flex-wrap gap-4 mt-10">
                        <button onclick="smoothScrollTo('locator')"
                                class="px-10 py-5 bg-[#E8B923] hover:bg-white text-[#0A2540] text-xl font-semibold rounded-3xl flex items-center gap-x-3 group">
                            Find a room now
                            <span class="text-3xl group-active:rotate-12"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
    <path d="M11.584 2.376a.75.75 0 0 1 .832 0l9 6a.75.75 0 1 1-.832 1.248L12 3.901 3.416 9.624a.75.75 0 0 1-.832-1.248l9-6Z" />
    <path fillRule="evenodd" d="M20.25 10.332v9.918H21a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1 0-1.5h.75v-9.918a.75.75 0 0 1 .634-.74A49.109 49.109 0 0 1 12 9c2.59 0 5.134.202 7.616.592a.75.75 0 0 1 .634.74Zm-7.5 2.418a.75.75 0 0 0-1.5 0v6.75a.75.75 0 0 0 1.5 0v-6.75Zm3-.75a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 1-1.5 0v-6.75a.75.75 0 0 1 .75-.75ZM9 12.75a.75.75 0 0 0-1.5 0v6.75a.75.75 0 0 0 1.5 0v-6.75Z" clipRule="evenodd" />
    <path d="M12 7.875a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" />
    </svg>
    </span>
                        </button>
                        <button onclick="smoothScrollTo('schedule')"
                                class="px-8 py-5 border-2 border-white/70 hover:border-[#E8B923] text-white text-xl font-medium rounded-3xl">
                            Open my schedule
                        </button>
                    </div>
                    <div class="mt-16 flex items-center gap-x-12 text-sm">
                        <div class="flex -space-x-6">
                            <div class="w-9 h-9 bg-[#E8B923] text-[#0A2540] rounded-2xl flex items-center justify-center text-xl ring-4 ring-[#0A2540]">👩‍🎓</div>
                            <div class="w-9 h-9 bg-[#0A2540] text-white rounded-2xl flex items-center justify-center text-xl ring-4 ring-[#0A2540]">🧪</div>
                            <div class="w-9 h-9 bg-white text-[#0A2540] rounded-2xl flex items-center justify-center text-xl ring-4 ring-[#0A2540]">📍</div>    
                        </div>
                        <p class="text-white/70 max-w-[220px]">
                            Used daily by <span class="text-[#E8B923] font-semibold">every college</span> at Pangasinan State University Bayambang Campus
                        </p>
                    </div>
                </div>

                <div class="md:col-span-5 relative">
                    <div class="bg-white/5 backdrop-blur-3xl border border-white/10 rounded-3xl p-3 shadow-2xl">
                        <div class="bg-[#001A33] rounded-3xl p-6 relative overflow-hidden">
                            <div class="aspect-[9/16] bg-gradient-to-br from-[#0A2540] to-[#001F3F] rounded-3xl flex flex-col p-4 border border-[#E8B923]/30">
                                <div class="flex justify-between text-xs mb-6 px-2">
                                    <div>9:41</div>
                                    <div class="flex items-center gap-x-1">98% <span class="text-[#E8B923]"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
    <path fillRule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clipRule="evenodd" />
    </svg>
    </span></div>
                                </div>
                                <div class="text-center mb-8">
                                    <div class="inline-flex bg-[#E8B923] text-[#0A2540] text-xs font-bold px-6 py-1 rounded-3xl items-center gap-x-2">
                                        <span class="relative flex h-3 w-3">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#0A2540] opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-[#0A2540]"></span>
                                        </span>
                                        LIVE CAMPUS
                                    </div>
                                </div>
                                <div class="flex-1 bg-[#0A2540] rounded-2xl p-4 flex items-center justify-center relative">
                                    <div class="text-center">
                                        <div class="text-6xl mb-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
    <path fillRule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clipRule="evenodd" />
    </svg></div>
                                        <p class="text-[#E8B923] text-xl font-medium">You are here</p>
                                        <p class="text-white/60 mt-1">Room 104 • Cast Building</p>
                                        <div class="mt-8 flex justify-center gap-x-8">
                                            <div class="flex flex-col items-center">
                                                <div class="w-4 h-4 bg-[#E8B923] rounded-full room-dot"></div>
                                                <div class="h-12 w-px bg-gradient-to-b from-[#E8B923] to-transparent"></div>
                                            </div>
                                            <div class="text-white/40 text-2xl">→</div>
                                            <div class="flex flex-col items-center">
                                                <div class="w-4 h-4 bg-[#E8B923] rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center text-xs mt-4 text-white/60 font-medium">Next class in 12 minutes • Cast Lab 2 is OPEN</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-[#E8B923] text-[#0A2540] text-sm font-bold px-5 py-2 rounded-3xl flex items-center gap-x-2 shadow-xl rotate-[-8deg]">
                        <span>169 users online</span>
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-10 left-1/2 flex flex-col items-center gap-y-1 text-xs opacity-60">
                <div class="animate-bounce">↓</div>
                <span>Scroll for more info</span>
            </div>
        </section>

        <!-- FEATURES -->
        <section id="features" class="max-w-screen-2xl mx-auto px-8 py-24">
            <div class="text-center mb-16">
                <span class="px-5 py-1 bg-white/10 text-[#E8B923] text-sm font-semibold rounded-3xl">BSIT-WMT-2-1</span>
                <h2 class="display-font text-5xl mt-4 tracking-[-1px]">One platform.<br>Three campus needs.</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="card-hover bg-white/5 border border-white/10 rounded-3xl p-8 flex flex-col">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-compass"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336zm-5 14.66a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m3.684 -10.949l-6 2a1 1 0 0 0 -.633 .633l-2.007 6.026l-.023 .086l-.017 .113l-.004 .068v.044l.009 .111l.012 .07l.04 .144l.045 .1l.054 .095l.064 .09l.069 .075l.084 .074l.098 .07l.1 .054l.078 .033l.105 .033l.109 .02l.043 .005l.068 .004h.044l.111 -.009l.07 -.012l.02 -.006l.019 -.002l.074 -.022l6 -2a1 1 0 0 0 .633 -.633l2 -6a1 1 0 0 0 -1.265 -1.265zm-1.265 2.529l-1.21 3.629l-3.629 1.21l1.21 -3.629l3.629 -1.21zm-9.419 1.42a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m-7 -7a1 1 0 1 0 0 2a1 1 0 0 0 0 -2" /></svg>                <h3 class="display-font text-3xl mb-3">Smart Room Locator</h3>
                    <p class="text-white/70 text-lg flex-1">Instantly locate any room, lab, or facility on campus with live availability and shortest-path directions.</p>
                    <div class="text-[#E8B923] text-sm font-medium mt-8">Real-time • Indoor GPS • Cast Building Covered →</div>
                </div>
                <div class="card-hover bg-white/5 border border-white/10 rounded-3xl p-8 flex flex-col">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2l0 -12" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2l0 -2" /></svg>                <h3 class="display-font text-3xl mb-3">Intelligent Scheduling</h3>
                    <p class="text-white/70 text-lg flex-1">View, book, and manage class schedules, professor office hours, and room reservations in one beautiful calendar.</p>
                    <div class="text-[#E8B923] text-sm font-medium mt-8">Conflict-free • Sync with Google • Soon to be Faculty approved →</div>
                </div>
                <div class="card-hover bg-white/5 border border-white/10 rounded-3xl p-8 flex flex-col">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-desktop">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10" />
        <path d="M7 20h10" />
        <path d="M9 16v4" />
        <path d="M15 16v4" />
    </svg>                <h3 class="display-font text-3xl mb-3">Lab Attendance + Monitoring</h3>
                    <p class="text-white/70 text-lg flex-1">Real-time attendance tracking, live lab occupancy, equipment status, and safety compliance monitoring.</p>
                    <div class="text-[#E8B923] text-sm font-medium mt-8">Face recognition ready • Instant reports • Live dashboards →</div>
                </div>
            </div>
        </section>

        <!-- ROOM LOCATOR -->
        <section id="locator" class="bg-white/5 py-20">
            <div class="max-w-screen-2xl mx-auto px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                    <div>
                        <span class="text-[#E8B923] text-sm font-semibold">INTERACTIVE DEMO</span>
                        <h2 class="display-font text-5xl tracking-[-1px]">Find any room in seconds</h2>
                    </div>
                    <div class="mt-6 md:mt-0 flex items-center gap-x-3 bg-white/10 rounded-3xl px-5 py-2">
                        <input id="room-search" onkeyup="if(event.keyCode===13) filterRooms()" type="text"
                            placeholder="Search rooms or buildings..."
                            class="bg-transparent outline-none text-white placeholder:text-white/40 w-72">
                        <button onclick="filterRooms()" class="bg-[#E8B923] text-[#0A2540] px-6 py-2 rounded-3xl font-medium">Search</button>
                    </div>
                </div>
                <div class="grid lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-4 bg-[#001A33] rounded-3xl p-6 max-h-[560px] overflow-auto">
                        <h4 class="font-medium mb-4 flex justify-between">
                            <span>Results</span>
                            <span id="result-count" class="text-[#E8B923]">5 rooms</span>
                        </h4>
                        <div id="rooms-list" class="space-y-3"></div>
                    </div>
                    <div class="lg:col-span-8 bg-[#001A33] rounded-3xl p-8 relative">
                        <div class="flex justify-between mb-6">
                            <div class="text-sm flex items-center gap-x-2">
                                <span class="font-semibold">Cast Building • Floor 1</span>
                                <span onclick="changeFloor()" class="cursor-pointer text-[#E8B923] underline">Change floor →</span>
                            </div>
                            <span class="px-3 py-1 bg-green-400/20 text-green-400 rounded-3xl text-xs uppercase tracking-widest font-medium">LIVE</span>
                        </div>
                        <svg id="map-svg" width="100%" height="420" viewBox="0 0 800 420" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                            <rect width="800" height="420" fill="#0A2540" rx="20"/>
                            <rect x="80" y="80" width="640" height="20" fill="#E8B923" fill-opacity="0.15"/>
                            <rect x="80" y="220" width="640" height="20" fill="#E8B923" fill-opacity="0.15"/>
                            <rect x="120" y="120" width="110" height="80" rx="12" fill="#112C4F" stroke="#E8B923" stroke-width="6" id="room-301" onclick="selectRoom(301)" class="cursor-pointer"/>
                            <text x="145" y="160" fill="#E8B923" font-size="22" font-weight="600">Lab 1</text>
                            <text x="145" y="185" fill="#fff" font-size="13">Lecture</text>
                            <rect x="260" y="120" width="110" height="80" rx="12" fill="#112C4F" stroke="#E8B923" stroke-width="6" id="room-302" onclick="selectRoom(302)" class="cursor-pointer"/>
                            <text x="285" y="160" fill="#E8B923" font-size="22" font-weight="600">106</text>
                            <text x="285" y="185" fill="#fff" font-size="13">Lecture</text>
                            <rect x="400" y="120" width="110" height="80" rx="12" fill="#112C4F" stroke="#E8B923" stroke-width="6" id="room-303" onclick="selectRoom(303)" class="cursor-pointer"/>
                            <text x="425" y="160" fill="#E8B923" font-size="22" font-weight="600">107</text>
                            <text x="425" y="185" fill="#fff" font-size="13">Lecture</text>
                            <rect x="540" y="120" width="110" height="80" rx="12" fill="#112C4F" stroke="#E8B923" stroke-width="6" id="room-304" onclick="selectRoom(304)" class="cursor-pointer"/>
                            <text x="565" y="160" fill="#E8B923" font-size="22" font-weight="600">Lab 2</text>
                            <text x="565" y="185" fill="#fff" font-size="13">Hands on</text>
                            <circle cx="670" cy="280" r="18" fill="#E8B923" opacity="0.3"/>
                            <circle cx="670" cy="280" r="12" fill="#E8B923"/>
                            <text x="670" y="286" text-anchor="middle" fill="#0A2540" font-size="18" font-weight="700">YOU</text>
                        </svg>
                        <div id="room-detail-panel" class="absolute bottom-8 right-8 bg-white/10 backdrop-blur-xl border border-[#E8B923] rounded-3xl p-6 w-80 hidden">
                            <h4 id="detail-title" class="display-font text-2xl"></h4>
                            <p id="detail-subtitle" class="text-white/70"></p>
                            <div class="my-6 flex gap-x-6">
                                <div><div class="text-xs uppercase">Status</div><div id="detail-status" class="font-medium"></div></div>
                                <div><div class="text-xs uppercase">Est. walk time</div><div id="detail-time" class="font-medium text-[#E8B923]"></div></div>
                            </div>
                            <button onclick="hideDetailPanel()" class="text-sm px-8 py-4 w-full bg-[#E8B923] text-[#0A2540] font-semibold rounded-3xl">Get walking directions</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SCHEDULING -->
        <section id="schedule" class="max-w-screen-2xl mx-auto px-8 py-24">
            <div class="grid md:grid-cols-12 gap-12 items-center">
                <div class="md:col-span-5">
                    <span class="text-[#E8B923]">Schedules Demo</span>
                    <h2 class="display-font text-5xl tracking-[-1px] mt-2">Your week at a glance</h2>
                    <p class="text-white/70 text-xl mt-4">Drag, drop, and instantly see conflicts. Syncs with your professors and lab schedules.</p>
                    <div class="mt-8 bg-white/5 border border-white/10 rounded-3xl p-6">
                        <div class="flex justify-between text-xs mb-4">
                            <span class="font-medium">May 20-27, 2026</span>
                            <span class="text-[#E8B923]">Week 8 • Midterms</span>
                        </div>
                        <div class="grid grid-cols-7 gap-px bg-white/10 rounded-2xl overflow-hidden text-center text-xs">
                            <div class="bg-[#0A2540] py-3">Mon</div>
                            <div class="bg-[#0A2540] py-3">Tue</div>
                            <div class="bg-[#0A2540] py-3 text-[#E8B923]">Wed</div>
                            <div class="bg-[#0A2540] py-3">Thu</div>
                            <div class="bg-[#0A2540] py-3">Fri</div>
                            <div class="bg-[#0A2540] py-3">Sat</div>
                            <div class="bg-[#0A2540] py-3">Sun</div>
                            <div onclick="mockCalendarClick(this)" class="bg-[#112C4F] p-2 text-left text-[10px] cursor-pointer">9AM<br><span class="font-medium">MT101 • Room 106</span></div>
                            <div class="bg-transparent p-2 text-left text-[10px]"></div>
                            <div onclick="mockCalendarClick(this)" class="bg-[#112C4F] p-2 text-left text-[10px] cursor-pointer">10AM<br><span class="font-medium">Lab 2 • CC105</span></div>
                            <div class="bg-transparent p-2"></div>
                            <div onclick="mockCalendarClick(this)" class="bg-[#112C4F] p-2 text-left text-[10px] cursor-pointer">1PM<br><span class="font-medium">WEBDEC • Lab 3</span></div>
                            <div class="bg-transparent p-2"></div>
                            <div class="bg-transparent p-2"></div>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-7">
                    <div class="bg-gradient-to-br from-[#112C4F] to-[#0A2540] rounded-3xl p-8 shadow-inner">
                        <div id="calendar-detail" class="hidden">
                            <h4 class="text-3xl display-font mb-1">MT101 • Lecture</h4>
                            <p class="text-[#E8B923]">Wednesday • 10:00 AM • Room 106 • Prof. Sir Wendell</p>
                            <div class="mt-8 grid grid-cols-2 gap-6 text-sm">
                                <div>📍 <span class="font-medium">Cast Building, 1st floor</span></div>
                                <div>👥 <span class="font-medium">45 students enrolled</span></div>
                                <div>⏳ <span class="font-medium">1 hour 30 minutes</span></div>
                                <div>📌 <span class="font-medium">No conflicts detected</span></div>
                            </div>
                            <button onclick="hideCalendarDetail()" class="mt-10 text-sm uppercase tracking-widest px-8 py-3 border border-white/30 rounded-3xl hover:bg-white/10">Close preview</button>
                        </div>
                        <p id="calendar-placeholder" class="text-center text-white/40 py-12">Click any slot above to preview details</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- ABOUT -->
        <section id="about" class="max-w-screen-2xl mx-auto px-8 py-24 border-t border-white/10">
            <div class="grid md:grid-cols-12 gap-12">
                <div class="md:col-span-4">
                    <h2 class="display-font text-5xl tracking-[-1px]">Built for Pangasinan State University</h2>
                    <p class="mt-8 text-xl text-white/80">Navi Track was created by frontend developers and PSU students to solve real campus pain points: lost time finding rooms, clashing schedules, and manual lab attendance sheets.</p>
                    <div class="mt-12 text-[#E8B923] flex items-center gap-x-6">
                        <div class="flex-1 h-px bg-[#E8B923]"></div>
                        Version 2.4 • May 2026
                    </div>
                </div>
                <div class="md:col-span-8 text-white/70 leading-relaxed">
                    From the moment you step on campus, Campus Nav knows where you need to go. Our system integrates room availability, professor schedules, and live lab sensors into one beautiful web experience. No app download required.
                    <br><br>
                    Every feature was designed with the distinct blue-and-gold identity of PSU — sharp, proud, and unmistakably ours.
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-black py-12 border-t border-white/10">
            <div class="max-w-screen-2xl mx-auto px-8">
                <div class="flex flex-col md:flex-row justify-between items-start">
                    <div class="flex items-center gap-x-3 mb-8 md:mb-0">
                        <div class="w-9 h-9 bg-[#E8B923] rounded-2xl flex items-center justify-center rotate-12">🧭</div>
                        <h1 class="display-font text-3xl">Navi Track</h1>
                    </div>
                    <div class="grid grid-cols-3 md:flex gap-y-8 gap-x-16">
                        <div>
                            <div class="uppercase text-xs font-medium mb-4 text-white/60">Product</div>
                            <p class="text-sm leading-relaxed cursor-pointer">Room Locator</p>
                            <p class="text-sm leading-relaxed cursor-pointer">Scheduling</p>
                            <p class="text-sm leading-relaxed cursor-pointer">Lab Monitoring</p>
                        </div>
                        <div>
                            <div class="uppercase text-xs font-medium mb-4 text-white/60">University</div>
                            <p class="text-sm leading-relaxed cursor-pointer">Pangasinan State University</p>
                            <p class="text-sm leading-relaxed cursor-pointer">All Colleges</p>
                            <p class="text-sm leading-relaxed cursor-pointer">Faculty Portal</p>
                        </div>
                        <div>
                            <div class="uppercase text-xs font-medium mb-4 text-white/60">Legal</div>
                            <p class="text-sm leading-relaxed cursor-pointer">Privacy &amp; Data</p>
                            <p class="text-sm leading-relaxed cursor-pointer">BSIT-WMT-2-1</p>
                        </div>
                    </div>
                </div>
                <div class="text-center text-xs text-white/40 mt-16">
                    © 2026 Campus Nav • Pangasinan State University • All rights reserved.<br>
                    BSIT-WMT-2-1 STUDENTS
                </div>
            </div>
        </footer>

        <!-- LOGIN MODAL -->
        <div onclick="if(event.target.id==='login-modal') hideLoginModal()"
            id="login-modal"
            class="hidden fixed inset-0 bg-black/70 backdrop-blur-xl z-[9999] flex items-center justify-center">
            <div onclick="event.stopImmediatePropagation()"
                class="modal bg-[#0A2540] w-full max-w-md mx-4 rounded-3xl p-8">
                <h2 class="display-font text-4xl mb-8">Welcome back, User</h2>
                <input type="text" placeholder="Student ID or Email"
                    class="w-full py-6 px-6 bg-white/10 rounded-3xl outline-none mb-4 placeholder:text-white/40">
                <input type="password" placeholder="Password"
                    class="w-full py-6 px-6 bg-white/10 rounded-3xl outline-none mb-8 placeholder:text-white/40">
                <button onclick="fakeLogin()" class="w-full py-6 bg-[#E8B923] text-[#0A2540] font-semibold text-xl rounded-3xl">Sign in securely</button>
                <p onclick="hideLoginModal()" class="text-center text-sm mt-8 text-white/60 cursor-pointer hover:text-white">Cancel</p>
            </div>
        </div>

        <!-- ============================================================
            LOADING SCREEN SCRIPT  (runs before main.js)
        ============================================================ -->
        <script>
            const lsSteps = [
                { pct: 15,  label: 'Initializing'     },
                { pct: 32,  label: 'Loading assets'    },
                { pct: 52,  label: 'Fetching rooms'    },
                { pct: 68,  label: 'Syncing schedules' },
                { pct: 84,  label: 'Preparing campus'  },
                { pct: 100, label: 'Ready'             },
            ];

            let lsIdx = 0;

            function lsStep() {
                if (lsIdx >= lsSteps.length) return;
                const s = lsSteps[lsIdx];
                document.getElementById('ls-fill').style.width   = s.pct + '%';
                document.getElementById('ls-pct').textContent    = s.pct + '%';
                document.getElementById('ls-status').textContent = s.label;
                lsIdx++;
                if (lsIdx < lsSteps.length) {
                    setTimeout(lsStep, Math.random() * 220 + 150);
                } else {
                    setTimeout(lsDismiss, 320);
                }
            }

            function lsDismiss() {
                const el = document.getElementById('loading-screen');
                el.classList.add('ls-exit');
                setTimeout(() => { el.style.display = 'none'; }, 680);
            }

            window.addEventListener('DOMContentLoaded', () => setTimeout(lsStep, 500));
        </script>

        <script src="mainuser.js"></script>
    </body>
    </html>