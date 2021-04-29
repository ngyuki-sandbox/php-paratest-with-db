<?php
namespace Test;

use App\ConnectionFactory;
use PHPUnit\Framework\TestCase;

class Sample8Test extends TestCase
{
    public function test()
    {
        $pdo = (new ConnectionFactory())->create();
        $pdo->prepare('delete from t')->execute();
        $pdo->prepare('insert into t values (1+sleep(1))')->execute();
        $rows = $pdo->query('select * from t')->fetchAll();
        $this->assertCount(1, $rows);
    }
}
