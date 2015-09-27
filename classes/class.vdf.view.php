<?php
namespace vdf\perceive;

class View
{
    private $controller = null;

    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Destructor
     * unset class variables
     */
    public function __destruct()
    {
        unset($this->controller);
    }

    public function dataIn($data = null)
    {
        if (empty($data)) {
            // There is no incoming data so this is the first page load
            $this->draw();
        } else {
            // There is incoming data
            // TODO: perform more intellegent actions with incoming data
            $this->draw();
            foreach ($data as $name => $value) {
                echo $name . ' : ' . $value . '<br />';
            }
        }
    }

    private function draw()
    {
        $header = new Header();
    }
}
