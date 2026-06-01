# NexCore Technology — Demo 網站

NexCore Technology 虛構科技公司的前後端分離展示網站。前台展示公司服務、消息及聯絡功能；後台提供內容管理。

## 技術架構

| 層級 | 技術 |
|------|------|
| 前端 | Vue 3 + Vite + Pinia + Vue Router + Tailwind CSS |
| 後端 | Laravel 11 (API-only) + Laravel Sanctum |
| 資料庫 | MySQL 8.x |
| 認證 | Sanctum Token 認證 |

## 系統需求

- PHP 8.3+
- Composer 2.7+
- Node.js 18+
- npm 9+
- MySQL 8.0+

## 安裝步驟

### 後端

```bash
cd /home/andy/pro/demo/backend
composer install
cp .env.example .env   # 或直接編輯現有 .env
php artisan key:generate
php artisan migrate:fresh --seed
```

### 前端

```bash
cd /home/andy/pro/demo/frontend
npm install
```

## 環境設定

### 後端 `.env` 關鍵欄位

```env
APP_NAME="NexCore Technology"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=demo_db
DB_USERNAME=root
DB_PASSWORD=directx9
SANCTUM_STATEFUL_DOMAINS=localhost:5173
SESSION_DOMAIN=localhost
```

### 前端 `.env.local`

```env
VITE_API_BASE_URL=http://localhost:8000
```

## 啟動步驟

### 啟動後端

```bash
cd /home/andy/pro/demo/backend
php artisan serve --port=8000
```

### 啟動前端

```bash
cd /home/andy/pro/demo/frontend
npm run dev
```

前端預設運行於 `http://localhost:5173`

## 測試帳號

| 帳號 | 密碼 |
|------|------|
| admin | directx9 |
| admin@nexcore.com | directx9 |

## API 端點列表

### 公開端點

| 方法 | 路徑 | 說明 |
|------|------|------|
| POST | /api/login | 登入，回傳 token |
| GET | /api/news | 取得已發布新聞列表 |
| GET | /api/news/{slug} | 取得單篇新聞 |
| GET | /api/services | 取得啟用服務列表 |
| POST | /api/contacts | 送出聯絡表單 |

### 需要認證（Bearer Token）

| 方法 | 路徑 | 說明 |
|------|------|------|
| POST | /api/logout | 登出 |
| GET | /api/me | 取得當前使用者 |
| GET | /api/admin/dashboard | 儀表板統計 |
| GET | /api/admin/news | 管理員取得所有文章 |
| POST | /api/admin/news | 新增文章 |
| PUT | /api/admin/news/{id} | 更新文章 |
| DELETE | /api/admin/news/{id} | 刪除文章 |
| POST | /api/admin/services | 新增服務 |
| PUT | /api/admin/services/{id} | 更新服務 |
| DELETE | /api/admin/services/{id} | 刪除服務 |
| GET | /api/admin/contacts | 取得所有詢問 |
| PATCH | /api/admin/contacts/{id}/read | 標記詢問為已讀 |

## 前台頁面路徑

| 路徑 | 說明 |
|------|------|
| / | 首頁（Hero、服務亮點、最新消息、統計） |
| /about | 關於我們（公司介紹、核心價值、團隊） |
| /services | 服務項目（所有服務卡片） |
| /news | 新聞列表 |
| /news/:slug | 新聞詳細頁 |
| /contact | 聯絡表單 |

## 後台頁面路徑

| 路徑 | 說明 |
|------|------|
| /admin/login | 管理員登入 |
| /admin | Dashboard（統計卡片、近期詢問） |
| /admin/news | 最新消息 CRUD |
| /admin/services | 服務項目 CRUD |
| /admin/contacts | 聯絡詢問管理（查看、標記已讀） |

## 目錄結構

```
demo/
├── backend/                # Laravel 11 API
│   ├── app/
│   │   ├── Http/Controllers/Api/
│   │   │   ├── AuthController.php
│   │   │   ├── NewsController.php
│   │   │   ├── ServiceController.php
│   │   │   ├── ContactController.php
│   │   │   └── DashboardController.php
│   │   └── Models/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   └── routes/api.php
└── frontend/               # Vue 3 SPA
    └── src/
        ├── api/            # Axios API modules
        ├── stores/         # Pinia stores
        ├── router/         # Vue Router
        ├── layouts/        # PublicLayout / AdminLayout
        ├── components/
        │   ├── public/     # Navbar, Footer, HeroBanner, ServiceCard
        │   └── admin/      # Sidebar, TopBar, DataTable
        └── views/
            ├── public/     # Home, About, Services, News, Contact
            └── admin/      # Login, Dashboard, News/Services/Contacts Manage
```
