<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navi Track • Faculty</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="eses.css">
    
</head>
<body class="bg-[#0A2540] text-white overflow-x-hidden">

    <!-- LOADING SCREEN -->
    <div id="loading-screen">
        <div class="text-center">
            <div class="w-24 h-24 mx-auto mb-8 relative">
                <div class="absolute inset-0 border-4 border-[#E8B923]/30 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-t-[#E8B923] border-r-[#E8B923] rounded-full animate-spin"></div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chalkboard-teacher"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 19h-3a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v11a1 1 0 0 1 -1 1" /><path d="M12 14a2 2 0 1 0 4.001 -.001a2 2 0 0 0 -4.001 .001" /><path d="M17 19a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2" /></svg>
            </div>
            <h1 class="display-font text-4xl tracking-tight mb-2">NaviTrack</h1>
            <p class="text-[#E8B923] font-medium tracking-widest">FACULTY PORTAL</p>
            <div class="mt-12 w-64 mx-auto">
                <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                    <div id="ls-fill" class="h-1 bg-[#E8B923] w-0 transition-all"></div>
                </div>
            </div>
            <p id="ls-status" class="mt-4 text-sm text-white/60">Loading...</p>
        </div>
    </div>

    <!-- Navigation Bar-->
    <nav class="sticky top-0 z-50 bg-[#0A2540]/95 backdrop-blur-lg border-b border-white/10">
        <div class="max-w-screen-2xl mx-auto px-6 md:px-8 py-5 flex items-center justify-between">
            <div class="flex items-center gap-x-3">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chalkboard-teacher"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 19h-3a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v11a1 1 0 0 1 -1 1" /><path d="M12 14a2 2 0 1 0 4.001 -.001a2 2 0 0 0 -4.001 .001" /><path d="M17 19a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2" /></svg>                <h1 class="display-font text-3xl tracking-[-1px]">NaviTrack</h1>
                <span class="px-4 py-1 text-xs font-bold bg-[#E8B923] text-[#0A2540] rounded-3xl">Faculty</span>
            </div>

            <div class="hidden md:flex items-center gap-x-10 text-sm font-medium">
                <a href="#schedule" class="nav-link">Schedule</a>
                <a href="#classes" class="nav-link">Classes</a>
                <a href="#booking" class="nav-link">Room Booking</a>
                <a href="#attendance" class="nav-link">Attendance</a>
            </div>

            <div class="flex items-center gap-x-4">
                <button onclick="showLoginModal()" id="login-btn"
                        class="px-6 py-2.5 text-sm font-semibold border border-[#E8B923] text-[#E8B923] rounded-3xl hover:bg-[#E8B923] hover:text-[#0A2540]">
                    Teacher Login
                </button>
                <div id="user-info" class="hidden items-center gap-x-3 bg-white/10 px-5 py-2 rounded-3xl">
                    <div class="w-8 h-8 bg-emerald-400 rounded-2xl flex items-center justify-center text-sm font-bold">W.S.</div>
                    <div><p class="text-sm font-medium">Prof. Salosagcol</p></div>
                </div>
                <button onclick="logout()" id="logout-btn" class="hidden px-6 py-2.5 text-sm font-semibold border border-white/30 hover:border-red-400 hover:text-red-400 rounded-3xl">
                    Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- LOGIN MODAL -->
    <div id="login-modal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-xl z-[9999] flex items-center justify-center">
        <div class="modal bg-[#0A2540] w-full max-w-md mx-4 rounded-3xl p-10">
            <h2 class="display-font text-4xl mb-8 text-center">Teacher Login</h2>
            <input id="teacher-id" type="text" placeholder="Employee ID or Email" class="w-full py-5 px-6 bg-white/10 rounded-3xl outline-none mb-4 placeholder:text-white/50">
            <input id="teacher-pass" type="password" placeholder="Password" class="w-full py-5 px-6 bg-white/10 rounded-3xl outline-none mb-8 placeholder:text-white/50">
            <button onclick="performLogin()" class="w-full py-5 bg-[#E8B923] text-[#0A2540] font-semibold text-xl rounded-3xl">Sign In</button>
            <p onclick="hideLoginModal()" class="text-center text-sm mt-8 text-white/60 cursor-pointer hover:text-white">Cancel</p>
        </div>
    </div>

    <!-- HERO -->
    <section id="hero" class="hero-bg min-h-screen flex items-center relative pt-20">
        <div class="max-w-screen-2xl mx-auto px-8">
            <h1 class="display-font text-7xl md:text-8xl leading-[1.05] tracking-[-3px]">Teach Better.<br>Manage Smarter.</h1>
        </div>
    </section>

    <!-- SCHEDULE -->
    <section id="schedule" class="max-w-screen-2xl mx-auto px-8 py-24 bg-white/5">
        <div class="text-center mb-12"><h2 class="display-font text-5xl tracking-[-1px]">My Weekly Schedule</h2></div>
        <div class="bg-[#001A33] rounded-3xl p-8 overflow-x-auto">
            <table class="w-full min-w-[1000px]">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="py-5 px-6 text-left font-medium text-white/60">TIME</th>
                        <th class="py-5 px-6 text-left font-medium text-white/60">COURSE CODE</th>
                        <th class="py-5 px-6 text-left font-medium text-white/60">COURSE TITLE</th>
                        <th class="py-5 px-6 text-left font-medium text-white/60">SECTION</th>
                        <th class="py-5 px-6 text-left font-medium text-white/60">DAY</th>
                        <th class="py-5 px-6 text-left font-medium text-white/60">ROOM</th>
                        <th class="py-5 px-6 text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody id="schedule-table"></tbody>
            </table>
        </div>
    </section>

    <!-- ROOM BOOKING + CALENDAR -->
    <section id="booking" class="max-w-screen-2xl mx-auto px-8 py-24">
        <div class="text-center mb-12">
            <h2 class="display-font text-5xl tracking-[-1px]">Room Booking & Availability</h2>
        </div>
        <div class="grid lg:grid-cols-12 gap-8">
            <!-- Booking Form with Conflict Detection -->
            <div class="lg:col-span-5 bg-[#001A33] rounded-3xl p-8">
                <h3 class="text-2xl mb-6">Book a Room</h3>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm text-white/60 mb-2">Room</label>
                        <select id="room-select" onchange="checkForConflict()" class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                            <option value="">Select Room</option>
                            <option value="Cast 107">Cast 107</option>
                            <option value="Cast Lab 3">Lab 3</option>
                            <option value="Cast 106">Cast 106</option>
                            <option value="Soc Hall">Soc Hall</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm text-white/60 mb-2">Date</label>
                            <input type="date" id="booking-date" onchange="checkForConflict()" class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                        </div>
                        <div>
                            <label class="block text-sm text-white/60 mb-2">Start Time</label>
                            <input type="time" id="booking-time" onchange="checkForConflict()" class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-2">Duration (hours)</label>
                        <input type="number" id="booking-duration" value="2" min="1" max="6" onchange="checkForConflict()" 
                               class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                    </div>

                    <div id="conflict-alert" class="hidden p-4 rounded-2xl text-sm font-medium"></div>

                    <button onclick="submitBooking()" id="book-btn"
                            class="w-full py-5 bg-[#E8B923] text-[#0A2540] font-semibold rounded-3xl disabled:opacity-50"
                            disabled>Check Availability First</button>
                </div>
            </div>

            <!-- Calendar -->
            <div class="lg:col-span-7 bg-[#001A33] rounded-3xl p-8">
                <h3 class="text-2xl mb-6">Room Availability Calendar (May 2026)</h3>
                <div id="calendar" class="bg-white/5 rounded-2xl p-6"></div>
            </div>
        </div>
    </section>

    <!-- ATTENDANCE -->
    <section id="attendance" class="max-w-screen-2xl mx-auto px-8 py-24 bg-white/5">
        <div class="text-center mb-12"><h2 class="display-font text-5xl tracking-[-1px]">Attendance System</h2></div>
        <div class="bg-[#001A33] rounded-3xl p-8">
            <div class="flex flex-wrap gap-6 mb-8">
                <div>
                    <label class="block text-sm text-white/60 mb-2">Class</label>
                    <select id="attendance-class" class="bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                        <option value="MT 101">MT 101 - BSIT-WMT-2-1</option>
                        <option value="WEBDEV 101">WEBDEV 101 - BSIT-WMT-2-1</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-2">Date</label>
                    <input type="date" id="attendance-date" class="bg-white/10 border border-white/20 rounded-2xl px-6 py-4">
                </div>
                <button onclick="loadAttendance()" class="self-end px-8 py-4 bg-emerald-400 text-[#0A2540] font-semibold rounded-3xl">Load Students</button>
            </div>
            <div id="attendance-list" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
            <div class="mt-10 flex justify-between items-center">
                <div id="attendance-summary" class="text-lg font-medium"></div>
                <button onclick="saveAttendance()" class="px-10 py-5 bg-[#E8B923] text-[#0A2540] font-semibold rounded-3xl">Save Attendance</button>
            </div>
        </div>
    </section>

    <script src="jsjs.js"></script>
</body>
</html>