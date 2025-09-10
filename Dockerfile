FROM php:8.2-cli

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    git \
    unzip \
    && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY --from=docker.io/library/composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . .

RUN composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist

# RUN sh build/ci/createEnvFile.sh

# RUN php artisan key:generate

# RUN sh build/ci/createSqliteFile.sh

CMD ["bash"]