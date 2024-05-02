FROM ubuntu:latest
LABEL authors="motti"

ENTRYPOINT ["top", "-b"]

# Используем официальный образ PHP с Docker Hub
FROM php:8.1-apache

# Устанавливаем дополнительные расширения (если нужно)
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install gd

# Копируем файлы проекта в директорию веб-сервера контейнера
COPY . /var/www/html

# Открываем порт 80 для доступа к веб-серверу
EXPOSE 80
