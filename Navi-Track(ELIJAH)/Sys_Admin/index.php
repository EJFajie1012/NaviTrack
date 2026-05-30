<?php
session_start();
include "../Sys_Database/db_connection.php";
include "../Sys_Database/activity.php";
global $conn;

if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'ADMIN'){
    header("Location: /Sys_Login/index.php");
    exit;
}

// PARA SA USER TABLE
$sql = "SELECT users.user_id, users.username, users.email,users.is_active, role.role_name AS role_id
        FROM users
        JOIN role ON users.role_id = role.role_id";
$result = mysqli_query($conn, $sql);

// PARA SA ROOMS TABLE
$sqlRooms = " SELECT room_id, room_name, building, room_status
        FROM room_list";

$roomResult = mysqli_query($conn, $sqlRooms);

// PARA SA SCHEDULE TABLE
$sqlSchedule = " SELECT room_sched.sched_id, room_list.room_name, subjects.subject_name, teachers.prof_name AS instructor_name, room_sched.day_of_week, DATE_FORMAT(room_sched.start_time, '%h:%i %p') AS start_time,
                DATE_FORMAT(room_sched.end_time, '%h:%i %p') AS end_time
                FROM room_sched
                JOIN room_list 
                     ON room_sched.room_id = room_list.room_id
                JOIN teachers 
                    ON room_sched.prof_id = teachers.prof_id
                JOIN subjects 
                    ON room_sched.sub_id = subjects.sub_id";
$schedResult = mysqli_query($conn, $sqlSchedule);

//PARA SA DASHBOARD TOTAL USERS
$sqltotalUsers = "SELECT COUNT(*) AS total_users FROM users";
$totalUsersResult = mysqli_query($conn, $sqltotalUsers);

//PARA SA DASHBOARD TOTAL ROOMS MANAGED
$sqlTotalRooms = "SELECT COUNT(*) AS total_rooms FROM room_list";
$totalRoomsResult = mysqli_query($conn, $sqlTotalRooms);

// PARA SA DASHBOARD SCHEDULES TODAY
$today = date("1");
$sqlSchedulesToday = "SELECT COUNT(*) AS schedules_today
                    FROM room_sched
                    WHERE day_of_week = '$today'";
$schedulesTodayResult = mysqli_query($conn, $sqlSchedulesToday);

//PARA SA DASHBOARD ACTIVE USERS
$sqlactiveUsers = "SELECT COUNT(*) AS active_users FROM users WHERE last_activity >= (NOW() - INTERVAL 5 MINUTE)";
$activeUsersResult = mysqli_query($conn, $sqlactiveUsers);

$row = mysqli_fetch_assoc($activeUsersResult);

$active_users = $row['active_users'] ?? 0;

echo $active_users;
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Navi Track • Admin Portal</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="adminstyle.css">
    
    </head>
    <body class="bg-[#0A2540] text-white min-h-screen">
        <!-- ==================== UPGRADED LOADING SCREEN ==================== -->
        <div id="loading-screen">
            <div class="loader-glow"></div>

            <div class="loader-container">

                <!-- Compass -->
                <div class="compass-ring">
                    <!-- Rotating dashed ring -->
                    <svg viewBox="0 0 112 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="56" cy="56" r="50"
                            stroke="#E8B923"
                            stroke-width="1.5"
                            stroke-dasharray="6 4"
                            stroke-linecap="round"
                            opacity="0.5"/>
                        <!-- Cardinal marks -->
                        <rect x="54.5" y="4" width="3" height="8" rx="1.5" fill="#E8B923" opacity="0.9"/>
                        <rect x="54.5" y="100" width="3" height="8" rx="1.5" fill="#E8B923" opacity="0.4"/>
                        <rect x="4" y="54.5" width="8" height="3" rx="1.5" fill="#E8B923" opacity="0.4"/>
                        <rect x="100" y="54.5" width="8" height="3" rx="1.5" fill="#E8B923" opacity="0.4"/>
                    </svg>

                    <!-- Inner gold circle + needle -->
                    <div class="compass-inner">
                        <div style="position:relative;width:100%;height:100%;">
                            <div class="needle needle-north"></div>
                        </div>
                    </div>
                </div>

                <!-- Brand Name -->
                <div class="brand-title">Navi Track</div>
                <div class="brand-sub">Admin Portal</div>

                <!-- Progress Bar -->
                <div class="progress-area">
                    <div class="progress-label">
                        <span class="progress-status" id="status-text">Initializing</span>
                        <span class="progress-pct" id="pct-text">0%</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                </div>

                <!-- Dots -->
                <div class="loader-dots">
                    <span></span><span></span><span></span>
                </div>

            </div>
        </div>

        <!-- ==================== LOGIN PAGE ==================== -->
        <div id="login-page" class="min-h-screen flex items-center justify-center hidden">
            <div class="w-full max-w-md mx-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center gap-x-3 mb-6">
                        <div class="w-14 h-14 bg-[#E8B923] rounded-3xl flex items-center justify-center rotate-12 shadow-2xl">
                            <span class="text-[#0A2540] text-5xl">🧭</span>
                        </div>
                        <h1 class="display-font text-5xl tracking-[-2px]">Navi Track</h1>
                    </div>
                    <p class="text-[#E8B923] text-2xl font-medium">Administrator Portal</p>
                </div>

                <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-10">
                    <h2 class="display-font text-3xl text-center mb-8">Admin Login</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm mb-2 text-white/70">Username or Email</label>
                            <input type="text" id="admin-username" 
                                class="w-full px-6 py-4 bg-white/10 border border-white/20 rounded-2xl outline-none focus:border-[#E8B923] placeholder:text-white/50"
                                placeholder="admin@psu.edu.ph">
                        </div>
                        <div>
                            <label class="block text-sm mb-2 text-white/70">Password</label>
                            <input type="password" id="admin-password" 
                                class="w-full px-6 py-4 bg-white/10 border border-white/20 rounded-2xl outline-none focus:border-[#E8B923] placeholder:text-white/50"
                                placeholder="••••••••">
                        </div>

                        <button onclick="adminLogin()" 
                                class="w-full py-5 bg-[#E8B923] hover:bg-white text-[#0A2540] font-semibold text-xl rounded-2xl transition-all">
                            Sign In as Administrator
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== ADMIN PANEL ==================== -->
        <div id="admin-panel" class="hidden">

            <!-- Sidebar -->
            <div class="fixed left-0 top-0 h-screen w-72 bg-[#001A33] border-r border-white/10 p-8 flex flex-col">
                <div class="flex items-center gap-x-3 mb-16">
                    <div class="w-11 h-11 bg-[#E8B923] rounded-3xl flex items-center justify-center rotate-12">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-compass">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336zm-5 14.66a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m3.684 -10.949l-6 2a1 1 0 0 0 -.633 .633l-2.007 6.026l-.023 .086l-.017 .113l-.004 .068v.044l.009 .111l.012 .07l.04 .144l.045 .1l.054 .095l.064 .09l.069 .075l.084 .074l.098 .07l.1 .054l.078 .033l.105 .033l.109 .02l.043 .005l.068 .004h.044l.111 -.009l.07 -.012l.02 -.006l.019 -.002l.074 -.022l6 -2a1 1 0 0 0 .633 -.633l2 -6a1 1 0 0 0 -1.265 -1.265zm-1.265 2.529l-1.21 3.629l-3.629 1.21l1.21 -3.629l3.629 -1.21zm-9.419 1.42a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m-7 -7a1 1 0 1 0 0 2a1 1 0 0 0 0 -2" />
    </svg>
                    </div>
                    <h1 class="display-font text-3xl tracking-[-1px]">Navi Track</h1>
                </div>

                <nav class="flex-1 space-y-2">
                    <a onclick="showPage('dashboard')" class="admin-nav-item active flex items-center gap-x-4 px-6 py-4 rounded-2xl cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
    </svg>

                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a onclick="showPage('users')" class="admin-nav-item flex items-center gap-x-4 px-6 py-4 rounded-2xl cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
    </svg>

                        <span class="font-medium">Total Users</span>
                    </a>
                    <a onclick="showPage('rooms')" class="admin-nav-item flex items-center gap-x-4 px-6 py-4 rounded-2xl cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
    </svg>
                        <span class="font-medium">Total Rooms Managed</span>
                    </a>
                    <a onclick="showPage('schedule')" class="admin-nav-item flex items-center gap-x-4 px-6 py-4 rounded-2xl cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
    </svg>

                        <span class="font-medium">Schedules(BSIT only)</span>
                    </a>
                </nav>

                <button onclick="window.location.href='../Sys_Login/logout.php'"
                     class="mt-auto w-full py-4 border border-white/30 hover:border-red-400 hover:text-red-400 rounded-2xl text-sm font-medium">
                    Logout
                </button>
            </div>

            <!-- Main Content -->
            <div class="ml-72 p-10">

                <!-- DASHBOARD PAGE -->
                <div id="page-dashboard" class="page">
                    <h1 class="display-font text-5xl tracking-[-1px] mb-12">Dashboard</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
    </svg>

                            <div class="text-6xl font-bold text-[#E8B923]">
                                <?php echo mysqli_fetch_assoc($totalUsersResult)['total_users']; ?>
                            </div>

                            <div class="text-white/70 mt-1">Total Users</div>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
    </svg>

                            <div class="text-6xl font-bold text-[#E8B923]">
                                <?php echo mysqli_fetch_assoc($totalRoomsResult)['total_rooms']; ?>
                            </div>
                            <div class="text-white/70 mt-1">Rooms Managed</div>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
    </svg>

                            <div class="text-6xl font-bold text-[#E8B923]">
                                <?php echo mysqli_fetch_assoc($schedulesTodayResult)['schedules_today']; ?>
                            </div>
                            <div class="text-white/70 mt-1">Schedules Today</div>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-compass">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M8 16l2 -6l6 -2l-2 6l-6 2" />
        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
        <path d="M12 3l0 2" />
        <path d="M12 19l0 2" />
        <path d="M3 12l2 0" />
        <path d="M19 12l2 0" />
    </svg>
                            <div class="text-6xl font-bold text-[#E8B923]">
                                <?= $row['active_users'] ?? 0; ?>
                            </div>
                            <div class="text-white/70 mt-1">Users Online</div>
                        </div>
                    </div>
                </div>

                <!-- USERS PAGE -->
                <div id="page-users" class="page hidden">
                    <div class="flex justify-between items-center mb-10">
                        <h1 class="display-font text-5xl tracking-[-1px]">Users Management</h1>
                        <button onclick="addNewUser()" 
                                class="px-8 py-4 bg-[#E8B923] text-[#0A2540] font-semibold rounded-3xl hover:bg-white transition">
                            + Add New User
                        </button>
                    </div>
                    <input type="text" id="user-search" 
                        onkeyup="searchUsers()" 
                        placeholder="Search by name, ID or email..." 
                        class="w-full max-w-xl px-6 py-4 bg-white/10 border border-white/20 rounded-3xl outline-none focus:border-[#E8B923] mb-8">
                    
                    <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10 bg-white/5">
                                    <th class="text-center p-6">User ID</th>
                                    <th class="text-center p-6">Name</th>
                                    <th class="text-center p-6">Role</th>
                                    <th class="text-center p-6">Email</th>
                                    <th class="text-center p-6">Status</th>
                                    <th class="text-center p-6">Action</th>
                                </tr>
                                <?php
                                while($row= mysqli_fetch_assoc($result)){
                                    $status = ($row['is_active'] == 1)
                                        ? "Active"
                                        : "Inactive";
                                    echo "<tr class='border-b border-white/10 bg-white/5'>";
                                    echo "<th class='text-center p-6'>" . $row['user_id'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['username'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['role_id'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['email'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $status . "</th>";
                                    echo "<th class='text-center p-6'><button class='px-4 py-2 bg-[#E8B923] text-[#0A2540] rounded-2xl hover:bg-white transition'>Edit</button></th>";
                                    echo "</tr>";
                                }
                                ?>
                            </thead>
                            <tbody id="users-body"></tbody>
                        </table>
                    </div>
                </div>

                <!-- ROOMS PAGE -->
                <div id="page-rooms" class="page hidden">
                    <div class="flex justify-between items-center mb-10">
                        <h1 class="display-font text-5xl tracking-[-1px]">Room List</h1>
                        <button onclick="addNewRoom()" 
                                class="px-8 py-4 bg-[#E8B923] text-[#0A2540] font-semibold rounded-3xl hover:bg-white transition">
                            + Add New Room
                        </button>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10 bg-white/5">
                                    <th class="text-center p-6">Room ID</th>
                                    <th class="text-center p-6">Room Name</th>
                                    <th class="text-center p-6">Building</th>
                                    <th class="text-center p-6">Status</th>
                                    <th class="text-center p-6">Action</th>
                                </tr>
                                <?php
                                while($row= mysqli_fetch_assoc($roomResult)){
                                    echo "<tr class='border-b border-white/10 bg-white/5'>";
                                    echo "<th class='text-center p-6'>" . $row['room_id']."</th>";
                                    echo "<th class='text-center p-6'>" . $row['room_name']."</th>";
                                    echo "<th class='text-center p-6'>" . $row['building']."</th>";
                                    echo "<th class='text-center p-6'>" . ($row['room_status'] == 1 ? "Available" : "Occupied") . "</th>";
                                    echo "<th class='text-center p-6'><button class='px-4 py-2 bg-[#E8B923] text-[#0A2540] rounded-2xl hover:bg-white transition'>Edit</button></th>";
                                    echo "</tr>";
                                }
                                ?>
                            </thead>
                            <tbody id="rooms-body"></tbody>
                        </table>
                    </div>
                </div>

                <!-- SCHEDULE PAGE -->
                <div id="page-schedule" class="page hidden">
                    <div class="flex justify-between items-center mb-10">
                        <h1 class="display-font text-5xl tracking-[-1px]">Schedule Management</h1>
                        <button onclick="addNewSchedule()" 
                                class="px-8 py-4 bg-[#E8B923] text-[#0A2540] font-semibold rounded-3xl hover:bg-white transition">
                            + Add New Schedule
                        </button>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10 bg-white/5">
                                    <th class="text-center p-6">Schedule ID</th>
                                    <th class="text-center p-6">Room Name</th>
                                    <th class="text-center p-6">Room Subject</th>
                                    <th class="text-center p-6">Instructor</th>
                                    <th class="text-center p-6">Day</th>
                                    <th class="text-center p-6">Time in</th>
                                    <th class="text-center p-6">Time out</th>
                                </tr>
                                <?php
                                while($row = mysqli_fetch_assoc($schedResult)){
                                    echo "<tr class='border-b border-white/10 bg-white/5'>";
                                    echo "<th class='text-center p-6'>" . $row['sched_id'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['room_name'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['subject_name'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['instructor_name'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['day_of_week'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['start_time'] . "</th>";
                                    echo "<th class='text-center p-6'>" . $row['end_time'] . "</th>";
                                    echo "</tr>";
                                }
                                ?>
                            </thead>
                            <tbody id="rooms-body"></tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <script>
            // ====================== UPGRADED LOADING SCREEN ======================
            const loadingSteps = [
                { pct: 18,  label: "Initializing"      },
                { pct: 38,  label: "Loading modules"    },
                { pct: 58,  label: "Fetching data"      },
                { pct: 78,  label: "Preparing portal"   },
                { pct: 92,  label: "Almost ready"       },
                { pct: 100, label: "Done"               },
            ];

            let stepIndex = 0;

            function runLoadingStep() {
                if (stepIndex >= loadingSteps.length) return;

                const step = loadingSteps[stepIndex];
                document.getElementById('progress-fill').style.width = step.pct + '%';
                document.getElementById('pct-text').textContent = step.pct + '%';
                document.getElementById('status-text').textContent = step.label;
                stepIndex++;

                if (stepIndex < loadingSteps.length) {
                    const delay = stepIndex === loadingSteps.length - 1 ? 280 : Math.random() * 250 + 160;
                    setTimeout(runLoadingStep, delay);
                } else {
                    setTimeout(finishLoading, 350);
                }
            }

            function finishLoading() {
                const screen = document.getElementById('loading-screen');
                screen.classList.add('fade-out');
                setTimeout(() => {
                    screen.style.display = 'none';
                    document.getElementById('login-page').classList.remove('hidden');
                }, 680);
            }

            window.onload = function() {
                setTimeout(runLoadingStep, 600);
            };

            // ====================== PAGE NAVIGATION ======================
            function showPage(page) {
                document.querySelectorAll('.page').forEach(p => p.classList.add('hidden'));
                document.getElementById(`page-${page}`).classList.remove('hidden');

                document.querySelectorAll('.admin-nav-item').forEach(item => item.classList.remove('active'));
                const activeLink = Array.from(document.querySelectorAll('.admin-nav-item'))
                    .find(item => item.getAttribute('onclick').includes(`'${page}'`));
                if (activeLink) activeLink.classList.add('active');
            }

            // ====================== LOGIN ======================
            function adminLogin() {
                document.getElementById('login-page').classList.add('hidden');
                document.getElementById('admin-panel').classList.remove('hidden');
                showPage('dashboard');
            }

            function logout() {
                if (confirm("Logout from Admin Portal?")) {
                    document.getElementById('admin-panel').classList.add('hidden');
                    document.getElementById('login-page').classList.remove('hidden');
                }
            }

            // ====================== USERS ======================
            
            function renderUsers(filtered = usersData) {
                const tbody = document.getElementById('users-body');
                tbody.innerHTML = '';
                filtered.forEach(user => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="font-medium p-6">${user.id}</td>
                        <td class="p-6">${user.name}</td>
                        <td class="p-6">${user.course} - ${user.year}</td>
                        <td class="p-6 text-white/80">${user.email}</td>
                        <td class="p-6"><span class="status-active">${user.status}</span></td>
                        <td class="p-6 text-center">
                            <button onclick="viewUser('${user.id}')" class="px-5 py-2 text-sm border border-white/30 hover:border-[#E8B923] rounded-xl">View</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            function searchUsers() {
                const query = document.getElementById('user-search').value.toLowerCase();
                const filtered = usersData.filter(u => 
                    u.name.toLowerCase().includes(query) || 
                    u.id.toLowerCase().includes(query) ||
                    u.email.toLowerCase().includes(query)
                );
                renderUsers(filtered);
            }

            function addNewUser() { alert("Add New User form would appear here."); }
            function viewUser(id) { alert(`Viewing details for Student ID: ${id}`); }

            // ====================== ROOMS ======================
            let roomsData = [
                { number: "Lab 1", building: "Cast", floor: "1", type: "Computer Lab", capacity: "40", status: "Available" },
                { number: "Lab 2", building: "Cast", floor: "1", type: "Computer Lab", capacity: "44", status: "Occupied" },
                { number: "Lab 3", building: "Cast", floor: "1", type: "Computer Lab", capacity: "45", status: "Available" },
                { number: "Rm 106", building: "Cast", floor: "1", type: "Lecture", capacity: "143", status: "Available" }
            ];

            function renderRooms() {
                const tbody = document.getElementById('rooms-body');
                tbody.innerHTML = '';
                roomsData.forEach(room => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="font-medium p-6">${room.number}</td>
                        <td class="p-6">${room.building}</td>
                        <td class="p-6">${room.floor}</td>
                        <td class="p-6">${room.type}</td>
                        <td class="p-6">${room.capacity}</td>
                        <td class="p-6"><span class="${room.status === 'Available' ? 'text-emerald-400' : 'text-amber-400'}">${room.status}</span></td>
                        <td class="p-6 text-center">
                            <button onclick="editRoom('${room.number}')" class="px-5 py-2 text-sm border border-white/30 hover:border-[#E8B923] rounded-xl">Edit</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            function addNewRoom() { alert("Add New Room form would appear here."); }
            function editRoom(number) { alert(`Editing Room ${number}`); }

            // ====================== SCHEDULES ======================
            function renderSchedules() {
                const container = document.getElementById('schedule-list');
                container.innerHTML = `
                    <div class="bg-white/10 rounded-3xl p-6 flex justify-between items-center">
                        <div>
                            <p class="font-medium">MT-101 • Multi Media Technology</p>
                            <p class="text-white/70">Lab 1 • 8:00 AM - 9:30 AM • Prof. Wendell</p>
                        </div>
                        <span class="text-emerald-400 font-medium">Today</span>
                    </div>
                    <div class="bg-white/10 rounded-3xl p-6 flex justify-between items-center">
                        <div>
                            <p class="font-medium">HCI102 • Human Computer Interaction</p>
                            <p class="text-white/70">Lab 2 • 10:00 AM - 11:30 AM • Prof. Sharyll</p>
                        </div>
                        <span class="text-emerald-400 font-medium">Today</span>
                    </div>
                `;
            }

            function addNewSchedule() {
                const subject = prompt("Enter Subject Code (e.g. CC-101):");
                if (subject) {
                    alert(`✅ New schedule for ${subject} added successfully!`);
                }
            }

            // ====================== INITIALIZATION ======================
            document.addEventListener('DOMContentLoaded', () => {
                if (document.getElementById('users-body')) renderUsers();
                if (document.getElementById('rooms-body')) renderRooms();
                if (document.getElementById('schedule-list')) renderSchedules();
            });
        </script>

        <script src="adminmain.js"></script>
    </body>

    </html>