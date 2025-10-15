<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$auth = new Auth($pdo);

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
  <title>SchoolSpace - Welcome</title>
  <link rel="stylesheet" href="styles/style.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="auth-page">
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h1 class="brand">SchoolSpace</h1>
        <p class="auth-subtitle">Connect with your school community</p>
      </div>
      
      <div class="auth-tabs">
        <button class="auth-tab active" data-tab="login">Login</button>
        <button class="auth-tab" data-tab="register">Register</button>
      </div>
      
      <!-- Login Form -->
      <form id="loginForm" class="auth-form active" method="POST" action="login.php">
        <div class="form-group">
          <label for="loginEmail">Email</label>
          <input type="email" id="loginEmail" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
          <label for="loginPassword">Password</label>
          <input type="password" id="loginPassword" name="password" placeholder="Enter your password" required>
        </div>
        
        <button type="submit" class="btn-primary">Sign In</button>
        
        <div class="auth-links">
          <a href="#" class="forgot-password">Forgot password?</a>
        </div>
      </form>
      
      <!-- Register Form -->
      <form id="registerForm" class="auth-form" method="POST" action="register.php">
        <div class="form-group">
          <label for="regFullname">Full Name</label>
          <input type="text" id="regFullname" name="fullname" placeholder="Enter your full name" required>
        </div>
        
        <div class="form-group">
          <label for="regUsername">Username</label>
          <input type="text" id="regUsername" name="username" placeholder="Choose a username" required>
        </div>
        
        <div class="form-group">
          <label for="regEmail">Email</label>
          <input type="email" id="regEmail" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
          <label for="regClass">Class</label>
          <select id="regClass" name="class" required>
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
          <label for="regPassword">Password</label>
          <input type="password" id="regPassword" name="password" placeholder="Create a password" required>
        </div>
        
        <div class="form-group">
          <label for="regConfirmPassword">Confirm Password</label>
          <input type="password" id="regConfirmPassword" name="confirm_password" placeholder="Confirm your password" required>
        </div>
        
        <button type="submit" class="btn-primary">Create Account</button>
      </form>
    </div>
    
    <div class="auth-features">
      <div class="feature-card">
        <i data-lucide="users" class="feature-icon"></i>
        <h3>Connect with Classmates</h3>
        <p>Stay connected with your classmates and teachers</p>
      </div>
      
      <div class="feature-card">
        <i data-lucide="book-open" class="feature-icon"></i>
        <h3>Share Resources</h3>
        <p>Exchange study materials and resources</p>
      </div>
      
      <div class="feature-card">
        <i data-lucide="calendar" class="feature-icon"></i>
        <h3>Stay Updated</h3>
        <p>Never miss important announcements and events</p>
      </div>
    </div>
  </div>

  <script>
    // Tab switching
    document.querySelectorAll('.auth-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        const targetTab = tab.dataset.tab;
        
        // Update active tab
        document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        
        // Show corresponding form
        document.querySelectorAll('.auth-form').forEach(form => form.classList.remove('active'));
        document.getElementById(targetTab + 'Form').classList.add('active');
      });
    });
    
    // Password confirmation validation
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
      registerForm.addEventListener('submit', function(e) {
        const password = document.getElementById('regPassword').value;
        const confirmPassword = document.getElementById('regConfirmPassword').value;
        
        if (password !== confirmPassword) {
          e.preventDefault();
          alert('Passwords do not match!');
        }
      });
    }
    
    // Initialize icons
    lucide.createIcons();
  </script>
</body>
</html>