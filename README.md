# LAMDAKU - Healthcare Accreditation Company Website

## Project Overview

LAMDAKU adalah website company profile untuk perusahaan akreditasi kesehatan yang menyediakan layanan akreditasi untuk klinik, laboratorium, dan pusat kesehatan masyarakat (puskesmas). Project ini terdiri dari frontend React dan backend Laravel dengan CMS.

## Project Structure

```
LAMDAKU/
├── accreditation-company-profile/ (Frontend React)
│   ├── src/
│   │   ├── components/
│   │   │   ├── Header.jsx
│   │   │   ├── Hero.jsx
│   │   │   ├── Services.jsx
│   │   │   ├── About.jsx
│   │   │   ├── Contact.jsx
│   │   │   ├── Footer.jsx
│   │   │   ├── CompanyHistory.jsx
│   │   │   ├── VisionMission.jsx
│   │   │   ├── OrganizationalStructure.jsx
│   │   │   └── AdminDashboard.jsx
│   │   ├── pages/
│   │   │   ├── Home.jsx
│   │   │   ├── Services.jsx
│   │   │   ├── Profile.jsx
│   │   │   ├── Contact.jsx
│   │   │   └── Admin.jsx
│   │   ├── services/
│   │   │   └── api.js
│   │   └── styles/
│   │       ├── App.css
│   │       └── index.css
│   └── package.json
│
└── lamdaku-cms-backend/ (Backend Laravel)
    ├── app/
    │   ├── Models/
    │   │   ├── Page.php
    │   │   ├── Service.php
    │   │   ├── Contact.php
    │   │   └── Timeline.php
    │   └── Http/Controllers/Api/
    │       ├── PageController.php
    │       ├── ServiceController.php
    │       ├── ContactController.php
    │       └── TimelineController.php
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    ├── routes/
    │   └── api.php
    └── API_DOCUMENTATION.md
```

## Features

### Frontend (React)
- ✅ **Responsive Design** - Desktop, tablet, dan mobile friendly
- ✅ **Modern UI/UX** - Design modern dengan gradient blue theme
- ✅ **Complete Navigation** - Header dengan menu Beranda, Layanan, Profil, Kontak
- ✅ **Dynamic Content** - Integasi dengan API Laravel untuk konten dinamis
- ✅ **Company Profile Pages**:
  - Beranda: Hero section, overview services, about company
  - Layanan: Detail 6 layanan akreditasi
  - Profil: 3 sub-halaman (Sejarah, Visi-Misi, Struktur Organisasi)
  - Kontak: Form kontak terintegrasi dengan backend
- ✅ **Admin Dashboard** - Interface untuk mengelola konten CMS

### Backend (Laravel)
- ✅ **RESTful API** - Complete CRUD operations
- ✅ **Database Models** - Pages, Services, Contacts, Timeline
- ✅ **CORS Support** - Configured for React frontend
- ✅ **Seeded Data** - Pre-populated dengan data LAMDAKU
- ✅ **API Documentation** - Detailed endpoint documentation

## Technology Stack

### Frontend
- **React 18.2.0** - Frontend framework
- **React Router 6.8.1** - Client-side routing
- **React Icons** - Icon library
- **CSS3** - Modern styling dengan Flexbox/Grid

### Backend
- **Laravel 11** - PHP framework
- **MySQL** - Database
- **Laravel Sanctum** - API authentication
- **Eloquent ORM** - Database operations

## Installation & Setup

### Prerequisites
- Node.js (v16 atau lebih baru)
- PHP 8.2+
- Composer
- MySQL
- Laragon/XAMPP (untuk development)

### Backend Setup (Laravel)

1. **Navigate to backend directory**
   ```bash
   cd lamdaku-cms-backend
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** (edit .env file)
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lamdaku_cms
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Create database**
   ```bash
   mysql -u root -e "CREATE DATABASE lamdaku_cms"
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Start Laravel server**
   ```bash
   php artisan serve
   ```
   Backend will run at: `http://127.0.0.1:8000`

### Frontend Setup (React)

1. **Navigate to frontend directory**
   ```bash
   cd accreditation-company-profile
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Start development server**
   ```bash
   npm start
   ```
   Frontend will run at: `http://localhost:3000`

## API Endpoints

### Public API (untuk Frontend)
- `GET /api/v1/services` - Get all services
- `GET /api/v1/timelines` - Get timeline events
- `POST /api/v1/contacts` - Submit contact form
- `GET /api/v1/pages` - Get pages

### Admin API (untuk CMS)
- `GET /api/admin/services` - Manage services
- `GET /api/admin/timelines` - Manage timeline
- `GET /api/admin/contacts` - View contact submissions
- `GET /api/admin/pages` - Manage pages

Lihat `API_DOCUMENTATION.md` untuk detail lengkap.

## Usage

### Accessing the Website
1. Frontend: http://localhost:3000
2. Backend API: http://127.0.0.1:8000/api
3. Admin Dashboard: http://localhost:3000/admin

### Managing Content
1. **Services**: Add/edit layanan akreditasi
2. **Timeline**: Manage sejarah perusahaan
3. **Contacts**: View dan manage pesan dari contact form
4. **Pages**: Manage halaman statis

### Contact Form Integration
Contact form di frontend otomatis tersimpan ke database Laravel melalui API.

## Database Schema

### Services Table
- id, title, slug, description, content, icon, image, price, is_active, sort_order

### Timeline Table  
- id, year, title, description, icon, is_active, sort_order

### Contacts Table
- id, name, email, phone, company, subject, message, is_read, read_at

### Pages Table
- id, title, slug, content, meta_description, meta_keywords, is_published, sort_order

## Customization

### Adding New Services
1. Use admin dashboard atau API endpoint
2. Include: title, description, icon, active status

### Modifying Timeline
1. Access admin timeline management
2. Add/edit events dengan year, title, description

### Styling Changes
Edit CSS files di `src/styles/`:
- `App.css` - Main component styles
- `index.css` - Global styles

## Deployment

### Frontend (React)
```bash
npm run build
# Deploy build folder to web server
```

### Backend (Laravel)
```bash
composer install --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Support

Untuk pertanyaan atau masalah, silakan hubungi tim development atau buat issue di repository.

## License

This project is proprietary software developed for LAMDAKU.

---

**LAMDAKU CMS** - Modern Healthcare Accreditation Management System
