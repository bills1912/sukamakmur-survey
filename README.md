# 📊 Suka Makmur Village Survey System

A comprehensive data collection and survey management system built for **Desa Suka Makmur** (Suka Makmur Village). This web application enables field officers to conduct household surveys, manage family data, and visualize population statistics through an intuitive admin dashboard.

---

## 🚀 Tech Stack

| Layer | Technology |
|---|---|
| Backend Framework | Laravel 12 |
| Admin Panel | Filament v3 |
| Frontend | Vite + Tailwind CSS v3 |
| Authentication | Laravel Sanctum + Filament Breezy |
| Authorization | Filament Shield (Spatie Permission) |
| SSO | Laravel Socialite (Google OAuth) |
| API | Rupadana Filament API Service |
| Map Picker | Afsakar Leaflet Map Picker |
| Media | Spatie Laravel Media Library |
| Settings | Spatie Laravel Settings |
| Export | Filament Excel (pxlrbt) + Filament Actions Export |
| Theme | Hasnayeen Themes |
| Impersonation | STS Filament Impersonate |

---

## ✨ Features

### 🏘️ Survey & Data Collection
- Multi-step household questionnaire covering family members, demographics, and livelihoods
- GPS-based house location picker using Leaflet Maps
- Dynamic employment sector forms (Agriculture, Fisheries, Livestock, Other)
- Support for primary and secondary occupation entries
- Real-time age calculation from date of birth
- Disability status tracking with multiple selections

### 📋 Resource Management
- **Questionnaire Management** — Create, view, edit, and delete survey entries
- **Survey Management** — Organize questionnaires under named surveys
- **User Management** — Admin panel for managing field officers and roles
- **Role & Permission Management** — Fine-grained access control via Filament Shield
- **Book Management** — Sample CRUD resource with full API support

### 📊 Dashboard & Analytics
- Real-time stats: total officers, household count, total ethnic groups
- Data collection progress chart per officer (filterable by sub-village/dusun)
- Population breakdown by education level
- Gender distribution doughnut chart
- Average net income by livelihood sector
- Dashboard filter by **Dusun** (sub-village): I-A, I-B, II Timur, II Barat, III, IV

### 🔐 Authentication & Security
- Email/password login with rate limiting
- Google OAuth (SSO) login
- Two-factor authentication (2FA) via Filament Breezy
- Email verification
- User impersonation for admins

### 📤 Export & Import
- Export questionnaire data to Excel/CSV
- Export and import users and books
- Filament native export with completion notifications

### 🌐 REST API
- Token-based authentication via Laravel Sanctum
- Ability-scoped API tokens
- Full CRUD API for Books resource (Create, Read, Update, Delete, Paginate)
- Swagger/OpenAPI documentation via Dedoc Scramble

### ⚙️ Settings
- Configurable site name, registration, login, password reset, and SSO toggles
- Managed via Spatie Laravel Settings with Filament UI

---

## 📁 Project Structure

```
app/
├── Filament/
│   ├── Exports/          # Data exporters (Book, Contact, Questionnaire, User)
│   ├── Imports/          # Data importers (Book, User)
│   ├── Pages/            # Custom pages (Dashboard, Login, ManageSetting)
│   ├── Resources/        # Filament resources (Book, Questionnaire, Role, Survey, User)
│   └── Widgets/          # Dashboard widgets (Stats, Charts)
├── Http/
│   ├── Controllers/Api/  # API authentication controller
│   └── Requests/         # Form request validation
├── Models/               # Eloquent models
├── Policies/             # Authorization policies
├── Providers/            # Service providers
└── Settings/             # Application settings class
```

---

## ⚙️ Installation

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL or SQLite database

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install Node.js dependencies**
```bash
npm install
```

**4. Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials and app settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Google OAuth (optional)
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost/auth/google/callback
```

**5. Run migrations and seeders**
```bash
php artisan migrate --seed
```

**6. Generate Shield permissions**
```bash
php artisan shield:generate --all --panel=admin
php artisan shield:super-admin --user=1
```

**7. Link storage**
```bash
php artisan storage:link
```

**8. Build frontend assets**
```bash
npm run build
```

**9. Start the development server**
```bash
composer run dev
```

This command concurrently starts the Laravel server, queue worker, log viewer, and Vite dev server.

---

## 🛠️ Development Scripts

| Command | Description |
|---|---|
| `composer run dev` | Start all dev services concurrently |
| `composer run setup` | Fresh migration + seed + shield setup |
| `npm run dev` | Vite development server |
| `npm run build` | Build production assets |

---

## 🌐 API Documentation

The REST API is automatically documented via **Dedoc Scramble**. Once the application is running, access the API docs at:

```
http://localhost/docs/api
```

### Authentication

```http
POST /api/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password"
}
```

Returns a Bearer token to be used in subsequent requests:
```http
Authorization: Bearer {token}
```

---

## 🗺️ Questionnaire Data Model

The questionnaire (`r_*` fields) follows a structured coding system:

| Code Range | Section |
|---|---|
| `r_102` – `r_104` | Household identity & KK status |
| `r_200` – `r_212` | Family members (repeater) |
| `r_300` – `r_305` | Employment data per member |
| `r_401` | General remarks |

Employment data supports three worker types:
- **Berusaha** (Self-employed/Business owner) — Agriculture, Fisheries, Livestock, Other
- **Buruh/Pegawai** (Employee/Worker) — Agricultural or Non-agricultural sector
- **Pekerja Bebas** (Freelance/Casual worker) — Agricultural or Non-agricultural sector

Each type supports a primary and secondary (tambah) occupation entry.

---

## 👥 User Roles

| Role | Access Level |
|---|---|
| `super_admin` | Full access to all resources and settings |
| `admin` | Access to survey data, exports, user management |
| `surveyor` | Can create and view their own questionnaire entries |

Roles and permissions are managed through **Filament Shield** and can be customized from the admin panel under the **Roles** resource.

---

## 📸 Key Pages

- **Dashboard** — Overview statistics and filterable charts
- **Kuesioner** (Questionnaire) — Full household data collection form
- **Daftar Survei** (Survey List) — Survey name management
- **Users** — User management with role assignment and impersonation
- **Roles** — Granular permission configuration
- **My Profile** — Personal info, avatar, password change, and 2FA setup
- **Settings** — Toggle site features (registration, login, SSO, etc.)

---

## 🔧 Configuration

### Settings (via Admin Panel)

Navigate to **Settings → Manage Settings** to configure:

| Setting | Description |
|---|---|
| `site_name` | Application display name |
| `site_active` | Enable/disable the site |
| `registration_enabled` | Allow new user registrations |
| `login_enabled` | Enable/disable login page |
| `password_reset_enabled` | Enable password reset flow |
| `sso_enabled` | Enable Google OAuth login |

---

## 📄 License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature/your-feature-name`
5. Open a Pull Request

---

## 📬 Contact

For questions or support, please open an issue in the repository or contact the project maintainer.

---

> Built with ❤️ using [Laravel](https://laravel.com) and [Filament](https://filamentphp.com)