# Family Memories Album Platform

A private, secure, and family-friendly platform to store, organize, and share family memories. Users can create **projects** for children or family events, add multiple **albums** inside each project, upload **photos, videos, and audio**, and share them via secure links.

---

## 🧩 Overview

This platform allows parents and families to:

* Create **Projects** representing children, events, or themes.
* Add multiple **Albums** per project.
* Upload **media** (images, videos, audio) to albums.
* Share **projects or albums** via secure links with optional expiration and ZIP download.
* Manage **permissions** per project or album using [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction).

---

## 🧱 Features

### Authentication

* Register, login, logout
* Password reset
* Optional profile photo

### Projects

* CRUD operations
* Cover image and description
* Projects contain multiple albums

### Albums

* CRUD operations nested inside projects
* Cover image and description
* Gallery display of media

### Media Uploads

* Supported types:

  * Images: jpg, png, gif
  * Videos: mp4, m4a
  * Audio: mp3
* File validation and storage (local or cloud)
* Delete or replace media

### Secure Sharing

* Generate unique read-only links for projects or albums
* Optional expiration date and recipient email
* ZIP download of media
* Users accessing via token can later be added to the project/album with editable roles

### Permissions & Roles

* Managed with Spatie Laravel Permission
* Default roles: Owner, Editor, Viewer, Guest
* Roles scoped to project or album
* Owners can assign or edit roles
* Shared links provide temporary read-only access without creating roles

### Notifications

* Email invitations or shared link notifications
* Optional ZIP attachments
* Success and error messages for user feedback

---

## ⚙️ Tech Stack

* **Backend:** Laravel (latest stable)
* **Frontend:** Blade + Tailwind CSS
* **Database:** MySQL (Eloquent ORM)
* **File Storage:** Laravel Storage (local or cloud)
* **Mailing:** Laravel Mailables and optional queues
* **Roles & Permissions:** Spatie Laravel Permission
* **Architecture:** MVC (Models, Controllers, Views, Migrations)
* **Containerization:** Docker + Docker Compose

---

## 🐳 Docker Setup

### Prerequisites

* Docker
* Docker Compose

### Steps

1. Clone the repository:

```bash
git clone https://github.com/Cris-T14N0/Memini
cd Memini
```

2. Copy the environment file:

```bash
cp .env.example .env
```

3. Update `.env` as needed (DB_HOST, DB_PORT, MAIL settings, etc.)

4. Build and start containers:

```bash
docker-compose up -d --build
```

5. Run migrations and seeders inside the app container:

```bash
docker-compose exec app php artisan migrate --seed
```

6. Access the application at:

```
http://localhost:8000
```

### Useful Commands

* Enter app container:

```bash
docker-compose exec app bash
```

* Artisan commands:

```bash
php artisan route:list
php artisan storage:link
php artisan tinker
```

* Stop containers:

```bash
docker-compose down
```

---

## 🗂️ Database Structure

* **users** → Registered families
* **projects** → Top-level container for albums
* **albums** → Nested inside projects
* **media** → Photos, videos, audios inside albums
* **shared_links** → Secure links for sharing projects or albums
* **project_user / album_user** → Pivots for roles and permissions

---

## 🧩 Usage

* Users can create projects and albums via the dashboard.
* Upload media to albums using the upload form.
* Generate secure shared links for family and friends.
* Assign roles (Viewer, Editor, Owner) to users per project or album.

---

## 🛠️ Contributing

1. Fork the repository
2. Create a new branch: `git checkout -b feature/your-feature`
3. Commit changes: `git commit -m 'Add some feature'`
4. Push: `git push origin feature/your-feature`
5. Open a Pull Request

---

## 📜 License

This project is licensed under the MIT License.

---

## ❤️ Notes

This platform is designed for **families to safely store and share their most precious memories**.
Focus on usability, privacy, and long-term preservation is a core priority.
