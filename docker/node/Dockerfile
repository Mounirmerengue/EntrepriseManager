FROM node:16

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers du projet
COPY frontend /app

# Installer les dépendances
RUN npm install

# Exposer le port 3000 pour React
EXPOSE 3000

# Commande par défaut
CMD ["npm", "start"]