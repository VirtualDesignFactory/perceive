<?php
namespace vdf\perceive;

/**
 * Model Class - Application logic and database opperations
 */
class Model
{
    /**
     * @var $view   [stores the View object]
     * @var $db     [stores a handle to the database]
     */
    private $view = null;
    private $db = null;

    /**
     * Stores a database handle from the static getHanle()
     * method from the Database class
     */
    public function __construct()
    {
        $this->db = Database::getHandle();
    }

    /**
     * Sets the view object
     * @param [View] $view      - Stores the View in a private variable for later reference
     */
    public function setView(View $view)
    {
        $this->view = $view;
    }

    /**
     * Takes incoming data from the Controller class and performs application logic on it
     * @param  [array] $data    - Incomming array from the Controller class
     * @return [void]           - Returns nothing
     */
    public function dataIn($data = null)
    {
        if (empty($data)) {
            // There is no incoming data so this is the first page load
            $this->view->dataIn();

        } else {
            // There is incoming data
            // TODO: perform more intellegent operations with data
            $this->view->dataIn($data);
        }
    }
}
