# Laravel8でTodo作る。

## migrations
> https://readouble.com/laravel/8.x/ja/migrations.html

### テーブルを考える
| 論理名 | 物理名  | 型  | 型の意味 |
| -------- | -------- | -------- | -------- |
| ID | id | bigIncrements | 連番(主キー) |
| 作成日 | created_at | timestamps | 日付、時刻 |
| 更新日 | updated_at | timestamps | 日付、時刻 |
| タイトル | title | string, 100 | 100字までの文字列 |
| 詳細 | detail | string | 文字列 |
| 達成状態 | state | boolean | 論理型 |
| 論理削除 | |||
| ユーザID(外部キー制約) | user_id | unsignedBigInteger | BIGINT(参照先の型と同じにする) |

### 必要modelとmigrationを作成する
```
php artisan make:model Todo --migration
```

### 作成したmigrationを編集する
database/migrations/2021_11_15_084615_create_todos_table.php
```php
public function up()
{
    Schema::create('todos', function (Blueprint $table) {
        $table->id();                                               // id
        $table->timestamps();                                       // 作成日
        $table->char('title', 100);                                 // タイトル
        $table->string('detail')->nullable();                       // 詳細
        $table->boolean('state')->default(false);                   // 達成したか
        $table->softDeletes();                                      // 論理削除
        $table->unsignedBigInteger('user_id');                      // userのidがBigIntegerなのでこちらもBigIntegerを使う
        $table->foreign('user_id')->references('id')->on('users');  // user外部キー制約
    });
}
```
> migrate実行順はファイル名の`2021_11_15_084615`<-ここの部分で判定される
> 
> 日付が早い順で実行される

### ユーザのmigrationを触らない理由
デフォルトのままで使用可能なのでそのまま使用する

## seeders
> https://readouble.com/laravel/8.x/ja/seeding.html

### 必要なシーダを作成する
```
php artisan make:seeder UserSeeder
php artisan make:seeder TodoSeeder
```

### テストデータを入れる

/database/seeders/UserSeeder.php
```php
public function run()
{
    //
    User::factory()->create([
        'name' => 'test1',
        'email' => 'test1@test.jp',
        'password' => bcrypt('testtest')
    ]);
    DB::table('users')->insert([
        'name' => 'test2',
        'email' => 'test2@test.jp',
        'password' => Hash::make('password')
    ]);
    User::factory()->count(3)->create();
}
```

/database/seeders/TodoSeeder.php
```php
public function run()
{
    //
    DB::table('todos')->insert([
        'title' => 'hoge',
        'detail' => 'hogehogehoge',
        'user_id' => 1,
    ]);
}
```

/database/seeders/DatabaseSeeder.php
```php
public function run()
{
    // \App\Models\User::factory(10)->create();
    $this->call(UserSeeder::class);
    $this->call(TodoSeeder::class);
}
```

## routes

### routes/api.phpを編集する
```php
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('todo', TodoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);
    Route::apiResource('user', UserController::class)->only([
        'store', 'update', 'destroy'
    ]);
});

Route::apiResource('users', TodoController::class)->only([
    'store'
]);

Route::post('/login', [TodoController::class, 'login']);
```
> onlyに使用するルートを宣言する。
> 使用しないルートを宣言する方法もあるがonlyの方が分かりやすいので採用した。

### apiResource使うメリットとデメリット(個人的偏見)
  - メリット
    - コード量が減る
    - APIに使用する場合はテンプレートなので使いやすい
  - デメリット
    - HTTPメソッド(getやpostなど)が指定できないのかな？
    - コードだけでは分かりづらい

### apiResourceを採用した理由
  - apiテンプレートしか使わないので採用した

### auth:sanctumを書く理由
  - ログイン済みなら実行できる場所とログインしなくても実行できる場所を別けている
    - middleware('auth:sanctum')で囲ってい場所がログイン済み

## Models
> https://readouble.com/laravel/8.x/ja/eloquent-relationships.html

### app/Models/User.php編集
```php
use App\Models\Todo;

~~~省略~~~

/**
*   userの所有するtodoを取得
*/
public function todo()
{
    return $this->hasMany(Todo::class);
}
```
> fillableにデータを処理するカラムを指定する

### app/Models/Todo.php編集
```php
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
    'title', 'detail', 'user_id'
];

/**
*   todo所有userの取得
*/
public function user()
{
    return $this->belongsTo(User::class);
}
```

## 確認用にフロント書く
今回は省略

## validation
> https://readouble.com/laravel/8.x/ja/validation.html

### 必要なフォームリクエスト作成する
```
php artisan make:request UserPostRequest
```
> 書くの面倒なので一つだけで許して。。。

### 作成したのを編集
app/Http/Requests/UserPostRequest.php
```php
public function authorize()
{
    return true;
}

public function rules()
{
    return [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ];
}
```

## Controllers

### 必要Controllerを作成する
```
php artisan make:controller UserController --api
php artisan make:controller TodoController --api
```

app/Http/Controllers/UserController
```php
public function login(Request $request)
{
    if (Auth::attempt($request->all())) {
        return Auth::user();
    }

    throw ValidationException::withMessages([
        'email' => ['メールアドレスまたはパスワードが違います。'],
    ]);
}
```

### app/Http/Controllers/TodoController
```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    // 一行追加、何かは以下リンクに記載している

~省略~

public function index()
{
    //
    return Auth::user()->todo()->get();
}
```
> https://readouble.com/laravel/8.x/ja/authentication.html


## 参考にしたリンク
- 公式
  - https://readouble.com/laravel/8.x/ja
- github api
  - https://github.com/Tony133/laravel-api-rest
  - https://github.com/guillaumebriday/laravel-blog
- github web
  - https://github.com/youyingxiang/livewire-blog
  - https://github.com/savanihd/laravel-8-roles-and-permissions
  - https://github.com/GiantVlad/laravel_shop_cart
- [routes](##routes)
  - https://zenn.dev/naoki_oshiumi/articles/8fc5b9d20bcc89
