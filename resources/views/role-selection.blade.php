<!DOCTYPE html>
<html lang="en">

<head>
  <title>Choose Your Role | code_wars_official</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <style>
    .selection-container {
      display: flex;
      gap: 30px;
      z-index: 1000;
      perspective: 1000px;
    }

    .role-card {
      width: 300px;
      height: 400px;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(15px);
      border: 2px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: 0.5s;
      text-decoration: none;
      color: #fff;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
      position: relative;
      overflow: hidden;
    }

    .role-card:hover {
      transform: translateY(-10px) rotateY(5deg);
      background: rgba(255, 255, 255, 0.12);
      border-color: #0ef;
      box-shadow: 0 15px 40px rgba(0, 238, 255, 0.25);
    }

    .role-card i {
      font-size: 100px;
      color: #0ef;
      margin-bottom: 20px;
      transition: 0.5s;
    }

    .role-card:hover i {
      transform: scale(1.2);
      text-shadow: 0 0 20px #0ef;
    }

    .role-card h2 {
      font-size: 28px;
      text-transform: uppercase;
      letter-spacing: 2px;
      transition: 0.5s;
    }

    .role-card:hover h2 {
      color: #0ef;
    }

    .role-card p {
      margin-top: 15px;
      font-size: 14px;
      opacity: 0.7;
      text-align: center;
      padding: 0 20px;
    }

    .selection-title {
      position: absolute;
      top: 10%;
      color: #fff;
      font-size: 48px;
      text-transform: uppercase;
      letter-spacing: 5px;
      z-index: 1000;
      text-align: center;
      text-shadow: 0 0 20px rgba(0, 238, 255, 0.5);
    }

    /* Background Animation Overlay */
    .selection-wrapper {
      position: absolute;
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: transparent;
      overflow: hidden;
      flex-direction: column;
    }
  </style>
</head>

<body>
  <section>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span>
  </section>

  <div class="selection-wrapper">
    <h1 class="selection-title">Select Your Role</h1>

    <div class="selection-container">
      <a href="{{ route('student') }}" class="role-card">
        <i class="bx bxs-graduation"></i>
        <h2>Student</h2>
        <p>Login to register for events, track your entries, and manage your profile.</p>
      </a>

      <a href="{{ route('category.login') }}" class="role-card">
        <i class="bx bxs-group"></i>
        <h2>Category Admin</h2>
        <p>Manage specific event categories and audit departmental registrations.</p>
      </a>

      <a href="{{ route('admin') }}" class="role-card">
        <i class="bx bxs-lock-alt"></i>
        <h2>Admin</h2>
        <p>Master control for system configuration, user approvals, and global stats.</p>
      </a>
    </div>

    <!-- Registration Section for Admins/Staff -->
    <div class="mt-12 text-center relative z-[1000]">
        <p class="text-white/40 text-sm uppercase tracking-[3px] mb-4">New Administrative User?</p>
        <a href="{{ route('admin.register') }}" class="px-8 py-3 bg-white/5 hover:bg-cyan-500/20 border border-white/10 hover:border-cyan-500/50 text-white rounded-full transition-all duration-300 font-bold tracking-widest text-xs inline-flex items-center gap-2">
            <i class="bx bxs-user-plus text-lg"></i> CREATE AN ACCOUNT <i class="bx bx-right-arrow-alt ml-2"></i>
        </a>
    </div>
  </div>
</body>

</html>
