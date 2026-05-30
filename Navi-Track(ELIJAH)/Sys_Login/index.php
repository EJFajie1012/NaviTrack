<?php
$Page = "Login Page";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Navi Track • Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" href="ssc.css">
        
    </head>
    <body class="hero-bg min-h-screen flex items-center justify-center overflow-hidden relative text-white">

        <!-- Animated Background Blobs -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-[-15%] left-[-10%] w-[500px] h-[500px] bg-cyan-400 rounded-full mix-blend-screen filter blur-[120px] opacity-20 blob" style="animation-delay: 0s;"></div>
            <div class="absolute bottom-[-20%] right-[-15%] w-[600px] h-[600px] bg-blue-500 rounded-full mix-blend-screen filter blur-[130px] opacity-20 blob" style="animation-delay: -8s;"></div>
            <div class="absolute top-[40%] right-[20%] w-[400px] h-[400px] bg-indigo-400 rounded-full mix-blend-screen filter blur-[110px] opacity-10 blob" style="animation-delay: -15s;"></div>
        </div>

        <!-- Subtle Grid Overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(rgba(255,255,255,0.07)_1px,transparent_1px)] [background-size:60px_60px] opacity-30"></div>

        <div class="max-w-[420px] w-full mx-auto px-6 relative z-10">
            
            <!-- Login Card -->
            <div class="glass-card rounded-3xl shadow-2xl p-10 pb-9 glow-cyan">
                
                <!-- Logo -->
    <div class="flex justify-center mb-8">
        <div class="flex items-center gap-x-3">
            
            <!-- Logo Image -->
            <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-inner border border-white/10">
                <img 
                    src="Logoo.png" 
                    alt="Navi Track Logo" 
                    class="w-full h-full object-cover"
                >
            </div>

            <!-- Logo Text -->
            <div class="heading-font">
                <span class="block text-3xl font-semibold tracking-[-2px]">
                    Navi Track
                </span>
                <span class="block text-[10px] text-cyan-300 -mt-1 tracking-[1px] uppercase">
                    Pangasinan State University Bayambang Campus
                </span>
            </div>

        </div>
    </div>

                <!-- Headline -->
                <div class="text-center mb-9">
                    <h1 class="heading-font text-4xl font-semibold tracking-tighter mb-2">Welcome to Navi Track</h1>
                    <p class="text-slate-400 text-[15.5px]">Smart Campus Access at Your Fingertips</p>
                </div>

                <!-- Role Selector -->
                <div class="flex bg-white/5 border border-white/10 rounded-2xl p-1 mb-9">
                    <button onclick="selectRole(0)" class="role-btn flex-1 py-3 text-sm font-medium rounded-xl transition-all active bg-white/10 text-white" data-role="0">
                        Student
                    </button>
                    <button onclick="selectRole(1)" class="role-btn flex-1 py-3 text-sm font-medium rounded-xl transition-all text-slate-400 hover:text-white" data-role="1">
                        Faculty
                    </button>
                    <button onclick="selectRole(2)" class="role-btn flex-1 py-3 text-sm font-medium rounded-xl transition-all text-slate-400 hover:text-white" data-role="2">
                        Admin
                    </button>
                </div>

                <!-- Form -->
                <form action= "/Sys_Database/Login_conn.php" method="post" id="loginForm" class="space-y-6">
                    
                    <!-- Identifier -->
                    <div>
                        <label class="block text-sm text-slate-400 mb-2 font-medium">Email or Student ID</label>
                        <div class="relative group">
                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-cyan-400 transition-colors">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <input type="text" name="username" id="username"
                                class="input-field w-full pl-12 pr-5 py-4 rounded-2xl text-base placeholder-slate-500 focus:outline-none"
                                placeholder="caralos@psu.edu.ph" required>
                        </div>
                    </div>  

                    <!-- Password -->
                    <div>
                        <label class="block text-sm text-slate-400 mb-2 font-medium">Password</label>
                        <div class="relative group">
                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-cyan-400 transition-colors">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="password"
                                class="input-field w-full pl-12 pr-12 py-4 rounded-2xl text-base placeholder-slate-500 focus:outline-none"
                                placeholder="••••••••" required>
                            <button type="button" onclick="togglePassword()" 
                                    class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition-colors">
                                <i class="fa-solid fa-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 accent-cyan-400 bg-white/10 border-white/30 rounded">
                            <span class="text-sm text-slate-400">Remember me</span>
                        </label>
                        <a href="#" onclick="forgotPassword()" 
                        class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                            class="w-full mt-4 py-4 bg-gradient-to-r from-[#3B82F6] to-[#22D3EE] hover:brightness-110 active:scale-[0.985] transition-all font-semibold text-base rounded-2xl shadow-xl shadow-cyan-500/30 flex items-center justify-center gap-x-3 group">
                        <span>Sign in to Navi Track</span>
                        <i class="fa-solid fa-arrow-right transition-transform group-active:translate-x-1"></i>
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-xs text-slate-500">
                        Need an Account?  
                        <a href="" class="text-cyan-400 hover:underline">Register Now</a>
                    </p>
                </div>
            </div>

            <!-- Trust Line -->
            <div class="flex justify-center items-center gap-x-6 mt-8 text-[10px] text-slate-500 tracking-widest">
                <div class="flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Pangasinan State University Bayambang Campus</span>
                </div>
                <div class="w-px h-3 bg-white/20"></div>
                <div>© 2026 Navi Track |  All Rights Reserved</div>
            </div>
        </div>

        <!-- Success Toast -->
        
        <script src="skript.js"></script>   
    </body>
    </html>