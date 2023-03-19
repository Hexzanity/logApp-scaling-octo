<?php
    require_once 'vendor/autoload.php';
    $faker = Faker\Factory::create();

    $db = mysqli_connect("localhost","root","Loveisshit143","recordsapp");

    $db->query("UPDATE FROM office");

    for ($i=0; $i < 200; $i++){
        $db->query("
            INSERT INTO office (name, contactnum,email, address,city,country,postal)
            VALUES ('$faker->company','$faker->e164PhoneNumber','$faker->email',
            '$faker->address','$faker->citySuffix','$faker->city,'$faker->country,'$faker->postcode)
        ");
    }
    if($i == 200){
        break;
    }
?>