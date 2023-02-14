<?php

namespace App\eCommerce\Model\Repository;
//require_once __DIR__ . '/../Config/Conf.php';
use App\eCommerce\Config\Conf;
use PDO;

class DataBaseConnection
{


    private static ?DataBaseConnection $instance = null;
    private PDO $pdo;


    public static function fonctionTestAffichage(): void
    {
        echo "<script> alert('test');</script>";
    }

    public static function getPdo(): PDO
    {
        return static::getInstance()->pdo;
    }

    public function __construct()
    {
        $hostname = Conf::getHostname();
        $databaseName = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();



        // Connexion à la base de données
        // Le dernier argument sert à ce que toutes les chaines de caractères
        // en entrée et sortie de MySql soit dans le codage UTF-8
        $this->pdo = new PDO("mysql:host=$hostname;dbname=$databaseName", $login, $password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    }


    private static function getInstance()
    {
        // L'attribut statique $pdo s'obtient avec la syntaxe static::$pdo
        // au lieu de $this->pdo pour un attribut non statique
        if (is_null(static::$instance))
            // Appel du constructeur
            static::$instance = new DataBaseConnection();
        return static::$instance;
    }


}


?>
