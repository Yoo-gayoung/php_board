<?php
require_once 'service.php';

class HobbyService{
	private $dao;
	public function __construct(){
		$this->dao = new HobbyDao();
	}
	public function getAll(){
		return $this->dao->selectAll();
	}
}

class BoarderController{
	private $bService;
	private $hService;
	private $action;
	private $data;
	private $view;
	private $article;
	private $category;
	
	public function __construct($action){
		$this->bService = new BoardService();
		$this->hService = new HobbyService();
		$this->action = $action;
	}
	public function run(){
		switch ($this->action){
			case "writeForm":
				$this->writeForm();
				break;
			case "write":
				$this->write();
				return;
			case "listByNum":
				$this->listByNum();
				break;
			case "listByWriter":
				$this->listByWriter();
				break;
			case "listByTitle":
				$this->listByTitle();
				break;
			case "listByCategory":
				$this->listByCategory();
				break;
			case "list":
				$this->boardlist();
				break;
			case "edit":
				$this->edit();
				return;
			case "del":
				$this->del();
				return;
		}
		require 'view/'.$this->view;
	}
	
	public function writeForm(){
		$this->getCategory();
		$this->view = "writeForm.php";
	}
	
	public function write(){
		$article= new Article(null,null,$_POST['title'],$_POST['content'],$_POST['writer'],$_POST['category']);
		$this->bService->addArticle($article);
		$this->action="list";
		$this->run();
	}
	public function listByNum(){
		$num=$_GET['num'];
		$this->data = $this->bService->getByNum($num);
		$this->getCategory();
		$this->view = "detailForm.php";
	}
	
	public function listByWriter(){
		$writer=$_GET['writer'];
		$this->article = $this->bService->getByWriter($writer);
		$this->view = "searchlistForm.php";
	}
	
	public function listByTitle(){
		$title=$_GET['title'];
		$this->article = $this->bService->getByTitle($title);
		$this->view = "searchlistForm.php";
	}
	
	public function listByCategory(){
		$category=$_POST['category'];
		$this->data = $this->bService->getByCategory($category);
		$this->getCategory();
		$this->view = "listForm.php";
	}
	
	public function boardlist(){
		$this->data = $this->bService->getAll();
		$this->getCategory();
		$this->view = "listForm.php";
	}
	
	public function getCategory(){
		$this->category = $this->hService->getAll();
	}
	
	public function edit(){
		$article= new Article($_POST['num'],null,$_POST['title'],$_POST['content'],$_POST['writer'],$_POST['category']);
		$this->bService->editArticle($article);
		$this->action="list";
		$this->run();
	}
	
	public function del(){
		$num=$_GET['num'];
		$this->bService->del($num);
		$this->getCategory();
		$this->action="list";
		$this->run();
	}	
}
?>