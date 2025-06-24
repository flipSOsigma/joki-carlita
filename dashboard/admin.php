<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    header('Location: index.php');
    exit;
}

$data_file = 'data.json';
$data = json_decode(file_get_contents($data_file), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Use save_data.php for saving']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SMPN 5 Content Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-800 text-white p-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold">SMPN 5 Content Management</h1>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition">Logout</a>
    </header>
    
    <nav class="bg-blue-700 text-white">
        <ul class="flex overflow-x-auto">
            <li><a href="#school-info" class="block px-4 py-3 hover:bg-blue-600 transition">School Info</a></li>
            <li><a href="#principal" class="block px-4 py-3 hover:bg-blue-600 transition">Principal</a></li>
            <li><a href="#stats" class="block px-4 py-3 hover:bg-blue-600 transition">Statistics</a></li>
            <li><a href="#news" class="block px-4 py-3 hover:bg-blue-600 transition">News</a></li>
            <li><a href="#about" class="block px-4 py-3 hover:bg-blue-600 transition">About</a></li>
            <li><a href="#hero" class="block px-4 py-3 hover:bg-blue-600 transition">Hero Section</a></li>
            <li><a href="#add-news" class="block px-4 py-3 hover:bg-blue-600 transition">Add News</a></li>
            <li><a href="#add-teacher" class="block px-4 py-3 hover:bg-blue-600 transition">Add Teacher</a></li>
            <li><a href="#add-student" class="block px-4 py-3 hover:bg-blue-600 transition">Add Student</a></li>
            <li><a href="#add-achievement" class="block px-4 py-3 hover:bg-blue-600 transition">Add Achievement</a></li>
        </ul>
    </nav>
    
    <main class="container mx-auto p-4 max-w-7xl">
        <!-- School Info Section -->
        <section id="school-info" class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">School Information</h2>
            <form class="ajax-form" data-section="school">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">School Name</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($data['school']['name']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Short Name</label>
                        <input type="text" name="shortName" value="<?php echo htmlspecialchars($data['school']['shortName']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Address</label>
                    <textarea name="address" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"><?php echo htmlspecialchars($data['school']['address']); ?></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($data['school']['email']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Instagram URL</label>
                        <input type="url" name="instagram" value="<?php echo htmlspecialchars($data['school']['instagram']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">WhatsApp URL</label>
                        <input type="url" name="whatsapp" value="<?php echo htmlspecialchars($data['school']['whatsapp']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Motto</label>
                    <textarea name="motto" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"><?php echo htmlspecialchars($data['school']['motto']); ?></textarea>
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Changes
                </button>
            </form>
        </section>
        
        <!-- Principal Section -->
        <section id="principal" class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Principal Information</h2>
            <form class="ajax-form" data-section="principal">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($data['principal']['name']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">NIP</label>
                        <input type="text" name="nip" value="<?php echo htmlspecialchars($data['principal']['nip']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Greeting</label>
                    <input type="text" name="greeting" value="<?php echo htmlspecialchars($data['principal']['greeting']); ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Message</label>
                    <textarea name="message" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-32"><?php echo htmlspecialchars($data['principal']['message']); ?></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Image Path</label>
                    <input type="text" name="image" value="<?php echo htmlspecialchars($data['principal']['image']); ?>" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Changes
                </button>
            </form>
        </section>

        
        <!-- News Section -->
        <section id="news" class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">News Items</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach ($data['news'] as $index => $news): ?>
                <form class="ajax-form news-form bg-gray-50 p-4 rounded-md border border-gray-200" data-section="news" data-index="<?php echo $index; ?>">
                    <h3 class="font-medium text-gray-700 mb-3">News #<?php echo $index + 1; ?></h3>
                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Title</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Category</label>
                        <input type="text" name="category" value="<?php echo htmlspecialchars($news['category']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Excerpt</label>
                        <textarea name="excerpt" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm h-24"><?php echo htmlspecialchars($news['excerpt']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Image Path</label>
                        <input type="text" name="image" value="<?php echo htmlspecialchars($news['image']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Link</label>
                        <input type="text" name="link" value="<?php echo htmlspecialchars($news['link']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-4 rounded-md text-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Save
                    </button>
                </form>
                <?php endforeach; ?>
            </div>
        </section>
        
        <!-- About Section -->
        <section id="about" class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">About Section</h2>
            <form class="ajax-form" data-section="about">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Title</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($data['about']['title']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Subtitle</label>
                        <input type="text" name="subtitle" value="<?php echo htmlspecialchars($data['about']['subtitle']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Vision</h3>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Vision Title</label>
                        <input type="text" name="vision_title" value="<?php echo htmlspecialchars($data['about']['vision']['title']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Vision Content</label>
                        <textarea name="vision_content" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-32"><?php echo htmlspecialchars($data['about']['vision']['content']); ?></textarea>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Mission</h3>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Mission Title</label>
                        <input type="text" name="mission_title" value="<?php echo htmlspecialchars($data['about']['mission']['title']); ?>" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Mission Content</label>
                        <textarea name="mission_content" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-32"><?php echo htmlspecialchars($data['about']['mission']['content']); ?></textarea>
                    </div>
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Changes
                </button>
            </form>
        </section>
        
        <!-- Hero Section -->
        <section id="hero" class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Hero Section</h2>
            <form class="ajax-form" data-section="hero">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Title</label>
                    <textarea name="title" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"><?php echo htmlspecialchars($data['hero']['title']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Subtitle</label>
                    <textarea name="subtitle" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-32"><?php echo htmlspecialchars($data['hero']['subtitle']); ?></textarea>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Changes
                </button>
            </form>
        </section>
        <!-- Add News Section -->
<section id="add-news" class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Add News</h2>
    <form class="add-form" data-type="news">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Category</label>
                <input type="text" name="category" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Excerpt</label>
            <textarea name="excerpt" required 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"></textarea>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Image Path</label>
                <input type="text" name="image" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Link</label>
                <input type="text" name="link" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Date</label>
                <input type="date" name="date" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Author</label>
                <input type="text" name="author" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            Add News
        </button>
    </form>
</section>

<!-- Add Teacher Section -->
<section id="add-teacher" class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Add Teacher</h2>
    <form class="add-form" data-type="teacher">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                <input type="text" name="name" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">NIP</label>
                <input type="text" name="nip" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Subject</label>
                <input type="text" name="subject" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Phone</label>
                <input type="tel" name="phone" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Image Path</label>
                <input type="text" name="image" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            Add Teacher
        </button>
    </form>
</section>

<!-- Add Student Section -->
<section id="add-student" class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Add Student</h2>
    <form class="add-form" data-type="student">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                <input type="text" name="name" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">NIS</label>
                <input type="text" name="nis" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Class</label>
                <input type="text" name="class" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Birth Date</label>
                <input type="date" name="birth_date" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Address</label>
            <textarea name="address" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"></textarea>
        </div>
        
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            Add Student
        </button>
    </form>
</section>

<!-- Add Achievement Section -->
<section id="add-achievement" class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Add Achievement</h2>
    <form class="add-form" data-type="achievement">
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" name="title" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Student ID</label>
                <input type="text" name="student_id" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Student Name</label>
                <input type="text" name="student_name" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Competition</label>
                <input type="text" name="competition" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Date</label>
                <input type="date" name="date" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Level</label>
                <select name="level" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Level</option>
                    <option value="School">School</option>
                    <option value="Kota">Kota</option>
                    <option value="Provinsi">Provinsi</option>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"></textarea>
        </div>
        
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            Add Achievement
        </button>
    </form>
</section>
    </main>
    
    <!-- Notification -->
    <div id="notification" class="fixed bottom-4 right-4 px-6 py-3 rounded-md shadow-lg bg-green-500 text-white transform translate-y-16 opacity-0 transition-all duration-300"></div>
    
    <script src="assets/script.js"></script>
</body>
</html>