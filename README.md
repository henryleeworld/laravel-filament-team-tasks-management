# Laravel 11 Filament 團隊任務管理

Filament 團隊任務管理採用快速建立簡捷的 TALL（Tailwind CSS、Alpine.js、Laravel 和 Livewire）堆疊應用程式的工具組，在一處位置可視化您的所有團隊任務，確保無一遺漏，讓您與團隊成員保持同步，不必再等待另行安排的會議、交流了。

## 使用方式
- 打開 php.ini 檔案，啟用 PHP 擴充模組 intl 和 zip，並重啟服務器。
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產生 Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 執行 __Artisan__ 指令的 __migrate__ 來執行所有未完成的遷移，並執行資料庫填充（如果要測試的話）。
```sh
$ php artisan migrate --seed
```
- 執行安裝 Vite 和 Laravel 擴充套件引用的依賴項目。
```sh
$ npm install
```
- 執行正式環境版本化資源管道並編譯。
```sh
$ npm run build
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 你可以經由 `/admin/register` 來進行註冊。
- 完成註冊後，可以經由 `/admin/login` 來進行登入。
- 登入後可以經由 `/admin/tasks` 來進行任務管理。

----

## 畫面截圖
![](https://i.imgur.com/8R3hLRc.png)
> 任務代表可採取行動的步驟或待辦事項，以明確人、事、時，但它們也可以代表構想和參考項目

![](https://i.imgur.com/g3fgutD.png)
> 任務清單可化身重要的商務工具，以確保團隊恪守期限
