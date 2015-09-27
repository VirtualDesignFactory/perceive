<?php
namespace vdf\perceive;

class Controller
{
    private $model = null;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    /**
     * Destructor
     * unset class variables
     */
    public function __destruct()
    {
        unset($this->model);
    }

    public function dataIn($post_var)
    {
        if (empty($post_var)) {
            // This is the first page load
            $this->model->dataIn();
        } else {
            // Post data is populated
            // TODO: parse incoming data and give more intellegent info to the model
            $this->model->dataIn($post_var);
        }
    }
}
