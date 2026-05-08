<div align="center">

# ✂️ BARBERSHOP
### Barbershop Management System — Built with Laravel

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

A web-based management system for barbershop businesses — handling customers, barbers, services, products, and transactions in one place.

</div>

---

## 📌 About

**Barbershop** is an admin dashboard application designed to streamline the day-to-day operations of a barbershop. It allows the admin to manage customers, barbers, services, and products, as well as record transactions and generate reports — all from a single interface.

---

## ✨ Features

| Feature | Description |
|---|---|
| 🔐 **Admin Authentication** | Secure admin login system |
| 👤 **Customer Management** | Add, edit, and delete customer data |
| 💈 **Barber Management** | Manage barber profiles |
| 🛎️ **Service Management** | Manage available services and pricing |
| 📦 **Product Management** | Track barbershop products and stock |
| 💰 **Transaction Recording** | Record and manage customer transactions |
| 📊 **Dashboard** | Overview of total customers, barbers, services, products & transactions |
| 📋 **Reports** | Generate business reports |

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11, PHP 8.2+
- **Database:** MySQL
- **Frontend:** Blade Template Engine, Bootstrap, Custom CSS
- **Auth:** Laravel Admin Authentication

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/username/barbershop.git
cd barbershop

# 2. Install PHP dependencies
composer install

# 3. Copy the environment file
cp .env.example .env

# 4. Configure your database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=barbershop
DB_USERNAME=root
DB_PASSWORD=

# 5. Generate application key
php artisan key:generate

# 6. Run migrations
php artisan migrate

# 7. Start the development server
php artisan serve
```

Open your browser and go to: **http://localhost:8000**

---

## 📂 Project Structure

```
Barbershop/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminAuthController.php     # Admin login & auth
│   │   ├── DashboardController.php     # Dashboard statistics
│   │   ├── PelangganController.php     # Customer management
│   │   ├── BarberController.php        # Barber management
│   │   ├── LayananController.php       # Service management
│   │   ├── ProdukController.php        # Product management
│   │   ├── TransaksiController.php     # Transaction recording
│   │   └── LaporanController.php       # Reports
│   ├── Models/
│   │   ├── Pelanggan.php               # Customer model
│   │   ├── Barber.php                  # Barber model
│   │   ├── Layanan.php                 # Service model
│   │   ├── Produk.php                  # Product model
│   │   └── Transaksi.php              # Transaction model
├── database/
│   └── migrations/                     # Database schema
├── resources/views/                    # Blade templates
│   └── admin/                          # Admin panel views
└── public/css/style.css               # Custom styles
```

---

## 📊 Dashboard Overview

The admin dashboard displays real-time statistics including total customers, barbers, services, products, and transactions, alongside a table of the 5 most recent transactions.

---

## 📸 Screenshots

> <img width="830" height="486" alt="image" src="https://github.com/user-attachments/assets/6891d107-001d-488e-a74d-5efa70748f77" />


---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you'd like to change.

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

<div align="center">
  Built with ❤️ using Laravel
</div>
