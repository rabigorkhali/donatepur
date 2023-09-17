
1. Install Voyager
2. Composer install
3. setup database

--For Queue:
type screen in terminal, then paste the command. it will keep runnung in background. Queue is using redis.

for local
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=predis

for live,


--For cron Job

/usr/local/bin/php /home/donatepu/public_html/artisan sync:expired-campaigns  >> /dev/null 2>&1 