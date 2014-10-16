<!--
define('USER',"login");
define('PASSWD',"votre password");
define('SERVER',"dbmary");
define('Base',"votre base");

function connect_bd(){
	$dsn="mysql:dname=".BASE.";host=".SERVER;
		try{
		$connexion=new PDO($dsn,USER,PASSWD);
		}
		catch(PDOException $e){
		printf("Échec de connexion : %s\n, $e->getMessage());
		exit();
		}
	return $connexion;
}

-->
	
