# もぎたて

##　商品管理システム

## 環境構築手順

### 1. リポジトリクローン

git clone git@github.com:coachtech-material/laravel-docker-template.git

docker-compose up -d --build

docker-compose exec php bash

composer install

cp .env.example .env

php artisan key:generate

php artisan db:seed

### 使用技術
・PHP

・Laravel

・MySQL

## ER図

### productsテーブル
| カラム名     | データ型  | 特徴           |
|:-------------|:----------|:---------------|
| id           | BIGINT    | 主キー          |
| name         | STRING    | 商品名          |
| price        | INTEGER   | 商品価格        |
| description  | TEXT      | 商品説明        |
| image        | STRING    | 商品画像パス    |
| created_at   | TIMESTAMP | 作成日時        |
| updated_at   | TIMESTAMP | 更新日時        |

---

### seasonsテーブル
| カラム名     | データ型  | 特徴           |
|:-------------|:----------|:---------------|
| id           | BIGINT    | 主キー          |
| name         | STRING    | 季節名（春夏秋冬） |
| created_at   | TIMESTAMP | 作成日時        |
| updated_at   | TIMESTAMP | 更新日時        |

---

### product_seasonテーブル（中間テーブル）
| カラム名     | データ型  | 特徴                             |
|:-------------|:----------|:---------------------------------|
| product_id   | BIGINT    | 外部キー（products.id）          |
| season_id    | BIGINT    | 外部キー（seasons.id）           |
| created_at   | TIMESTAMP | 作成日時                         |
| updated_at   | TIMESTAMP | 更新日時                         |

※ER図の作成が間に合わなかったため、Markdown版で記載しています。

### URL
	•	環境構築後アクセスURL
→ http://localhost/
	•	phpMyAdmin
→ http://localhost:8080/
