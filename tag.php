<?php
// 1. GET TAG FROM URL
$current_tag = isset($_GET['name']) ? $_GET['name'] : 'Unknown';

// 2. LINK TO BACKEND
// require 'actions/fetch_questions_by_tag.php';

// --- TEMPORARY MOCK DATA ---
// We mimic filtering the list
$questions = [
    [
        'id' => 10,
        'title' => 'How to use lists in ' . $current_tag . '?',
        'description' => 'I am new to ' . $current_tag . ' and I want to know how arrays work...',
        'tags' => $current_tag . ', basics, arrays',
        'view_count' => 45,
        'user_id' => 101,
        'username' => 'NewbieCoder',
        'created_at' => '2023-11-01'
    ],
    [
        'id' => 12,
        'title' => 'Advanced ' . $current_tag . ' patterns',
        'description' => 'Looking for best practices in architecture...',
        'tags' => $current_tag . ', architecture, advanced',
        'view_count' => 120,
        'user_id' => 205,
        'username' => 'SeniorDev',
        'created_at' => '2023-11-02'
    ]
];
// ----------------------------
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Questions tagged [<?php echo htmlspecialchars($current_tag); ?>]</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand"><a href="index.php">Coders' Journey</a></div>
        <div class="nav-links">
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
                <h2>
                    Questions tagged <span style="color: #4a90e2;">[<?php echo htmlspecialchars($current_tag); ?>]</span>
                </h2>
                <a href="ask.php" class="btn btn-primary">Ask Question</a>
            </div>

            <p class="text-muted" style="margin-bottom: 20px;">
                Showing <?php echo count($questions); ?> results
            </p>

            <?php foreach ($questions as $q): ?>
                <div class="question-card">
                    <div class="stats-container">
                        <div class="stat-box">
                            <span class="stat-value"><?php echo $q['view_count']; ?></span>
                            <span class="stat-label">views</span>
                        </div>
                    </div>

                    <div class="question-content">
                        <h3 class="question-title">
                            <a href="question.php?id=<?php echo $q['id']; ?>">
                                <?php echo htmlspecialchars($q['title']); ?>
                            </a>
                        </h3>
                        <p class="question-excerpt">
                            <?php echo htmlspecialchars(substr($q['description'], 0, 150)); ?>...
                        </p>
                        <div class="meta-footer">
                            <div class="tags-list">
                                <?php 
                                    $tags_array = explode(',', $q['tags']); 
                                    foreach($tags_array as $tag):
                                ?>
                                    <?php $is_active = (trim($tag) == $current_tag) ? 'background:#d0e6ff; font-weight:bold;' : ''; ?>
                                    
                                    <span class="tag" style="<?php echo $is_active; ?>">
                                        <?php echo trim($tag); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                            <div class="user-info">
                                <span class="text-muted">asked by</span>
                                <a href="#" class="author-name"><?php echo htmlspecialchars($q['username']); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </main>

        <aside class="sidebar-right">
             <div class="card">
                <h3>About <?php echo htmlspecialchars($current_tag); ?></h3>
                <p class="text-muted">
                    This tag is used for questions related to <strong><?php echo htmlspecialchars($current_tag); ?></strong> development.
                </p>
            </div>
        </aside>

    </div>

</body>
</html>