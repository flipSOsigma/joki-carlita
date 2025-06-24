<?php
$students = json_decode(file_get_contents('dashboard/data/students.json'), true);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa - SMPN 5 Semarang</title>
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
                    <a href="students.php" class="px-4 py-2 text-blue-600 font-medium">Siswa</a>
                    <a href="teachers.php" class="px-4 py-2 hover:text-blue-600">Guru</a>
                    <a href="achievements.php" class="px-4 py-2 hover:text-blue-600">Prestasi</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Siswa</h1>
            <div class="flex space-x-4">
                <select id="classFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>
                    <option value="7">Kelas 7</option>
                    <option value="8">Kelas 8</option>
                    <option value="9">Kelas 9</option>
                </select>
                <div class="relative w-64">
                    <input type="text" id="searchInput" placeholder="Cari siswa..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <ion-icon name="search" class="absolute right-3 top-2.5 text-gray-400 text-xl"></ion-icon>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="studentsTable">
                        <?php foreach ($students as $student): ?>
                        <tr class="student-row hover:bg-gray-50" 
                            data-name="<?= htmlspecialchars(strtolower($student['name'])) ?>" 
                            data-class="<?= htmlspecialchars(strtolower($student['class'])) ?>">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($student['nis']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($student['name']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= htmlspecialchars($student['class']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('d M Y', strtotime($student['birth_date'])) ?>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($student['address']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="noResults" class="hidden text-center py-10">
            <ion-icon name="alert-circle" class="text-4xl text-gray-400 mb-2"></ion-icon>
            <p class="text-gray-600">Tidak ditemukan siswa yang sesuai dengan pencarian Anda.</p>
        </div>
    </main>

    <script>
        const searchInput = document.getElementById('searchInput');
        const classFilter = document.getElementById('classFilter');
        const studentRows = document.querySelectorAll('.student-row');

        function filterStudents() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedClass = classFilter.value.toLowerCase();
            let hasResults = false;

            studentRows.forEach(row => {
                const name = row.getAttribute('data-name');
                const studentClass = row.getAttribute('data-class');
                
                const matchesSearch = name.includes(searchTerm);
                const matchesClass = selectedClass === '' || studentClass.includes(selectedClass);
                
                if (matchesSearch && matchesClass) {
                    row.classList.remove('hidden');
                    hasResults = true;
                } else {
                    row.classList.add('hidden');
                }
            });

            document.getElementById('noResults').classList.toggle('hidden', hasResults);
        }

        searchInput.addEventListener('input', filterStudents);
        classFilter.addEventListener('change', filterStudents);
    </script>
</body>
</html>