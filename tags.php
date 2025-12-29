<?php
// 1. LINK TO BACKEND (Teammate's file)
// require 'actions/fetch_all_tags.php';

// --- TEMPORARY MOCK DATA ---
// We group tags so you can have that "Big Title" and "Small Sub-tags" look
$tag_groups = [
    [
        'name' => 'JavaScript',
        'description' => 'The language of the web.',
        'sub_tags' => ['React', 'Vue', 'Node.js', 'ES6', 'DOM'],
        'count' => 142
    ],
    [
        'name' => 'PHP',
        'description' => 'Server-side scripting language.',
        'sub_tags' => ['Laravel', 'Composer', 'PDO', 'Sessions', 'XAMPP'],
        'count' => 98
    ],
    [
        'name' => 'CSS',
        'description' => 'Styling and layout for web pages.',
        'sub_tags' => ['Flexbox', 'Grid', 'Bootstrap', 'Tailwind', 'Animations'],
        'count' => 205
    ],
    [
        'name' => 'Database',
        'description' => 'Storing and retrieving data.',
        'sub_tags' => ['MySQL', 'PostgreSQL', 'Oracle', 'SQL', 'Normalization'],
        'count' => 76
    ]
];
// ----------------------------
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Tags - Coders' Journey</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Tag Grid Layout */
        .tags-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .tag-card {
            background: white;
            border: 1px solid #e1e4e8;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .tag-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-color: #4a90e2;
        }

        .tag-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .tag-title {
            font-size: 1.4rem;
            color: #2c3e50;
            font-weight: bold;
            text-decoration: none;
        }
        
        .tag-count {
            background: #f1f2f3;
            color: #666;
            font-size: 0.8rem;
            padding: 2px 8px;
            border-radius: 12px;
        }

        .tag-desc {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .sub-tags-container {
            border-top: 1px solid #f1f1f1;
            padding-top: 10px;
        }

        .sub-tag-link {
            display: inline-block;
            font-size: 0.85rem;
            color: #4a90e2;
            margin-right: 8px;
            margin-bottom: 5px;
            text-decoration: none;
        }
        .sub-tag-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand"><a href="index.php">Coders' Journey</a></div>
        <div class="nav-links">
            <a href="roadmaps.php">Roadmaps</a>
            <a href="tags.php" class="active">Tags</a>
        </div>
        <div class="nav-auth">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn-register" style="background:#e74c3c;">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn-login">Log In</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container main-layout">
        
        <aside class="sidebar-left">
            <div class="sidebar-menu">
                <a href="index.php" class="menu-item">🏠 Home</a>
                <a href="roadmaps.php" class="menu-item">🗺️ Roadmaps</a>
                <a href="tags.php" class="menu-item active">🏷️ Tags</a>
            </div>
        </aside>

        <main class="content-feed">
            
            <div class="feed-header">
                <h2>Topics & Keywords</h2>
                <input type="text" placeholder="Find a tag..." style="padding: 8px; border:1px solid #ddd; border-radius:4px; font-size: 0.9rem;">
            </div>

            <div class="tags-grid">
                <?php foreach($tag_groups as $group): ?>
                    <div class="tag-card">
                        
                        <div class="tag-header">
                            <a href="tag.php?name=<?php echo urlencode($group['name']); ?>" class="tag-title">
                                <?php echo htmlspecialchars($group['name']); ?>
                            </a>
                            <span class="tag-count"><?php echo $group['count']; ?> questions</span>
                        </div>

                        <p class="tag-desc"><?php echo htmlspecialchars($group['description']); ?></p>

                        <div class="sub-tags-container">
                            <?php foreach($group['sub_tags'] as $sub): ?>
                                <a href="tag.php?name=<?php echo urlencode($sub); ?>" class="sub-tag-link">
                                    <?php echo htmlspecialchars($sub); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </main>

        <aside class="sidebar-right"></aside>

    </div>

</body>
</html>