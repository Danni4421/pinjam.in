<?php

Router::view('/', 'user.dashboard');
Router::view('/login', 'login');
Router::view('/register', 'register');
Router::view('/peminjaman', 'user.peminjaman', ['user']);
Router::view('/ruang', 'user.ruang');
Router::view('/account', 'user.account', ['user']);
Router::view('/admin', 'admin.dashboard', ['admin', 'superadmin']);
Router::view('/admin/kalender', 'admin.kalender', ['admin', 'superadmin']);
Router::view('/admin/persetujuan', 'admin.persetujuan', ['admin', 'superadmin']);
Router::view('/admin/ruang/kelas', 'admin.ruang.kelas', ['admin', 'superadmin']);
Router::view('/admin/ruang/dosen', 'admin.ruang.dosen', ['superadmin']);
Router::view('/admin/riwayat', 'admin.riwayat', ['superadmin']);
