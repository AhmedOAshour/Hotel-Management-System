<?php
class Pages extends Controller{
    private $postModel;
    public function __construct(){
        $this->postModel = $this->LoadModel('Post');
    }

    public function index(){
        $data = [
            'title' => 'MIU SE305 Blog',
        ];

        $this->loadView('pages/index', $data);
    }

    public function about(){
        $data = [
            'title' => 'About Us',
        ];

        $this->loadView('pages/about', $data);
    }

    public function test(){
        $data = [
            'val1' => 'Test MVC',
        ];

        $this->loadView('pages/test', $data);
    }
}
