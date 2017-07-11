<?php
//DTO

class Hobby{
	private $id;
	private $name;
	
	public function __construct($id, $name){
		$this->id = $id;
		$this->name = $name;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function getName(){
		return $this->name;
	}
}

class Article{
	private $num;
	private $wdate;
	private $title;
	private $content;
	private $writer;
	private $category;
	
	public function __construct($num,$wdate,$title,$content,$writer,$caregory){
		$this->num=$num;
		$this->wdate=$wdate;
		$this->title=$title;
		$this->content=$content;
		$this->writer=$writer;
		$this->category=$caregory;
	}
	
	public function setNum($num){
		$this->num=$num;
	}
	
	public function getNum(){
		return $this->num;
	}
	
	public function setWdate($wdate){
		$this->wdate=$wdate;
	}
	
	public function getWdate(){
		return $this->wdate;
	}
	
	public function setTitle($title){
		$this->title=$title;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function setContent($content){
		$this->content=$content;
	}
	
	public function getContent(){
		return $this->content;
	}
	
	public function setWriter($writer){
		$this->writer=$writer;
	}
	
	public function getWriter(){
		return $this->writer;
	}
	
	public function setCategory($category){
		$this->category=$category;
	}
	
	public function getCategory(){
		return $this->category;
	}
	
	public function __toString(){ //객체를 설명하는 메소드
		return "num:".$this->num.", wdate:".$this->wdate.", title:".$this->title.", content:".$this->content.", writer:".$this->writer.", category:".$this->category."<br>";
	}
}
	
?>