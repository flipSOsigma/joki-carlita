// Simple client-side authentication (not secure for production)
const ADMIN_CREDENTIALS = {
    username: "admin",
    password: "smpn5semarang123" // CHANGE THIS IN PRODUCTION
};

// Check if user is logged in
function checkAuth() {
    if (window.location.pathname.includes('dashboard.html') && !sessionStorage.getItem('isAuthenticated')) {
        window.location.href = 'index.html';
    }
}

// Login function
document.getElementById('loginForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorElement = document.getElementById('errorMessage');
    
    if (username === ADMIN_CREDENTIALS.username && password === ADMIN_CREDENTIALS.password) {
        sessionStorage.setItem('isAuthenticated', 'true');
        window.location.href = 'dashboard.html';
    } else {
        errorElement.textContent = 'Username atau password salah';
        errorElement.classList.remove('hidden');
    }
});

// Logout function
document.getElementById('logoutBtn')?.addEventListener('click', function() {
    sessionStorage.removeItem('isAuthenticated');
    window.location.href = 'index.html';
});

// Check authentication on page load
window.addEventListener('DOMContentLoaded', checkAuth);
