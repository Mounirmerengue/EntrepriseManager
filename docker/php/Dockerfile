FROM php:8.2-fpm

# Définir les variables avec des valeurs par défaut
ARG USER_ID=1000
ARG GROUP_ID=1000

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    zip \
    unzip \
    sudo \
    procps \
    net-tools && \
    rm -rf /var/lib/apt/lists/*
# Installer les extensions PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Installer Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Valider les ID utilisateur/groupe
RUN if ! echo "${USER_ID}" | grep -qE '^[0-9]+$'; then \
        echo "ERROR: USER_ID must be a number"; exit 1; \
    fi && \
    if ! echo "${GROUP_ID}" | grep -qE '^[0-9]+$'; then \
        echo "ERROR: GROUP_ID must be a number"; exit 1; \
    fi

# Créer l'utilisateur et le groupe
RUN groupadd -g ${GROUP_ID} appuser && \
    useradd -u ${USER_ID} -g appuser -m appuser && \
    mkdir -p /home/appuser/.composer/vendor/bin && \
    chown -R appuser:appuser /home/appuser/.composer && \
    usermod -aG sudo appuser && \
    echo 'appuser ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Installer Composer
USER appuser
WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/home/appuser/.composer/vendor/bin --filename=composer

ENV PATH="/home/appuser/.composer/vendor/bin:${PATH}"

# Copier le code source
COPY --chown=appuser:appuser backend /var/www/html

# Installer les dépendances
RUN composer install --no-interaction --optimize-autoloader

# Configuration finale
EXPOSE 9000

CMD ["symfony", "server:start", "--port=9001", "--allow-http", "--no-tls", "--allow-all-ip"]


