# Test

Test is a Laravel app for create/delete/list repositories on/from github

## Installation

composer

```bash
composer install
```
docker

```bash
docker run --rm -v $(pwd):/app composer install
docker-compose up -d
```
docker container php artisan key generate

```bash
docker ps
docker exec <container-name/ID> php artisan key:generate
```

NOTE: make sure your vendor/storage directory public 
## Usage
Create Git repo
```bash
php artisan test:createrepo {repo}
```
Delete Git repo
```bash
php artisan test:deleterepo {repo}
```
API for list repositories with search by name

http://localhost/api/search-repositories?name={repo}