<?php

Router::view('/', 'user.dashboard');
Router::view('/login', 'auth');
Router::view('/register', 'auth');
Router::view('/ruang', 'user.ruang.main');
Router::view('/ruang/kelas', 'user.ruang.kelas');
Router::view('/ruang/auditorium', 'user.ruang.auditorium');
Router::view('/ruang/laboratorium', 'user.ruang.laboratorium');
Router::view('/ruang/dosen', 'user.ruang.dosen');
Router::view('/denah', 'user.ruang.denah');
Router::view('/peminjaman', 'user.peminjaman', ['user']);
Router::view('/account', 'user.account', ['user']);
Router::view('/account/riwayat', 'user.account', ['user']);
Router::view('/account/riwayat/surat', 'user.letter', ['user']);
Router::view('/admin', 'admin.dashboard', ['admin', 'superadmin']);
Router::view('/admin/kalender', 'admin.kalender', ['admin', 'superadmin']);
Router::view('/admin/persetujuan', 'admin.persetujuan', ['admin', 'superadmin']);
Router::view('/admin/user', 'admin.user', ['superadmin']);
Router::view('/admin/ruang/kelas', 'admin.ruang.kelas', ['admin', 'superadmin']);
Router::view('/admin/ruang/dosen', 'admin.ruang.dosen', ['superadmin']);
Router::view('/admin/riwayat', 'admin.riwayat', ['superadmin']);
Router::view('/admin/fasilitas', 'admin.fasilitas', ['superadmin']);
Router::view('/admin/matakuliah', 'admin.matakuliah', ['superadmin']);
Router::view('/admin/jamkuliah', 'admin.jamkuliah', ['superadmin']);
