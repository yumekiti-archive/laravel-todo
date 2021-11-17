# sanctum

```
composer require laravel/sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

php artisan migrate
```

app/Http/Kernel.php
```
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

config/sanctum.php
```
'prefix' => 'api'
```

routes/api.php
```
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
```

.env
```
SANCTUM_STATEFUL_DOMAINS=localhost:8080
SESSION_DOMAIN=
```

axios
```
axios.get('/api/csrf-cookie').then(() => {
    axios
        .post('/api/' + this.url, postData)
        .then(res => (this.data = res.data))
});
```