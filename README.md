# Clonar o projeto
# Guia: Configuração Laravel Sail no Windows

## 1. Instalar WSL2

Abra o **PowerShell como Administrador** e execute:

```powershell
wsl --install
```

**Reinicie o computador.**

---

## 2. Instalar Ubuntu

### Via Microsoft Store (Recomendado)

1. Abra a **Microsoft Store**
2. Procure por **"Ubuntu"**
3. Clique em **Instalar**
4. Depois de instalar, clique em **Abrir**

Ou procure "Ubuntu" no menu Iniciar.

### Via PowerShell (Alternativa)

```powershell
wsl --install -d Ubuntu-22.04
```

### Configurar Ubuntu

Quando o Ubuntu abrir pela primeira vez:

1. Crie um username (minúsculas, sem espaços)
2. Crie uma password

Depois atualize o sistema:

```bash
sudo apt update && sudo apt upgrade -y
```

---

## 3. Instalar Docker Desktop

1. Download em: [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
2. Execute o instalador
3. Marque a opção **"Use WSL 2 instead of Hyper-V"**
4. Instale e reinicie

### Configurar Docker Desktop

1. Abra o Docker Desktop
2. Vá a **Settings** → **Resources** → **WSL Integration**
3. Ative **Ubuntu**
4. Clique em **Apply & Restart**

---

## 4. Clonar e Executar o Projeto Laravel (Dentro do Ubuntu)

### Instalar e Configurar Git

```bash
sudo apt install git -y
git config --global user.name "Seu Nome"
git config --global user.email "seuemail@exemplo.com"
```

### Clonar o Repositório

```bash
mkdir apps
cd apps
git clone https://github.com/Cris-T14N0/Memini.git
cd Memini
```

### Configurar o Projeto

```bash
# Copiar ficheiro de ambiente
cp .env.example .env

# Abrir o code neste diretório
code .

# Fazer download do .env no link abaixo, copiar o seu conteudo e colar no .env do projeto
https://drive.google.com/file/d/1TJXXF2Y0yAhyR9uUdiNhEYOa-LFK8T6m/view?usp=sharing

# Instalar dependências
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs

# Iniciar containers
./vendor/bin/sail up -d

# Gerar chave da aplicação
./vendor/bin/sail artisan key:generate

# Executar migrações
./vendor/bin/sail artisan migrate

# Instalar e iniciar npm
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev

# Para parar o projeto:

# Parar o npm
Ctrl + C no terminal onde iniciou o npm

# Parar os containers
./vendor/bin/sail down
```

### Aceder à Aplicação

Abra o browser: **http://localhost**

### Criar Alias (Opcional)

```bash
echo "alias sail='./vendor/bin/sail'" >> ~/.bashrc
source ~/.bashrc
```

Depois pode usar apenas: `sail up -d`

---

# Family Memories Album Platform

A private, secure, and family-friendly platform to store, organize, and share family memories. Users can create **projects** for children or family events, add multiple **albums** inside each project, upload **photos, videos, and audio**, and share them via secure links.

---

## 🧩 Overview

This platform allows parents and families to:

* Create **Projects** representing people, events, or themes.
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

## 🧩 Usage

* Users can create projects and albums via the dashboard.
* Upload media to albums using the upload form.
* Generate secure shared links for family and friends.
* Assign roles (Viewer, Editor, Owner) to users per project or album.

---

## 📜 License

This project is licensed under the MIT License.
