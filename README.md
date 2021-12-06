Voici un formulaire d'inscription et de connexion d'une page d'accueil Facebook en HTML, CSS, Javascript et PHP.

Les étapes à réaliser afin d'enregistrer un membre dans la base de données : 

- Lancer le serveur.
- Se connecter sur phpmyadmin.
- Aller dans les scripts inscription.php et connexion.php. Remplacer "nom_de_la_base_de_donnees" par le nom de la base de données que vous souhaitez.
- Créer la base de données sur phpmyadmin au nom que vous avez choisi.
- Une fois la base de données créée, aller sur http://localhost:8888/Facebook/inscription.php . La table "membres" se crée automatiquement, ainsi que les différents champs.
- Vous êtes ensuite redirigé vers une page vous indiquant "Vous êtes inscrit avec succès!". Les données rentrées sont enregistrées dans la base de données précédemment créee.
- Vous pouvez maintenant vous connecter à partir de l'URL http://localhost:8888/Facebook/inscription.php , grâce aux identifiants rentrés lors de l'inscription.
