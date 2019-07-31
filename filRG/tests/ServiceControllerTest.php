<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ServiceControllerTest extends TestCase
{
// tests/Util/CalculatorTest.php

    public function testregisterOk()
    {
        $user = static::createClient();
 
        $crawler = $user->request('POST', '/api/register');

        $values = json_decode(getContent());
        if(isset($values->username,$values->password)) {
            $user = new User();
            $user->setUsername($values->username);
            $user->setPassword(encodePassword($user, $values->password));
            $user->setRoles($values->roles);
            $user->setNom($values->nom);
            $user->setPrenom($values->prenom);
            $crawler = $values->submit($user);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(1,
            $crawler->filter('li:contains("This value is not valid.")')->count()
        );
    }
    }
}


