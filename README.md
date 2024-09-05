# Minsihoue - La Maison de l'Enseignant

**Minsihoue** est une plateforme en ligne dédiée aux enseignants du primaire pour faciliter le partage de ressources pédagogiques. Elle vise à offrir un espace collaboratif où les enseignants peuvent échanger des informations, des outils pédagogiques et des idées pour améliorer leurs pratiques éducatives.
Minsihoue en français, « la maison de l’enseignant » est une plateforme en ligne conçue
pour faciliter le partage de ressources entre instituteurs. Elle vise à offrir un espace où les
enseignants peuvent échanger des informations, des outils pédagogiques et des idées pour
améliorer leurs pratiques éducatives. Conçu pour être un outils de collaboration en ligne entre les enseignants, il facilitera le partage d'expériences, la collaration et la mutualisation des ressources du métier de l'enseignant. 
<br>
## Fonctionnalités principales

- **Partage de ressources** : Téléchargement et consultation de documents pédagogiques.
- **Collaboration** : Espace de discussion et d’échange entre enseignants.
- **Mutualisation des expériences** : Partage d’idées et d’expériences pour améliorer la qualité de l’enseignement.
- **Système de paiement sécurisé** : Intégration de l'API FedaPay pour les transactions.
- **Notifications par email** : Utilisation de l'API d'envoi de mails pour les notifications importantes.

## Technologies utilisées

- **Framework** : Laravel 11
- **Base de données** : MySQL
- **Frontend** : HTML, CSS, jQuery, Ajax
- **Paiement** : Intégration de l'API FedaPay
- **Envoi d'emails** : API d'envoi de mail

## Installation et configuration

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/Zohade/Enseignant
   cd minsihoue
   ```

2. **Installer les dépendances** :
   ```bash
   composer install
   npm install
   ```

3. **Configurer l'application** :
   Copier le fichier `.env.example` et le renommer en `.env`, puis ajuster les paramètres de la base de données, de l'API FedaPay et de l'API d'envoi de mails.

   ```bash
   php artisan key:generate
   ```

4. **Migrer la base de données** :
   ```bash
   php artisan migrate
   ```

5. **Lancer le serveur local** :
   ```bash
   php artisan serve
   ```

## Contribution

Les contributions sont les bienvenues. Si vous souhaitez contribuer, veuillez suivre ces étapes :

1. Forker le projet
2. Créer une nouvelle branche (`git checkout -b feature/feature-name`)
3. Committer vos changements (`git commit -m 'Add feature'`)
4. Pousser sur la branche (`git push origin feature/feature-name`)
5. Ouvrir une pull request

---

