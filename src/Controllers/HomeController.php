<?php

namespace Catalog\Controllers;

use Catalog\Http\HTMLResponse;
use Catalog\Http\Response;

/**
 * Class HomeController
 *
 * @package Catalog\Controllers
 */
class HomeController extends FrontController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        // echo 'HomeController constructed<br>';
        parent::__construct();
    }

    /**
     * @return Response
     */
    public function renderHomePage(): Response
    {
        //return new TestResponse('Test response here...');
        $htmlResponse = new HTMLResponse();
        $htmlResponse->setContent(
            '<table style="width:30%">
                         <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Age</th>
                         </tr>
                         <tr>
                            <td>Jill</td>
                            <td>Smith</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <td>Eve</td>
                            <td>Jackson</td>
                            <td>94</td>
                        </tr>
                     </table>');

        //$content = file_get_contents(__DIR__ . '../TemplateView.php',1);
        //$htmlResponse->setContent($content);

        return $htmlResponse;
    }
}