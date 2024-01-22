<?php
function getJson(){
    try {
        // Connexion à la base de données
        $file_db = new PDO('sqlite:formulaire.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // Création de la table si elle n'existe pas
        $file_db->exec("CREATE TABLE IF NOT EXISTS Formulaire (
            id INTEGER PRIMARY KEY,
            json_path TEXT)");

        // Données à insérer
        $data = array(
            array('id' => '1', 'json_path' => 'test.json')
        );

        // Requête d'insertion préparée
        $insert = "INSERT INTO Formulaire (id, json_path) VALUES (:id, :json_path)";
        $stmt = $file_db->prepare($insert);

        // Déclaration de la variable $id à l'extérieur de la boucle foreach
        $id = null;
        
        foreach ($data as $row) {
            $id = $row['id'];
            $json_path = $row['json_path'];

            // Binding des paramètres et exécution de la requête
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':json_path', $json_path);
            $stmt->execute();
        }

        // Requête de sélection
        $stmt = $file_db->prepare("SELECT json_path FROM Formulaire WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Récupération des résultats sous forme de tableau associatif
        $json = $stmt->fetch(PDO::FETCH_ASSOC);

        // Affichage du résultat

        // Fermeture de la connexion à la base de données
        $file_db = null;

        return $json['json_path'];
    } catch(PDOException $ex) {
        // Gestion des exceptions
        echo $ex->getMessage();
        return null;
    }
}
?>
