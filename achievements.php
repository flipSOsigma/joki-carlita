<?php
$achievements = json_decode(file_get_contents('dashboard/data/achievements.json'), true);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Siswa - SMPN 5 Semarang</title>
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
                    <a href="teachers.php" class="px-4 py-2 hover:text-blue-600">Guru</a>
                    <a href="achievements.php" class="px-4 py-2 text-blue-600 font-medium">Prestasi</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Prestasi Siswa</h1>
            <div class="relative w-64">
                <input type="text" id="searchInput" placeholder="Cari prestasi..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <ion-icon name="search" class="absolute right-3 top-2.5 text-gray-400 text-xl"></ion-icon>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="achievementsContainer">
            <?php foreach ($achievements as $achievement): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 achievement-card" 
                 data-title="<?= htmlspecialchars(strtolower($achievement['title'])) ?>" 
                 data-student="<?= htmlspecialchars(strtolower($achievement['student_name'])) ?>"
                 data-competition="<?= htmlspecialchars(strtolower($achievement['competition'])) ?>">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full"><?= htmlspecialchars($achievement['level']) ?></span>
                        <span class="text-sm text-gray-500"><?= date('d M Y', strtotime($achievement['date'])) ?></span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($achievement['title']) ?></h3>
                    <p class="text-gray-600 mb-1"><span class="font-medium">Siswa:</span> <?= htmlspecialchars($achievement['student_name']) ?></p>
                    <p class="text-gray-600 mb-1"><span class="font-medium">Kompetisi:</span> <?= htmlspecialchars($achievement['competition']) ?></p>
                    <p class="text-gray-600 mb-4"><?= htmlspecialchars($achievement['description']) ?></p>
                    <a href="#" class="text-blue-500 hover:text-blue-700 font-medium">Detail →</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div id="noResults" class="hidden text-center py-10">
            <ion-icon name="alert-circle" class="text-4xl text-gray-400 mb-2"></ion-icon>
            <p class="text-gray-600">Tidak ditemukan prestasi yang sesuai dengan pencarian Anda.</p>
        </div>
    </main>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.achievement-card');
            let hasResults = false;

            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                const student = card.getAttribute('data-student');
                const competition = card.getAttribute('data-competition');
                
                if (title.includes(searchTerm) || student.includes(searchTerm) || competition.includes(searchTerm)) {
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