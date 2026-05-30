let isLoggedIn = false;
let currentUser = "Prof. Wendell Salosagcol";

const teacherSchedule = [
    { time: "08:00 - 09:30", code: "IT 101", title: "Introduction to Computing", section: "BSIT-WMT-2-1", day: "Mon", room: "Cast 106" },
    { time: "10:00 - 11:30", code: "WEBDEV 101", title: "Web Development", section: "BSIT-WMT-2-1", day: "Tue", room: " Cast Lab 3" },
    { time: "08:00 - 09:30", code: "IT 101", title: "Introduction to Computing", section: "BSIT-WMT-2-1", day: "Mon", room: "Cast 106" },

];

let myBookings = [
    { room: "Cast 106", date: "2026-04-28", startTime: "09:00", duration: 2 },
    { room: "Cast Lab 3", date: "2026-04-26", startTime: "13:00", duration: 3 },
    { room: "Cast 107", date: "2026-04-26", startTime: "14:00", duration: 2 }
];

let students = [
    { id: 1, name: "Joshua Vince Junio II", present: true },
    { id: 2, name: "Elijah Josh Fajardo", present: false },
    { id: 3, name: "Viktor Isaac Arcega", present: true },
    { id: 4, name: "Jesreel Ignacio Calimlim", present: true }
];

// Login
function showLoginModal() { document.getElementById('login-modal').classList.remove('hidden'); }
function hideLoginModal() { document.getElementById('login-modal').classList.add('hidden'); }

function performLogin() {
    if (document.getElementById('teacher-id').value.trim().length > 3) {
        isLoggedIn = true;
        hideLoginModal();
        document.getElementById('login-btn').classList.add('hidden');
        document.getElementById('user-info').classList.remove('hidden');
        document.getElementById('logout-btn').classList.remove('hidden');
        alert(`Welcome back, ${currentUser}!`);
    } else {
        alert("Please enter valid credentials.");
    }
}

function logout() {
    if (confirm("Logout from EduTrack?")) location.reload();
}

// Schedule
function populateSchedule() {
    const tbody = document.getElementById('schedule-table');
    tbody.innerHTML = teacherSchedule.map(cls => `
        <tr class="border-b border-white/10 hover:bg-white/5">
            <td class="py-6 px-6">${cls.time}</td>
            <td class="py-6 px-6 font-mono text-[#E8B923]">${cls.code}</td>
            <td class="py-6 px-6">${cls.title}</td>
            <td class="py-6 px-6">${cls.section}</td>
            <td class="py-6 px-6">${cls.day}</td>
            <td class="py-6 px-6 text-emerald-400">${cls.room}</td>
            <td class="py-6 px-6 text-center">
                <button onclick="takeAttendance('${cls.code}')" class="px-6 py-2 bg-emerald-400 text-[#0A2540] rounded-3xl text-sm font-bold">Attendance</button>
            </td>
        </tr>
    `).join('');
}

// Real-time Conflict Detection + Time Slot Suggestions
function checkForConflict() {
    const room = document.getElementById('room-select').value;
    const date = document.getElementById('booking-date').value;
    const startTime = document.getElementById('booking-time').value;
    const duration = parseInt(document.getElementById('booking-duration').value) || 1;

    const alertBox = document.getElementById('conflict-alert');
    const suggestionsDiv = document.getElementById('suggestions');
    const suggestionSlots = document.getElementById('suggestion-slots');
    const bookBtn = document.getElementById('book-btn');

    alertBox.classList.add('hidden');
    suggestionsDiv.classList.add('hidden');
    bookBtn.disabled = true;
    bookBtn.textContent = "Check Availability";

    if (!room || !date || !startTime) return;

    const [sh, sm] = startTime.split(':').map(Number);
    const endTimeMinutes = (sh + duration) * 60 + sm;

    const conflict = myBookings.find(b => {
        if (b.room !== room || b.date !== date) return false;
        const [bh, bm] = b.startTime.split(':').map(Number);
        const bookingEnd = (bh + b.duration) * 60 + bm;
        return !(endTimeMinutes <= (bh * 60 + bm) || (sh * 60 + sm) >= bookingEnd);
    });

    if (conflict) {
        alertBox.className = "conflict p-5 rounded-2xl text-sm";
        alertBox.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
  <path fillRule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clipRule="evenodd" />
</svg>
 Conflict detected with existing booking at ${conflict.startTime} (${conflict.duration}h)`;
        alertBox.classList.remove('hidden');

        // Generate suggestions
        suggestionsDiv.classList.remove('hidden');
        suggestionSlots.innerHTML = '';

        let currentHour = 8;
        let suggestionsFound = 0;

        while (suggestionsFound < 3 && currentHour <= 17) {
            const suggestedStart = `${currentHour.toString().padStart(2, '0')}:00`;
            const suggestedEnd = currentHour + duration;

            const hasConflict = myBookings.some(b => 
                b.room === room && b.date === date &&
                !(suggestedEnd * 60 <= (parseInt(b.startTime.split(':')[0]) * 60) || 
                  currentHour * 60 >= (parseInt(b.startTime.split(':')[0]) + b.duration) * 60)
            );

            if (!hasConflict) {
                const slot = document.createElement('button');
                slot.className = "suggestion-slot px-5 py-2 rounded-3xl text-sm font-medium cursor-pointer hover:bg-[#E8B923] hover:text-[#0A2540]";
                slot.textContent = `${suggestedStart} - ${suggestedEnd}:00`;
                slot.onclick = () => {
                    document.getElementById('booking-time').value = suggestedStart;
                    checkForConflict();
                };
                suggestionSlots.appendChild(slot);
                suggestionsFound++;
            }
            currentHour++;
        }
    } else {
        alertBox.className = "available p-5 rounded-2xl text-sm";
        alertBox.innerHTML = `✅ Room is available for the selected time.`;
        alertBox.classList.remove('hidden');
        bookBtn.disabled = false;
        bookBtn.textContent = "Confirm Booking";
    }
}

function submitBooking() {
    if (!isLoggedIn) return alert("Please login first.");

    const room = document.getElementById('room-select').value;
    const date = document.getElementById('booking-date').value;
    const startTime = document.getElementById('booking-time').value;
    const duration = parseInt(document.getElementById('booking-duration').value);

    myBookings.push({ room, date, startTime, duration });

    alert(`✅ Booking confirmed!\nRoom: ${room}\nDate: ${date}\nTime: ${startTime} (${duration} hours)`);

    // Reset form
    document.getElementById('room-select').value = '';
    document.getElementById('booking-date').value = '';
    document.getElementById('booking-time').value = '';
    document.getElementById('conflict-alert').classList.add('hidden');
    document.getElementById('suggestions').classList.add('hidden');
    document.getElementById('book-btn').disabled = true;
    document.getElementById('book-btn').textContent = "Check Availability";

    renderCalendar();
}

// Calendar
function renderCalendar() {
    const calendarDiv = document.getElementById('calendar');
    let html = `<div class="grid grid-cols-7 gap-1 text-center text-sm mb-4">`;
    ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].forEach(d => html += `<div class="font-medium py-2 text-white/60">${d}</div>`);

    for (let i = 1; i <= 35; i++) {
        const dateStr = `2026-04-${i.toString().padStart(2, '0')}`;
        const isBooked = myBookings.some(b => b.date === dateStr);
        const isToday = i === 26;

        html += `
            <div onclick="selectCalendarDate(${i})" 
                 class="calendar-day ${isBooked ? 'booked' : ''} ${isToday ? 'today' : ''}">
                ${i}
            </div>`;
    }
    html += `</div>`;
    calendarDiv.innerHTML = html;
}

function selectCalendarDate(day) {
    document.getElementById('booking-date').value = `2026-04-${day.toString().padStart(2, '0')}`;
    checkForConflict();
}

// Attendance
function loadAttendance() {
    if (!isLoggedIn) return alert("Please login first.");
    const container = document.getElementById('attendance-list');
    container.innerHTML = students.map(s => `
        <div class="bg-white/5 p-6 rounded-2xl flex justify-between items-center">
            <span>${s.name}</span>
            <button onclick="togglePresent(${s.id})" 
                    class="px-6 py-2 rounded-3xl text-sm ${s.present ? 'bg-emerald-400 text-[#0A2540]' : 'bg-white/20'}">
                ${s.present ? 'Present' : 'Absent'}
            </button>
        </div>
    `).join('');
    updateAttendanceSummary();
}

function togglePresent(id) {
    const student = students.find(s => s.id === id);
    if (student) student.present = !student.present;
    loadAttendance();
}

function updateAttendanceSummary() {
    const present = students.filter(s => s.present).length;
    document.getElementById('attendance-summary').innerHTML = 
        `<span class="text-emerald-400">${present}/${students.length}</span> students present`;
}

function saveAttendance() {
    if (!isLoggedIn) return alert("Please login first.");
    alert("Attendance saved successfully!");
}

function takeAttendance(code) {
    if (!isLoggedIn) return alert("Please login first.");
    document.getElementById('attendance').scrollIntoView({ behavior: 'smooth' });
    document.getElementById('attendance-class').value = code;
    loadAttendance();
}

// Initialize
window.addEventListener('load', () => {
    setTimeout(() => {
        document.getElementById('ls-fill').style.width = '100%';
        document.getElementById('ls-status').textContent = 'Ready';
        setTimeout(() => {
            document.getElementById('loading-screen').style.opacity = '0';
            setTimeout(() => {
                document.getElementById('loading-screen').style.display = 'none';
                populateSchedule();
                renderCalendar();
            }, 600);
        }, 600);
    }, 800);
});