!! REMOVE AFTER DEPLOYMENT !!
username : devuser
password : devuser1234


Tasks :
- Log in as another user
- Fake admin user and add a game
- Inject script on another person's browser
- delete all comments in one action


Repository forked from : https://github.com/jvspeed74/PHP-Procedural-Web-Application

# Projet Pédagogique : Illustration des Failles de Sécurité en PHP

Ce projet vise à sensibiliser les développeurs débutants aux erreurs de sécurité courantes en PHP fonctionnel et à leur impact sur les applications web. Chaque exemple montre une faille de sécurité avec son explication et une solution pour la corriger.

---

## 1. Injection SQL
### Exemple :
Un formulaire d'authentification utilisant des requêtes SQL non préparées :
```php
<?php
$username = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect('localhost', 'root', '', 'test');
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Bienvenue, $username!";
} else {
    echo "Identifiants incorrects.";
}

```
Problème : Un utilisateur peut entrer ' OR '1'='1 dans les champs pour contourner l'authentification.
Solution : Utilisez des requêtes préparées avec PDO ou mysqli_stmt


## 2. XSS (Cross-Site Scripting)
###   Exemple :
   Afficher un commentaire utilisateur sans le nettoyer :

```php
<?php
$comment = $_POST['comment'];
echo "Votre commentaire : $comment";
?>
```

Problème :
Un utilisateur peut soumettre <script>alert('XSS');</script> pour exécuter du code malveillant.

Solution :
Échappez les caractères spéciaux avec htmlspecialchars() lors de l'affichage :

```php
<?php
echo htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
?>
```

## 3. Inclusion de fichier non sécurisé
###   Exemple :
   Inclure un fichier via un paramètre utilisateur :

```php
<?php
$page = $_GET['page'];
include($page . '.php');
?>
```
Problème :
Un attaquant peut accéder à des fichiers sensibles comme /etc/passwd ou exécuter du code malveillant.

Solution :
Limitez les inclusions avec une liste blanche :

```php
<?php
$allowed_pages = ['home', 'about', 'contact'];
if (in_array($page, $allowed_pages)) {
    include($page . '.php');
} else {
    echo "Page non autorisée.";
}
?>
```

## 4. Téléchargement de fichiers non sécurisé
###   Exemple :
   Accepter un fichier sans vérifier son type ni limiter son extension :

```php
<?php
if (isset($_FILES['file'])) {
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
    echo "Fichier téléchargé avec succès.";
}
?>
```
Problème :
Un attaquant peut télécharger un script PHP malveillant et l'exécuter.

Solution :
Vérifiez les extensions et limitez les types MIME :

```php
<?php
$allowed_extensions = ['jpg', 'png', 'gif'];
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
if (in_array($ext, $allowed_extensions)) {
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
} else {
    echo "Extension non autorisée.";
}
?>

```
## 5. Révélation d'informations sensibles
### Exemple :
   Afficher les erreurs directement dans le navigateur :

```php
<?php
$conn = mysqli_connect('localhost', 'root', '', 'test');
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
```

Problème :
L'affichage de l'erreur peut révéler des informations sensibles, comme les paramètres de la base de données.

Solution :
Configurez display_errors à Off en production dans le fichier php.ini :

```
ini
Copier le code
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log

```
## 6. Exécution de code non sécurisé
### Exemple :
Passer des commandes système directement via une entrée utilisateur :

```php
<?php
$cmd = $_GET['cmd'];
echo shell_exec($cmd);
?>
```
Problème :
Un attaquant peut exécuter des commandes système comme rm -rf /.

Solution :
Validez et nettoyez les entrées utilisateur avant de les utiliser :

```php
<?php
$allowed_commands = ['ls', 'whoami'];
if (in_array($_GET['cmd'], $allowed_commands)) {
    echo shell_exec($_GET['cmd']);
} else {
    echo "Commande non autorisée.";
}
?>

```

## 7. Session Fixation
###   Exemple :
   Accepter un identifiant de session depuis une URL :

```php
<?php
session_id($_GET['sid']);
session_start();
?>
```
Problème :
Un attaquant peut utiliser cette fonctionnalité pour voler une session active.

Solution :
Régénérez les IDs de session après l'authentification avec session_regenerate_id() :

```php
<?php
session_start();
if (isset($_POST['login'])) {
    session_regenerate_id();
    $_SESSION['user'] = $username;
}
?>
```
## 8. Manque de validation des entrées
###   Exemple :
   Calculer une somme sans valider les paramètres :


```php
<?php
$a = $_GET['a'];
$b = $_GET['b'];
echo "Somme : " . ($a + $b);
?>

```

Problème :
Des données non numériques peuvent être utilisées pour des comportements inattendus.

Solution :
Validez les données avec filter_var() ou des expressions régulières :


```php
<?php
$a = filter_var($_GET['a'], FILTER_VALIDATE_FLOAT);
$b = filter_var($_GET['b'], FILTER_VALIDATE_FLOAT);
if ($a !== false && $b !== false) {
    echo "Somme : " . ($a + $b);
} else {
    echo "Entrées invalides.";
}
?>
```
