// Final script.js - Campus Nav Admin System

console.log("%c✅ Campus Nav Admin System Loaded Successfully", "color:#E8B923; font-weight:700; font-size:16px;");

// ====================== ADMIN LOGIN ======================
function adminLogin() {
    const username = document.getElementById('admin-username')?.value;
    const password = document.getElementById('admin-password')?.value;

    if (username && password) {
        alert("✅ Login Successful!\nWelcome to Campus Nav Admin Portal");
        window.location.href = "dashboard.html";
    } else {
        alert("Please enter username and password");
    }
}

// ====================== LOGOUT ======================
function logout() {
    if (confirm("Are you sure you want to logout from Admin Portal?")) {
        window.location.href = "index.html";
    }
}

// ====================== USERS MANAGEMENT ======================
let usersData = [

            { id: "24-BGU-0318", name: "Joshua Vince Junio II", course: "BSIT Web and Mobile Technologies", year: "2nd", email: "joshuavincejunio@psu.edu.ph", status: "Active" },
            { id: "24-BGU-0362", name: "Aleah Mae T. Valdez", course: "BSIT Data Analytics", year: "2nd", email: "aleahmaevaldez@psu.edu.ph", status: "Active" },
            { id: "24-BGU-0369", name: "Aehri Vien Valdez Junio", course: "BS Nursing", year: "1st", email: "aehrivien@psu.edu.ph", status: "Inactive" },
            { id: "24-BGU-0361", name: "Vinvin Valdez Junio", course: "BSIT Data Analytics", year: "1st", email: "vinvin@psu.edu.ph", status: "Inactive" }
];


function renderUsers(filteredUsers = usersData) {
    const tbody = document.getElementById('users-body');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    filteredUsers.forEach(user => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="font-medium">${user.id}</td>
            <td>${user.name}</td>
            <td>${user.course} - ${user.year} Year</td>
            <td class="text-white/80">${user.email}</td>
            <td><span class="status-active">${user.status}</span></td>
            <td class="text-center">
                <button onclick="viewUser('${user.id}')" 
                        class="px-5 py-2 text-sm border border-white/30 hover:border-[#E8B923] rounded-xl transition">View</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function searchUsers() {
    const query = document.getElementById('user-search').value.toLowerCase().trim();
    const filtered = usersData.filter(user => 
        user.name.toLowerCase().includes(query) ||
        user.id.toLowerCase().includes(query) ||
        user.email.toLowerCase().includes(query)
    );
    renderUsers(filtered);
}

function addNewUser() {
    const name = prompt("Enter Full Name:");
    if (name) {
        alert(`New user "${name}" has been added successfully!`);
        // In real system, you would push to usersData and re-render
    }
}

function viewUser(id) {
    alert(`📋 User Profile\n\nStudent ID: ${id}\n\nFull details, attendance history, and schedule will be shown here.`);
}

// ====================== ROOMS MANAGEMENT ======================
let roomsData = [
    { id: "24-BGU-0318", name: "Joshua Vince Junio II", course: "BSIT Web and Mobile Technologies", year: "2nd", email: "joshuavincejunio@psu.edu.ph", status: "Active" },
            { id: "24-BGU-0362", name: "Aleah Mae T. Valdez", course: "BSIT Data Analytics", year: "2nd", email: "aleahmaevaldez@psu.edu.ph", status: "Active" },
            { id: "24-BGU-0369", name: "Aehri Vien Valdez Junio", course: "BS Nursing", year: "1st", email: "aehrivien@psu.edu.ph", status: "Inactive" },
            { id: "24-BGU-0366", name: "Vinvin Valdez Junio", course: "BSIT Data Analytics", year: "1st", email: "vinvin@psu.edu.ph", status: "Inactive" },
            { id: "24-BGU-0475", name: "Viktor Isaac Arcega", course: "BSIT Web and Mobile Technologies", year: "2nd", email: "viktorvik@psu.edu.ph", status: "Active" },
            { id: "24-BGU-0320", name: "Elijah Josh Fajardo", course: "BSIT Web and Mobile Technologies", year: "2nd", email: "Elijahjoshfajardo@psu.edu.ph", status: "Active" },
 ];

function renderRooms() {
    const tbody = document.getElementById('rooms-body');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    roomsData.forEach(room => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="font-medium">${room.number}</td>
            <td>${room.building}</td>
            <td>${room.floor}</td>
            <td>${room.type}</td>
            <td>${room.capacity}</td>
            <td><span class="${room.status === 'Available' ? 'text-emerald-400' : 'text-amber-400'}">${room.status}</span></td>
            <td class="text-center">
                <button onclick="editRoom('${room.number}')" 
                        class="px-5 py-2 text-sm border border-white/30 hover:border-[#E8B923] rounded-xl">Edit</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function addNewRoom() {
    alert("➕ Add New Room Form\n\nRoom number, building, capacity, etc. will open here.");
}

function editRoom(number) {
    alert(`Editing Room ${number}`);
}

// ====================== SCHEDULE MANAGEMENT ======================
function renderSchedules() {
    const container = document.getElementById('schedule-list');
    if (!container) return;

    container.innerHTML = `
        <div class="bg-white/10 rounded-2xl p-6 flex justify-between items-center">
            <div>
                <p class="font-medium">CS-101 • Computer Fundamentals</p>
                <p class="text-white/70 text-sm">Room 301 • 8:00 AM - 9:30 AM • Prof. Santos</p>
            </div>
            <span class="text-emerald-400 text-sm font-medium">Today</span>
        </div>
        <div class="bg-white/10 rounded-2xl p-6 flex justify-between items-center">
            <div>
                <p class="font-medium">ENG-204 • Digital Electronics</p>
                <p class="text-white/70 text-sm">Room 304 • 10:00 AM - 11:30 AM • Prof. Reyes</p>
            </div>
            <span class="text-emerald-400 text-sm font-medium">Today</span>
        </div>
    `;
}

function addNewSchedule() {
    const subject = prompt("Enter Subject Code (e.g. CS-101):");
    if (subject) {
        alert(`✅ New schedule for ${subject} has been successfully added!`);
    }
}

// ====================== INITIALIZE ALL PAGES ======================
document.addEventListener('DOMContentLoaded', () => {
    // Render Users if on users.html
    if (document.getElementById('users-body')) {
        renderUsers();
    }

    // Render Rooms if on rooms.html
    if (document.getElementById('rooms-body')) {
        renderRooms();
    }

    // Render Schedules if on schedule.html
    if (document.getElementById('schedule-list')) {
        renderSchedules();
    }

            // ====================== LOADING SCREEN ======================
        window.onload = function() {
            // Show loading for 1.8 seconds then hide it
            setTimeout(() => {
                const loadingScreen = document.getElementById('loading-screen');
                if (loadingScreen) {
                    loadingScreen.style.opacity = '0';
                    
                    setTimeout(() => {
                        loadingScreen.style.display = 'none';
                        // Show login page after loading
                        const loginPage = document.getElementById('login-page');
                        if (loginPage) loginPage.classList.remove('hidden');
                    }, 600);
                }
            }, 1800);
        };
});