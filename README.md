## 🚗 MasRental — Sistem Rental Kendaraan

MasRental adalah aplikasi berbasis web untuk mengelola penyewaan kendaraan.  
Dibuat sebagai tugas **PSAS** dengan menggunakan **Laravel 12**, **Bootstrap 5**, dan **MySQL**.

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-blue)
![MySQL](https://img.shields.io/badge/Database-MySQL-green)
![Status](https://img.shields.io/badge/Status-Development-orange)

---

## 📌 Fitur Utama Sistem
- Login & Register
- Reset Password
- Pembagian akses **Admin dan User biasa**
- CRUD data kendaraan
- Sistem peminjaman kendaraan
- Riwayat peminjaman

---

## 👥 Pembagian Hak Akses
| Role | Akses |
|------|-------|
| **Admin** | Mengelola kendaraan, mengelola user, mengelola peminjaman |
| **User** | Melihat daftar kendaraan, meminjam kendaraan, melihat riwayat |

---

## 🔧 Teknologi yang Digunakan
| Teknologi | Versi |
|----------|-------|
| Laravel | 12 |
| PHP | 8.2 |
| Bootstrap | 5 |
| MySQL | 8 |
| ORM | Eloquent |

---

## 🗂 Struktur Database
| Tabel | Deskripsi |
|-------|-----------|
| `users` | Data user termasuk admin & user biasa |
| `kendaraan` | Data kendaraan yang dapat disewa |
| `pinjam` | Transaksi peminjaman kendaraan |

---
## Preview
| Login | Dashboard | kendaraan |
|-------|------|--------------|
| <img src="public/img/preview/login.png" width="250"/> | <img src="public/img/preview/dashboard.png" width="250"/> | <img src="public/img/preview/kendaraan.png" width="250"/> |
---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>