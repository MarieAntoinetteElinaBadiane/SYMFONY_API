<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationControllerTest extends WebTestCase
{
    public function testpartOk()
    {
        $part = static::createClient();
        
        $crawler = $part->request('POST', '/api/part',array(),array(),
        array('CONTENT_TYPE'=>"application/json"),array(
        '{"mat":"mame1994","ninea":"amyguediawaye","rs":"ag4","rc":"mag2"}',
        '{"mat":"kimora97","ninea":"mamaguisse97","rs":"mabo9","rc":"guisse7"}',
        '{"mat":"gainde88","ninea":"abasse199","rs":"diatta9","rc":"ndiaye8"}'));
        $rep=$part->getResponse();
        var_dump($rep);
        $this->assertSame(201,$part->getResponse()->getStatusCode());
    }
}
