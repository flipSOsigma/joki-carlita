<?php
require_once '../includes/auth.php';
requireAuth();

$content = loadContent();
$success = isset($_GET['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100" x-data="{ activeTab: 'school' }">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold">Content Manager</h1>
            <a href="logout.php" class="text-red-600 hover:text-red-800">Logout</a>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                Content updated successfully!
            </div>
        <?php endif; ?>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="border-b flex overflow-x-auto">
                <button @click="activeTab = 'school'" 
                        :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'school' }"
                        class="px-4 py-3 font-medium whitespace-nowrap">
                    School Info
                </button>
                <button @click="activeTab = 'hero'" 
                        :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'hero' }"
                        class="px-4 py-3 font-medium whitespace-nowrap">
                    Hero Section
                </button>
                <button @click="activeTab = 'principal'" 
                        :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'principal' }"
                        class="px-4 py-3 font-medium whitespace-nowrap">
                    Principal
                </button>
                <button @click="activeTab = 'stats'" 
                        :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'stats' }"
                        class="px-4 py-3 font-medium whitespace-nowrap">
                    Statistics
                </button>
                <button @click="activeTab = 'news'" 
                        :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'news' }"
                        class="px-4 py-3 font-medium whitespace-nowrap">
                    News
                </button>
                <button @click="activeTab = 'about'" 
                        :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'about' }"
                        class="px-4 py-3 font-medium whitespace-nowrap">
                    About Us
                </button>
            </div>
            
            <div class="p-6">
                <form id="contentForm" action="save-content.php" method="POST">
                    <div x-show="activeTab === 'school'">
                        <h2 class="text-xl font-semibold mb-6">School Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 mb-2">School Name</label>
                                <input type="text" name="school[name]" value="<?= htmlspecialchars($content['school']['name'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Short Name</label>
                                <input type="text" name="school[shortName]" value="<?= htmlspecialchars($content['school']['shortName'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Address</label>
                                <input type="text" name="school[address]" value="<?= htmlspecialchars($content['school']['address'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Email</label>
                                <input type="email" name="school[email]" value="<?= htmlspecialchars($content['school']['email'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Instagram URL</label>
                                <input type="url" name="school[instagram]" value="<?= htmlspecialchars($content['school']['instagram'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">WhatsApp URL</label>
                                <input type="url" name="school[whatsapp]" value="<?= htmlspecialchars($content['school']['whatsapp'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 mb-2">Motto</label>
                                <textarea name="school[motto]" class="w-full px-4 py-2 border rounded-md"><?= 
                                    htmlspecialchars($content['school']['motto'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div x-show="activeTab === 'hero'" x-transition>
                        <h2 class="text-xl font-semibold mb-6">Hero Section</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-2">Title</label>
                                <input type="text" name="hero[title]" value="<?= htmlspecialchars($content['hero']['title'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Subtitle</label>
                                <textarea name="hero[subtitle]" class="w-full px-4 py-2 border rounded-md"><?= 
                                    htmlspecialchars($content['hero']['subtitle'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div x-show="activeTab === 'principal'" x-transition>
                        <h2 class="text-xl font-semibold mb-6">Principal Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 mb-2">Name</label>
                                <input type="text" name="principal[name]" value="<?= htmlspecialchars($content['principal']['name'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">NIP</label>
                                <input type="text" name="principal[nip]" value="<?= htmlspecialchars($content['principal']['nip'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Greeting</label>
                                <input type="text" name="principal[greeting]" value="<?= htmlspecialchars($content['principal']['greeting'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Image Path</label>
                                <input type="text" name="principal[image]" value="<?= htmlspecialchars($content['principal']['image'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 mb-2">Message</label>
                                <textarea name="principal[message]" id="principalMessage" class="w-full px-4 py-2 border rounded-md"><?= 
                                    htmlspecialchars($content['principal']['message'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div x-show="activeTab === 'stats'" x-transition>
                        <h2 class="text-xl font-semibold mb-6">School Statistics</h2>
                        
                        <div class="space-y-6" id="statsContainer">
                            <?php foreach ($content['stats'] as $index => $stat): ?>
                            <div class="border rounded-lg p-4">
                                <h3 class="font-medium mb-4">Statistic #<?= $index + 1 ?></h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-gray-700 mb-2">Value</label>
                                        <input type="text" name="stats[<?= $index ?>][value]" 
                                               value="<?= htmlspecialchars($stat['value'] ?? '') ?>"
                                               class="w-full px-4 py-2 border rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Label</label>
                                        <input type="text" name="stats[<?= $index ?>][label]" 
                                               value="<?= htmlspecialchars($stat['label'] ?? '') ?>"
                                               class="w-full px-4 py-2 border rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Link</label>
                                        <input type="text" name="stats[<?= $index ?>][link]" 
                                               value="<?= htmlspecialchars($stat['link'] ?? '') ?>"
                                               class="w-full px-4 py-2 border rounded-md">
                                    </div>
                                </div>
                                <button type="button" onclick="removeStat(this)" 
                                        class="mt-2 text-red-600 hover:text-red-800 text-sm">
                                    Remove Statistic
                                </button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <button type="button" onclick="addStat()" 
                                class="mt-4 bg-blue-100 text-blue-600 px-4 py-2 rounded-md hover:bg-blue-200">
                            + Add New Statistic
                        </button>
                    </div>
                    
                    <div x-show="activeTab === 'news'" x-transition>
                        <h2 class="text-xl font-semibold mb-6">News Articles</h2>
                        
                        <div class="space-y-6" id="newsContainer">
                            <?php foreach ($content['news'] as $index => $news): ?>
                            <div class="border rounded-lg p-4">
                                <h3 class="font-medium mb-4">News #<?= $index + 1 ?></h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 mb-2">Title</label>
                                        <input type="text" name="news[<?= $index ?>][title]" 
                                               value="<?= htmlspecialchars($news['title'] ?? '') ?>"
                                               class="w-full px-4 py-2 border rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Category</label>
                                        <input type="text" name="news[<?= $index ?>][category]" 
                                               value="<?= htmlspecialchars($news['category'] ?? '') ?>"
                                               class="w-full px-4 py-2 border rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Image Path</label>
                                        <input type="text" name="news[<?= $index ?>][image]" 
                                               value="<?= htmlspecialchars($news['image'] ?? '') ?>"
                                               class="w-full px-4 py-2 border rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Link</label>
                                        <input type="text" name="news[<?= $index ?>][link]" 
                                               value="<?= htmlspecialchars($news['link'] ?? '') ?>"
                                               class="w-full px-4 py-2 border rounded-md">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-gray-700 mb-2">Excerpt</label>
                                        <textarea name="news[<?= $index ?>][excerpt]" 
                                                  class="w-full px-4 py-2 border rounded-md"><?= 
                                            htmlspecialchars($news['excerpt'] ?? '') ?></textarea>
                                    </div>
                                </div>
                                <button type="button" onclick="removeNews(this)" 
                                        class="mt-2 text-red-600 hover:text-red-800 text-sm">
                                    Remove News
                                </button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <button type="button" onclick="addNews()" 
                                class="mt-4 bg-blue-100 text-blue-600 px-4 py-2 rounded-md hover:bg-blue-200">
                            + Add New News
                        </button>
                    </div>
                    
                    <div x-show="activeTab === 'about'" x-transition>
                        <h2 class="text-xl font-semibold mb-6">About Us Section</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-2">Title</label>
                                <input type="text" name="about[title]" value="<?= htmlspecialchars($content['about']['title'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Subtitle</label>
                                <input type="text" name="about[subtitle]" value="<?= htmlspecialchars($content['about']['subtitle'] ?? '') ?>" 
                                       class="w-full px-4 py-2 border rounded-md">
                            </div>
                            
                            <div class="border-t pt-6 mt-6">
                                <h3 class="text-lg font-medium mb-4">Vision</h3>
                                <div>
                                    <label class="block text-gray-700 mb-2">Title</label>
                                    <input type="text" name="about[vision][title]" 
                                           value="<?= htmlspecialchars($content['about']['vision']['title'] ?? '') ?>"
                                           class="w-full px-4 py-2 border rounded-md">
                                </div>
                                <div class="mt-4">
                                    <label class="block text-gray-700 mb-2">Content</label>
                                    <textarea name="about[vision][content]" 
                                              class="w-full px-4 py-2 border rounded-md h-32"><?= 
                                        htmlspecialchars($content['about']['vision']['content'] ?? '') ?></textarea>
                                </div>
                            </div>
                            
                            <div class="border-t pt-6 mt-6">
                                <h3 class="text-lg font-medium mb-4">Mission</h3>
                                <div>
                                    <label class="block text-gray-700 mb-2">Title</label>
                                    <input type="text" name="about[mission][title]" 
                                           value="<?= htmlspecialchars($content['about']['mission']['title'] ?? '') ?>"
                                           class="w-full px-4 py-2 border rounded-md">
                                </div>
                                <div class="mt-4">
                                    <label class="block text-gray-700 mb-2">Content</label>
                                    <textarea name="about[mission][content]" 
                                              class="w-full px-4 py-2 border rounded-md h-32"><?= 
                                        htmlspecialchars($content['about']['mission']['content'] ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-8">
                        <button type="submit" 
                                class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                            Save All Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Initialize CKEditor
        CKEDITOR.replace('principal[message]');
        
        // Dynamic form elements
        let statCount = <?= count($content['stats']) ?>;
        let newsCount = <?= count($content['news']) ?>;
        
        function addStat() {
            const container = document.getElementById('statsContainer');
            const newIndex = statCount++;
            
            const statHTML = `
                <div class="border rounded-lg p-4">
                    <h3 class="font-medium mb-4">Statistic #${newIndex + 1}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Value</label>
                            <input type="text" name="stats[${newIndex}][value]" 
                                   class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Label</label>
                            <input type="text" name="stats[${newIndex}][label]" 
                                   class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Link</label>
                            <input type="text" name="stats[${newIndex}][link]" 
                                   class="w-full px-4 py-2 border rounded-md">
                        </div>
                    </div>
                    <button type="button" onclick="removeStat(this)" 
                            class="mt-2 text-red-600 hover:text-red-800 text-sm">
                        Remove Statistic
                    </button>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', statHTML);
        }
        
        function removeStat(button) {
            if (confirm('Are you sure you want to remove this statistic?')) {
                button.parentElement.remove();
                // Reindex remaining stats
                reindexStats();
            }
        }
        
        function reindexStats() {
            const stats = document.querySelectorAll('#statsContainer > div');
            stats.forEach((stat, index) => {
                stat.querySelector('h3').textContent = `Statistic #${index + 1}`;
                const inputs = stat.querySelectorAll('input');
                inputs[0].name = `stats[${index}][value]`;
                inputs[1].name = `stats[${index}][label]`;
                inputs[2].name = `stats[${index}][link]`;
            });
            statCount = stats.length;
        }
        
        function addNews() {
            const container = document.getElementById('newsContainer');
            const newIndex = newsCount++;
            
            const newsHTML = `
                <div class="border rounded-lg p-4">
                    <h3 class="font-medium mb-4">News #${newIndex + 1}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Title</label>
                            <input type="text" name="news[${newIndex}][title]" 
                                   class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Category</label>
                            <input type="text" name="news[${newIndex}][category]" 
                                   class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Image Path</label>
                            <input type="text" name="news[${newIndex}][image]" 
                                   class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Link</label>
                            <input type="text" name="news[${newIndex}][link]" 
                                   class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 mb-2">Excerpt</label>
                            <textarea name="news[${newIndex}][excerpt]" 
                                      class="w-full px-4 py-2 border rounded-md"></textarea>
                        </div>
                    </div>
                    <button type="button" onclick="removeNews(this)" 
                            class="mt-2 text-red-600 hover:text-red-800 text-sm">
                        Remove News
                    </button>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', newsHTML);
        }
        
        function removeNews(button) {
            if (confirm('Are you sure you want to remove this news item?')) {
                button.parentElement.remove();
                // Reindex remaining news
                reindexNews();
            }
        }
        
        function reindexNews() {
            const newsItems = document.querySelectorAll('#newsContainer > div');
            newsItems.forEach((news, index) => {
                news.querySelector('h3').textContent = `News #${index + 1}`;
                const inputs = news.querySelectorAll('input, textarea');
                inputs[0].name = `news[${index}][title]`;
                inputs[1].name = `news[${index}][category]`;
                inputs[2].name = `news[${index}][image]`;
                inputs[3].name = `news[${index}][link]`;
                inputs[4].name = `news[${index}][excerpt]`;
            });
            newsCount = newsItems.length;
        }
    </script>
</body>
</html>