# Laravel 簡易CRUDアプリ

## 使用したライブラリ
- spatie/laravel-permission
- spatie/laravel-authorize
- Maatwebsite/Laravel-Excel
- laralib/l5scaffold
- laravel-ja/comja5
- laracasts/flash

## 環境
- MacOS HighSierra
- PHP 7.2.4
- Laravel 5.5
- mysql 8.0
- laradock

## 実際に動いてるものはこちら

http://polish-test-server05.tokyo/larabel-simple-app/public/

### テストユーザ
- 管理者
    - mail: admin@mail
    - pass: admin
- スタッフ
    - mail: staff@mail
    - pass: staff
- 一般ユーザ
    - mail: common@mail
    - pass: common

## 事前準備

`laralib/l5scaffold`の不具合によりあるファイルに変更を加えないと正常に動きません

``/vendor/laralib/l5scaffold/src/Commands/ScaffoldMakeCommand.php``
​の21行目の

``use AppNamespaceDetectorTrait, MakerTrait;``
が嘘なので、

``use DetectsApplicationNamespace​, MakerTrait;``
に変えます。

同様に6行目も間違いなので
``use Illuminate\Console\DetectsApplicationNamespace;​``
と変えます。

``/vendor/laralib/l5scaffold/src/Makes/MakeController.php``
の13行目を

``use AppNamespaceDetectorTrait, MakerTrait;``
から、

``use DetectsApplicationNamespace​, MakerTrait;``
に変えます

参考：
https://qiita.com/masahirok_jp/items/43205bb62cdc4240bb83

## 概要
ログイン機能付きの記事投稿アプリです 

パーミッション管理やユーザ管理もあります

各ユーザーには以下の様なロールが割り当てられています
- admin(管理者)
- staff(スタッフ)
- common(一般ユーザ)
  
ユーザ情報のパーミッションは以下のようなものがあります
- Read(読み取り)
- Write(書き込み)

各ロールには以下の様なパーミッションが割り当てられています
- admin(Read, Write)
- staff(Read)

※ユーザ新規登録時は全員`common`が割り振られます


### 記事投稿機能
各記事は**投稿者自身と管理者のみ**編集及び削除が可能です

記事の新規追加はログイン済みユーザであれば**誰でも**作成が可能です

未ログインユーザは記事の**参照のみ**可能となっています

### ユーザ管理機能
ユーザ管理機能には**管理者**と**スタッフ**のみアクセスが可能です

管理者はユーザの読み取り及び書き込みが可能です

スタッフはユーザの読み取りのみ可能です

ページ下部の`Export Excel`ボタンを押下すると`users.xlsx`がダウンロードされます



