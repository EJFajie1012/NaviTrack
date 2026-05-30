// =============================================
// Navi Track • PSU
// Main JavaScript File
// =============================================

document.addEventListener('DOMContentLoaded', () => {
    initializeApp();
});

function initializeApp() {
    // Populate dynamic content
    populateRooms();
    populateLabStudents();

    // Simulate live lab updates
    setInterval(liveLabUpdate, 8000);

    console.log('%c✅ Navi Track • PSU initialized successfully', 
                'background:#E8B923; color:#0A2540; font-weight:700; padding:6px 14px; border-radius:9999px');
}

// ======================
// Room Locator Functions
// ======================

let allRooms = [
    { id: 301, name: "Lab 1 — Computer Lab", building: "Cast", floor: "1", status: "Available", time: "3 min walk" },
    { id: 302, name: "Lab 2 — Computer Lab", building: "Cast", floor: "1", status: "Occupied", time: "4 min walk" },
    { id: 303, name: "Lab 3 — Computer Lab", building: "Cast", floor: "1", status: "Available", time: "3 min walk" },
    { id: 304, name: "Room 106 — Lecture", building: "Cast", floor: "1", status: "Available", time: "1 min walk" },
    { id: 201, name: "Room 107 — Lecture", building: "Cast", floor: "1", status: "Occupied", time: "2 min walk" },
    { id: 105, name: "Soc Hall — Social Hall", building: "Cast", floor: "2", status: "Available", time: "5 min walk" },
];

function populateRooms(filteredRooms = allRooms) {
    const container = document.getElementById('rooms-list');
    if (!container) return;

    container.innerHTML = '';

    filteredRooms.forEach(room => {
        const div = document.createElement('div');
        div.className = `flex justify-between items-center px-5 py-4 rounded-3xl cursor-pointer hover:bg-white/10 
                         ${room.status === 'Available' ? 'border border-[#E8B923]' : ''}`;
        
        div.innerHTML = `
            <div>
                <div class="font-medium">${room.name}</div>
                <div class="text-xs text-white/60">${room.building} • Floor ${room.floor}</div>
            </div>
            <div class="text-right">
                <div class="text-sm ${room.status === 'Available' ? 'text-emerald-400' : 'text-amber-300'}">${room.status}</div>
                <div class="text-[#E8B923] text-xs">${room.time}</div>
            </div>
        `;
        
        div.onclick = () => selectRoom(room.id);
        container.appendChild(div);
    });

    const countEl = document.getElementById('result-count');
    if (countEl) countEl.textContent = `${filteredRooms.length} rooms`;
}

function filterRooms() {
    const query = document.getElementById('room-search')?.value.toLowerCase().trim() || '';
    
    const filtered = allRooms.filter(room => 
        room.name.toLowerCase().includes(query) || 
        room.building.toLowerCase().includes(query)
    );
    
    populateRooms(filtered);
}

window.selectRoom = function(id) {
    // Highlight selected room on SVG map
    document.querySelectorAll('#map-svg rect[id^="room-"]').forEach(rect => {
        rect.setAttribute('stroke', '#112C4F');
        if (parseInt(rect.getAttribute('id').split('-')[1]) === id) {
            rect.setAttribute('stroke', '#E8B923');
        }
    });

    const room = allRooms.find(r => r.id === id);
    if (!room) return;

    const panel = document.getElementById('room-detail-panel');
    if (!panel) return;

    document.getElementById('detail-title').textContent = room.name;
    document.getElementById('detail-subtitle').textContent = `${room.building} • Floor ${room.floor}`;
    document.getElementById('detail-status').innerHTML = `<span class="text-emerald-400">${room.status}</span>`;
    document.getElementById('detail-time').textContent = room.time;

    panel.classList.remove('hidden');
};

window.hideDetailPanel = function() {
    const panel = document.getElementById('room-detail-panel');
    if (panel) panel.classList.add('hidden');
};

window.changeFloor = function() {
    const svg = document.getElementById('map-svg');
    if (!svg) return;

    svg.style.transition = 'opacity 400ms';
    svg.style.opacity = '0';

    setTimeout(() => {
        alert("🔄 Floor changed to Level 2 (demo only)");
        svg.style.opacity = '1';
    }, 300);
};

// ======================
// Scheduling Functions
// ======================

window.mockCalendarClick = function(el) {
    document.getElementById('calendar-placeholder').classList.add('hidden');
    const detail = document.getElementById('calendar-detail');
    if (detail) detail.classList.remove('hidden');

    // Highlight clicked slot
    document.querySelectorAll('#schedule .grid > div').forEach(d => {
        d.classList.remove('ring-2', 'ring-[#E8B923]');
    });
    el.classList.add('ring-2', 'ring-[#E8B923]');
};

window.hideCalendarDetail = function() {
    document.getElementById('calendar-placeholder').classList.remove('hidden');
    const detail = document.getElementById('calendar-detail');
    if (detail) detail.classList.add('hidden');
};

// ======================
// UI Utility Functions
// ======================

window.toggleMobileMenu = function() {
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('hamburger-icon');
    
    if (!menu || !icon) return;

    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6h12v12" />`;
    } else {
        menu.classList.add('hidden');
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />`;
    }
};

window.smoothScrollTo = function(sectionId) {
    const el = document.getElementById(sectionId);
    if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
    }
};

// Login Modal
window.showLoginModal = function() {
    const modal = document.getElementById('login-modal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
};

window.hideLoginModal = function() {
    const modal = document.getElementById('login-modal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
};

window.fakeLogin = function() {
    hideLoginModal();
    setTimeout(() => {
        showToast('🎉 Welcome back, Joshua Vince • BSIT Web and Mobile Technologies');
    }, 500);
};

// Toast Notification
function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.transform = 'translateY(60px)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
    }, 3000);
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
}
function handleClick(type) {
  console.log(type + " clicked");

  // Example actions
  if (type === 'students') {
    alert("Show student list");
    window.location.href = "students.html";
  } 
}
