# Claude Code 指令檔 — 科技公司 Demo 網站

> 本檔案供 Claude Code 讀取，請在 `/home/andy/pro/demo` 目錄下執行 `claude`，
> 然後貼上本檔內容，或執行 `claude < CLAUDE.md`。

---

## 專案概覽

| 項目 | 說明 |
|------|------|
| 專案路徑 | `/home/andy/pro/demo` |
| 前端路徑 | `/home/andy/pro/demo/frontend` |
| 後端路徑 | `/home/andy/pro/demo/backend` |
| 架構 | 前後端分離（Vue 3 SPA + Laravel API） |
| 公司名稱 | NexCore Technology（虛構科技公司） |

---

## 環境資訊

```
PHP    8.3.6
Node   18.19.1
Composer 2.7.1
MySQL  127.0.0.1 / root / directx9 / DB: demo_db
```

---

## 任務清單（請依序完成）

---

### TASK 1：建立 Laravel 後端

```
請在 /home/andy/pro/demo/backend 建立 Laravel 11 專案：

1. 執行：
   cd /home/andy/pro/demo
   composer create-project laravel/laravel backend
   cd backend

2. 安裝 Laravel Sanctum：
   composer require laravel/sanctum
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

3. 設定 .env（請直接覆寫以下欄位）：
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

4. 設定 config/cors.php：
   'allowed_origins' => ['http://localhost:5173'],
   'supports_credentials' => true,

5. 建立資料庫：
   mysql -u root -pdirectx9 -e "CREATE DATABASE IF NOT EXISTS demo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

---

### TASK 2：建立資料庫 Migration 與 Seeder

```
在 Laravel 後端建立以下 Migration：

1. users 表（已內建，調整 seeder 新增 admin）
2. news 表：
   - id, title(string), slug(string,unique), content(text),
     summary(string,nullable), image(string,nullable),
     is_published(boolean,default:true), published_at(timestamp,nullable),
     created_at, updated_at

3. services 表：
   - id, title(string), description(text), icon(string,nullable),
     sort_order(integer,default:0), is_active(boolean,default:true),
     created_at, updated_at

4. contacts 表：
   - id, name(string), email(string), subject(string), message(text),
     is_read(boolean,default:false), created_at, updated_at

建立 DatabaseSeeder，新增以下資料：
- 使用者：name="Admin", email="admin@nexcore.com", password=bcrypt("directx9")
- 5 筆 news 假資料（科技相關文章）
- 6 筆 services 假資料（如：雲端解決方案、AI 整合、資安服務、ERP 系統、App 開發、技術顧問）
- 3 筆 contacts 假資料

執行：
php artisan migrate:fresh --seed
```

---

### TASK 3：建立 Laravel API Controllers

```
建立以下 API，所有 Controller 放在 app/Http/Controllers/Api/

1. AuthController
   - POST /api/login
     - 驗證 email + password（email 即帳號，用 admin@nexcore.com 或直接用 "admin" 對應）
     - 補充：讓 "admin" 也能登入，在 seeder 或 controller 做 email resolve
     - 成功回傳：{ token, user: { name, email } }
     - 失敗回傳：401 { message: "帳號或密碼錯誤" }
   - POST /api/logout（需 auth:sanctum）
   - GET  /api/me（需 auth:sanctum）

2. NewsController（Resource）
   - GET    /api/news（公開，回傳已發布文章列表）
   - GET    /api/news/{slug}（公開，單篇）
   - POST   /api/admin/news（需 auth:sanctum）
   - PUT    /api/admin/news/{id}（需 auth:sanctum）
   - DELETE /api/admin/news/{id}（需 auth:sanctum）

3. ServiceController
   - GET /api/services（公開，回傳啟用中服務）
   - POST/PUT/DELETE /api/admin/services（需 auth:sanctum）

4. ContactController
   - POST /api/contacts（公開，送出聯絡表單）
   - GET  /api/admin/contacts（需 auth:sanctum）
   - PATCH /api/admin/contacts/{id}/read（需 auth:sanctum，標記已讀）

5. DashboardController（需 auth:sanctum）
   - GET /api/admin/dashboard
   - 回傳：{ news_count, services_count, unread_contacts, total_contacts }

在 routes/api.php 註冊所有路由。
在 app/Http/Middleware 確認 CORS 設定正確。
```

---

### TASK 4：登入邏輯補充（支援 "admin" 帳號）

```
在 AuthController@login 中，支援兩種登入方式：
- 輸入 email: "admin", password: "directx9"
- 輸入 email: "admin@nexcore.com", password: "directx9"

實作方式：
if ($request->email === 'admin') {
    $user = User::where('email', 'admin@nexcore.com')->first();
} else {
    $user = User::where('email', $request->email)->first();
}
if (!$user || !Hash::check($request->password, $user->password)) {
    return response()->json(['message' => '帳號或密碼錯誤'], 401);
}
$token = $user->createToken('auth_token')->plainTextToken;
return response()->json(['token' => $token, 'user' => ['name' => $user->name, 'email' => $user->email]]);
```

---

### TASK 5：建立 Vue 3 前端專案

```
在 /home/andy/pro/demo/frontend 建立 Vue 3 專案：

cd /home/andy/pro/demo
npm create vite@latest frontend -- --template vue
cd frontend
npm install

安裝依賴：
npm install vue-router@4 pinia axios
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

安裝 shadcn-vue：
npm install shadcn-vue @radix-vue/vue-primitives class-variance-authority clsx tailwind-merge lucide-vue-next

設定 tailwind.config.js：
content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"]

在 src/style.css 加入 Tailwind directives：
@tailwind base;
@tailwind components;
@tailwind utilities;

建立 .env.local：
VITE_API_BASE_URL=http://localhost:8000
```

---

### TASK 6：Vue 前端目錄結構

```
請建立以下目錄結構：

src/
├── api/
│   ├── axios.js          # Axios instance，baseURL + 攔截器（自動帶 token）
│   ├── auth.js           # login(), logout(), getMe()
│   ├── news.js           # getNews(), getNewsDetail(), adminCRUD
│   ├── services.js       # getServices(), adminCRUD
│   └── contacts.js       # submitContact(), adminList(), markRead()
├── stores/
│   ├── auth.js           # Pinia: token, user, isLoggedIn, login(), logout()
│   └── ui.js             # Pinia: loading, notification
├── router/
│   └── index.js          # 路由設定（含 navigation guard）
├── layouts/
│   ├── PublicLayout.vue  # 前台 layout（Navbar + Footer）
│   └── AdminLayout.vue   # 後台 layout（Sidebar + Header）
├── components/
│   ├── public/
│   │   ├── Navbar.vue    # 含右上角 Login 按鈕
│   │   ├── Footer.vue
│   │   ├── HeroBanner.vue
│   │   └── ServiceCard.vue
│   └── admin/
│       ├── Sidebar.vue
│       ├── TopBar.vue
│       └── DataTable.vue
└── views/
    ├── public/
    │   ├── HomeView.vue
    │   ├── AboutView.vue
    │   ├── ServicesView.vue
    │   ├── NewsView.vue
    │   ├── NewsDetailView.vue
    │   └── ContactView.vue
    └── admin/
        ├── LoginView.vue
        ├── DashboardView.vue
        ├── NewsManageView.vue
        ├── ServicesManageView.vue
        └── ContactsManageView.vue
```

---

### TASK 7：Vue Router 設定

```
在 src/router/index.js 設定以下路由：

前台路由（使用 PublicLayout）：
- /              → HomeView
- /about         → AboutView
- /services      → ServicesView
- /news          → NewsView
- /news/:slug    → NewsDetailView
- /contact       → ContactView

後台路由（使用 AdminLayout，需驗證）：
- /admin/login   → LoginView（不需 auth）
- /admin/        → DashboardView（需 auth）
- /admin/news    → NewsManageView（需 auth）
- /admin/services → ServicesManageView（需 auth）
- /admin/contacts → ContactsManageView（需 auth）

Navigation Guard：
- 進入 /admin/* 前，檢查 authStore.isLoggedIn
- 若未登入，redirect 到 /admin/login
- 已登入不能進入 /admin/login，redirect 到 /admin/
```

---

### TASK 8：前台頁面實作

```
請實作以下前台頁面，設計風格：深色科技感，主色調深藍 + 電藍 accent (#0EA5E9)，
使用 Tailwind CSS，加入適當動畫效果。

1. Navbar.vue
   - 左側：NexCore Technology Logo（文字型）
   - 中間：導覽連結（首頁/關於/服務/最新消息/聯絡）
   - 右側：「登入後台」按鈕（藍色）→ router.push('/admin/login')
   - 滾動時背景變半透明

2. HomeView.vue
   - Hero Section：大標題「創新驅動未來」、副標、CTA 按鈕
   - 服務亮點 Section：從 API 取得前 3 筆服務，卡片呈現
   - 最新消息 Section：從 API 取得前 3 筆新聞，卡片呈現
   - 數字統計 Section：10年經驗、500+客戶、50+員工（動態數字動畫）

3. AboutView.vue
   - 公司簡介（段落文字 + 圖片佔位符）
   - 核心價值（3 個 icon card：創新、可靠、協作）
   - 團隊介紹（4 個虛構人員卡片）

4. ServicesView.vue
   - 從 API 取得所有服務
   - Grid 卡片佈局，每張有 icon + 標題 + 描述

5. NewsView.vue
   - 從 API 取得新聞列表
   - 卡片列表，點擊進入詳細頁

6. NewsDetailView.vue
   - 根據 slug 取得單篇新聞
   - 標題、日期、內容

7. ContactView.vue
   - 聯絡表單：姓名、Email、主旨、內容
   - POST 到 /api/contacts
   - 送出成功顯示感謝訊息

8. Footer.vue
   - 公司名稱、版權、連結
```

---

### TASK 9：後台頁面實作

```
請實作以下後台頁面，設計風格：簡潔白色管理後台，左側 Sidebar，頂部 TopBar。

1. LoginView.vue（/admin/login）
   - 居中登入卡片，深色背景
   - 帳號欄位（placeholder: admin）
   - 密碼欄位（placeholder: ••••••••）
   - 登入按鈕
   - 呼叫 authStore.login()，成功跳轉 /admin/

2. AdminLayout.vue
   - 左側 Sidebar（固定）：
     - 頂部：NexCore Logo
     - 導覽項目（icon + 文字）：
       - Dashboard（BarChart icon）
       - 最新消息（Newspaper icon）
       - 服務項目（Briefcase icon）
       - 聯絡詢問（Mail icon，未讀數 badge）
     - 底部：登出按鈕
   - 右側 TopBar：顯示管理者名稱、目前頁面名稱

3. DashboardView.vue（/admin/）
   - 4 個統計卡片（從 /api/admin/dashboard 取得）：
     - 文章總數（藍色）
     - 服務項目數（綠色）
     - 未讀詢問（紅色）
     - 總詢問數（灰色）
   - 最近 5 筆詢問列表（姓名、主旨、時間）

4. NewsManageView.vue（/admin/news）
   - 頂部：標題 + 「新增文章」按鈕
   - 表格：標題、狀態（已發布/草稿）、建立日期、操作（編輯/刪除）
   - 新增/編輯：使用 Modal 或 Drawer，欄位：標題、slug（自動產生）、摘要、內容（textarea）、是否發布
   - 刪除確認 Dialog

5. ServicesManageView.vue（/admin/services）
   - 同上 CRUD 模式
   - 欄位：標題、描述、icon（文字輸入）、排序、是否啟用

6. ContactsManageView.vue（/admin/contacts）
   - 表格：姓名、Email、主旨、時間、狀態（已讀/未讀）
   - 點擊可查看完整內容（Modal）
   - 標記已讀功能（PATCH /api/admin/contacts/{id}/read）
```

---

### TASK 10：Pinia Store 實作

```
請實作以下 Pinia stores：

1. src/stores/auth.js
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import * as authApi from '@/api/auth'

export const useAuthStore = defineStore('auth', () => {
  const token = ref(localStorage.getItem('admin_token') || null)
  const user  = ref(JSON.parse(localStorage.getItem('admin_user') || 'null'))

  const isLoggedIn = computed(() => !!token.value)

  async function login(email, password) {
    const res = await authApi.login(email, password)
    token.value = res.token
    user.value  = res.user
    localStorage.setItem('admin_token', res.token)
    localStorage.setItem('admin_user', JSON.stringify(res.user))
  }

  async function logout() {
    try { await authApi.logout() } catch {}
    token.value = null
    user.value  = null
    localStorage.removeItem('admin_token')
    localStorage.removeItem('admin_user')
  }

  return { token, user, isLoggedIn, login, logout }
})

2. src/api/axios.js
import axios from 'axios'

const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000',
  headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
})

api.interceptors.request.use(config => {
  const token = localStorage.getItem('admin_token')
  if (token) config.headers.Authorization = `Bearer ${token}`
  return config
})

export default api
```

---

### TASK 11：產生 README.md

```
在 /home/andy/pro/demo/ 根目錄建立 README.md，內容包含：

1. 專案名稱與說明
2. 技術架構（前後端）
3. 系統需求（PHP/Node/Composer 版本）
4. 安裝步驟（後端 + 前端）
5. 環境設定（.env 說明）
6. 啟動步驟
7. 測試帳號
8. API 端點列表
9. 前台頁面路徑
10. 後台頁面路徑
11. 目錄結構說明

README 要清楚、可直接給新人上手。
```

---

### TASK 12：最終驗收清單

```
完成所有 task 後，請執行以下驗收：

後端驗收：
1. php artisan migrate:fresh --seed  → 應成功
2. php artisan serve --port=8000     → 啟動成功
3. curl -X POST http://localhost:8000/api/login \
     -H "Content-Type: application/json" \
     -d '{"email":"admin","password":"directx9"}' \
   → 應回傳 token

前端驗收：
4. cd frontend && npm run dev → 啟動在 http://localhost:5173
5. 瀏覽首頁，確認 API 資料載入正常
6. 點擊右上角「登入後台」→ 輸入 admin / directx9 → 進入後台
7. 後台 Dashboard 顯示統計數字
8. 新增一筆新聞，確認列表更新

如有錯誤，請逐一修正後重新驗收。
```

---

## 執行順序摘要

```
TASK 1  → 建立 Laravel 專案
TASK 2  → Migration + Seeder
TASK 3  → API Controllers + Routes
TASK 4  → 登入邏輯補充
TASK 5  → 建立 Vue 專案
TASK 6  → 目錄結構
TASK 7  → Vue Router
TASK 8  → 前台頁面
TASK 9  → 後台頁面
TASK 10 → Pinia + Axios
TASK 11 → README.md
TASK 12 → 驗收
```

---

## 備註

- Laravel 後端 port：**8000**
- Vue 前端 port：**5173**
- 若 CORS 錯誤，檢查 `config/cors.php` 與 `app/Http/Middleware/HandleCors.php`
- Sanctum token 型驗證（API tokens），非 session 型
- 所有後台 API 需帶 `Authorization: Bearer {token}` header
