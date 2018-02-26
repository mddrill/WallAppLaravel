### WallAppLaravel

Wall app backend written with Laravel

Endpoints

`/post` - `GET`, `POST`
`/post/<post_id>` - `GET`, `POST`, `PUT`
`/register` - `POST`
`/oauth/token` - `POST` (get the `access_token` and send it in a header as `Access: Bearer <token>`

This repo uses Passport. To get the token from `/oauth/token`, you need to create a Password Grant Client by running `php artisan passport:client --password` then hit `/oauth/token` with a `POST` request containing:

```
{
  "grant_type": "password",
  "username": "<username>",
  "password": "<password>",
  "client_id": "<client_id>",
  "client_secret": "<client_secret>"
}
```

You'll get `client_id` and `client_secret` when you create the Password Grant Client.
