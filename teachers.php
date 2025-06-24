<?php
$teachers = json_decode(file_get_contents('dashboard/data/teachers.json'), true);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - SMPN 5 Semarang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="index.html" class="text-2xl font-bold text-blue-600">SMPN5<span class="text-blue-400">Semarang</span></a>
                <div class="flex space-x-4">
                    <a href="students.php" class="px-4 py-2 hover:text-blue-600">Siswa</a>
                    <a href="teachers.php" class="px-4 py-2 text-blue-600 font-medium">Guru</a>
                    <a href="achievements.php" class="px-4 py-2 hover:text-blue-600">Prestasi</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Guru</h1>
            <div class="relative w-64">
                <input type="text" id="searchInput" placeholder="Cari guru..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <ion-icon name="search" class="absolute right-3 top-2.5 text-gray-400 text-xl"></ion-icon>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="teachersContainer">
            <?php foreach ($teachers as $teacher): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 teacher-card" 
                 data-name="<?= htmlspecialchars(strtolower($teacher['name'])) ?>" 
                 data-subject="<?= htmlspecialchars(strtolower($teacher['subject'])) ?>">
                <div class="flex items-center p-6">
                    <div class="w-20 h-20 rounded-full bg-gray-200 overflow-hidden mr-4">
                        <?php if (!empty($teacher['image'])): ?>
                        <img src="<?= htmlspecialchars($teacher['image']) ?>" alt="<?= htmlspecialchars($teacher['name']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <ion-icon name="person" class="text-3xl"></ion-icon>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($teacher['name']) ?></h3>
                        <p class="text-gray-600"><?= htmlspecialchars($teacher['subject']) ?></p>
                        <p class="text-sm text-gray-500 mt-1">NIP: <?= htmlspecialchars($teacher['nip']) ?></p>
                        <div class="flex space-x-2 mt-2">
                            <?php if (!empty($teacher['email'])): ?>
                            <a href="mailto:<?= htmlspecialchars($teacher['email']) ?>" class="text-blue-500 hover:text-blue-700">
                                <ion-icon name="mail" class="text-lg"></ion-icon>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($teacher['phone'])): ?>
                            <a href="tel:<?= htmlspecialchars($teacher['phone']) ?>" class="text-blue-500 hover:text-blue-700">
                                <ion-icon name="call" class="text-lg"></ion-icon>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div id="noResults" class="hidden text-center py-10">
            <ion-icon name="alert-circle" class="text-4xl text-gray-400 mb-2"></ion-icon>
            <p class="text-gray-600">Tidak ditemukan guru yang sesuai dengan pencarian Anda.</p>
        </div>
    </main>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.teacher-card');
            let hasResults = false;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const subject = card.getAttribute('data-subject');
                
                if (name.includes(searchTerm) || subject.includes(searchTerm)) {
                    card.classList.remove('hidden');
                    hasResults = true;
                } else {
                    card.classList.add('hidden');
                }
            });

            document.getElementById('noResults').classList.toggle('hidden', hasResults);
        });
    </script>
</body>
</html>