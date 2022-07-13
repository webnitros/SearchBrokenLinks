<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 13.07.2022
 * Time: 08:30
 */

namespace Tests;

use App\Finder;
use Tests\TestCase;

class FinderTest extends TestCase
{

    public function testReplace()
    {

        $Finder = new Finder();
        $content = 'Какой то текст <a class="custom_class" href="https://bustep.ru/">тут новый текст</a> Какой то текст <a href="http://test.ru/custom2/">тут новый текст</a> <a href="http://test.ru/custom2/"><img src="#" alt=""></a>';
        $id = 100;
        $urls = $Finder->createDetour($id)->find($content)->status()->urls();

        $pq = $Finder->updateHref(1, 'http://example.ru/');
        self::assertEquals('<a href="http://example.ru/">тут новый текст</a>', $pq->htmlOuter());

        #$outer = $Finder->htmlOuter();
        $Finder->closed();

    }

    public function testSetSite()
    {

    }
}
