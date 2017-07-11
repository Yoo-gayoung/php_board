<?php
require_once 'dao.php';

class BoardService{
	
	private $dao;
	
	public function __construct(){
		$this->dao = new BoardDao();
	}
	
	public function addArticle($article){
		$this->dao->insert($article);
	}
	
	public function getByNum($num){
		return $this->dao->selectByNum($num);
	}
	
	public function getByWriter($writer){
		return $this->dao->selectByWriter($writer);
	}
	
	public function getByCategory($category){
		return $this->dao->selectByCategory($category);
	}
	
	public function getByTitle($title){
		return $this->dao->selectByTitle($title);
	}
	
	public function getAll(){
		return $this->dao->selectAll();
	}
	
	public function editArticle($article){
		$this->dao->update($article);
	}
	
	public function del($num){
		$this->dao->delete($num);
	}
}

?>