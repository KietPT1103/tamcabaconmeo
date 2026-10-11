# Tam Ca Ba Con Mèo
Website giới thiệu dịch vụ web và danh mục landing page, dựng bằng Laravel 12, PHP và Blade. CSS/JavaScript thuần, không cần chạy npm để xem giao diện.

## Chạy bằng Docker (khuyến nghị)
Cài và mở Docker Desktop, chọn Linux containers. Tại thư mục chứa compose.yaml:

```powershell
docker compose up -d --build
```

Mở http://localhost:8080. Lần chạy đầu Composer tải thư viện, tạo APP_KEY và tự chạy migrations. MySQL 8.4 có healthcheck; dữ liệu lưu trong volume mysql_data, tồn tại khi dừng container.

- MySQL từ máy host: 127.0.0.1:3307
- Database / user: tamca / tamca
- Password local: local_secret
- Từ container Laravel, host database là mysql, port 3306.
- Xem log: `docker compose logs -f web`
- Dừng: `docker compose down`
- Chạy test: `docker compose exec web php artisan test`

Các mật khẩu trong compose.yaml chỉ dành cho local. Khi triển khai thật, đổi mật khẩu, APP_ENV=production, APP_DEBUG=false và cấu hình HTTPS.

## Chạy PHP trực tiếp
PHP >= 8.2, Composer và extension pdo_sqlite (hoặc pdo_mysql). Tại app:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
if (-not (Test-Path database/database.sqlite)) { New-Item database/database.sqlite -ItemType File }
php artisan migrate
php artisan serve
```

Mở http://127.0.0.1:8000. .env.example mặc định dùng SQLite cho cách chạy trực tiếp; Docker ghi đè cấu hình sang MySQL. Nếu .env đã tồn tại thì bỏ bước copy. Không tạo lại file SQLite khi đã có dữ liệu.

## Tính năng
- Trang chủ theo ảnh tham chiếu: banner mèo, giới thiệu, lĩnh vực dịch vụ, mẫu landing page, dự án, thống kê và form tư vấn.
- Responsive tại desktop, tablet và điện thoại; menu mobile, bộ lọc lĩnh vực, tìm kiếm, dải dự án cuộn.
- Mỗi mẫu có đường dẫn /demo/{slug} và trang minh họa riêng.
- Form tư vấn có CSRF, kiểm tra dữ liệu, giới hạn 5 request/phút và lưu bảng inquiries.
- Sản phẩm nằm tại app/config/catalog.php; sửa tên, danh mục và nội dung tại đây.
- Giao diện: app/resources/views/home.blade.php, app/public/site.css, app/public/site.js.

## Tài nguyên và phạm vi
Ảnh banner dùng ảnh gốc người dùng cung cấp tại app/public/images/cat-team.jpg. Chưa có logo tách nền, ảnh văn phòng hoặc ảnh chụp từng dự án: logo và phần cuối sử dụng cùng ảnh mèo; tòa nhà và thumbnail là minh họa bằng CSS. Các mẫu demo là bản dựng minh họa, không phải website hoàn chỉnh của từng ngành. Tên doanh nghiệp và thống kê lấy theo ảnh UI; thống kê/dự án cần thay bằng dữ liệu thật trước khi công khai. Chưa có admin, thanh toán hoặc gửi email; yêu cầu tư vấn được lưu trong database.

## Kiểm tra
```powershell
cd app
php artisan test
php artisan view:cache
```
Bộ test kiểm tra trang chủ, mọi demo, đường dẫn sai, lưu form, dữ liệu không hợp lệ và giới hạn request.

## Deploy Render

Repository contains `render.yaml` for a free Docker web service and a free
Render PostgreSQL database, both in Singapore.

1. Push this repository to GitHub.
2. In Render, choose New > Blueprint and connect the repository.
3. Review the two free resources and deploy.
4. Wait for the web service to become Live, then open its onrender.com URL.

Use `Dockerfile.render` for Render; `Dockerfile` and `compose.yaml` remain for
local development. The production image installs Composer dependencies at build
time. Startup applies migrations and caches config/views. Render generates a
stable secret in RENDER_APP_KEY; the entrypoint converts it into Laravel APP_KEY.
Do not rotate this value between deploys. APP_URL follows RENDER_EXTERNAL_URL.
Sessions, rate limits and inquiries are stored in PostgreSQL. Logs go to stderr.
The health check endpoint is /up.

Free Render PostgreSQL expires after 30 days. Upgrade or move the database before
expiry if you want to retain submissions. Free web services can sleep when idle.
No persistent disk is needed for the current application (it has no uploads).
Do not use SQLite on the free web service for persistent form submissions.

If creating the services manually instead of using Blueprint, select Dockerfile.render
and copy the env settings from render.yaml. Set DB_URL to the PostgreSQL internal
connection URL and APP_KEY to the output of `php artisan key:generate --show`.
