let websiteData = {};

// Load JSON data
async function loadJSON() {
    try {
        const response = await fetch('../data.json');
        if (!response.ok) throw new Error('Failed to load data');
        websiteData = await response.json();
        return websiteData;
    } catch (error) {
        console.error('Error loading JSON:', error);
        showAlert('Gagal memuat data JSON', 'error');
        return null;
    }
}

// Download updated JSON
function downloadJSON() {
    if (!websiteData) {
        showAlert('Tidak ada data untuk didownload', 'error');
        return;
    }
    
    const dataStr = JSON.stringify(websiteData, null, 2);
    const dataBlob = new Blob([dataStr], { type: 'application/json' });
    const url = URL.createObjectURL(dataBlob);
    
    const a = document.createElement('a');
    a.href = url;
    a.download = 'data_updated.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    showAlert('File JSON siap didownload', 'success');
}

// Show alert message
function showAlert(message, type = 'success') {
    const alert = document.createElement('div');
    alert.className = `fixed top-4 right-4 p-4 rounded-md shadow-md ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white flex items-center`;
    
    alert.innerHTML = `
        <ion-icon name="${type === 'success' ? 'checkmark-circle' : 'alert-circle'}" class="mr-2"></ion-icon>
        ${message}
    `;
    
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 3000);
}

// Render sections
async function renderSection(section) {
    const contentDiv = document.getElementById('adminContent');
    const titleDiv = document.getElementById('adminSectionTitle');
    
    // Update active link
    document.querySelectorAll('[data-section]').forEach(link => {
        link.classList.remove('active-admin-link', 'text-primary', 'font-medium');
        if (link.getAttribute('data-section') === section) {
            link.classList.add('active-admin-link', 'text-primary', 'font-medium');
        }
    });
    
    switch(section) {
        case 'dashboard':
            titleDiv.textContent = 'Dashboard';
            renderDashboard(contentDiv);
            break;
        case 'hero':
            titleDiv.textContent = 'Edit Hero Section';
            await renderHeroEditor(contentDiv);
            break;
        case 'download':
            titleDiv.textContent = 'Download Data';
            renderDownloadSection(contentDiv);
            break;
        // Add other sections as needed...
        default:
            renderDashboard(contentDiv);
    }
}

// Dashboard view
function renderDashboard(container) {
    container.innerHTML = `
        <div class="space-y-6">
            <div class="bg-primary/10 p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-4">Selamat datang di Admin Panel</h3>
                <p>Gunakan menu di sidebar untuk mengedit berbagai bagian dari website SMPN 5 Semarang.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-sm">
                    <h4 class="font-semibold mb-3">Instruksi</h4>
                    <ul class="space-y-3 list-disc pl-5">
                        <li>Edit konten melalui menu sidebar</li>
                        <li>Gunakan "Download Data" untuk menyimpan perubahan</li>
                        <li>Ganti file data.json di root dengan file yang didownload</li>
                    </ul>
                </div>
                
                <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-sm">
                    <h4 class="font-semibold mb-3">Status Terkini</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <ion-icon name="checkmark-circle" class="text-green-500 mr-2"></ion-icon>
                            <span>Panel Admin Siap Digunakan</span>
                        </li>
                        <li class="flex items-center">
                            <ion-icon name="warning" class="text-yellow-500 mr-2"></ion-icon>
                            <span>Perubahan belum disimpan ke server</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    `;
}

// Hero Section Editor
async function renderHeroEditor(container) {
    const data = await loadJSON();
    if (!data) return;
    
    container.innerHTML = `
        <form id="heroForm" class="space-y-6">
            <div>
                <label class="block text-gray-700 mb-2 font-medium">Judul Utama</label>
                <input type="text" id="heroTitle" value="${data.hero.title}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2 font-medium">Subjudul</label>
                <textarea id="heroSubtitle" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">${data.hero.subtitle}</textarea>
            </div>
            
            <div class="flex justify-end space-x-4 pt-4">
                <button type="button" onclick="renderSection('dashboard')" 
                        class="px-6 py-2 border border-gray-300 rounded-full hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-primary text-white rounded-full hover:bg-secondary">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    `;
    
    document.getElementById('heroForm').addEventListener('submit', (e) => {
        e.preventDefault();
        websiteData.hero.title = document.getElementById('heroTitle').value;
        websiteData.hero.subtitle = document.getElementById('heroSubtitle').value;
        showAlert('Perubahan disimpan (lokal)', 'success');
    });
}

// Download Section
function renderDownloadSection(container) {
    container.innerHTML = `
        <div class="space-y-6">
            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                <h3 class="text-xl font-semibold mb-4">Download Data Terbaru</h3>
                <p class="mb-4">Klik tombol dibawah untuk mendownload file JSON dengan semua perubahan yang telah dibuat.</p>
                
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <ion-icon name="warning" class="text-yellow-500"></ion-icon>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Perhatian:</strong> File ini perlu diunggah manual ke server untuk memperbarui website.
                            </p>
                        </div>
                    </div>
                </div>
                
                <button onclick="downloadJSON()" 
                        class="w-full md:w-auto px-6 py-3 bg-primary text-white rounded-full hover:bg-secondary flex items-center justify-center">
                    <ion-icon name="download-outline" class="mr-2"></ion-icon>
                    Download data.json
                </button>
            </div>
        </div>
    `;
}

// Initialize admin panel
document.addEventListener('DOMContentLoaded', () => {
    // Handle navigation
    document.querySelectorAll('[data-section]').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const section = link.getAttribute('data-section');
            renderSection(section);
        });
    });
    
    // Load dashboard by default
    renderSection('dashboard');
});
