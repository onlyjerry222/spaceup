<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$auth = new Auth($pdo);

// Redirect if not logged in
if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$currentUser = [
    'id' => $_SESSION['user_id'],
    'username' => $_SESSION['username'],
    'fullname' => $_SESSION['fullname'],
    'class' => $_SESSION['class'],
    'role' => $_SESSION['role']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>SchoolSpace - Dashboard</title>
  <link rel="stylesheet" href="styles/style.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
  <!-- GLOBAL OVERLAY -->
  <div id="overlay" class="overlay"></div>

  <!-- SIDEBAR -->
  <aside id="sidebar" class="sidebar" aria-hidden="true">
    <!-- Sidebar content from original HTML -->
    <div class="sidebar-head">
      <h3>Classroom</h3>
      <button id="closeSidebar" class="btn-icon" title="Close sidebar" aria-label="Close sidebar">&times;</button>
    </div>

    <nav class="class-list">
      <button class="class-item">10A</button>
      <button class="class-item">10B</button>
      <button class="class-item">11A</button>
      <button class="class-item">11B</button>
    </nav>

    <section class="class-info">
      <h4><?php echo htmlspecialchars($currentUser['class']); ?> — Seat View</h4>
      <div id="classGrid" class="class-grid"></div>
      <small class="legend">
        Legend:
        <span class="dot present"></span> hadir •
        <span class="dot permission"></span> izin •
        <span class="dot sick"></span> sakit •
        <span class="dot absent"></span> alpa •
        <span class="dot left-early"></span> pulang
      </small>
    </section>
  </aside>

  <!-- APP -->
  <div class="app">
    <!-- TOPBAR -->
    <header class="topbar">
      <button id="openSidebar" class="btn-icon" aria-label="Open menu"><i data-lucide="menu"></i></button>
      <div class="brand">SchoolSpace</div>
      <div class="top-actions">
        <span class="welcome-text">Welcome, <?php echo htmlspecialchars($currentUser['fullname']); ?></span>
        <button id="chatsBtn" class="icon-wrap" aria-label="Open chats">
          <i data-lucide="message-circle"></i>
        </button>
        <a href="logout.php" class="btn-icon logout-btn" title="Logout">
          <i data-lucide="log-out"></i>
        </a>
      </div>
    </header>

    <!-- Rest of the dashboard content from original HTML -->
    <!-- ... (stories, announcements, feed, etc.) ... -->
    
    <!-- BOTTOM NAV -->
    <nav class="bottom-nav">
      <button id="homeNav" class="nav-btn active" title="Home"><i data-lucide="home"></i></button>
      <button id="searchNav" class="nav-btn" title="Search"><i data-lucide="search"></i></button>
      <button id="createNav" class="nav-btn create" title="Create Up"><i data-lucide="plus-circle"></i></button>
      <button id="notifNav" class="nav-btn" title="Notifications">
        <i data-lucide="bell"></i>
        <span id="notifDot" class="badge-dot small hidden"></span>
      </button>
      <button id="profileNav" class="nav-btn" title="Profile">
        <img id="miniProfile" class="mini-profile" src="https://i.pravatar.cc/100?img=65" alt="profile">
      </button>
    </nav>
  </div>

  <script src="scripts/script.js"></script>
  <script>lucide.createIcons()</script>
</body>
</html>