<?php
// loome mysql serveriga ühenduse, kui ebaõnnestub siis saab mysql errori
mysql_connect(DATABASE_HOSTNAME, DATABASE_USERNAME) or mysql_error();

// valime andmebaasi
mysql_select_db(DATABASE_DATABASE) or mysql_error();
// serverisse saadetavad kodeeringud on utf8 kodeeringus
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER 'utf8'");

function q($sql, &$query_pointer=NULL, $debug = FALSE)
{
	if ($debug) {
		print"<pre>$sql</pre>";
	}
    $query_pointer=mysql_query($sql)or mysql_error();
    switch (substr($sql,0,4)){
        case 'SELE':
            return mysql_num_rows($query_pointer);
        case 'INSE':
            return mysql_insert_id();
        default:
            return mysql_affected_rows();
    }
}
function get_all($sql){
	$q=mysql_query($sql) or exit (mysql_error());
	while (($result[]=mysql_fetch_assoc($q)) || array_pop($result)){
			;
	}
	return $result;
}
// meetod get_one  kutsutakse välja  näiteks auth.php-s kus antakse talle parameeter $sql (päring)
function get_one($sql, $debug = FALSE)
{
	// juhul kui debugi väärtus on true, siis ta läbib selle koodibloki.
	if ($debug) {
		print"<pre>$sql</pre>";
	}
	// loome muutuja $q mille väärtuseks on kas päring ($sql) või läbikukkumise puhul error.
	$q = mysql_query($sql) or exit(mysql_error());

	// Juhul kui mysql_num_rows($q)  tagastab väärtuse false, siis väljutakse funktsioonist
	if (mysql_num_rows($q) === FALSE) {
		exit($sql);
	}
	// uus muutuja $result, millesse salvestub päringutulemus massiivina
	$result = mysql_fetch_row($q);
	// Kontrollitakse, kas $result on massiiv ja kas tal on sisu. , siis tagastame $result esimese elemendi,
	// vastasel juhul tagastame 0
	return is_array($result) && count($result) > 0 ? $result[0] : NULL;
}
