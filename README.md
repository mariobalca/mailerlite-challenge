## MailerLite Challenge
### Description

Code challenge made for the [Laravel and Vue.js Developer position](https://www.mailerlite.com/jobs/laravel-and-vue-js-developer-mailerlite) of [MailerLite](https://mailerlite.com).

Frontend styleguide from [Tweetboard](https://tweetboard.io) (a side-project of mine, which I can also show/demo during the call/interview).

[Live demo](https://google.com)

### Instructions to run locally (with Docker)

First clone the repo with the following command 

```git clone git@github.com:mariobalca/mailerlite-challenge.git```

Then change directory into that folder and run

```docker compose up```

Finally, to run migrations and populate db run

```docker compose exec backend php artisan migrate --seed```

Then go to [http://localhost:5173](http://localhost:5173) and that's it :tada: 
