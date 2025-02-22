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
    libxml2-dev \
    zip \
    unzip \
    sudo

# Installer les extensions PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Valider que les variables sont des nombres
RUN if ! echo "${USER_ID}" | grep -qE '^[0-9]+$'; then \
        echo "ERROR: USER_ID must be a number"; exit 1; \
    fi && \
    if ! echo "${GROUP_ID}" | grep -qE '^[0-9]+$'; then \
        echo "ERROR: GROUP_ID must be a number"; exit 1; \
    fi

# Créer le groupe et l'utilisateur
RUN groupadd -g ${GROUP_ID} appuser && \
    useradd -u ${USER_ID} -g appuser -m appuser && \
    mkdir -p /home/appuser/.composer/vendor/bin && \
    chown -R appuser:appuser /home/appuser/.composer && \
    usermod -aG sudo appuser && \
    echo 'appuser ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Installer Composer en tant qu'utilisateur non-root
USER appuser
WORKDIR /var/www/html

# Installer Composer localement
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/home/appuser/.composer/vendor/bin --filename=composer

# Ajouter Composer au PATH
ENV PATH="/home/appuser/.composer/vendor/bin:${PATH}"

# Copier les fichiers du projet
COPY --chown=appuser:appuser backend /var/www/html

# Installer les dépendances
RUN composer install --no-interaction --optimize-autoloader

# Revenir à root pour le CMD
USER root

EXPOSE 9000
CMD ["php-fpm"]