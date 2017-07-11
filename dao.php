<?php
require_once 'dto.php';

class HobbyDao {
	private $conn = null;
	public function connect() {
		try {
			$this->conn = new PDO ( 'mysql:host=localhost;dbname=mydb;charset=utf8', 'hr', 'hr' );
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->conn->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
	}
	public function disconnect() {
		$this->conn = null;
	}
	public function selectAll() {
		$arr = array ();
		$this->connect ();
		$sql = "select * from hobby";
		$result = null;
		try {
			$result = $this->conn->query ( $sql );
			$cnt = $result->rowCount ();
			if ($cnt > 0) {
				while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Hobby ( $row ['id'], $row ['name'] );
				}
			}
		} catch ( Exception $e ) {
			print $e->getMessage ();
		}
		$this->disconnect ();
		return $arr;
	}
}

class BoardDao{

	private $conn = null;
	
	public function connect() {
		try {
			$this->conn = new PDO ( 'mysql:host=localhost;dbname=mydb;charset=utf8', 'hr', 'hr' );
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->conn->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
	}
	
	public function disconnect() {
		$this->conn = null;
	}
	
	public function insert($article) { //글 저장
		$this->connect();
		try {
			$sql = "insert into board values(null,now(),?,?,?,?)";
			$stm = $this->conn->prepare ( $sql );
			$stm->bindValue ( 1, $article->getTitle () );
			$stm->bindValue ( 2, $article->getContent () );
			$stm->bindValue ( 3, $article->getWriter () );
			$stm->bindValue ( 4, $article->getCategory () );
			$stm->execute ();
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
		$this->disconnect();
	}
	public function selectByNum($num) { //글번호로 검색하여 글 객체 하나 반환
		$arti = null;
		$this->connect();
		try {
			$sql = "select * from board where num=?";
			$stm = $this->conn->prepare ( $sql );
			$stm->bindValue ( 1, $num );
			$stm->execute ();
			$cnt = $stm->rowCount();
			if($cnt > 0){
				$row = $stm->fetch(PDO::FETCH_ASSOC);
				$arti = new Article($row['num'],$row['wdate'],$row['title'], $row['content'],$row['writer'],$row['category']);
			}
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
		$this->disconnect();
		return $arti;
	}
	
	public function selectByWriter($writer){ //작성자로 검색하여 글 객체를 배열에 담아 반환
		$arr = array();
		$this->connect();
		try {
			$sql = "select * from board where writer=?";
			$stm = $this->conn->prepare ( $sql );
			$stm->bindValue ( 1, $writer );
			$stm->execute ();
			$cnt = $stm->rowCount();
			if($cnt > 0){
				while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Article( $row['num'],$row['wdate'],$row['title'], $row['content'],$row['writer'],$row['category'] );
				}
			}
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
		$this->disconnect();
		return $arr;
	}
	
	public function selectByCategory($category){ //카테고리로 글검색하여 배열에 담아 반환
		$arr = array();
		$this->connect();
		try {
			$sql = "select * from board where category=?";
			$stm = $this->conn->prepare ( $sql );
			$stm->bindValue ( 1, $category );
			$stm->execute ();
			$cnt = $stm->rowCount();
			if($cnt > 0){
				while ( $row = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Article( $row['num'],$row['wdate'],$row['title'], $row['content'],$row['writer'],$row['category'] );
				}
			}
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
		$this->disconnect();
		return $arr;
	}
	
	public function selectByTitle($title){ //제목으로 검색하여 배열에 담아 반환
		$arr = array();
		$this->connect();
		try {
			$sql = "select * from board where title like '%".$title."%'";
			$stm = $this->conn->prepare ( $sql );
			$stm->execute ();
			$cnt = $stm->rowCount();
			if($cnt > 0){
				while ( $row = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Article( $row['num'],$row['wdate'],$row['title'], $row['content'],$row['writer'],$row['category'] );
				}
			}
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
		$this->disconnect();
		return $arr;
	}
	
	public function selectAll() { //글 전체 검색
		$arr = array ();
		$this->connect ();
		$sql = "select * from board";
		$result = null;
		try {
			$result = $this->conn->query ( $sql );
			$cnt = $result->rowCount ();
			if ($cnt > 0) {
				while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
					$arr [] = new Article( $row['num'],$row['wdate'],$row['title'], $row['content'],$row['writer'],$row['category'] );
				}
			}
		} catch ( Exception $e ) {
			print $e->getMessage ();
		}
		$this->disconnect ();
		return $arr;
	}
	
	public function update($article) { //제목, 내용, 카테고리를 수정(num)
		$this->connect();
		try {
			$sql = "update board set wdate=now(), title=?, content=?, category=? where num=?";
			$stm = $this->conn->prepare ( $sql );
			$stm->bindValue ( 1, $article->getTitle () );
			$stm->bindValue ( 2, $article->getContent () );
			$stm->bindValue ( 3, $article->getCategory () );
			$stm->bindValue ( 4, $article->getNum () );
			$stm->execute();
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
		$this->disconnect();
	}
	
	public function delete($num) { //글삭제
		$this->connect();
		try {
			$sql = "delete from board where num=?";
			$stm = $this->conn->prepare ( $sql );
			$stm->bindValue ( 1, $num );
			$stm->execute ();
		} catch ( PDOException $e ) {
			print $e->getMessage ();
		}
		$this->disconnect();
	}
}


?>