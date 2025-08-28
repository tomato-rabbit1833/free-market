環境構築
1. Docker ビルド

bash   
git clone git@github.com:tomato-rabbit1833/free-market.git
cd free-market
docker-compose up -d --build

※ Mac M1/M2 の場合に no matching manifest for linux/arm64/v8 エラーが出たら、
docker-compose.yml の mysql に以下を追記

yaml
platform: linux/x86_64

2. Laravel 環境構築
bash
docker-compose exec php bash
composer install
cp .env.example .env


.env 設定
env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

3. アプリ初期化
bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

利用技術
PHP 8.3.0
Laravel 8.83.27
MySQL 8.0.26

## テーブル設計

### users
| カラム名           | 型             | PK  | UNIQUE | NOT NULL | 外部キー |
|--------------------|----------------|-----|--------|----------|----------|
| id                 | unsigned bigint| ○   |        | ○        |          |
| name               | string(255)    |     |        | ○        |          |
| email              | string(255)    |     | ○      | ○        |          |
| password           | string(255)    |     |        | ○        |          |
| profile_image      | string(255)    |     |        |          |          |
| postal_code        | string(20)     |     |        |          |          |
| address            | string(255)    |     |        |          |          |
| email_verified_at  | timestamp      |     |        |          |          |
| created_at         | timestamp      |     |        |          |          |
| updated_at         | timestamp      |     |        |          |          |

### items
| カラム名      | 型             | PK  | UNIQUE | NOT NULL | 外部キー         |
|---------------|----------------|-----|--------|----------|------------------|
| id            | unsigned bigint| ○   |        | ○        |                  |
| user_id       | unsigned bigint|     |        | ○        | users(id)        |
| name          | string(255)    |     |        | ○        |                  |
| brand_name    | string(255)    |     |        |          |                  |
| condition     | string(50)     |     |        | ○        |                  |
| description   | text           |     |        | ○        |                  |
| price         | integer        |     |        | ○        |                  |
| is_sold       | boolean        |     |        | ○        |                  |
| created_at    | timestamp      |     |        |          |                  |
| updated_at    | timestamp      |     |        |          |                  |

### categories
| カラム名   | 型             | PK  | UNIQUE | NOT NULL | 外部キー |
|------------|----------------|-----|--------|----------|----------|
| id         | unsigned bigint| ○   |        | ○        |          |
| name       | string(255)    |     | ○      | ○        |          |
| created_at | timestamp      |     |        |          |          |
| updated_at | timestamp      |     |        |          |          |

### item_category
| カラム名    | 型             | PK  | UNIQUE | NOT NULL | 外部キー         |
|-------------|----------------|-----|--------|----------|------------------|
| id          | unsigned bigint| ○   |        | ○        |                  |
| item_id     | unsigned bigint|     |        | ○        | items(id)        |
| category_id | unsigned bigint|     |        | ○        | categories(id)   |

### likes
| カラム名  | 型             | PK  | UNIQUE | NOT NULL | 外部キー   |
|-----------|----------------|-----|--------|----------|------------|
| id        | unsigned bigint| ○   |        | ○        |            |
| user_id   | unsigned bigint|     |        | ○        | users(id)  |
| item_id   | unsigned bigint|     |        | ○        | items(id)  |

### comments
| カラム名  | 型             | PK  | UNIQUE | NOT NULL | 外部キー   |
|-----------|----------------|-----|--------|----------|------------|
| id        | unsigned bigint| ○   |        | ○        |            |
| user_id   | unsigned bigint|     |        | ○        | users(id)  |
| item_id   | unsigned bigint|     |        | ○        | items(id)  |
| content   | string(255)    |     |        | ○        |            |
| created_at| timestamp      |     |        |          |            |
| updated_at| timestamp      |     |        |          |            |

### purchases
| カラム名       | 型             | PK  | UNIQUE | NOT NULL | 外部キー       |
|----------------|----------------|-----|--------|----------|----------------|
| id             | unsigned bigint| ○   |        | ○        |                |
| user_id        | unsigned bigint|     |        | ○        | users(id)      |
| item_id        | unsigned bigint|     |        | ○        | items(id)      |
| address_id     | unsigned bigint|     |        | ○        | addresses(id)  |
| payment_method | string(50)     |     |        | ○        |                |
| created_at     | timestamp      |     |        |          |                |

### addresses
| カラム名     | 型             | PK  | UNIQUE | NOT NULL | 外部キー  |
|--------------|----------------|-----|--------|----------|-----------|
| id           | unsigned bigint| ○   |        | ○        |           |
| user_id      | unsigned bigint|     |        | ○        | users(id) |
| postal_code  | string(20)     |     |        | ○        |           |
| address_line | string(255)    |     |        | ○        |           |
| created_at   | timestamp      |     |        |          |           |
| updated_at   | timestamp      |     |        |          |           |

### item_images
| カラム名  | 型             | PK  | UNIQUE | NOT NULL | 外部キー  |
|-----------|----------------|-----|--------|----------|-----------|
| id        | unsigned bigint| ○   |        | ○        |           |
| item_id   | unsigned bigint|     |        | ○        | items(id) |
| filename  | string(255)    |     |        | ○        |           |

ER図
<img width="3840" height="2944" alt="Untitled diagram _ Mermaid Chart-2025-08-12-114004" src="https://github.com/user-attachments/assets/c2706a93-f9e4-4ba5-8e05-506e2e0e52ea" />

URL
開発環境：http://localhost:81/
phpMyAdmin:：http://localhost:8080/
