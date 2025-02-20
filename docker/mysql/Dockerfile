FROM mysql:5.7

# Copier le fichier de configuration de la base de données
COPY docker/mysql/my.cnf /etc/mysql/conf.d/my.cnf

# Exposer le port 3306 pour MySQL
EXPOSE 3306

# Définir les variables d'environnement pour MySQL
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=EntrepriseManager
ENV MYSQL_USER=user
ENV MYSQL_PASSWORD=password

# Commande par défaut
CMD ["mysqld"]