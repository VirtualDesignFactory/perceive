<?php
namespace vdf\perceive;

class View
{
    private $controller = null;

    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function dataIn($data = null)
    {
        if (empty($data)) {
            // There is no incoming data so this is the first page load
            $this->draw();
        } else {
            // There is incoming data
            // TODO: perform more intellegent actions with incoming data
            foreach ($data as $name => $value) {
                echo $name . ' : ' . $value . '<br />';
            }
        }
    }

    private function draw()
    {
        ?>

        <html>
            <head>
                <title>Percieve Database</title>
            </head>
            <body>
                <form name="test" method="post">
                    <input type="text" name="input1" /><br />
                    <input type="text" name="input2" /><br />
                    <input type="text" name="input3" /><br />
                    <input type="text" name="input4" /><br />
                    <button type="submit">Push Me!</button><br />
                </form>
            </body>
        </htmk>

        <?php
    }
}
