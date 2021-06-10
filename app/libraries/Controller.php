<?php
/*
 * Base Controller
 * Loads the models and views
 */
class Controller
{
    // Load model
    public function loadModel($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    // Load view
    public function loadView($view, $data = [])
    {
        // Check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }
}
