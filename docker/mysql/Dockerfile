FROM mysql:5.7

# Copier le fichier de configuration MySQL
COPY my.cnf /etc/mysql/conf.d/my.cnf

# Définir les variables d'environnement
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=entrepriseManager
ENV MYSQL_USER=user
ENV MYSQL_PASSWORD=password

CMD ["mysqld"]