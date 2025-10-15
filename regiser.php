<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$auth = new Auth($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $class = $_POST['class'] ?? '';
    
    $result = $auth->register($username, $email, $password, $fullname, $class);
    
    if ($result === true) {
        header('Location: login.php?registered=1');
        exit;
    } else {
        $error = $result;
    }
}

// Redirect if already logged in
if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Register - SchoolSpace</title>
  <link rel="stylesheet" href="styles/style.css" />
</head>
<body class="auth-page">
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h1 class="brand">SchoolSpace</h1>
        <p class="auth-subtitle">Create your account</p>
      </div>
      
      <?php if (isset($error)): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>
      
      <?php if (isset($_GET['registered'])): ?>
        <div class="alert alert-success">Registration successful! You can now login.</div>
      <?php endif; ?>
      
      <form method="POST" class="auth-form">
        <div class="form-group">
          <label for="fullname">Full Name</label>
          <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
        </div>
        
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Choose a username" required>
        </div>
        
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
          <label for="class">Class</label>
          <select id="class" name="class" required>
            <option value="">Select your class</option>
            <option value="10A">10A</option>
            <option value="10B">10B</option>
            <option value="11A">11A</option>
            <option value="11B">11B</option>
            <option value="12A">12A</option>
            <option value="12B">12B</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>
        
        <button type="submit" class="btn-primary">Create Account</button>
        
        <div class="auth-links">
          <a href="index.php" class="back-link">← Back to home</a>
          <a href="login.php">Already have an account? Sign in</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>