## リポジトリについて
社内イベント告知アプリ「Matricaria（マトリカリア）」のバックエンドリポジトリです。

## 内容物
- Laravelソース
- openapi（Swagger）
    - docsフォルダ内

## モックサーバー
prismを使用して、ローカルでモックサーバーを建てることができます。
ローカル：``http://localhost:4010``

### 手順
1. ``npm install -g @stoplight/prism-cli``でprismをインストール
2. ``prism mock docs/openapi.yaml``で起動