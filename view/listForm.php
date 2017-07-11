<html>
<head>
</head>
<body>
<h3>게시판</h3>
<a href='/article/index.php?action=writeForm'>글쓰기</a><br>

<form action="/article/index.php?action=listByCategory" method="post" >
<select name="category">
<?php 
foreach ($this->category as $c){
	print "<option value=".$c->getId().">".$c->getName()."</option>";
}
?>
</select>
<input type="submit" value="카테고리 별로 보기" >
</form>
<table border="2">
<tr>
<th>번호</th>
<th>제목</th>
<th>작성자</th>
</tr>
<?php 
   foreach ($this->data as $a){
      print "<tr>";
      print "<td>".$a->getNum()."</td>";
      print "<td><a href='/article/index.php?action=listByNum&num=".$a->getNum()."'>".$a->getTitle()."</a></td>";
      print "<td>".$a->getWriter()."</td>";
      print "</tr>";
   }
?>
</table>

</body>
</html>