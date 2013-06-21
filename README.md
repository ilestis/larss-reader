## Larss - A Laravel RSS reader

Seeing as Google Reader is closing down at the end of this month, I've been looking for a replacement to it that fits my needs. Having not being satisfied with what I found, and wanting to test out the Laravel framework, I decided to build this little app. It is by no means a finished product, nor error prone! The main purpose was to try out Laravel with a real project.

## Installation
- Clone the git onto your computer or server.
- $ composer install
- Create a database with the sql/table_create.sql script
- Set up a cron (I recommend every 2h to not miss any updates) for /rss/pull
- Try it out!

## Limitations
- No login feature. Secure it with a htpasswd or whatever you prefer
- No cleanup of db
- Only RSS support
- Very limited feed management (CRUD and 1 level sections)

## Future updates
- Login feature
- Cleanup tasks
- Better overall performances
- Add ATOM support
- Multi-user?
- Security (currently dies when urls contain wrong data)
- Import/Export of your feeds from google
- Better laravel foundations ;-)

